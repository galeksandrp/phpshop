<?php

$_classPath = "../../";
include($_classPath . "class/obj.class.php");
PHPShopObj::loadClass("base");
PHPShopObj::loadClass("system");
PHPShopObj::loadClass("valuta");
PHPShopObj::loadClass("array");
PHPShopObj::loadClass("page");
PHPShopObj::loadClass("security");
PHPShopObj::loadClass("category");

// ����������� � ��
$PHPShopBase = new PHPShopBase($_classPath . "inc/config.ini");
$PHPShopBase->chekAdmin();

// ��������� ���������
$PHPShopSystem = new PHPShopSystem();

// �������� GUI
PHPShopObj::loadClass("admgui");
$PHPShopGUI = new PHPShopGUI();
$PHPShopGUI->title = __("�������������� ��������");
$PHPShopGUI->reload = "all";

// SQL
PHPShopObj::loadClass("orm");
$PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['delivery']);

// ������
PHPShopObj::loadClass("modules");
$PHPShopModules = new PHPShopModules($_classPath . "modules/");

/**
 * ����� �������� ���� ��������������
 */
function actionStart() {
    global $PHPShopGUI, $PHPShopModules, $PHPShopOrm, $PHPShopSystem, $PHPShopBase;

    // ��� ����
    if ($_COOKIE['winOpenType'] == 'default')
        $dot = ".";
    else
        $dot = false;




    $PHPShopGUI->dir = "../";
    //$PHPShopGUI->size = "700,650";
    // ����������� ��������� ����
    $PHPShopGUI->setHeader(__('�������� �������� '), __(""), $PHPShopGUI->dir . "img/i_actionlog_med[1].gif");


    $data['PID'] = $_REQUEST['categoryID'];
    $data['city'] = "����� ��������";

    // ������� �������� 
    $Tab1.= $PHPShopGUI->setField(__("�������:"), $PHPShopGUI->setInputText(false, "parent_name", Disp_cat($data['PID']), '400px', false, 'left') .
            $PHPShopGUI->setInput("hidden", "PID_new", $data['PID'], "left", 400) .
            $PHPShopGUI->setButton(__('�������'), "../img/icon-move-banner.gif", "100px", '25px', "left", "miniWin('adm_cat.php?category=" . $data['PID'] . "',300,400);return false;"));

    // ������������
    $Tab1 .= $PHPShopGUI->setField(__("��������:"), $PHPShopGUI->setInputText(false, 'city_new', $data['city'], '222px') .
            $PHPShopGUI->setCheckbox('flag_new', 1, __('�������� �� ���������'), 0), "left");

    // ����
    $Tab1.= $PHPShopGUI->setField(__("���������:"), $PHPShopGUI->setDiv("", $PHPShopGUI->setInputText(false, 'price_new', 0, '50px'), "height: 52px;"), 'left');

    // ���������
    $Tab1.= $PHPShopGUI->setField(__("��������� (���/����):"), $PHPShopGUI->setDiv("", $PHPShopGUI->setCheckbox('enabled_new', 1, __('��������'), 1), "height: 52px;"), 'left');

    // ����� �� �������
    $Tab1.= $PHPShopGUI->setField(__("����� �� �������:"), $PHPShopGUI->setDiv("", $PHPShopGUI->setInputText(false, 'num_new', 0, '50px'), "height: 52px;"), 'left');


    // ���������� ��������
    $Tab1 .= $PHPShopGUI->setLine() . $PHPShopGUI->setField(__("���������� ��������:"), $PHPShopGUI->setInputText("�����", 'price_null_new', 1000, '50%', "���.", "left") .
                    $PHPShopGUI->setCheckbox('price_null_enabled_new', 1, __('��������'), 0));


    // ��������� ������ ������� �� ��
    $city_select_value[] = array('�� ������������', 0, $data['city_select']);
    $city_select_value[] = array('������ ������� � ������ ��', 1, $data['city_select']);
    $city_select_value[] = array('��� ������ ����', 2, $data['city_select']);
    $Tab1.=$PHPShopGUI->setField(__("������ ������� �����, �������� � �������:"), $PHPShopGUI->setSelect('city_select_new', $city_select_value, 120), 'left');
    // ������
    $Tab1.= $PHPShopGUI->setField(__('������'), $PHPShopGUI->setInputText(false, "icon_new", $data['icon'], '190px', false, 'left') .
            $PHPShopGUI->setButton(__('�������'), "../img/icon-move-banner.gif", "100px", '25px', "right", "ReturnPic('icon_new');return false;"));

    $Tab2 .= $PHPShopGUI->setField(__("��������� ����� ������ ��� ������� ���� ��������:"), "<table >
                <tr><td>����</td><td>���/����</td><td>�������� ��� ������</td><td>������������</td><td>No</td></tr>"
            . "<tr><td>������</td>"
            . "<td>" . $PHPShopGUI->setCheckbox('data_fields[enabled][country][enabled]', 1, __(''), $data_fields[enabled][country][enabled]) . "</td>"
            . "<td>" . $PHPShopGUI->setInputText(false, 'data_fields[enabled][country][name]', $data_fields[enabled][country][name], "100") . "</td>"
            . "<td>" . $PHPShopGUI->setCheckbox('data_fields[enabled][country][req]', 1, __(''), $data_fields[enabled][country][req]) . "</td>"
            . "<td>" . $PHPShopGUI->setInputText(false, 'data_fields[num][country]', $data_fields[num][country], "20") . "</td></tr>"
            . "<tr><td>������/����</td>"
            . "<td>" . $PHPShopGUI->setCheckbox('data_fields[enabled][state][enabled]', 1, __(''), $data_fields[enabled][state][enabled]) . "</td>"
            . "<td>" . $PHPShopGUI->setInputText(false, 'data_fields[enabled][state][name]', $data_fields[enabled][state][name], "100") . "</td>"
            . "<td>" . $PHPShopGUI->setCheckbox('data_fields[enabled][state][req]', 1, __(''), $data_fields[enabled][state][req]) . "</td>"
            . "<td>" . $PHPShopGUI->setInputText(false, 'data_fields[num][state]', $data_fields[num][state], "20") . "</td></tr>"
            . "<tr><td>�����</td>"
            . "<td>" . $PHPShopGUI->setCheckbox('data_fields[enabled][city][enabled]', 1, __(''), $data_fields[enabled][city][enabled]) . "</td>"
            . "<td>" . $PHPShopGUI->setInputText(false, 'data_fields[enabled][city][name]', $data_fields[enabled][city][name], "100") . "</td>"
            . "<td>" . $PHPShopGUI->setCheckbox('data_fields[enabled][city][req]', 1, __(''), $data_fields[enabled][city][req]) . "</td>"
            . "<td>" . $PHPShopGUI->setInputText(false, 'data_fields[num][city]', $data_fields[num][city], "20") . "</td></tr>"
            . "<tr><td>������</td>"
            . "<td>" . $PHPShopGUI->setCheckbox('data_fields[enabled][index][enabled]', 1, __(''), $data_fields[enabled][index][enabled]) . "</td>"
            . "<td>" . $PHPShopGUI->setInputText(false, 'data_fields[enabled][index][name]', $data_fields[enabled][index][name], "100") . "</td>"
            . "<td>" . $PHPShopGUI->setCheckbox('data_fields[enabled][index][req]', 1, __(''), $data_fields[enabled][index][req]) . "</td>"
            . "<td>" . $PHPShopGUI->setInputText(false, 'data_fields[num][index]', $data_fields[num][index], "20") . "</td></tr>"
            . "<tr><td>���</td>"
            . "<td>" . $PHPShopGUI->setCheckbox('data_fields[enabled][fio][enabled]', 1, __(''), $data_fields[enabled][fio][enabled]) . "</td>"
            . "<td>" . $PHPShopGUI->setInputText(false, 'data_fields[enabled][fio][name]', $data_fields[enabled][fio][name], "100") . "</td>"
            . "<td>" . $PHPShopGUI->setCheckbox('data_fields[enabled][fio][req]', 1, __(''), $data_fields[enabled][fio][req]) . "</td>"
            . "<td>" . $PHPShopGUI->setInputText(false, 'data_fields[num][fio]', $data_fields[num][fio], "20") . "</td></tr>"
            . "<tr><td>�������</td>"
            . "<td>" . $PHPShopGUI->setCheckbox('data_fields[enabled][tel][enabled]', 1, __(''), $data_fields[enabled][tel][enabled]) . "</td>"
            . "<td>" . $PHPShopGUI->setInputText(false, 'data_fields[enabled][tel][name]', $data_fields[enabled][tel][name], "100") . "</td>"
            . "<td>" . $PHPShopGUI->setCheckbox('data_fields[enabled][tel][req]', 1, __(''), $data_fields[enabled][tel][req]) . "</td>"
            . "<td>" . $PHPShopGUI->setInputText(false, 'data_fields[num][tel]', $data_fields[num][tel], "20") . "</td></tr>"
            . "<tr><td>�����</td>"
            . "<td>" . $PHPShopGUI->setCheckbox('data_fields[enabled][street][enabled]', 1, __(''), $data_fields[enabled][street][enabled]) . "</td>"
            . "<td>" . $PHPShopGUI->setInputText(false, 'data_fields[enabled][street][name]', $data_fields[enabled][street][name], "100") . "</td>"
            . "<td>" . $PHPShopGUI->setCheckbox('data_fields[enabled][street][req]', 1, __(''), $data_fields[enabled][street][req]) . "</td>"
            . "<td>" . $PHPShopGUI->setInputText(false, 'data_fields[num][street]', $data_fields[num][street], "20") . "</td></tr>"
            . "<tr><td>���</td>"
            . "<td>" . $PHPShopGUI->setCheckbox('data_fields[enabled][house][enabled]', 1, __(''), $data_fields[enabled][house][enabled]) . "</td>"
            . "<td>" . $PHPShopGUI->setInputText(false, 'data_fields[enabled][house][name]', $data_fields[enabled][house][name], "100") . "</td>"
            . "<td>" . $PHPShopGUI->setCheckbox('data_fields[enabled][house][req]', 1, __(''), $data_fields[enabled][house][req]) . "</td>"
            . "<td>" . $PHPShopGUI->setInputText(false, 'data_fields[num][house]', $data_fields[num][house], "20") . "</td></tr>"
            . "<tr><td>�������</td>"
            . "<td>" . $PHPShopGUI->setCheckbox('data_fields[enabled][porch][enabled]', 1, __(''), $data_fields[enabled][porch][enabled]) . "</td>"
            . "<td>" . $PHPShopGUI->setInputText(false, 'data_fields[enabled][porch][name]', $data_fields[enabled][porch][name], "100") . "</td>"
            . "<td>" . $PHPShopGUI->setCheckbox('data_fields[enabled][porch][req]', 1, __(''), $data_fields[enabled][porch][req]) . "</td>"
            . "<td>" . $PHPShopGUI->setInputText(false, 'data_fields[num][porch]', $data_fields[num][porch], "20") . "</td></tr>"
            . "<tr><td>��� ��������</td>"
            . "<td>" . $PHPShopGUI->setCheckbox('data_fields[enabled][door_phone][enabled]', 1, __(''), $data_fields[enabled][door_phone][enabled]) . "</td>"
            . "<td>" . $PHPShopGUI->setInputText(false, 'data_fields[enabled][door_phone][name]', $data_fields[enabled][door_phone][name], "100") . "</td>"
            . "<td>" . $PHPShopGUI->setCheckbox('data_fields[enabled][door_phone][req]', 1, __(''), $data_fields[enabled][door_phone][req]) . "</td>"
            . "<td>" . $PHPShopGUI->setInputText(false, 'data_fields[num][door_phone]', $data_fields[num][door_phone], "20") . "</td></tr>"
            . "<tr><td>��������</td>"
            . "<td>" . $PHPShopGUI->setCheckbox('data_fields[enabled][flat][enabled]', 1, __(''), $data_fields[enabled][flat][enabled]) . "</td>"
            . "<td>" . $PHPShopGUI->setInputText(false, 'data_fields[enabled][flat][name]', $data_fields[enabled][flat][name], "100") . "</td>"
            . "<td>" . $PHPShopGUI->setCheckbox('data_fields[enabled][flat][req]', 1, __(''), $data_fields[enabled][flat][req]) . "</td>"
            . "<td>" . $PHPShopGUI->setInputText(false, 'data_fields[num][flat]', $data_fields[num][flat], "20") . "</td></tr>"
            . "<tr><td>����� ��������</td>"
            . "<td>" . $PHPShopGUI->setCheckbox('data_fields[enabled][delivtime][enabled]', 1, __(''), $data_fields[enabled][delivtime][enabled]) . "</td>"
            . "<td>" . $PHPShopGUI->setInputText(false, 'data_fields[enabled][delivtime][name]', $data_fields[enabled][delivtime][name], "100") . "</td>"
            . "<td>" . $PHPShopGUI->setCheckbox('data_fields[enabled][delivtime][req]', 1, __(''), $data_fields[enabled][delivtime][req]) . "</td>"
            . "<td>" . $PHPShopGUI->setInputText(false, 'data_fields[num][delivtime]', $data_fields[num][delivtime], "20") . "</td></tr>"
            . "</table>"
    );


    // ����� ����� ��������
    $PHPShopGUI->setTab(array(__("��������"), $Tab1, 300), array(__("��������� ����� ������ �� ������"), $Tab2, 480));



    // ������ ������ �� ��������
    $PHPShopModules->setAdmHandler($_SERVER["SCRIPT_NAME"], __FUNCTION__, $data);

    // ����� ������ ��������� � ����� � �����
    $ContentFooter =
            $PHPShopGUI->setInput("button", "", "������", "right", 70, "return onCancel();", "but") .
            $PHPShopGUI->setInput("reset", "", "��������", "right", 70, "", "but") .
            $PHPShopGUI->setInput("submit", "editID", "��", "right", 70, "", "but", "actionInsert.delivery.create") .
            $PHPShopGUI->setLine();

    // �����
    $PHPShopGUI->setFooter($ContentFooter);
    return true;
}

