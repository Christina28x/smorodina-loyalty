"""Build an offline catalog review from browser-saved ZIP archives. No database writes."""
import argparse
import hashlib
import html
import io
import json
import posixpath
import re
import zipfile
from collections import Counter
from pathlib import Path, PurePosixPath
from urllib.parse import unquote, urlparse
from bs4 import BeautifulSoup
from PIL import Image
from extract import clean_html, text


def amount(value):
    digits = re.sub(r'[\s\u00a0₽]', '', value or '')
    if not re.fullmatch(r'\d+', digits):
        raise ValueError('Цена отсутствует или не является целым числом рублей')
    return int(digits)


def fragment(node):
    if node is None:
        return None
    # Some saved pages contain an unclosed short-description div. Stop at UI.
    clone = BeautifulSoup(str(node), 'html.parser').find()
    for boundary in clone.select('.js-detail-text, .js-detail-text_sphere, .html-detail-text, .product-page__top__add-block, .product-page__top__sub-texts'):
        for sibling in list(boundary.next_siblings):
            sibling.extract()
        boundary.decompose()
    return clean_html(clone)


def image_member(names, page_path, reference):
    parent = posixpath.dirname(page_path)
    url_path = unquote(urlparse(reference).path)
    exact = posixpath.normpath(posixpath.join(parent, url_path))
    if exact in names and not exact.startswith('../'):
        return exact, 'relative_path'
    # User placed HTML inside its _files folder; browser paths still name _files.
    basename = posixpath.basename(url_path)
    matches = [n for n in names if posixpath.dirname(n) == parent and posixpath.basename(n) == basename]
    if len(matches) == 1:
        return matches[0], 'same_product_folder'
    raise ValueError(f'Нет однозначного локального файла: {basename}')


def parse_page(raw, member, archive_name):
    soup = BeautifulSoup(raw, 'html.parser')
    page = soup.select_one('section.product-page')
    if page is None or page.h1 is None:
        raise ValueError('Нет основной карточки товара')
    parts = PurePosixPath(member).parts
    if len(parts) < 4:
        raise ValueError('Нужна структура категория/подкатегория/товар/HTML')
    category, subcategory = parts[:2]
    canonical = soup.select_one('link[rel="canonical"]')
    url = canonical.get('href') if canonical else None
    source_id = page.get('data-product-id')
    identity = str(source_id or url or member)
    key = category + '-' + hashlib.sha256(identity.encode()).hexdigest()[:16]
    price_block = page.select_one('.product-page__top__price')
    old = price_block.select_one('.product__price_old') if price_block else None
    current = price_block.select_one('[data-product-price]') if price_block else None
    price = amount(text(old)) if old else amount(current.get('data-product-price') if current else None)
    link = page.select_one('.js-detail-text, .js-detail-text_sphere')
    description = link.find_next_sibling(class_='html-detail-text') if link else None
    series_node = page.select_one('.product-page__top__tag')
    series_label = re.sub(r'^линейка\s+', '', text(series_node) or '', flags=re.I).strip() or None
    volume = text(page.select_one('.simple-product-page__top__value, .product-page__top__value_active'))
    volume_source = 'page_field' if volume else None
    if not volume:
        suffix = re.search(r'(\d+(?:[.,]\d+)?\s*(?:мл|ml|г|g))\s*$', text(page.h1), re.I)
        if suffix:
            volume = suffix.group(1)
            volume_source = 'product_name'
    fields = {'name': text(page.h1), 'price': price, 'volume': volume,
              'description_short': fragment(page.select_one('.product-page__top__short-about')),
              'description': clean_html(description), 'usage': None, 'ingredients': None, 'packaging': None}
    for block in page.select('.product-page__top__sub-text'):
        label = text(block.select_one('.product-page__top__sub-text__title'))
        field = {'Применение':'usage', 'Активные ингредиенты':'ingredients', 'Упаковка':'packaging'}.get(label)
        if field:
            fields[field] = clean_html(block.select_one('.html-detail-text') or block.select_one('.product-page__top__sub-text__desc'))
    references = []
    for node in page.select('.product-page__gallery-slides .product-page__gallery-item img'):
        # Saved src is the downloaded file; data-src can still point at the live site.
        ref = node.get('src') or node.get('data-src')
        if ref and ref not in references:
            references.append(ref)
    warnings = []
    if not fields['description']:
        warnings.append('Не найдено полное описание')
    if not references:
        warnings.append('Не найдены фотографии галереи')
    return {'key': key, 'archive': archive_name, 'source_html': member, 'source_url': url,
            'source_product_id': source_id, 'category': category, 'subcategory': subcategory,
            'volume_source': volume_source, 'series_label': series_label, 'series_style_source': series_node.get('style') if series_node else None,
            'price_source': 'regular_struck_through' if old else 'regular_current',
            'fields': fields, 'image_references': references, 'images': [], 'warnings': warnings,
            'approved': False}


