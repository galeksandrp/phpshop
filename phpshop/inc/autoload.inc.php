<?php
/**
 * ������������ ���������
 * @package PHPShopInc
 */

// ���������� ����������
$SysValue['other']['telNum']=$PHPShopSystem->getValue('tel');
$SysValue['other']['name']=$PHPShopSystem->getValue('name');
$SysValue['other']['company']=$PHPShopSystem->getValue('company');
$SysValue['other']['descrip']=$PHPShopSystem->getValue('descrip');
$SysValue['other']['adminMail'] =$PHPShopSystem->getValue('adminmail2');
$SysValue['other']['pageCss']=$SysValue['dir']['templates'].chr(47).$_SESSION['skin'].chr(47).$SysValue['css']['default'];
$SysValue['other']['pathTemplate']=$SysValue['dir']['templates'].chr(47).$_SESSION['skin'];
$SysValue['other']['serverName']=$_SERVER['SERVER_NAME'];
$SysValue['other']['UserLogin']=$_SESSION['UserLogin'];
$SysValue['other']['UserPassword']=$_SESSION['UserPassword'];
$SysValue['other']['UserChecked']=$_SESSION['UserChecked'];
$SysValue['other']['ShopDir']=$SysValue['dir']['dir'];

/*
 * �������� �������
*/
include($SysValue['class']['modules']);
$PHPShopModules = new PHPShopModules();
$PHPShopModules->doLoad();

/*
 * ���������� ��� API 2.X
*/
$LoadItems=CacheReturnBase($sid);
if(!$LoadItems["Podcatalog"])
    $LoadItems["Podcatalog"]=&$LoadItems["Catalog"];

/*
 * ���������� ������ autoload
*/
foreach($SysValue['autoload'] as $val)
    if (is_file($val)) include_once($val);

/*
 * �������� API 2.X
*/
include($SysValue['file']['meta']);
include($SysValue['file']['lastmodified']);
if(empty($GLOBALS['p'])) $GLOBALS['p']=1;

// ����� ������ ��������� �������
$SysValue['other']['leftCatal']=Vivod_cats();  

// ����� ��������� �������
$SysValue['other']['pageCatal']=Vivod_page_cats();    

// �������� ��� ������� ��������� �������� API 2.X
$GLOBALS['admoption']=unserialize($LoadItems['System']['admoption']);
if($SysValue['nav']['truepath'] == "/") {

    // ������� ���������
    include($SysValue['file']['catalogtable']);
    $SysValue['other']['leftCatalTable']=Vivod_cat_table();

    // ������� ��������������� �� �������
    $SysValue['other']['specMain']=DispSpecMain();

    // ������� ������� �� �������
    $SysValue['other']['specMainTitle'] = $SysValue['lang']['newprod'];
    $SysValue['other']['specMainIcon'] = DispNewIcon("and newtip='1'");
    if(empty($SysValue['other']['specMainIcon']))
        $SysValue['other']['specMainIcon'] = DispNewIcon();

    // �������� RSS
    include($SysValue['file']['rssgraber']);
    if($GLOBALS['admoption']['rss_graber_enabled']==1) rss_graber();

    // ������� ���������� ��������� ������� �������������
    include($SysValue['file']['nowbuy']);
    
    switch($admoption['nowbuy_enabled']) {
        // ���������� ����� ������� ��������
        case 2: $SysValue['other']['nowBuy']=HitTradeMain();
            break;
        // ������� ����� ������� � ���������
        default: $SysValue['other']['nowBuy']=nowbuy();
            break;
    }
}

/**
 * �������� ��� ���� ������� API 2.X
 */

// ������� � ������ �������
if($SysValue['nav']['path'] != "shop") {

    $SysValue['other']['specMainTitle'] = $SysValue['lang']['newprod'];
    $SysValue['other']['specMainIcon'] = DispNewIcon("and newtip='1'");

    if(empty($SysValue['other']['specMainIcon'])) {
        $SysValue['other']['specMainTitle'] = $SysValue['lang']['specprod'];
        $SysValue['other']['specMainIcon'] = DispNewIcon("and spec='1'");
    }
}

