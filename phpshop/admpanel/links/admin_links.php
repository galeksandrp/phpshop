<?
$TitlePage=__("������");

function actionStart()
{
global $PHPShopInterface;
$PHPShopInterface->size="630,550";
$PHPShopInterface->link="links/adm_linksID.php";
$PHPShopInterface->setCaption(array("&plusmn;","5%"),array("��������","30%"),array("��������","50%"),array("������","10%"));

// SQL
$PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['links']);
$data = $PHPShopOrm->select(array('*'),false,array('order'=>'num desc'),array("limit"=>"1000"));
if(is_array($data))
foreach($data as $row){
extract($row);
$PHPShopInterface->setRow($id,$PHPShopInterface->icon($enabled),$name,$content,$image);
}

$PHPShopInterface->setAddItem('links/adm_links_new.php');
$PHPShopInterface->Compile();
}
?>
