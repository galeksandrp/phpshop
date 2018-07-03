<?php

$TitlePage = __('�������������� ������ #' . intval($_GET['id']));

// SQL
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.multilanguages.multilanguages"));

// ������� ����������
function actionUpdate() {
    global $PHPShopOrm;

    if($_POST['content_multilanguages_ini']!='') {
        // ����� ���������� ������� � ����
        if($_POST['prefix_new']!='')
            file_put_contents($_SERVER['DOCUMENT_ROOT'].'/phpshop/modules/multilanguages/inc/lang_'.$_POST['prefix_new'].'.ini', $_POST['content_multilanguages_ini']);
    }

    if (empty($_POST['enabled_new']))
        $_POST['enabled_new'] = 0;

    $action = $PHPShopOrm->update($_POST, array('id' => '=' . $_POST['rowID']));
    return array('success'=>$action);
}

// ��������� ������� ��������
function actionStart() {
    global $PHPShopGUI, $PHPShopOrm, $PHPShopSystem, $PHPShopBase;

    // �������
    $data = $PHPShopOrm->select(array('*'), array('id' => '=' . intval($_GET['id'])));

    $PHPShopGUI->field_col = 2;
    $Tab1 = $PHPShopGUI->setField('��������', $PHPShopGUI->setInputText(false, 'name_new', $data['name']));
    $Tab1 .= $PHPShopGUI->setField('�����������', $PHPShopGUI->setInputText(false, 'prefix_new', $data['prefix']).$PHPShopGUI->setHelp('������ �������� ������ ���������� � ����� /phpshop/modules/multilanguages/inc/lang_'.$data['prefix'].'.ini'),false,'��� ����� � ����������� (en/fr)');
    //$Tab1 .= $PHPShopGUI->setField('������', $PHPShopGUI->setInputText(false, 'icon_new', $data['icon']));

    $Tab1.= $PHPShopGUI->setField('���������', $PHPShopGUI->setInputText('�', 'num_new', $data['num'], '100') .
            $PHPShopGUI->setCheckbox('enabled_new', 1, '���.', $data['enabled']));
    

    //������ ��������
    if($data['prefix']!='') {
        $file = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/phpshop/modules/multilanguages/inc/lang_'.$data['prefix'].'.ini', FILE_USE_INCLUDE_PATH);
        $fileu = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/phpshop/modules/multilanguages/inc/lang.ini', FILE_USE_INCLUDE_PATH);
    }

    $PHPShopGUI->setEditor('ace', true);
    $oFCKeditor = new Editor('content_multilanguages_ini');
    $oFCKeditor->Height = '550';
    $oFCKeditor->Config['EditorAreaCSS'] = chr(47) . "phpshop" . chr(47) . "templates" . chr(47) . $PHPShopSystem->getValue('skin') . chr(47) . $PHPShopBase->getParam('css.default');
    $oFCKeditor->ToolbarSet = 'Normal';
    $oFCKeditor->Value = $file;
    $info = $oFCKeditor->AddGUI();

    $oFCKeditorUni = new Editor('content_multilanguages_ini_uni');
    $oFCKeditorUni->Height = '550';
    $oFCKeditorUni->Config['EditorAreaCSS'] = chr(47) . "phpshop" . chr(47) . "templates" . chr(47) . $PHPShopSystem->getValue('skin') . chr(47) . $PHPShopBase->getParam('css.default');
    $oFCKeditorUni->ToolbarSet = 'Normal';
    $oFCKeditorUni->Value = $fileu;
    $infouni = $oFCKeditorUni->AddGUI();
    $Tab2.='<div class="row"><div class="col-md-6"><h4>�������</h4>'.$info.'</div>'; 
    $Tab2.='<div class="row"><div class="col-md-6"><h4>��������</h4>'.$infouni.'</div>'; 


    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1, true), array("��������", $Tab2,true));

    // ����� ������ ��������� � ����� � �����
    $ContentFooter =
            $PHPShopGUI->setInput("hidden", "rowID", $data['id'], "right", 70, "", "but") .
            $PHPShopGUI->setInput("button", "delID", "�������", "right", 70, "", "but", "actionDelete.modules.edit") .
            $PHPShopGUI->setInput("submit", "editID", "���������", "right", 70, "", "but", "actionUpdate.modules.edit") .
            $PHPShopGUI->setInput("submit", "saveID", "���������", "right", 80, "", "but", "actionSave.modules.edit");

    $PHPShopGUI->setFooter($ContentFooter);
    return true;
}

/**
 * ����� ����������
 */
function actionSave() {
    global $PHPShopGUI;


    // ���������� ������
    actionUpdate();

    header('Location: ?path=' . $_GET['path']);
}

// ������� ��������
function actionDelete() {
    global $PHPShopOrm;
    $action = $PHPShopOrm->delete(array('id' => '=' . $_POST['rowID']));
    return array("success" =>  $action);
}


// ��������� �������
$PHPShopGUI->getAction();

// ����� ����� ��� ������
$PHPShopGUI->setAction($_GET['id'], 'actionStart', 'none');

?>