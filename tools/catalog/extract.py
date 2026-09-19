"""Extract saved Smorodina product HTML for review; never connects to a database."""
import argparse
import hashlib
import html
import io
import json
import re
from pathlib import Path
from urllib.parse import urljoin, urlparse
from urllib.request import Request, build_opener, HTTPRedirectHandler

from bs4 import BeautifulSoup, Comment
from PIL import Image

HOST = 'smorodinacosmetic.com'
ALLOWED_TAGS = {'p', 'br', 'b', 'strong', 'i', 'em', 'u', 'ul', 'ol', 'li', 'div', 'span'}


def clean_html(node):
    if node is None:
        return None
    fragment = BeautifulSoup(node.decode_contents(), 'html.parser')
    for comment in fragment.find_all(string=lambda s: isinstance(s, Comment)):
        comment.extract()
    for tag in fragment.select('script, style, iframe, object, form, input, button'):
        tag.decompose()
    for tag in list(fragment.find_all(True)):
        if tag.name not in ALLOWED_TAGS:
            tag.unwrap()
        else:
            tag.attrs = {}
    return str(fragment).strip() or None


def text(node):
    return node.get_text(' ', strip=True) if node else None


def extract(path):
    raw = path.read_text(encoding='utf-8-sig')
    soup = BeautifulSoup(raw, 'html.parser')
    page = soup.select_one('.product-page')
    if not page or not page.select_one('h1'):
        raise ValueError('Нет карточки товара: возможно, это проверка браузера или страница каталога.')
    canonical = soup.select_one('link[rel="canonical"]')
    url = canonical.get('href', '') if canonical else ''
    parsed = urlparse(url)
    if parsed.scheme != 'https' or parsed.hostname != HOST or not parsed.path.startswith('/catalog/'):
        raise ValueError('Нет корректного canonical URL карточки Smorodina.')
    price_node = page.select_one('.product-page__top__price [data-product-price]')
    price = price_node.get('data-product-price', '') if price_node else ''
    if not re.fullmatch(r'\d+', price):
        raise ValueError('Цена не найдена или требует ручной проверки.')
    description_link = page.select_one('.js-detail-text')
    description = description_link.find_next_sibling('div', class_='html-detail-text') if description_link else None
    fields = {
        'name': text(page.select_one('h1')),
        'price': int(price),
        'description_short': clean_html(page.select_one('.product-page__top__short-about')),
        'description': clean_html(description),
        'volume': text(page.select_one('.simple-product-page__top__value')),
        'usage': None, 'ingredients': None, 'packaging': None,
    }
    for block in page.select('.product-page__top__sub-text'):
        title = text(block.select_one('.product-page__top__sub-text__title'))
        key = {'Применение': 'usage', 'Активные ингредиенты': 'ingredients', 'Упаковка': 'packaging'}.get(title)
        if key:
            detail = block.select_one('.html-detail-text')
            fields[key] = clean_html(detail or block.select_one('.product-page__top__sub-text__desc'))
    images = []
    for node in page.select('.product-page__gallery-slides .product-page__gallery-item img'):
        source = node.get('data-src') or node.get('src')
        if not source:
            continue
        source = urljoin(url, source)
        p = urlparse(source)
        if p.scheme != 'https' or p.hostname != HOST or not p.path.startswith('/upload/'):
            raise ValueError('Неподдерживаемая ссылка на изображение: требуется ручная проверка.')
        if source not in [i['source_url'] for i in images]:
            images.append({'source_url': source, 'role': 'main' if not images else 'gallery', 'local_path': None, 'status': 'not_downloaded'})
    warnings = [f'На странице отсутствует поле {key}; значение не придумано.' for key in ['volume', 'packaging'] if not fields[key]]
    if not fields['description'] or not images:
        raise ValueError('Отсутствует полное описание или галерея; карточка не готова к разбору.')
    old_price = text(page.select_one('.product__price_old'))
    return {
        'format_version': 1, 'source_url': url, 'source_html_sha256': hashlib.sha256(raw.encode()).hexdigest(),
        'source_slug': parsed.path.rstrip('/').split('/')[-1],
        'category_source_slug': parsed.path.split('/')[2], 'subcategory_source_slug': parsed.path.split('/')[3],
        'source_old_price': int(re.sub(r'\D', '', old_price)) if old_price else None,
        'fields': fields, 'images': images,
        'review': {'approved': False, 'existing_product_id': None, 'category_id': None, 'subcategory_id': None, 'series_id': None},
        'warnings': warnings + ['Соответствие старому товару и решение по цене требуют проверки.'],
    }