def copy_images(z, product, output):
    names = set(z.namelist())
    for index, reference in enumerate(product.pop('image_references')):
        image = {'position': index, 'role': 'main' if index == 0 else 'gallery', 'saved_reference': reference, 'local_path': None}
        try:
            member, method = image_member(names, product['source_html'], reference)
            if z.getinfo(member).file_size > 20 * 1024 * 1024:
                raise ValueError('Файл больше 20 МБ')
            data = z.read(member)
            with Image.open(io.BytesIO(data)) as im:
                fmt, dimensions = im.format, im.size
                im.verify()
            ext = {'JPEG':'.jpg','PNG':'.png','WEBP':'.webp','GIF':'.gif'}.get(fmt)
            if not ext:
                raise ValueError('Неподдерживаемый формат изображения')
            digest = hashlib.sha256(data).hexdigest()
            relative = f'img/products/{product["key"]}/{index + 1:02d}-{digest[:12]}{ext}'
            dest = output / 'public' / relative
            dest.parent.mkdir(parents=True, exist_ok=True)
            dest.write_bytes(data)
            image.update(local_path=relative, dimensions=dimensions, sha256=digest, member=member, match_method=method, status='ready')
            if min(dimensions) < 400:
                product['warnings'].append(f'Небольшое изображение {index+1}: {dimensions[0]}×{dimensions[1]}')
        except Exception as error:
            image.update(status='missing', error=str(error))
            product['warnings'].append(str(error))
        product['images'].append(image)
    product['fields']['image'] = next((i['local_path'] for i in product['images'] if i['role']=='main'), None)


STYLE = 'body{font:16px/1.55 system-ui;margin:0;background:#faf5f7;color:#282229}main{max-width:1250px;margin:30px auto;padding:20px}a{color:#8b315a}h1{font-size:32px}h2{font-size:23px}h3{font-size:17px;color:#8b315a}article{background:white;padding:24px;border-radius:18px;margin:18px 0}img{width:100%;height:240px;object-fit:contain}.grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:18px}.grid article{margin:0}.grid a{text-decoration:none}figure{margin:0}input,select{padding:12px;font:inherit;border:1px solid #d9c2cc;border-radius:10px;margin:6px}table{border-collapse:collapse;width:100%}td,th{padding:8px;text-align:left;border-bottom:1px solid #e7d4dc}.warn{color:#943c22}small{color:#65535e}'
LABELS = {'description_short':'Краткое описание','description':'Полное описание','usage':'Применение','ingredients':'Ингредиенты','packaging':'Упаковка'}


def document(title, body):
    return f'<!doctype html><html lang="ru"><meta charset="utf-8"><meta name="viewport" content="width=device-width"><title>{html.escape(title)}</title><style>{STYLE}</style><main>{body}</main></html>'


