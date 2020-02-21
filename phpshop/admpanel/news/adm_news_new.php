<?php

$TitlePage = __('�������� �������');
$PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['news']);

function actionStart() {
    global $PHPShopGUI, $PHPShopModules, $PHPShopSystem, $TitlePage;

    // ������ �������� ����
    $PHPShopGUI->field_col = 2;
    
    // �������
    $data['datas'] = PHPShopDate::get();
    $data['zag'] = __('������� �� ') . $data['datas'];

    // datetimepicker
    $PHPShopGUI->addJSFiles('./js/jquery.tagsinput.min.js', './js/bootstrap-datetimepicker.min.js', './js/jquery.waypoints.min.js', './news/gui/news.gui.js');
    $PHPShopGUI->addCSSFiles('./css/jquery.tagsinput.css', './css/bootstrap-datetimepicker.min.css');

    $PHPShopGUI->setActionPanel($TitlePage, false, array('��������� � �������'));

    // �������� 1
    $PHPShopGUI->setEditor($PHPShopSystem->getSerilizeParam("admoption.editor"));
    $oFCKeditor = new Editor('kratko_new');
    $oFCKeditor->Height = '270';
    $oFCKeditor->Value = $data['kratko'];

    // ���������� �������� 1
    $Tab1 = $PHPShopGUI->setField("����", $PHPShopGUI->setInputDate("datas_new", $data['datas'])) .
            $PHPShopGUI->setField("���������", $PHPShopGUI->setInput("text", "zag_new", $data['zag']));

    $Tab1.=$PHPShopGUI->setField("�����", $oFCKeditor->AddGUI());


    // �������� 2
    $oFCKeditor2 = new Editor('podrob_new');
    $oFCKeditor2->Height = '550';
    $oFCKeditor2->Value = $data['podrob'];

    $Tab1.=$PHPShopGUI->setField("��������", $oFCKeditor2->AddGUI());
    
    $Tab2.=$PHPShopGUI->setField("������ ������", $PHPShopGUI->setInputDate("datau_new", $data['datas']));
    
    // ������
    $Tab2 .= $PHPShopGUI->setField("�����������", $PHPShopGUI->setIcon($data['icon'], "icon_new", false));

    // ������������� ������
    $Tab2 .= $PHPShopGUI->setField('������������� ������', $PHPShopGUI->setTextarea('odnotip_new', $data['odnotip'], false, false, 300, __('������� ID ������� ��� ��������������') . ' <a href="#" data-target="#odnotip_new"  class="btn btn-sm btn-default tag-search"><span class="glyphicon glyphicon-search"></span> ' . __('������� �������') . '</a>'));

    $Tab2.=$PHPShopGUI->setField("�������", $PHPShopGUI->loadLib('tab_multibase', $data, 'catalog/'));

    // ������ ������ �� ��������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $data);

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1, true), array("�������������", $Tab2, true));

    // ����� ������ ��������� � ����� � �����
    $ContentFooter = $PHPShopGUI->setInput("submit", "saveID", "��", "right", 70, "", "but", "actionInsert.news.create");

    // �����
    $PHPShopGUI->setFooter($ContentFooter);
    return true;
}

// ������� ����������
function actionInsert() {
    global $PHPShopOrm, $PHPShopModules;

    if (!empty($_POST['datau_new']))
        $_POST['datau_new'] = PHPShopDate::GetUnixTime($_POST['datau_new']);
    else
        $_POST['datau_new'] = PHPShopDate::GetUnixTime($_POST['datas_new']);

    // ����������
    $_POST['servers_new'] = "";
    if (is_array($_POST['servers']))
        foreach ($_POST['servers'] as $v)
            if ($v != 'null' and !strstr($v, ','))
                $_POST['servers_new'].="i" . $v . "i";

    $_POST['icon_new'] = iconAdd();        
            
    // �������� ������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $_POST);

    $action = $PHPShopOrm->insert($_POST);
    header('Location: ?path=' . $_GET['path']);
    return $action;
}

// ���������� ����������� 
function iconAdd() {
    global $PHPShopSystem;

    // ����� ����������
    $path = $GLOBALS['SysValue']['dir']['dir'] . '/UserFiles/Image/' . $PHPShopSystem->getSerilizeParam('admoption.image_result_path');

    // �������� �� ������������
    if (!empty($_FILES['file']['name'])) {
        $_FILES['file']['ext'] = PHPShopSecurity::getExt($_FILES['file']['name']);
        if (in_array($_FILES['file']['ext'], array('gif', 'png', 'jpg', 'jpeg', 'svg'))) {
            if (move_uploaded_file($_FILES['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dir']['dir'] . $path . $_FILES['file']['name'])) {
                $file = $GLOBALS['dir']['dir'] . $path . $_FILES['file']['name'];
            }
        }
    }

    // ������ ���� �� URL
    elseif (!empty($_POST['furl'])) {
        $file = $_POST['icon_new'];
    }

    // ������ ���� �� ��������� ���������
    elseif (!empty($_POST['icon_new'])) {
        $file = $_POST['icon_new'];
    }

    if (empty($file))
        $file = '';

    return $file;
}

// ��������� �������
$PHPShopGUI->getAction();

// ����� ����� ��� ������
$PHPShopGUI->setLoader($_POST['editID'], 'actionStart');
?>
