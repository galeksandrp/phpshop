<?php

$TitlePage = __('�������� ������ �����');

// SQL
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.multilanguages.multilanguages"));


// ������� ������
function actionInsert() {
    global $PHPShopOrm;
    if(empty($_POST['num_new'])) $_POST['num_new']=1;
    if(empty($_POST['enabled_new'])) $_POST['enabled_new']=0;

    if($_POST['content_multilanguages_ini']!='') {
        //������� ��� ����

        // ����� ���������� ������� � ����
        if($_POST['prefix_new']!='')
            file_put_contents($_SERVER['DOCUMENT_ROOT'].'/phpshop/modules/multilanguages/inc/lang_'.$_POST['prefix_new'].'.ini', $_POST['content_multilanguages_ini']);
    }

    $action = $PHPShopOrm->insert($_POST);
    
    header('Location: ?path=' . $_GET['path']);
    
    return $action;
}

// ��������� ������� ��������
function actionStart() {
    global $PHPShopGUI, $PHPShopOrm, $PHPShopSystem, $PHPShopBase;


    // �������
    $data['name']='����� ����';
    $data['enabled']=1;
    $data['num']=1;
    

    $PHPShopGUI->field_col = 2;
    $Tab1 = $PHPShopGUI->setField('��������', $PHPShopGUI->setInputText(false, 'name_new', $data['name']));
    $Tab1 .= $PHPShopGUI->setField('�����������', $PHPShopGUI->setInputText(false, 'prefix_new', $data['prefix']),false,'��� ����� � ����������� (en/fr)');
    //$Tab1 .= $PHPShopGUI->setField('������', $PHPShopGUI->setInputText(false, 'icon_new', $data['icon']));

    $Tab1.= $PHPShopGUI->setField('���������', $PHPShopGUI->setInputText('�', 'num_new', $data['num'], '100') .
            $PHPShopGUI->setCheckbox('enabled_new', 1, '���.', $data['enabled']));
    
    //������ ��������
    $file = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/phpshop/modules/multilanguages/inc/lang.ini', FILE_USE_INCLUDE_PATH);
    
    $PHPShopGUI->setEditor('ace', true);
    $oFCKeditor = new Editor('content_multilanguages_ini');
    $oFCKeditor->Height = '450';
    $oFCKeditor->Config['EditorAreaCSS'] = chr(47) . "phpshop" . chr(47) . "templates" . chr(47) . $PHPShopSystem->getValue('skin') . chr(47) . $PHPShopBase->getParam('css.default');
    $oFCKeditor->ToolbarSet = 'Normal';
    $oFCKeditor->Value = $file;
    $info = $oFCKeditor->AddGUI();
    $Tab2.=$info; 


    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1, true), array("��������", $Tab2,true));

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