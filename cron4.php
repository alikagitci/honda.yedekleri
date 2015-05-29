<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
// Include the client library
//include "test.php";
require_once( 'wp-load.php' );
require_once( "lib/woocommerce-api.php");
//require_once( 'wp-content/plugins/woocommerce/includes/class-wc-api.php' );
//require_once "lib/woocommerce-api/class-wc-api-client.php";
//require_once( 'wp-content/plugins/woocommerce/woocommerce.php' );
//require_once( 'wp-content/plugins/woocommerce/includes/api/class-wc-api-products.php' );
$options = array(
    "debug"           => true,
    "return_as_array" => false,
    "validate_url"    => false,
    "timeout"         => 30,
    "ssl_verify"      => false,
);

$sqlQuery =  "SELECT CONCAT(c.stokodu,'-', d.match_id) as stokKodu, c.stokodu, c.UreticiKodu, c.urun_marka, c.urun_adi as stokadi, c.olculer, c.motor_hacmi,
              c.kasa_tipi,c.kapi_sayisi, c.yil_baslangic, c.yil_bitis, c.arac_tip, c.seri, c.oem_no, a.sysmarka as aracmarka, b.sysaracmodel as aracmodel, e.sysurunanagrup as anagrup, f.sysurunaltgrup as altgrup,
              c.fiyat as fiyat, c.dovtip as dovtip, c.bakiye as bakiye
                    FROM askdbyeni AS c
                    JOIN matchModel AS b
                    JOIN matchAltgrup f
                    JOIN matchProduct as g
                    JOIN matchMarka AS a
                    ON a.id=b.marka_id
                    JOIN matchCategory AS d
                    ON (c.aracmarka=d.marka AND c.aracmodel=d.category AND d.match_id=b.id and   c.anagrup=g.anagrup AND c.altgrup=g.category And g.match_id=f.id )
                    JOIN matchAnagrup as e
                    ON e.id=f.urunanagrup_id
                    WHERE c.aracmarka='Honda' ";

global $wpdb;
$consumer_key = 'ck_7c96beb6bf85652974fd8ab0d0a34e24'; // Add your own Consumer Key here
$consumer_secret = 'cs_b44eb010c209f0fcc428b9668caf1d6b'; // Add your own Consumer Secret here
$store_url = 'http://www.lyedekleri.com/'; // Add the home URL to the store you want to connect to here

$options = array(
    'debug'           => true,
    'return_as_array' => false,
    'validate_url'    => false,
    'timeout'         => 30,
    'ssl_verify'      => false,
);

$attributes = array(
    'olculer', 'motor_hacmi', 'kasa_tipi', 'kapi_sayisi', 'yil_baslangic', 'yil_bitis', 'arac_tip', 'seri', 'oem_no'
);

$client = new WC_API_Client( 'http://www.lyedekleri.com', $consumer_key, $consumer_secret, $options );