class NoRedirects(HTTPRedirectHandler):
    def redirect_request(self, req, fp, code, msg, headers, newurl):
        return None


def download_images(product, output):
    """Stop at the first failure/challenge. Do not save HTML as a JPEG."""
    opener = build_opener(NoRedirects())
    for index, item in enumerate(product['images']):
        try:
            with opener.open(Request(item['source_url']), timeout=20) as response:
                if not response.headers.get_content_type().startswith('image/'):
                    raise ValueError('Сервер вернул не изображение (возможно, проверку браузера).')
                data = response.read(20 * 1024 * 1024 + 1)
            if len(data) > 20 * 1024 * 1024:
                raise ValueError('Изображение больше 20 МБ.')
            with Image.open(io.BytesIO(data)) as image:
                fmt = image.format
                dimensions = image.size
                image.verify()
            extension = {'JPEG': '.jpg', 'PNG': '.png', 'WEBP': '.webp', 'GIF': '.gif'}.get(fmt)
            if extension is None:
                raise ValueError('Неподдерживаемый формат изображения.')
            digest = hashlib.sha256(data).hexdigest()
            relative = f'img/products/{product["source_slug"]}/{index + 1:02d}-{digest[:12]}{extension}'
            target = output / 'public' / relative
            target.parent.mkdir(parents=True, exist_ok=True)
            target.write_bytes(data)
            item.update(local_path=relative, status='downloaded', sha256=digest, dimensions=dimensions)
        except Exception as error:
            item.update(status='failed', error=str(error))
            product['warnings'].append('Загрузка остановлена на первой ошибке; импорт не выполнялся.')
            break


def preview(products, output):
    cards = []
    for p in products:
        pictures = ''.join(f'<figure><img src="{html.escape("public/" + i["local_path"], quote=True)}"><figcaption>{i["role"]}</figcaption></figure>' for i in p['images'] if i['local_path'])
        fields = ''.join(f'<h3>{html.escape(k)}</h3><div>{v if k in {"description", "description_short", "usage", "ingredients", "packaging"} else html.escape(str(v))}</div>' for k,v in p['fields'].items() if v is not None)
        warnings = ''.join(f'<li>{html.escape(w)}</li>' for w in p['warnings'])
        cards.append(f'<article><h2>{html.escape(p["fields"]["name"])}</h2><p>Черновик: в базу ничего не записано. Фотографии: {sum(i["status"]=="downloaded" for i in p["images"])}/{len(p["images"])}.</p><a href="{html.escape(p["source_url"], quote=True)}">Исходная карточка</a><p>Зачёркнутая цена: {p["source_old_price"]}</p><ul>{warnings}</ul><section class="photos">{pictures}</section>{fields}</article>')
    (output / 'review.html').write_text('<!doctype html><html lang="ru"><meta charset="utf-8"><meta name="viewport" content="width=device-width"><title>Smorodina — проверка переноса</title><style>body{font:16px/1.6 system-ui;background:#fbf6f8;color:#252126;margin:0}main{max-width:1080px;margin:40px auto;padding:24px}article{background:white;padding:32px;border-radius:24px}h3{color:#8b315a}img{width:100%;height:240px;object-fit:contain}.photos{display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:12px}figure{margin:0}a{color:#8b315a}</style><main><h1>Пробный перенос каталога</h1>' + ''.join(cards) + '</main></html>', encoding='utf-8')


def main():
    parser = argparse.ArgumentParser(description=__doc__)
    parser.add_argument('inputs', type=Path, nargs='+')
    parser.add_argument('--output', type=Path, required=True)
    parser.add_argument('--download-images', action='store_true')
    args = parser.parse_args()
    args.output.mkdir(parents=True, exist_ok=True)
    products = []
    for path in args.inputs:
        product = extract(path)
        if any(p['source_url'] == product['source_url'] for p in products):
            continue
        if args.download_images:
            download_images(product, args.output)
        products.append(product)
    (args.output / 'products.review.json').write_text(json.dumps(products, ensure_ascii=False, indent=2), encoding='utf-8')
    preview(products, args.output)
    print(json.dumps({'products': len(products), 'images_downloaded': sum(i['status']=='downloaded' for p in products for i in p['images']), 'database_modified': False}, ensure_ascii=False))


if __name__ == '__main__':
    main()
