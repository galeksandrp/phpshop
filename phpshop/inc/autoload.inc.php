<?
// ����� ��������������� �� �������
//if($SysValue['nav']['truepath'] == "/")
//$SysValue['other']['newtipMain'] = DispNewMain();    

// �������� �������
if(isset($_REQUEST['skin']) and !true_login($_REQUEST['skin'])) {
    $_SESSION['skin']=false;
    header('Location: /');
    exit;
}


// �������� �������
include_once("./phpshop/class/obj.class.php");
PHPShopObj::loadClass("base");
PHPShopObj::loadClass("system");
PHPShopObj::loadClass("orm");
PHPShopObj::loadClass("modules");
PHPShopObj::loadClass("security");

if(!$GLOBALS['PHPShopSystem']) $PHPShopSystem=&new PHPShopSystem();

$PHPShopModules = new PHPShopModules();
$PHPShopModules->doLoad();
?>