$results = $wpdb->get_results($sqlQuery);
foreach($results as $product) {

$productId = getProductInfoWithSku($product->stokKodu);
if($productId) {
 //   $productInfo = $client->products->get($productId);
    $newData = '{
        "product": {
            "regular_price": "'.$product->fiyat * 1.18.'",
            "sale_price": "'.$product->fiyat * 1.18.'",
            "price": "'.($product->fiyat * 1.18) * 1.30.'",
            "in_stock": "'.($product->bakiye).'",
            "featured": "true"
  }
}';
    $test= json_decode($newData,1);

    $client->products->update( $productId, $test);
} else {

    $categories = createProductCategory($product->aracmarka, $product->aracmodel, $product->anagrup, $product->altgrup);

    $urunAd = ucwords($product->aracmarka . ' ' . $product->aracmodel . ' ' . $product->stokadi);

    //  $markaCat = strtolower(convert2Turkish("{$product->aracmarka}-yedek-parcalari"));
   // $modelCat = strtolower(convert2Turkish("{$product->aracmarka}-{$product->aracmodel}-yedek-parcalari"));
   // $anaGrupCat = strtolower(convert2Turkish("{$product->aracmarka}-{$product->aracmodel}-{$product->anagrup}"));
   // $altGrupCat = strtolower(convert2Turkish("{$product->aracmarka}-{$product->aracmodel}-{$product->altgrup}"));


    $newData = '{
    "product": {
    "title": "' . $urunAd . '   ",
    "type": "simple",
    "regular_price": "' . $product->fiyat * 1.18 . '",
    "sale_price": "' . $product->fiyat * 1.18 . '",
    "price": "' . ($product->fiyat * $product->kdv) * 1.30 . '",
    "in_stock": "' . ($product->bakiye) . '",
    "featured": "true",
    "sku": "' . $product->stokKodu . '",
    "description": "Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.",
    "short_description": "Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.",';

    $category = get_term_by('id', $categories['model'], 'product_cat');
    $mainCat = get_term_by('id', $categories['ana_grup'], 'product_cat');
    $subCat = get_term_by('id', $categories['alt_grup'], 'product_cat');

    $newData .= '"categories": [
             "' . $category->name . '",
             "' . $mainCat->name  . '",
             "' . $subCat->name  . '"
        ],
        "tags": [
             "' . $product->aracmarka . '",
             "' . $product->aracmodel . '",
             "' . $product->anagrup . '",
             "' . $product->altgrup . '"
        ],
   "images": [
      {
          "src": "http://www.yedekdunyasi.com/media/catalog/product/p/e/peugeot-206-hb-99-09-fan-kanadi-klimali-tip.jpg",
          "title":"' . $urunAd . '",
          "alt":"' . $urunAd . '",
        "position": 0
      },
      {
          "src": "http://www.yedekdunyasi.com/media/catalog/product/p/e/peugeot-206-hb-99-09-fan-kanadi-klimali-tip.jpg",
          "title":"' . $urunAd . '",
          "alt":"' . $urunAd . '",
        "position": 1
      },
      {
          "src": "http://www.yedekdunyasi.com/media/catalog/product/p/e/peugeot-206-hb-99-09-fan-kanadi-klimali-tip.jpg",
          "title":"' . $urunAd . '",
          "alt":"' . $urunAd . '",
        "position": 2
      },
      {
          "src": "http://www.yedekdunyasi.com/media/catalog/product/p/e/peugeot-206-hb-99-09-fan-kanadi-klimali-tip.jpg",
          "title":"' . $urunAd . '",
          "alt":"' . $urunAd . '",
        "position": 3
      }
    ]
}
}';

    $test = json_decode($newData, 1);
}
    try {
    $client->products->create($test);
} catch ( WC_API_Client_Exception $e ) {

    echo $e->getMessage() . PHP_EOL;
    echo $e->getCode() . PHP_EOL;

    if ( $e instanceof WC_API_Client_HTTP_Exception ) {

        print_r( $e->get_request() );
        print_r( $e->get_response() );
    }
}
//exit;
}


function convert2Turkish($text, $toLower = true)
{
    // Remove spaces
    $text = trim($text);

    $search = array('Ç', 'ç', 'Ğ', 'ğ', 'ı', 'I', 'İ', 'i', 'Ö', 'ö', 'Ş', 'ş', 'Ü', 'ü', ' ', '(', ')', '/', '.', '?', '!', '&', '\\', '.');
    $replace[0] = array('c', 'c', 'g', 'g', 'i', 'i', 'i', 'i', 'o', 'o', 's', 's', 'u', 'u', '-', '', '', '-', '-', '-', '', '-ve', '', '');
    $replace[1] = array('ç', 'ç', 'ğ', 'ğ', 'ı', 'ı', 'i', 'i', 'ö', 'ö', 'ş', 'ş', 'ü', 'ü', ' ', 'u', ' ve', ' ', ' ');

    if ($toLower) {
        $new_text = str_replace($search, $replace[0], $text);
    } else {
        $new_text = str_replace($search, $replace[1], $text);
        // Remove double spaces
        $new_text = preg_replace("/\s+/", " ", $new_text);
    }

    // Remove double dash
    $new_text = preg_replace("/\-+/", "-", $new_text);

    // Remove dash
    $new_text = rtrim(trim($new_text), "-");

    return $new_text;
}

//var_dump($test);
//exit;


