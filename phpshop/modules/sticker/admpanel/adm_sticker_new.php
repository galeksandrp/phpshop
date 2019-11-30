<?php

// SQL
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.sticker.sticker_forms"));

// ����� ������� �������
function GetSkinList($skin) {
    global $PHPShopGUI;
    $dir = "../templates/";
    
    $value[] = array('�� �������', '', '');

    if (is_dir($dir)) {
        if (@$dh = opendir($dir)) {
            while (($file = readdir($dh)) !== false) {
                if (file_exists($dir . '/' . $file . "/main/index.tpl")) {

                    if ($skin == $file)
                        $sel = "selected";
                    else
                        $sel = "";

                    if ($file != "." and $file != ".." and !strpos($file, '.'))
                        $value[] = array($file, $file, $sel);
                }
            }
            closedir($dh);
        }
    }

    return $PHPShopGUI->setSelect('skin_new', $value);
}

// ������� ������
function actionInsert() {
    global $PHPShopOrm;

    if (empty($_POST['enabled_new']))
        $_POST['enabled_new'] = 0;

    $action = $PHPShopOrm->insert($_POST);
    
    header('Location: ?path=' . $_GET['path']);
    return $action;
}

// ��������� ������� ��������
function actionStart() {
    global $PHPShopGUI, $PHPShopSystem;

    // �������
    $data['name'] = '����� ������';
    $data['enabled']=1;



    $Tab1 = $PHPShopGUI->setField('��������:', $PHPShopGUI->setInputText(false, 'name_new', $data['name'], 300));
    $Tab1.=$PHPShopGUI->setField('������:', $PHPShopGUI->setInputText('@sticker_', 'path_new', $data['path'], 200, '@'));
    $Tab1.=$PHPShopGUI->setField('�����:', $PHPShopGUI->setCheckbox('enabled_new', 1, '����� �� �����', $data['enabled']));
    $Tab1.=$PHPShopGUI->setField('�������� � ���������:', $PHPShopGUI->setInputText(false, 'dir_new', $data['dir']) . $PHPShopGUI->setHelp('������: /page/about.html,/page/company.html'));
    $Tab1.=$PHPShopGUI->setField('������', GetSkinList($data['skin']));


    $PHPShopGUI->setEditor($PHPShopSystem->getSerilizeParam("admoption.editor"), true);
    $oFCKeditor = new Editor('content_new', true);
    $oFCKeditor->Height = '320';
    $oFCKeditor->ToolbarSet = 'Normal';
    $oFCKeditor->Value = $data['content'];

    $Tab2 = $oFCKeditor->AddGUI();


    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1, true), array("����������", $Tab2, true));

    // ����� ������ ��������� � ����� � �����
    $ContentFooter=$PHPShopGUI->setInput("submit","saveID","���������","right",false,false,false,"actionInsert.modules.create");

    $PHPShopGUI->setFooter($ContentFooter);
    return true;
}

// ��������� �������
$PHPShopGUI->getAction();

// ����� ����� ��� ������
$PHPShopGUI->setLoader($_POST['saveID'], 'actionStart');
?>