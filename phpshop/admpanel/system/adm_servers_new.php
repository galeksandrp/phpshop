<?php

$TitlePage = __('�������� �������');
$PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['servers']);

// ����� ������� �������
function GetSkinList($skin) {
    global $PHPShopGUI;
    $dir = "../templates/";

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

// ����� �����
function GetLocaleList($skin) {
    global $PHPShopGUI;
    $dir = "../locale/";
    
    $locale_array = array(
        'russian'=>'�������',
        'ukrainian'=>'����������',
        'belarusian'=>'��������',
        'english'=>'English'
        );
    
    if (is_dir($dir)) {
        if (@$dh = opendir($dir)) {
            while (($file = readdir($dh)) !== false) {
                
                $name=$locale_array[$file];
                if(empty($name))
                $name=$file;

                if ($skin == $file)
                    $sel = "selected";
                else
                    $sel = "";

                if ($file != "." and $file != ".." and !strpos($file, '.'))
                $value[] = array($name, $file, $sel, 'data-content="<img src=\''.$dir.'/'.$file.'/icon.png\'/> ' . $name . '"');
            }
            closedir($dh);
        }
    }

    return $PHPShopGUI->setSelect('lang_new', $value);
}

// ��������� ���
function actionStart() {
    global $PHPShopGUI, $TitlePage, $PHPShopModules, $PHPShopSystem;

    PHPShopObj::loadClass('valuta');

    $PHPShopGUI->field_col = 2;
    $PHPShopGUI->setActionPanel($TitlePage, false, array('��������� � �������'));

    // �������
    $data['name'] = __('����� �������');
    $data['enabled'] = 1;

    $Tab1 = $PHPShopGUI->setField("��������", $PHPShopGUI->setInputText(null, "name_new", $data['name']));
    $Tab1 .= $PHPShopGUI->setField("�����", $PHPShopGUI->setInputText('http://', "host_new", $data['host']));
    $Tab1 .= $PHPShopGUI->setField("��������", $PHPShopGUI->setInputText(null, "tel_new", $data['tel']));
    $Tab1 .= $PHPShopGUI->setField("E-mail ����������", $PHPShopGUI->setInputText(null, "adminmail_new", $data['adminmail']));
    $Tab1.=$PHPShopGUI->setField("������", $PHPShopGUI->setRadio("enabled_new", 1, "���.", $data['enabled']) . $PHPShopGUI->setRadio("enabled_new", 0, "����.", $data['enabled']));
    $Tab1.=$PHPShopGUI->setField("�������", $PHPShopGUI->setIcon($data['logo'], "logo_new", false));
    $Tab1.=$PHPShopGUI->setField('��������� (Title)', $PHPShopGUI->setTextarea('title_new', $data['title'], false, false, 100));
    $Tab1.=$PHPShopGUI->setField('�������� (Description)', $PHPShopGUI->setTextarea('descrip_new', $data['descrip'], false, false, 100));
    $Tab1 .= $PHPShopGUI->setField("������������ �����������", $PHPShopGUI->setInputText(null, "company_new", $data['company']));
    $Tab1 .= $PHPShopGUI->setField("����������� �����", $PHPShopGUI->setInputText(null, "adres_new", $data['adres']));

    // ������
    $PHPShopValutaArray = new PHPShopValutaArray();
    $valuta_array = $PHPShopValutaArray->getArray();
    if (is_array($valuta_array))
        foreach ($valuta_array as $val) {
            $currency_value[] = array($val['name'], $val['id'], $PHPShopSystem->getDefaultValutaId());
        }

    $Tab1 .= $PHPShopGUI->setField(array('������', '������', '����'), array($PHPShopGUI->setSelect('currency_new', $currency_value), GetSkinList($PHPShopSystem->getParam('skin')), GetLocaleList($PHPShopSystem->getSerilizeParam('admoption.lang'))), array(array(2, 2), array(1, 2), array(1, 2)));

    $sql_value[] = array('�� �������', 0, 0);
    $sql_value[] = array('�������� ��� ��������', 1, 0);
    $sql_value[] = array('��������� ��� ��������', 2, 0);

    $Tab1.=$PHPShopGUI->setField("�������� ���������", $PHPShopGUI->setSelect('sql', $sql_value, false, true));

    // ������ ������ �� ��������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $data);

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1, true), array("����������", $PHPShopGUI->loadLib('tab_showcase', false, './system/')));

    // ����� ������ ��������� � ����� � �����
    $ContentFooter = $PHPShopGUI->setInput("submit", "saveID", "��", "right", 70, "", "but", "actionInsert.servers.create");

    // �����
    $PHPShopGUI->setFooter($ContentFooter);
    return true;
}

// ������� ����������
function actionInsert() {
    global $PHPShopOrm, $PHPShopModules, $PHPShopBase;

    $License = @parse_ini_file_true("../../license/" . PHPShopFile::searchFile("../../license/", 'getLicense'), 1);
    $_POST['code_new'] = md5($License['License']['Serial'] . str_replace('www.', '', getenv('SERVER_NAME')) . $_POST['host_new'] . $PHPShopBase->getParam("connect.host") . $PHPShopBase->getParam("connect.user_db") . $PHPShopBase->getParam("connect.pass_db"));

    $_POST['icon_new'] = iconAdd();

    // �������� ������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $_POST);
    $action = $PHPShopOrm->insert($_POST);

    // �������
    switch ($_POST['sql']) {

        case 1:
            $PHPShopOrmCat = new $PHPShopOrm();
            $PHPShopOrmCat->query('update ' . $GLOBALS['SysValue']['base']['categories'] . ' set `servers`=CONCAT("i' . $action . 'ii1000i", `servers` )');
            break;

        case 2:
            $PHPShopOrmCat = new $PHPShopOrm();
            $PHPShopOrmCat->query('update ' . $GLOBALS['SysValue']['base']['categories'] . ' set `servers`=REPLACE(`servers`,"i' . $action . 'i",  "")');
            break;
    }


    header('Location: ?path=' . $_GET['path']);
    return $action;
}

// ���������� ����������� 
function iconAdd($name = 'icon_new') {

    // ����� ����������
    $path = '/UserFiles/Image/';

    // �������� �� ������������
    if (!empty($_FILES['file']['name'])) {
        $_FILES['file']['ext'] = PHPShopSecurity::getExt($_FILES['file']['name']);
        if (in_array($_FILES['file']['ext'], array('gif', 'png', 'jpg'))) {
            if (move_uploaded_file($_FILES['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dir']['dir'] . $path . $_FILES['file']['name'])) {
                $file = $GLOBALS['dir']['dir'] . $path . $_FILES['file']['name'];
            }
        }
    }

    // ������ ���� �� URL
    elseif (!empty($_POST['furl'])) {
        $file = $_POST[$name];
    }

    // ������ ���� �� ��������� ���������
    elseif (!empty($_POST[$name])) {
        $file = $_POST[$name];
    }

    if (empty($file))
        $file = '';

    return $file;
}

// ��������� �������
$PHPShopGUI->getAction();

// ����� ����� ��� ������
$PHPShopGUI->setLoader($_POST['saveID'], 'actionStart');
?>