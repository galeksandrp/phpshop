<?php
/**
 * ����� ������������� � ������
 * @package PHPShopAjaxElementsDepricated
 */

session_start();
$_classPath="./";
include($_classPath."class/obj.class.php");
PHPShopObj::loadClass("base");
$PHPShopBase = new PHPShopBase($_classPath."inc/config.ini");
PHPShopObj::loadClass("array");
PHPShopObj::loadClass("category");
PHPShopObj::loadClass("sort");

require_once "./lib/Subsys/JsHttpRequest/Php.php";
$JsHttpRequest =& new Subsys_JsHttpRequest_Php("windows-1251");

// ������ ���������
$PCA = new PHPShopCategoryArray();
$LoadItems['Catalog']=$PCA->getArray();

// ������ ��������� �������������
$PSCA = new PHPShopSortCategoryArray();
$LoadItems['CatalogSort']=$PSCA->getArray();

// ���������� ������
include("./inc/sort.inc.php");


$_RESULT = array(
        'sort' =>DispCatSort($_REQUEST['category'])
); 
?>