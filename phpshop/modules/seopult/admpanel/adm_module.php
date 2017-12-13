<?php

$_classPath = "../../../";
include($_classPath . "class/obj.class.php");
PHPShopObj::loadClass("base");
PHPShopObj::loadClass("system");
PHPShopObj::loadClass("security");
PHPShopObj::loadClass("orm");

$PHPShopBase = new PHPShopBase($_classPath . "inc/config.ini");
include($_classPath . "admpanel/enter_to_admin.php");

$PHPShopSystem = new PHPShopSystem();

// ��������� ������
PHPShopObj::loadClass("modules");
$PHPShopModules = new PHPShopModules($_classPath . "modules/");


// ��������
PHPShopObj::loadClass("admgui");
$PHPShopGUI = new PHPShopGUI();
$PHPShopGUI->dir = $_classPath . "admpanel/";
$PHPShopGUI->title = "��������� ������ Seo Pult";
$PHPShopGUI->size = "500,450";
$PHPShopGUI->ajax = "'modules','seopult'";
$PHPShopGUI->addJSFiles('../../../lib/Subsys/JsHttpRequest/Js.js');

// SQL
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.seopult.seopult_system"));

// ������� ����������
function actionUpdate() {
    global $PHPShopOrm, $PHPShopModules;


    $params = array(
        'login' => $_POST['login_new'],
        'url' => $_SERVER['SERVER_NAME'],
        'email' => $_POST['email_new'],
        'hash' => md5($_SERVER['SERVER_NAME'] . time()),
        'partner' => '7a52518f2d1b22983a51a2fbf2a8ec75'
    );

    $request = http_build_query($params);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://i.seopult.pro/iframe/getCryptKeyWithUserReg?" . $request);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CRLF, true);

    $json = curl_exec($ch);

    $result = json_decode($json, true);

    // ����������� ������ ������������
    if ($result['status']['code'] == 0) {

        $PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.seopult.seopult_system"));
        $PHPShopOrm->debug = false;
        $params['cryptkey'] = $result['data']['cryptKey'];
        $PHPShopOrm->update($params, false, '');
    }


    if (curl_error($ch) != '' || $json == false) {
        echo "Error: " . curl_error($ch);
        curl_close($ch);
        die;
    }

    curl_close($ch);

    $PHPShopOrm->debug = false;
    $action = $PHPShopOrm->update($_POST);
    return $action;
}

function actionStart() {
    global $PHPShopGUI, $PHPShopSystem, $PHPShopOrm;

    // �������
    $data = $PHPShopOrm->select();
    @extract($data);

    // ����������� ��������� ����
    $PHPShopGUI->setHeader("��������� ������ 'Seo Pult'", "��������� �����������", $PHPShopGUI->dir . "img/i_display_settings_med[1].gif");
    
    if(empty($login)) $login=$_SERVER['SERVER_NAME'].'_'.rand(0,100);
    if(empty($email)) $email=$PHPShopSystem->getParam('adminmail2');

    $Tab1 = $PHPShopGUI->setField('������������', $PHPShopGUI->setInputText(false, 'login_new', $login));
    $Tab1.=$PHPShopGUI->setField('E-mail', $PHPShopGUI->setInputText(false, 'email_new', $email));

    $Tab2 = $PHPShopGUI->setInfo($info, 200, '96%');

    // ����� �����������
    $Tab3 = $PHPShopGUI->setPay($serial, false);

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1, 270), array("� ������", $Tab3, 270));

    // ����� ������ ��������� � ����� � �����
    $ContentFooter =
            $PHPShopGUI->setInput("hidden", "newsID", $id, "right", 70, "", "but") .
            $PHPShopGUI->setInput("button", "", "������", "right", 70, "return onCancel();", "but") .
            $PHPShopGUI->setInput("submit", "editID", "�����������", "right", 120, "", "but", "actionUpdate");

    $PHPShopGUI->setFooter($ContentFooter);
    return true;
}

if ($UserChek->statusPHPSHOP < 2) {

    // ����� ����� ��� ������
    $PHPShopGUI->setLoader($_POST['editID'], 'actionStart');

    // ��������� �������
    $PHPShopGUI->getAction();
}
else
    $UserChek->BadUserFormaWindow();
?>