// ���������� ����� �������
//$SysValue['other']['vendorDispA'] = dispBrend(1);

// ����������� �������������
if(PHPShopSecurity::true_param($_POST['login'],$_POST['password'])) {

    // �������� ������ � ������ � ��
    $ChekUsersBase=ChekUsersBase($_POST['login'],$_POST['password']);
    if(!empty($ChekUsersBase)) {

        // ����� ������������
        $_SESSION['UsersId']=$ChekUsersBase[0];

        // ������ ������������
        $_SESSION['UsersStatus']=$ChekUsersBase[1];

        // ���������� ������������ � cookie
        if(isset($_POST['user_enter'])) {
            if(!empty($_POST['safe_users'])) {
                setcookie("UserLogin", $_POST['login'], time()+60*60*24*30, "/",$_SERVER['SERVER_NAME'], 0);
                setcookie("UserPassword", $_POST['password'], time()+60*60*24*30, "/",$_SERVER['SERVER_NAME'], 0);
                setcookie("UserChecked", "checked", time()+60*60*24*30, "/",$_SERVER['SERVER_NAME'], 0);
            }else {
                setcookie("UserLogin", "", time()+60*60*24*30, "/",$_SERVER['SERVER_NAME'], 0);
                setcookie("UserPassword", "", time()+60*60*24*30, "/",$_SERVER['SERVER_NAME'], 0);
                setcookie("UserChecked", "", time()+60*60*24*30, "/",$_SERVER['SERVER_NAME'], 0);
            }
        }

        if(preg_match("/LogOut/",$_SERVER['REQUEST_URI']))
            $url_user = str_replace("?LogOut","#userPage",$_SERVER['REQUEST_URI']);
        else $url_user = $_SERVER['REQUEST_URI'];

        header("Location: ".$url_user);
    }
    else $SysValue['other']['usersError']=$SysValue['lang']['error_login'];
}

// ����� ������������
if(isset($GLOBALS['SysValue']['nav']['query']['LogOut'])){
    unset($_SESSION['UsersId']);
    unset($_SESSION['UsersStatus']);
    $url_user = str_replace("?LogOut","",$_SERVER['REQUEST_URI']);
    header("Location: ".$url_user);
}

// ����� ����������� ������������
if(!isset($_SESSION['UsersId'])) $SysValue['other']['usersDisp']=ParseTemplateReturn($SysValue['templates']['users_forma']);
else $SysValue['other']['usersDisp']=ParseTemplateReturn($SysValue['templates']['users_forma_enter']);

// ���������������� ����� ����� ������
if(isset($_POST['valuta'])) {
    $_SESSION['valuta']=$_POST['valuta'];
    header("Location: ".$_SERVER['REQUEST_URI']);
}

// �����
$PHPShopOprosElement = &new PHPShopOprosElement();
$PHPShopOprosElement->init('oprosDisp');

// ����-�������
$PHPShopNewsElement = &new PHPShopNewsElement();
$PHPShopNewsElement->init('miniNews');

// ������
$PHPShopBannerElement = &new PHPShopBannerElement();
$PHPShopBannerElement->init('banersDisp');

// ������ �����
$PHPShopCloudElement = &new PHPShopCloudElement();
$PHPShopCloudElement->init('cloud');

// ����� �������
$PHPShopSkinElement = &new PHPShopSkinElement();
$PHPShopSkinElement->init('skinSelect');

// ��������� ����
$PHPShopTextElement = &new PHPShopTextElement();
$PHPShopTextElement->init('leftMenu'); // ����� ������ �����
$PHPShopTextElement->init('rightMenu'); // ����� ������� �����
$PHPShopTextElement->init('topMenu'); // ����� �������� ����

// ����� ������
$PHPShopCurrencyElement = new PHPShopCurrencyElement();
$PHPShopCurrencyElement->init('valutaDisp');

// �������
$PHPShopCartElement = new PHPShopCartElement();
$PHPShopCartElement->init('miniCart');
?>