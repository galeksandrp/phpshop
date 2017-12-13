<?php

$_classPath = "../../";
include($_classPath . "class/obj.class.php");
PHPShopObj::loadClass("base");

$PHPShopBase = new PHPShopBase($_classPath . "inc/config.ini");
$PHPShopBase->chekAdmin();

PHPShopObj::loadClass("system");
$PHPShopSystem = new PHPShopSystem();

// �������� GUI
PHPShopObj::loadClass("admgui");
$PHPShopGUI = new PHPShopGUI();
$PHPShopGUI->title = "�������������� ������";
$PHPShopGUI->ajax = "'menu','','','core'";
$PHPShopGUI->alax_lib = true;

// SQL
PHPShopObj::loadClass("orm");
$PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['table_name27']);

// ������
PHPShopObj::loadClass("modules");
$PHPShopModules = new PHPShopModules($_classPath . "modules/");

function actionStart() {
    global $PHPShopGUI, $PHPShopSystem, $SysValue, $_classPath, $PHPShopOrm, $PHPShopModules;

    if ($_GET['adrId'] == "new")
        $adrId = "";
    else
        $adrId = intval($_GET['adrId']);
    // �������
    $data = $PHPShopOrm->select(array('data_adres', 'id'), array('id' => '=' . intval($_GET['id'])));
    $mass = unserialize($data['data_adres']);



    // ID ���� ��� ������ ��������
    $PHPShopGUI->setID(__FILE__, $data['id']);

    $PHPShopGUI->dir = "../";
    //$PHPShopGUI->size = "630,530";
    // ����������� ��������� ����
    $PHPShopGUI->setHeader("�������������� ������ ������������", "", $PHPShopGUI->dir . "img/i_select_another_account_med[1].gif");

    $adresData = array();
    if (is_array($mass['list'][$adrId]))
        $adresData = $mass['list'][$adrId];

    if ($mass['main'] == $adrId)
        $defaultChecked = "checked";
    else
        $defaultChecked = "";
    // ������ ����������
    $Tab1 = $PHPShopGUI->setField(__("���"), $PHPShopGUI->setInputText('', 'mass[fio_new]', $adresData['fio_new'], '190', false, 'left'), 'left') .
            $PHPShopGUI->setField(__("�������"), $PHPShopGUI->setInputText('', 'mass[tel_new]', $adresData['tel_new'], '190', false, 'left'), 'left') .
            $PHPShopGUI->setField(__("������"), $PHPShopGUI->setInputText('', 'mass[country_new]', $adresData['country_new'], '190', false, 'left'), 'left') .
            $PHPShopGUI->setField(__("������/����"), $PHPShopGUI->setInputText('', 'mass[state_new]', $adresData['state_new'], '190', false, 'left'), 'left') .
            $PHPShopGUI->setField(__("�����"), $PHPShopGUI->setInputText('', 'mass[city_new]', $adresData['city_new'], '190', false, 'left'), 'left') .
            $PHPShopGUI->setField(__("������"), $PHPShopGUI->setInputText('', 'mass[index_new]', $adresData['index_new'], '190', false, 'left'), 'left') .
            $PHPShopGUI->setField(__("�����"), $PHPShopGUI->setInputText('', 'mass[street_new]', $adresData['street_new'], '190', false, 'left'), 'left') .
            $PHPShopGUI->setField(__("���"), $PHPShopGUI->setInputText('', 'mass[house_new]', $adresData['house_new_new'], '190', false, 'left'), 'left') .
            $PHPShopGUI->setField(__("�������"), $PHPShopGUI->setInputText('', 'mass[porch_new]', $adresData['porch_new_new'], '190', false, 'left'), 'left') .
            $PHPShopGUI->setField(__("��� ��������"), $PHPShopGUI->setInputText('', 'mass[door_phone_new]', $adresData['door_phone_new'], '190', false, 'left'), 'left') .
            $PHPShopGUI->setField(__("��������"), $PHPShopGUI->setInputText('', 'mass[flat_new]', $adresData['flat_new'], '190', false, 'left'), 'left') .
            $PHPShopGUI->setField(__("����� ��������"), $PHPShopGUI->setInputText('', 'mass[delivtime_new]', $adresData['delivtime_new'], '190', false, 'left'), 'left') .
            $PHPShopGUI->setField(__("������ �� ���������"), $PHPShopGUI->setCheckbox('default', '1', '���������� ��� ������ �� ���������', $defaultChecked), 'left');

    // ��. ������ ����������
    $Tab2 = $PHPShopGUI->setField(__("������������ ����������� "), $PHPShopGUI->setInputText('', 'mass[org_name_new]', $adresData['org_name_new'], '190', false, 'left'), 'left') .
            $PHPShopGUI->setField(__("��� "), $PHPShopGUI->setInputText('', 'mass[org_inn_new]', $adresData['org_inn_new'], '190', false, 'left'), 'left') .
            $PHPShopGUI->setField(__("���"), $PHPShopGUI->setInputText('', 'mass[org_kpp_new]', $adresData['org_kpp_new'], '190', false, 'left'), 'left') .
            $PHPShopGUI->setField(__("����������� �����"), $PHPShopGUI->setInputText('', 'mass[org_yur_adres_new]', $adresData['org_yur_adres_new'], '190', false, 'left'), 'left') .
            $PHPShopGUI->setField(__("����������� �����"), $PHPShopGUI->setInputText('', 'mass[org_fakt_adres_new]', $adresData['org_fakt_adres_new'], '190', false, 'left'), 'left') .
            $PHPShopGUI->setField(__("��������� ����"), $PHPShopGUI->setInputText('', 'mass[org_ras_new]', $adresData['org_ras_new'], '190', false, 'left'), 'left') .
            $PHPShopGUI->setField(__("������������ �����"), $PHPShopGUI->setInputText('', 'mass[org_bank_new]', $adresData['org_bank_new'], '190', false, 'left'), 'left') .
            $PHPShopGUI->setField(__("����������������� ����"), $PHPShopGUI->setInputText('', 'mass[org_kor_new]', $adresData['org_kor_new'], '190', false, 'left'), 'left') .
            $PHPShopGUI->setField(__("���"), $PHPShopGUI->setInputText('', 'mass[org_bik_new]', $adresData['org_bik_new'], '190', false, 'left'), 'left') .
            $PHPShopGUI->setField(__("�����"), $PHPShopGUI->setInputText('', 'mass[org_city_new]', $adresData['org_city_new'], '190', false, 'left'), 'left');


    // ����� ����� ��������
    $PHPShopGUI->setTab(array("������ ������������", $Tab1, 300), array("��. ������ ������������", $Tab2, 300));

    // ������ ������ �� ��������
    $PHPShopModules->setAdmHandler($_SERVER["SCRIPT_NAME"], __FUNCTION__, $data);

    // ����� ������ ��������� � ����� � �����
    $ContentFooter =
            $PHPShopGUI->setInput("hidden", "newsID", $data['id'], "right", 70, "", "but") .
            $PHPShopGUI->setInput("hidden", "adrId", $adrId, "right", 70, "", "but") .
            $PHPShopGUI->setInput("button", "", "������", "right", 70, "return onCancel();", "but") .
            $PHPShopGUI->setInput("button", "delID", "�������", "right", 70, "return onDelete('" . __('�� ������������� ������ �������?') . "')", "but", "actionDelete.shopusers.edit") .
            $PHPShopGUI->setInput("submit", "editID", "���������", "right", 70, "", "but", "actionUpdate.shopusers.edit") .
            $PHPShopGUI->setLine();

    // �����
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

    $_GET['id'] = $_POST['newsID'];
    $PHPShopGUI->setAction($_GET['id'], 'actionStart', 'none');
}