def write_review(products, errors, output):
    cards=[]
    for p in products:
        name=html.escape(p['fields']['name']); key=p['key']
        gallery=''.join(f'<figure><img loading="lazy" src="public/{i["local_path"]}"><figcaption>{"Главное фото" if i["role"]=="main" else "Дополнительное фото"} · {i["dimensions"][0]}×{i["dimensions"][1]}</figcaption></figure>' for i in p['images'] if i['local_path'])
        texts=''.join(f'<h3>{label}</h3>{p["fields"][field] or "<p>Не указано на сохранённой странице.</p>"}' for field,label in LABELS.items())
        warnings=''.join(f'<li>{html.escape(w)}</li>' for w in p['warnings'])
        metadata=f'{html.escape(p["category"])} / {html.escape(p["subcategory"])} · Серия: {html.escape(p["series_label"] or "не указана")} · Объём: {html.escape(p["fields"]["volume"] or "не указан")}'
        (output/f'{key}.html').write_text(document(p['fields']['name'], f'<a href="index.html">← Каталог</a><h1>{name}</h1><p>{metadata}</p><h2>{p["fields"]["price"]} ₽</h2><p>Обычная цена без скидки. Черновик для проверки, в БД не загружен.</p><ul class="warn">{warnings}</ul><div class="grid">{gallery}</div><article>{texts}</article>'),encoding='utf-8')
        first=p['fields']['image']
        image=f'<img loading="lazy" src="public/{first}">' if first else '<p class="warn">Нет главного фото</p>'
        search=html.escape(' '.join([p['fields']['name'],p['category'],p['subcategory'],p['series_label'] or '']).lower(),quote=True)
        cards.append(f'<article data-search="{search}" data-category="{html.escape(p["category"],quote=True)}"><a href="{key}.html">{image}<h3>{name}</h3></a><b>{p["fields"]["price"]} ₽</b><p><small>{metadata}</small></p><p>{len(p["images"])} фото · {len(p["warnings"])} замечаний</p></article>')
    summary={'products':len(products),'categories':dict(Counter(p['category'] for p in products)),
             'subcategories':dict(Counter(p['category']+'/'+p['subcategory'] for p in products)),
             'series':dict(Counter(p['series_label'] or 'не указана' for p in products)),
             'images_ready':sum(i['status']=='ready' for p in products for i in p['images']),
             'images_missing':sum(i['status']!='ready' for p in products for i in p['images']),
             'products_with_warnings':sum(bool(p['warnings']) for p in products),'errors':errors,'database_modified':False}
    for filename,data in [('products.review.json',products),('summary.json',summary)]:
        (output/filename).write_text(json.dumps(data,ensure_ascii=False,indent=2),encoding='utf-8')
    options=''.join(f'<option>{html.escape(c)}</option>' for c in summary['categories'])
    script='''<script>const q=document.querySelector('input'),c=document.querySelector('select');function filter(){for(const a of document.querySelectorAll('[data-search]'))a.hidden=!(a.dataset.search.includes(q.value.toLowerCase())&&(!c.value||a.dataset.category===c.value));}q.oninput=filter;c.onchange=filter;</script>'''
    errorlist=''.join(f'<li>{html.escape(e["page"])}: {html.escape(e["error"])}</li>' for e in errors)
    (output/'index.html').write_text(document('Smorodina — две категории',f'<h1>Каталог для проверки</h1><p>{len(products)} товаров · {summary["images_ready"]} фотографий · {summary["images_missing"]} недостающих фото. Рабочая база не изменена.</p><p>Категории взяты из папок. Цены обычные, без скидки. Серии — по явной метке на странице.</p><ul class="warn">{errorlist}</ul><input placeholder="Поиск по названию, серии…"><select><option value="">Все категории</option>{options}</select><div class="grid">'+''.join(cards)+'</div>'+script),encoding='utf-8')
    return summary


def main():
    parser=argparse.ArgumentParser(description=__doc__)
    parser.add_argument('archives',nargs='+',type=Path)
    parser.add_argument('--output',type=Path,required=True)
    args=parser.parse_args();args.output.mkdir(parents=True,exist_ok=True)
    products=[];errors=[];seen={}
    for archive in args.archives:
        with zipfile.ZipFile(archive) as z:
            for member in sorted(n for n in z.namelist() if n.lower().endswith(('.html','.htm'))):
                try:
                    if z.getinfo(member).file_size>10*1024*1024:
                        raise ValueError('HTML больше 10 МБ')
                    p=parse_page(z.read(member),member,archive.name)
                    if p['key'] in seen:
                        raise ValueError('Повтор одного товара: '+seen[p['key']])
                    seen[p['key']]=member
                    copy_images(z,p,args.output);products.append(p)
                except Exception as error:
                    errors.append({'archive':archive.name,'page':member,'error':str(error)})
    print(json.dumps(write_review(products,errors,args.output),ensure_ascii=False,indent=2))


if __name__=='__main__':main()
