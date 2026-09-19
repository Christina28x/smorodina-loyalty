import unittest
from archive_review import parse_page, image_member
from test_extract import FIXTURE

class ArchiveReviewTests(unittest.TestCase):
    def test_regular_price_and_folder_taxonomy(self):
        p=parse_page(FIXTURE.encode(),'face/cream/Крем_files/Крем.html','face.zip')
        self.assertEqual(p['fields']['price'],1500)
        self.assertEqual(p['category'],'face')
        self.assertEqual(p['subcategory'],'cream')
        self.assertEqual(p['price_source'],'regular_struck_through')

    def test_new_arrivals_url_does_not_override_folder(self):
        p=parse_page(FIXTURE.replace('/catalog/face/cream/example/','/catalog/novinki/example/').encode(),'face/serum/Крем_files/Крем.html','face.zip')
        self.assertEqual(p['subcategory'],'serum')

    def test_moved_html_resolves_only_its_product_folder(self):
        names={'face/cream/A_files/2.jpg','face/cream/B_files/2.jpg'}
        self.assertEqual(image_member(names,'face/cream/A_files/A.html','./A_files/2.jpg')[0],'face/cream/A_files/2.jpg')
        with self.assertRaises(ValueError):
            image_member({'face/cream/B_files/2.jpg'},'face/cream/A_files/A.html','./A_files/2.jpg')

    def test_volume_from_explicit_name_suffix(self):
        p=parse_page(FIXTURE.replace('<h1>Крем</h1>','<h1>Маска 90 г</h1>').encode(),'face/masks/A/A.html','face.zip')
        self.assertEqual(p['fields']['volume'],'90 г')
        self.assertEqual(p['volume_source'],'product_name')

    def test_alternative_description_control(self):
        p=parse_page(FIXTURE.replace('class="js-detail-text"','class="js-detail-text_sphere"').encode(),'face/cream/A/A.html','face.zip')
        self.assertEqual(p['fields']['description'],'<p>Полное описание</p>')

if __name__=='__main__':unittest.main()