function getProductInfoWithSku($sku){

    global $wpdb;

    $getProductId ="select max(post_id) as post_id from wp_postmeta where meta_key='_sku' AND meta_value='{$sku}'";
    $results = $wpdb->get_results($getProductId);
    return $results[0]->post_id;

}





function createProductCategory($aracMarka, $aracModel, $anaGrup, $altGrup)
{
    // get category informations

    $aracModelId = getChildDetails(0, $aracModel, $main = 1);
    $anaGrupId = getChildDetails($aracModelId, $anaGrup);
    $altGrupId = getChildDetails($anaGrupId, $altGrup);

    if ($aracModelId < 1) {
        $aracModelId = modelCreate(null, $aracMarka, $aracModel);
        echo "$aracModel created (category)\n";
    }
    if ($anaGrupId < 1) {
        $anaGrupId = anaGrupCreate($aracModelId, $aracMarka, $aracModel, $anaGrup);
        echo "$anaGrup created (category)\n";
    }

    if ($altGrupId < 1) {
        $altGrupId = altGrupCreate($anaGrupId, $aracMarka, $aracModel, $anaGrup, $altGrup);
        echo "$altGrup created (category)\n";
    }

    return array(
        "model" => $aracModelId,
        "ana_grup" => $anaGrupId,
        "alt_grup" => $altGrupId,
    );
}


function getChildDetails($id = 0, $category, $main = 0)
{
    if ($main == 1) {
        $sub_cats = term_exists($category, 'product_cat');
        $catId = $sub_cats['term_id'];
    } else {
        if ($id) {
            $sub_cats = term_exists($category, 'product_cat', $id);
            $catId = $sub_cats['term_id'];
        } else {
            $catId = 0;
        }
    }
    return $catId;
}

function markaCreate($parent_term_id, $aracMarka)
{

    $parent_term = wp_insert_term(
        $aracMarka, // the term
        'product_cat', // the taxonomy
        array(
            'description' => $aracMarka . ' Yedek Parçalarına uygun fiyata erişebileceğiniz tek site - http://' . strtolower($aracMarka) . '.yedekleri.com',
            'slug' => convert2Turkish("{$aracMarka}-yedek-parcalari"),
            'parent' => $parent_term_id
        )
    );

    return $parent_term['term_id'];

}

function modelCreate($parent_term_id, $aracMarka, $aracModel)
{

    $parent_term = wp_insert_term(
        $aracModel, // the term
        'product_cat', // the taxonomy
        array(
            'description' => $aracMarka . ' ' . $aracModel . ' Yedek Parçalarına uygun fiyata erişebileceğiniz tek site - http://' . strtolower($aracMarka) . '.yedekleri.com',
            'slug' => convert2Turkish("{$aracMarka}-{$aracModel}-yedek-parcalari"),
            'parent' => $parent_term_id
        )
    );

    return $parent_term['term_id'];
}

function anaGrupCreate($parent_term_id, $aracMarka, $aracModel, $anaGrup)
{

    $parent_term = wp_insert_term(
        $anaGrup, // the term
        'product_cat', // the taxonomy
        array(
            'description' => $aracMarka . ' ' . $aracModel . ' Modeline ait ' . $anaGrup . ' kategorisindeki ürünleri görüntülemektesiniz.  http://' . strtolower($aracMarka) . '.yedekleri.com',
            'slug' => convert2Turkish("{$aracMarka}-{$aracModel}-{$anaGrup}"),
            'parent' => $parent_term_id
        )
    );

    return $parent_term['term_id'];
}


function altGrupCreate($parent_term_id, $aracMarka, $aracModel, $anaGrup, $altGrup)
{

    $parent_term = wp_insert_term(
        $altGrup, // the term
        'product_cat', // the taxonomy
        array(
            'description' => $aracMarka . ' ' . $aracModel . ' Modeline ait ' . $anaGrup . ' grubundaki ' . $altGrup . ' ürünlerini görüntülemektesiniz.',
            'slug' => convert2Turkish("{$aracMarka}-{$aracModel}-{$altGrup}"),
            'parent' => $parent_term_id
        )
    );

    return $parent_term['term_id'];
}



?>