<?php
/**
 * �������� ����� ��� �����������
 * @package PHPShopCoreFunction
 * @param int $n ��  ��������
 * @param string $flag ������
 * @param bool $tip ��������
 * @return string
 */
function catalog_meta($array,$flag) {
    global $PHPShopSystem;
    
    // ������ �������� ��������
    $row=$array[0];

    // ������ �������� ��������
    $parent_row=$array[1];

    $tip=$row[$flag.'_enabled'];
    $cat=$row['parent_to'];
    

    if($cat != 0) {
        if($tip == 0) $Shablon=$PHPShopSystem->getParam($flag.'_shablon');
        elseif($tip == 1) $Shablon=$row[$flag];
        elseif($tip == 2) $Shablon=$row[$flag.'_shablon'];
    }else {
        if($tip == 0) $Shablon=$PHPShopSystem->getParam($flag.'_shablon3');
        elseif($tip == 1) $Shablon=$row[$flag];
        elseif($tip == 2) $Shablon=$row[$flag.'_shablon3'];
    }

    if($tip !=1) {
        if($cat != 0) {
            $Catalog=$parent_row['name'];
            $Podcatalog=$row['name'];
            $Title=$PHPShopSystem->getParam($flag);
            $Shablon=str_replace("@Catalog@", $Catalog, $Shablon);
            $Shablon=str_replace("@Podcatalog@", $Podcatalog, $Shablon);
            $Shablon=str_replace("@System@", $Title, $Shablon);
        }
        else {
            $Catalog=$row['name'];
            $Title=$PHPShopSystem->getParam($flag);
            $Shablon=str_replace("@Catalog@", $Catalog, $Shablon);
            $Shablon=str_replace("@Podcatalog@", $Podcatalog, $Shablon);
            $Shablon=str_replace("@System@", $Title, $Shablon);
        }
        if($flag == "keywords") {
            $Generator=setAutokeyword($row['content']);
            $Shablon=str_replace("@Generator@", $Generator, $Shablon);
        }
    }
    return $Shablon;
}


/**
 * �������� ����� ��� ������
 * @package PHPShopCoreFunction
 * @param int $row ������ ������
 * @param string $flag ������
 * @param bool $tip ��������
 * @return string
 */
function product_meta($array,$flag) {
    global $PHPShopSystem;

    // ������ �������� ������
    $row=$array[0];
    
    // ������ ��������
    $category_row=$array[1];

    // ������ ������������� ��������
    $parent_category_row=$array[2];

    $tip=$row[$flag.'_enabled'];
    if($tip == 0) $Shablon=$PHPShopSystem->getParam($flag.'_shablon2');
    elseif($tip == 1) $Shablon=$row[$flag];
    elseif($tip == 2) $Shablon=$row[$flag.'_shablon'];

    if($tip !=1) {
        $Catalog=$parent_category_row['name'];
        $Podcatalog=$category_row['name'];
        $Product=$row['name'];
        $Shablon=str_replace("@Catalog@", $Catalog, $Shablon);
        $Shablon=str_replace("@Podcatalog@", $Podcatalog, $Shablon);
        $Shablon=str_replace("@Product@", $Product, $Shablon);
        $Shablon=str_replace("@System@", $PHPShopSystem->getValue('title'), $Shablon);

        if($flag == "keywords") {
            $Generator=setAutokeyword($row["content"]);
            $Shablon=str_replace("@Generator@", $Generator, $Shablon);
        }
    }

    return $Shablon;
}


function set_meta($obj,$row) {
    switch ($obj->PHPShopNav->getNav('nav')) {
        case "CID":
            $obj->title=catalog_meta($row,"title");
            $obj->description=catalog_meta($row,"descrip");
            $obj->keywords=catalog_meta($row,"keywords");
            break;
        case "UID":
            $obj->title=product_meta($row,"title");
            $obj->description=product_meta($row,"descrip");
            $obj->keywords=product_meta($row,"keywords");
            break;
    }
}


/**
 * ���������� ���� ��� ����
 * @package PHPShopCoreFunction
 * @param string $content ��������
 * @return string
 */
function setAutokeyword($content) {
    $return=null;

    // ���������
    include('./phpshop/lib/autokeyword/class.autokeyword.php');
    
    $_data=strip_tags($content);
    $keyword = new autokeyword();
    $params['_W'] = $_data; //page content
    $params['_W1'] = 5;  //minimum length of single words
    $params['_W2'] = 4;  //minimum length of words for 2 word phrases
    $params['_W3'] = 3;  //minimum length of words for 3 word phrases
    $params['_P2'] = 12; //minimum length of 2 word phrases
    $params['_P3'] = 15; //minimum length of 3 word phrases
    $max_words=12; // �����
    $string = $keyword->autokeyword($params);

    // �������� �� 12 ����
    $words=explode(',', $string, $max_words+1);
    array_pop($words);
    foreach($words as $val)
        if(!empty($val)) $return.=$val.",";

    return substr($return,0,-1);
}
?>