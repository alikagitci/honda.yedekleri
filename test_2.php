<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
// Include the client library
require_once('wp-config.php');
require_once('wp-includes/wp-db.php');
require_once('wp-admin/includes/taxonomy.php');
require_once('wp-load.php');

$aracMarka = 'Honda';
$aracModel = 'City';
$anaGrup = 'Süspansiyon Öndüzen';
$altGrup = 'Helezon Yayı';
//print_r(wp_list_categories('product_cat'));
echo "<pre>";

//print_r($catId=categoryExist('Mazda', $parent, $parameters));


//$aracCatId = getChildDetails(0, $aracMarka);
$aracModelId = getChildDetails(0, $aracModel, $main=1);
$anaGrupId = getChildDetails($aracModelId, $anaGrup);
$altGrupId = getChildDetails($anaGrupId, $altGrup);

/*
 if ($aracCatId < 1) {
    $aracCatId = markaCreate(0, $aracMarka);
    echo "$aracMarka created (category)\n";
}
*/
if ($aracModelId < 1) {
    $aracModelId = modelCreate($aracCatId, $aracMarka, $aracModel);
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

function getChildDetails($id = 0, $category, $main=0)
{
    $args2 = array(
        'taxonomy' => 'product_cat',
        'parent' => $id,
        //'child_of' => $id,
        //  'slug'     => 'honda-yedek-parcalari',
        'name' => $category
    );

    if($main == 1   ){
        $catVar = term_exists($category, 'product_cat', $id);
        if ($catVar['term_id']) {
            return $catVar['term_id'];
        }
    }else {

            $sub_cats = get_categories($args2);

            foreach ($sub_cats as $_category) {
                $catId = $_category->term_id;
            }


            return $catId;
        }
}

function createProductCategory($aracMarka, $aracModel, $anaGrup, $altGrup)
{
    $mainStoreId = 180963;//yedekparca main store
    if (false == $this->root_cat_id) {
        // Yedek parça root kategori
        $this->root_cat_id = $this->getCategoryByUrlKey($this->root_url_key);
    }
    // get category informations

    $aracCatId = $this->getChildDetails($mainStoreId, $aracMarka);
    $aracModelId = $this->getChildDetails($aracCatId, $aracModel);
    $anaGrupId = $this->getChildDetails($aracModelId, $anaGrup);
    $altGrupId = $this->getChildDetails($anaGrupId, $altGrup);

    // Create arac category if not exists
    if ($aracCatId < 1 || $this->override) {
        $aracCatId = $this->markaCreate($this->root_cat_id, $aracMarka);
        echo "$aracMarka created (category)\n";
    }

    // Create arac model if not exists
    if ($aracModelId < 1 || $this->override) {
        $aracModelId = $this->modelCreate($aracCatId, $aracMarka, $aracModel);
        echo "$aracMarka => $aracModel created (category)\n";
    }
    // Create arac ana grup if not exists
    if ($anaGrupId < 1 || $this->override) {
        $anaGrupId = $this->mainGroupCreate($aracModelId, $aracMarka, $aracModel, $anaGrup);
        echo "$aracMarka => $aracModel => $anaGrup created (category)\n";
    }
    // Create arac alt grup if not exists
    if ($altGrupId < 1 || $this->override) {
        $altGrupId = $this->subGroupCreate($anaGrupId, $aracMarka, $aracModel, $anaGrup, $altGrup);
        echo "$aracMarka => $aracModel => $anaGrup => $altGrup created (category)\n";
    }
    return array("marka" => $aracCatId,
        "model" => $aracModelId,
        "ana_grup" => $anaGrupId,
        "alt_grup" => $altGrupId,
    );
}


?>