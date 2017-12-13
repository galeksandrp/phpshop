<?php

$_classPath="../../../";
include($_classPath."class/obj.class.php");
PHPShopObj::loadClass("base");
PHPShopObj::loadClass("system");
PHPShopObj::loadClass("security");
PHPShopObj::loadClass("orm");
PHPShopObj::loadClass("file");

$PHPShopBase = new PHPShopBase($_classPath."inc/config.ini");
include($_classPath."admpanel/enter_to_admin.php");


// ��������� ������
PHPShopObj::loadClass("modules");
$PHPShopModules = new PHPShopModules($_classPath."modules/");


// ��������
PHPShopObj::loadClass("admgui");
$PHPShopGUI = new PHPShopGUI();

// SQL
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.keywordsloader.keywordsloader_system"));

// ���������� ������ ������
function actionBaseUpdate() {
    global $PHPShopModules, $PHPShopOrm;
    $PHPShopOrm->clean();
    $option = $PHPShopOrm->select();
    $new_version = $PHPShopModules->getUpdate($option['version']);
    $PHPShopOrm->clean();
    $action = $PHPShopOrm->update(array('version_new' => $new_version));
    return $action;
}

// ��������� ������ CSV
function keywords_product_update($data){
    if(is_array($data)){
        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['products']);
        $PHPShopOrm->debug=false;
        $PHPShopOrm->update(array('keywords_new'=>$data[1]),array('id'=>'='.$data[0]));
    }
}

// ������� ����������
function actionUpdate() {

    // �������� ���� �������
    $_FILES['file']['ext'] = PHPShopSecurity::getExt($_FILES['file']['name']);
    if ($_FILES['file']['ext'] == "csv") {
        if (move_uploaded_file($_FILES['file']['tmp_name'], "../../../../UserFiles/Files/" . $_FILES['file']['name']))
        PHPShopFile::readCsv("../../../../UserFiles/Files/" . $_FILES['file']['name'], 'keywords_product_update');
    }
    
    return true;
}



function actionStart() {
    global $PHPShopGUI,$_classPath,$PHPShopOrm;


    $PHPShopGUI->dir=$_classPath."admpanel/";
    $PHPShopGUI->title="��������� ������ Keywords Loader";
    $PHPShopGUI->size="500,450";

    // �������
    $data = $PHPShopOrm->select();
    @extract($data);


    // ����������� ��������� ����
    $PHPShopGUI->setHeader("��������� ������ 'Keywords Loader'","��������� �����������",$PHPShopGUI->dir."img/i_display_settings_med[1].gif");

    $Tab1=$PHPShopGUI->setField('��������', $PHPShopGUI->setInput("button", "button1", "��������� CSV", "left", 150, "window.open('file.php')"));
  
    $Tab1.=$PHPShopGUI->setField('�������� ���� � ����������� *.csv',$PHPShopGUI->setInput("file", "file", "", "left", 350));

    // ����� �����������
    $Tab3 = $PHPShopGUI->setPay($serial, false, $version, true);

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������",$Tab1,270),array("� ������",$Tab3,270));

    // ����� ������ ��������� � ����� � �����
    $ContentFooter=
            $PHPShopGUI->setInput("button","","������","right",70,"return onCancel();","but").
            $PHPShopGUI->setInput("submit","editID","��","right",70,"","but","actionUpdate");

    $PHPShopGUI->setFooter($ContentFooter);
    return true;
}

if($UserChek->statusPHPSHOP < 2) {

    // ����� ����� ��� ������
    $PHPShopGUI->setLoader($_POST['editID'],'actionStart');

    // ��������� �������
    $PHPShopGUI->getAction();

}else $UserChek->BadUserFormaWindow();

?>