// ������� ����������
function actionUpdate() {
    global $PHPShopOrm, $PHPShopModules;

    $adrId = $_POST['adrId'];
    // �������
    $PHPShopOrm->clean();
    $data = $PHPShopOrm->select(array('data_adres', 'id'), array('id' => '=' . intval($_POST['newsID'])));
    $mass = unserialize($data['data_adres']);
    if (is_array($mass['list'][$adrId]))
        $mass['list'][$adrId] = $_POST['mass'];
    else {
        $mass['list'][] = $_POST['mass'];
        // �������� �� ������������ ������
        end($mass['list']);         // move the internal pointer to the end of the array
        $adrId = key($mass['list']);
    }
    // ��������� ����� �� ���������
    if (isset($_POST['default']) AND $_POST['default'] == 1)
        $mass['main'] = $adrId;
//        
    // �������� ������
    $PHPShopModules->setAdmHandler($_SERVER["SCRIPT_NAME"], __FUNCTION__, $_POST);


    $_POST['data_adres_new'] = serialize($mass);

    $action = $PHPShopOrm->update($_POST, array('id' => '=' . $_POST['newsID']));
    $PHPShopOrm->clean();
    echo"
<script>
    opener.location.reload(); 
    window.close(); 
</script>
	   ";
    return $action;
}

// ������� ��������
function actionDelete() {
    global $PHPShopOrm, $PHPShopModules;

    $adrId = $_POST['adrId'];
    // �������
    $PHPShopOrm->clean();
    $data = $PHPShopOrm->select(array('data_adres', 'id'), array('id' => '=' . intval($_POST['newsID'])));
    $mass = unserialize($data['data_adres']);
    if (isset($mass['list'][$adrId]))
        unset($mass['list'][$adrId]);
    // ���� ��������� ����� - ���. �� ���������, �������� ��������� 
    if ($mass['main'] == $adrId) {
        // �������� �� ������������ ������
        end($mass['list']);         // move the internal pointer to the end of the array
        $adrId = key($mass['list']);
        $mass['main'] = $adrId;
    }


    // �������� ������
    $PHPShopModules->setAdmHandler($_SERVER["SCRIPT_NAME"], __FUNCTION__, $_POST);


    $_POST['data_adres_new'] = serialize($mass);

    $action = $PHPShopOrm->update($_POST, array('id' => '=' . $_POST['newsID']));
    $PHPShopOrm->clean();
    echo"
<script>
    opener.location.reload(); 
    window.close(); 
</script>
	   ";
    return $action;
}

// ����� ����� ��� ������
$PHPShopGUI->setAction($_GET['id'], 'actionStart', 'none');

// ��������� �������
$PHPShopGUI->getAction();
?>