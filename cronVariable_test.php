<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
// Include the client library
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
$consumer_key = 'ck_bce603ba053331f4232e3f0f57c80689'; // Add your own Consumer Key here
$consumer_secret = 'cs_79f6ff97bdb00a609edc4c8a25d8d3f5'; // Add your own Consumer Secret here
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
foreach($results as $products) {
    $urunAd = ucwords($products->aracmarka.' '. $products->aracmodel.' '. $products->stokadi);

    $newData = '{
    "product": {
        "title": "'.$urunAd.'   ",
    "type": "variable",
    "description": "Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.",
    "short_description": "Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.",
    "categories": [
            "'.$products->aracmarka.'",
            "'.$products->aracmodel.'",
            "'.$products->anagrup.'",
            "'.$products->altgrup.'"
        ],
    "images": [
      {
          "src": "http://www.yedekdunyasi.com/media/catalog/product/p/e/peugeot-206-hb-99-09-fan-kanadi-klimali-tip.jpg",
        "position": 0
      },
      {
          "src": "http://www.yedekdunyasi.com/media/catalog/product/p/e/peugeot-206-hb-99-09-fan-kanadi-klimali-tip.jpg",
        "position": 1
      },
      {
          "src": "http://www.yedekdunyasi.com/media/catalog/product/p/e/peugeot-206-hb-99-09-fan-kanadi-klimali-tip.jpg",
        "position": 2
      },
      {
          "src": "http://www.yedekdunyasi.com/media/catalog/product/p/e/peugeot-206-hb-99-09-fan-kanadi-klimali-tip.jpg",
        "position": 3
      }
    ]';
    $i=0;
    $attr=',
    "attributes": [';
    foreach($attributes as $attribute){
        if (!is_null($products->$attribute)){
            if($i == 0){
                $attr .="{";
            }
            $attr .= '"name": "'.str_replace("_","-",$attribute).'",';
            $attr .= '"slug": "'.str_replace("_","-",$attribute).'",';
            $attr .= '"position": "'.$i.'",';
            $attr .= '"visible": "true",';
            $attr .= '"variation": "true",';
            $attr .= '"options": [';
            $attr .= '"'.$products->$attribute.'"';
            $attr .= ']';
            $attr .= '} ],';
            $i++;
        }
    }
    // $newData .= $attr;
    $newData .='
    "default_attributes": [
      {
          "name": "Color",
        "slug": "color",
        "option": "Black"
      }
    ],
    "variations": [
      {
          "regular_price": "19.99",
        "image": [
          {
              "src": "http://www.yedekdunyasi.com/media/catalog/product/p/e/peugeot-206-hb-99-09-fan-kanadi-klimali-tip.jpg",
            "position": 0
          }
        ],
        "attributes": [
          {
              "name": "Color",
            "slug": "color",
            "option": "black"
          }
        ]
      },
      {
          "regular_price": "19.99",
        "image": [
          {
              "src": "http://www.yedekdunyasi.com/media/catalog/product/p/e/peugeot-206-hb-99-09-fan-kanadi-klimali-tip.jpg",
            "position": 0
          }
        ],
        "attributes": [
          {
            "name": "Color",
            "slug": "color",
            "option": "green"
          }
        ]
      }
    ]
  }
}';

    echo "<pre>";
    $test= json_encode($newData,1);
    echo "</pre>";
    exit;
    print_r($client->products->create($test));

}
//var_dump($test);
//exit;



?>