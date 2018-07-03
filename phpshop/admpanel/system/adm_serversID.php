<?php

$TitlePage = __('�������������� �������').' #' . $_GET['id'];
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
    global $PHPShopGUI, $PHPShopOrm, $PHPShopModules, $PHPShopSystem;
    
    PHPShopObj::loadClass('valuta');

    $PHPShopGUI->field_col = 2;

    // �������
    $data = $PHPShopOrm->select(array('*'), array('id' => '=' . intval($_GET['id'])));

    // ��� ������
    if (!is_array($data)) {
        header('Location: ?path=' . $_GET['path']);
    }

    $PHPShopGUI->setActionPanel(__("�������������� �������").": " . $data['name'] . ' [ID ' . intval($_GET['id']) . ']', array('�������'), array('���������', '��������� � �������'));

    $Tab1 = $PHPShopGUI->setField("��������", $PHPShopGUI->setInputText(null, "name_new", $data['name']));
    $Tab1 .= $PHPShopGUI->setField("�����", $PHPShopGUI->setInputText('http://', "host_new", $data['host']));
    $Tab1 .= $PHPShopGUI->setField(
            array("��������","E-mail ����������"),
            array($PHPShopGUI->setInputText(null, "tel_new", $data['tel']),
            $PHPShopGUI->setInputText(null, "adminmail_new", $data['adminmail'])),
            array(array(2, 4), array(2, 4)));
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
            $currency_value[] = array($val['name'], $val['id'], $data['currency']);
        }

    if (empty($data['skin']))
        $data['skin'] = $PHPShopSystem->getParam('skin');
    
    if (empty($data['lang']))
        $data['lang'] = $PHPShopSystem->getSerilizeParam('admoption.lang');
    
    $Tab1 .= $PHPShopGUI->setField(array('������','������','����'), array($PHPShopGUI->setSelect('currency_new', $currency_value),GetSkinList($data['skin']),GetLocaleList($data['lang'])),array(array(2, 2), array(1, 2), array(1, 2)));

    $sql_value[] = array('�� �������', 0, 0);
    $sql_value[] = array('�������� ��� ��������', 1, 0);
    $sql_value[] = array('��������� ��� ��������', 2, 0);
    $sql_value[] = array('�������� ��� ��������', 3, 0);
    $sql_value[] = array('��������� ��� ��������', 4, 0);
    $sql_value[] = array('�������� ��� ����', 5, 0);
    $sql_value[] = array('��������� ��� ����', 6, 0);
    $sql_value[] = array('�������� ��� ��������', 7, 0);
    $sql_value[] = array('��������� ��� ��������', 8, 0);

    $Tab1.=$PHPShopGUI->setField("�������� ���������", $PHPShopGUI->setSelect('sql', $sql_value,false,true));

    // �������
    $_POST['logo_new'] = iconAdd('logo_new');

    // ������ ������ �� ��������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $data);

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1, true), array("����������", $PHPShopGUI->loadLib('tab_showcase', false, './system/')));

    // ����� ������ ��������� � ����� � �����
    $ContentFooter = $PHPShopGUI->setInput("hidden", "rowID", $data['id'], "right", 70, "", "but") .
            $PHPShopGUI->setInput("button", "delID", "�������", "right", 70, "", "but", "actionDelete.servers.edit") .
            $PHPShopGUI->setInput("submit", "editID", "���������", "right", 70, "", "but", "actionUpdate.servers.edit") .
            $PHPShopGUI->setInput("submit", "saveID", "���������", "right", 80, "", "but", "actionSave.servers.edit");

    // �����
    $PHPShopGUI->setFooter($ContentFooter);
    return true;
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

// ������� ��������
function actionDelete() {
    global $PHPShopOrm, $PHPShopModules;

    // �������� ������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $_POST);

    $action = $PHPShopOrm->delete(array('id' => '=' . $_POST['rowID']));
    return array("success" => $action);
}

/**
 * ����� ����������
 */
function actionSave() {

    // ���������� ������
    actionUpdate();

    header('Location: ?path=' . $_GET['path']);
}

// ������� ����������
function actionUpdate() {
    global $PHPShopOrm, $PHPShopModules, $PHPShopBase;

    if (empty($_POST['ajax'])) {
        $License = @parse_ini_file_true("../../license/" . PHPShopFile::searchFile("../../license/", 'getLicense'), 1);
        $_POST['code_new'] = md5($License['License']['Serial'] . str_replace('www.', '', getenv('SERVER_NAME')) . $_POST['host_new'] . $PHPShopBase->getParam("connect.host") . $PHPShopBase->getParam("connect.user_db") . $PHPShopBase->getParam("connect.pass_db"));
    }

    // �������
    switch ($_POST['sql']) {

        case 1:
            $PHPShopOrmCat = new $PHPShopOrm();
            $PHPShopOrmCat->query('update ' . $GLOBALS['SysValue']['base']['categories'] . ' set `servers`=CONCAT("i' . $_POST['rowID'] . 'ii1000i", `servers` )');
            break;

        case 2:
            $PHPShopOrmCat = new $PHPShopOrm();
            $PHPShopOrmCat->query('update ' . $GLOBALS['SysValue']['base']['categories'] . ' set `servers`=REPLACE(`servers`,"i' . $_POST['rowID'] . 'i",  "")');
            break;

        case 3:
            $PHPShopOrmCat = new $PHPShopOrm();
            $PHPShopOrmCat->query('update ' . $GLOBALS['SysValue']['base']['page'] . ' set `servers`=CONCAT("i' . $_POST['rowID'] . 'ii1000i", `servers` )');
            break;

        case 4:
            $PHPShopOrmCat = new $PHPShopOrm();
            $PHPShopOrmCat->query('update ' . $GLOBALS['SysValue']['base']['page'] . ' set `servers`=REPLACE(`servers`,"i' . $_POST['rowID'] . 'i",  "")');
            break;
        case 5:
            $PHPShopOrmCat = new $PHPShopOrm();
            $PHPShopOrmCat->query('update ' . $GLOBALS['SysValue']['base']['menu'] . ' set `servers`=CONCAT("i' . $_POST['rowID'] . 'ii1000i", `servers` )');
            break;

        case 6:
            $PHPShopOrmCat = new $PHPShopOrm();
            $PHPShopOrmCat->query('update ' . $GLOBALS['SysValue']['base']['menu'] . ' set `servers`=REPLACE(`servers`,"i' . $_POST['rowID'] . 'i",  "")');
            break;

        case 7:
            $PHPShopOrmCat = new $PHPShopOrm();
            $PHPShopOrmCat->query('update ' . $GLOBALS['SysValue']['base']['slider'] . ' set `servers`=CONCAT("i' . $_POST['rowID'] . 'ii1000i", `servers` )');
            break;

        case 8:
            $PHPShopOrmCat = new $PHPShopOrm();
            $PHPShopOrmCat->query('update ' . $GLOBALS['SysValue']['base']['slider'] . ' set `servers`=REPLACE(`servers`,"i' . $_POST['rowID'] . 'i",  "")');
            break;
    }

    // �������� ������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $_POST);
    $action = $PHPShopOrm->update($_POST, array('id' => '=' . $_POST['rowID']));
    return array("success" => $action);
}

// ��������� �������
$PHPShopGUI->getAction();

// ����� ����� ��� ������
$PHPShopGUI->setAction($_GET['id'], 'actionStart', 'none');
?>
