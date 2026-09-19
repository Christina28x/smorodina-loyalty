import tempfile
import unittest
from pathlib import Path
from extract import extract, clean_html
from bs4 import BeautifulSoup

FIXTURE = '''<link rel="canonical" href="https://smorodinacosmetic.com/catalog/face/cream/example/"><section class="product-page"><h1>Крем</h1><div class="product-page__top__price"><div class="product__price_old">1 500 ₽</div><div data-product-price="1200"></div></div><div class="product-page__top__short-about"><p>Кратко</p></div><div class="js-detail-text">Описание</div><div class="html-detail-text"><p>Полное описание</p></div><div class="product-page__gallery-slides"><div class="product-page__gallery-item"><img src="/upload/main.jpg"><img src="/upload/main.jpg"><img src="/upload/second.jpg"></div></div><div class="product-page__gallery-thumbs"><img src="/upload/thumb.jpg"></div><div class="product-page__top__sub-text"><div class="product-page__top__sub-text__title">Активные ингредиенты</div><div class="product-page__top__sub-text__desc">Сокращённый состав<div class="html-detail-text"><p>Полный состав</p></div></div></div></section>'''

class ExtractionTests(unittest.TestCase):
    def parse(self, raw):
        with tempfile.TemporaryDirectory() as directory:
            path = Path(directory) / 'sample.html'
            path.write_text(raw, encoding='utf-8')
            return extract(path)

    def test_price_gallery_and_full_ingredients(self):
        p = self.parse(FIXTURE)
        self.assertEqual(p['fields']['price'], 1200)
        self.assertEqual(p['source_old_price'], 1500)
        self.assertEqual(len(p['images']), 2)
        self.assertEqual(p['fields']['ingredients'], '<p>Полный состав</p>')
        self.assertIsNone(p['fields']['volume'])
        self.assertFalse(p['review']['approved'])

    def test_challenge_is_not_a_product(self):
        with self.assertRaises(ValueError):
            self.parse('<title>KillBot verification</title>')

    def test_missing_price_fails_closed(self):
        with self.assertRaises(ValueError):
            self.parse(FIXTURE.replace('data-product-price="1200"', ''))

    def test_foreign_image_source_fails_closed(self):
        with self.assertRaises(ValueError):
            self.parse(FIXTURE.replace('/upload/main.jpg', 'https://example.org/main.jpg'))

    def test_html_is_sanitized(self):
        node = BeautifulSoup('<div><script>alert(1)</script><p onclick="x()">Текст</p><img src="x" onerror="x()"></div>', 'html.parser').div
        self.assertEqual(clean_html(node), '<p>Текст</p>')

if __name__ == '__main__':
    unittest.main()