/**
 * ����� ����������
 * @return bool 
 */
function actionInsert() {
    global $PHPShopModules, $PHPShopBase, $PHPShopOrm;


    // �������� ���� ��������������
//    if ($PHPShopBase->Rule->CheckedRules('delivery', 'rule')) {
    if (is_array($_POST['data_fields']))
        $_POST['data_fields_new'] = serialize($_POST['data_fields']);

    // ������������ �������
    if (empty($_POST['flag_new']))
        $_POST['flag_new'] = 0;
    if (empty($_POST['enabled_new']))
        $_POST['enabled_new'] = 0;
    if (empty($_POST['price_null_enabled_new']))
        $_POST['price_null_enabled_new'] = 0;


    if ($_POST['flag_new'])
        $PHPShopOrm->update(array('flag_new' => '0'), array('is_folder' => "='0'"));

    $PHPShopOrm->clean();
    $action = $PHPShopOrm->insert($_POST);

    return $action;
//    }
}

// ����� ����� ��� ������
$PHPShopGUI->setLoader($_POST['editID'], 'actionStart');

// ��������� �������
$PHPShopGUI->getAction();

/**
 * ���� ��������
 * @param int $category �� ���������
 * @return string 
 */
function Disp_cat_pod($category) {// ����� ��������� � ������ ������������
    $sql = "select city from " . $GLOBALS['SysValue']['base']['table_name30'] . " where id='$category'";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    @$name = $row['city'];
    return @$name . " -> ";
}

function Disp_cat($category) {// ����� ��������� � ������
    $sql = "select city,PID from " . $GLOBALS['SysValue']['base']['table_name30'] . " where id=$category";
    $result = mysql_query($sql);
    @$row = mysql_fetch_array(@$result);
    @$num = mysql_num_rows(@$result);
    if ($num > 0) {
        $name = $row['city'];
        $parent_to = $row['PID'];
        $dis = Disp_cat_pod($parent_to) . $name;
    }
    return @$dis;
}

?>