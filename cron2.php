<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Include the client library
//require_once( 'wp-load.php' );

require_once( 'lib/woocommerce-api.php' );
//require_once( 'wp-content/plugins/woocommerce/includes/class-wc-api.php' );
//require_once( 'wp-content/plugins/woocommerce/woocommerce.php' );
//require_once( 'wp-content/plugins/woocommerce/includes/api/class-wc-api-products.php' );


$consumer_key = 'ck_bc406a97d8b9f3518c8a1629a8d8c152'; // Add your own Consumer Key here
$consumer_secret = 'cs_76d0f3f095808db2e021a0a888b5441c'; // Add your own Consumer Secret here
$store_url = 'http://www.lyedekleri.com/'; // Add the home URL to the store you want to connect to here

$options = array(
    'debug'           => true,
    'return_as_array' => false,
    'validate_url'    => false,
    'timeout'         => 30,
    'ssl_verify'      => false,
);



$client = new WC_API_Client( 'http://www.lyedekleri.com', $consumer_key, $consumer_secret, $options );



/*
$new_post = array(
    'post_title' => "Title of My Product2",
    'post_content' => 'Full description of My Product',
    'post_status' => 'publish',
    'post_type' => 'product',
    'is_visible' => '1',
    'images'=>array (
        'image'=>array(
             'src' => '/Users/alikagitci/www/yedekleri/tip.jpg',
            "id"=> 547,
            "created_at"=> "2015-01-22T19:46:16Z",
            "updated_at"=> "2015-01-22T19:46:16Z",
            "title"=> "testim ben test",
            "alt"=> "Hopi",
            "position" => 0,
            "src" => "http://www.google.com.tr/images/srpr/logo11w.png"
        )
    )
);

$post_id = wp_insert_post($new_post);
update_post_meta($post_id, '_sku', '5000' );
update_post_meta($post_id, '_regular_price' , '99.95');
update_post_meta($post_id, '_product_url' , 'http://www.myaffiliatesURL.com');
update_post_meta($post_id, '_button_text' , 'Buy from My Affiliate' );
update_post_meta($post_id, '_aioseop_description' , 'Short description of My Product' );
update_post_meta($post_id, '_visibility' , 'visible' );
update_post_meta($post_id, 'image' , 'http://www.google.com.tr/images/srpr/logo11w.png' );
*/

try {

   // $client = new WC_API('http://www.lyedekleri.com', $consumer_key, $consumer_secret, $options );

 $data = array(
                  //  $name => 'testingen',
                   // 'code' => '50',
                    'description' =>'Hebele Gübele',
                    'title' => 'Teslim Ol',
                    'type' => 'simple',
                    'price' => '8.88',
                    'status' => 'publish',
                    'sale_price' => '7.77',
                    'price_html' => "<span class=\"amount\">&#36;&nbsp;7.77</span>",
                    'taxable'=> true,
                    "in_stock" => true,
                    'regular_price' => '9.99',
                   // 'sku' => 'AB001',
                    'permalink' => ' http://www.lyedekleri.com/product/test-urunu/',
                    //'image' => 'tip.jpg',

         'images'=>array (
                'image'=>array(
                     // 'src' => '/Users/alikagitci/www/yedekleri/tip.jpg',
                     "id"=> 547,
                     "created_at"=> "2015-01-22T19:46:16Z",
                     "updated_at"=> "2015-01-22T19:46:16Z",
                     "title"=> "testim ben test",
                     "alt"=> "Hopi",
                     "position" => 0,
                    "featured_src" => "http://www.yedekdunyasi.com/media/catalog/product/p/e/peugeot-206-hb-99-09-fan-kanadi-klimali-tip.jpg"
         ),
             'image'=>array(
                 // 'src' => '/Users/alikagitci/www/yedekleri/tip.jpg',
                 "id"=> 547,
                 "created_at"=> "2015-01-22T19:46:16Z",
                 "updated_at"=> "2015-01-22T19:46:16Z",
                 "title"=> "testim ben test",
                 "alt"=> "Hopi",
                 "position" => 0,
                 "src" => "http://www.yedekdunyasi.com/media/catalog/product/p/e/peugeot-206-hb-99-09-fan-kanadi-klimali-tip.jpg"
             )
         )

 );

    echo "<pre>";
    print_r( $client->products->create($data));
    //  print_r($client->products->get_categories() );
   // print_r( $client->products->get( 99 ) );
    echo "</pre>";
} catch ( WC_API_Client_Exception $e ) {

    echo $e->getMessage() . PHP_EOL;
    echo $e->getCode() . PHP_EOL;

    if ( $e instanceof WC_API_Client_HTTP_Exception ) {

        print_r( $e->get_request() );
        print_r( $e->get_response() );
    }
}
?>