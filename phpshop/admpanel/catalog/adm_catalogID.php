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
$PHPShopGUI->reload = "left";

// SQL
PHPShopObj::loadClass("orm");
$PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['categories']);

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

    // �������
    $data = $PHPShopOrm->select(array('*'), array('id' => '=' . intval($_REQUEST['catalogID'])));

    // ID ���� ��� ������ ��������
    $PHPShopGUI->setID(__FILE__, $data['id']);

    $PHPShopGUI->dir = "../";
    //$PHPShopGUI->size = "700,650";
    // ����������� ��������� ����
    $PHPShopGUI->setHeader(__('�������������� �������� "' . $data['name'] . '"'), __(""), $PHPShopGUI->dir . "img/i_actionlog_med[1].gif");

    // ��� ������
    if (!is_array($data)) {
        $PHPShopGUI->setFooter($PHPShopGUI->setInput("button", "", "�������", "center", 100, "return onCancel();", "but"));
        return true;
    }

    // ������������
    $Tab1 = $PHPShopGUI->setField(__("������������ <b>CID " . $data['id'] . "</b>:"), $PHPShopGUI->setInputText(false, 'name_new', $data['name'], '100%'));

    // ����� ��������
    $Tab1.= $PHPShopGUI->setField(__("�������:"), $PHPShopGUI->setInputText(false, "parent_name", getCatPath($data['id']), '450px', false, 'left') .
            $PHPShopGUI->setInput("hidden", "parent_to_new", $data['parent_to'], "left", 400) .
            $PHPShopGUI->setButton(__('�������'), "../img/icon-move-banner.gif", "100px", '25px', "right", "miniWin('" . $dot . "./catalog/adm_cat.php?category=" . $data['parent_to'] . "',300,400);return false;"));

    // �����
    $num_row_area = $PHPShopGUI->setRadio('num_row_new', 1, 1, $data['num_row']);
    $num_row_area.=$PHPShopGUI->setRadio('num_row_new', 2, 2, $data['num_row']);
    $num_row_area.=$PHPShopGUI->setRadio('num_row_new', 3, 3, $data['num_row']);
    $num_row_area.=$PHPShopGUI->setRadio('num_row_new', 4, 4, $data['num_row']);
    $Tab1.=$PHPShopGUI->setField(__("������� � �����:"), $num_row_area, 'left');

    // �����
    // ����� ������� �������� ������ ��� �������� ���������.
    if ($data['parent_to'] == 0)
        $vid = $PHPShopGUI->setCheckbox('vid_new', 1, __('�������� ����������� ������� � �������� ����'), $data['vid']);
    $vid .= $PHPShopGUI->setCheckbox('skin_enabled_new', 1, __('������ �������'), $data['skin_enabled']);
    $Tab1.=$PHPShopGUI->setField(__("����� ������:"), $vid);

    // ������� �� ��������
    $Tab1.=$PHPShopGUI->setLine() . $PHPShopGUI->setField(__("������� �� ��������:"), $PHPShopGUI->setInputText(false, 'num_cow_new', $data['num_cow'], '50px', __('��.')), 'left');

    // ��� ����������
    $order_by_value[] = array('�� �����', 1, $data['order_by']);
    $order_by_value[] = array('�� ����', 2, $data['order_by']);
    $order_by_value[] = array('�� ������', 3, $data['order_by']);
    $order_to_value[] = array('�����������', 1, $data['order_to']);
    $order_to_value[] = array('��������', 2, $data['order_to']);
    $Tab1.=$PHPShopGUI->setField(__("����������:"), $PHPShopGUI->setInputText('�', "num_new", $data['num'], '50px', false, 'left') .
            $PHPShopGUI->setSelect('order_by_new', $order_by_value, 120) . $PHPShopGUI->setSelect('order_to_new', $order_to_value, 120), 'left');

    $PHPShopGUI->setEditor($PHPShopSystem->getSerilizeParam("admoption.editor"));
    $oFCKeditor = new Editor('content_new');
    $oFCKeditor->Height = '450';
    $oFCKeditor->Config['EditorAreaCSS'] = chr(47) . "phpshop" . chr(47) . "templates" . chr(47) . $PHPShopSystem->getValue('skin') . chr(47) . $PHPShopBase->getParam('css.default');
    $oFCKeditor->ToolbarSet = 'Normal';
    $oFCKeditor->Value = $data['content'];
    $Tab2 = $oFCKeditor->AddGUI();

    // ��������������
    $Tab4 = $PHPShopGUI->loadLib('tab_sorts', $data);

    // ���������
    $Tab7 = $PHPShopGUI->loadLib('tab_headers', $data);

    // �����������
    $Tab8_1 = $PHPShopGUI->loadLib('tab_secure', $data);

    // ����������
    $Tab8_2 = $PHPShopGUI->loadLib('tab_multibase', $data);

    $PHPShopInterfaceDoc = new PHPShopInterface('_dop_');
    $PHPShopInterfaceDoc->setTab(array(__("������������"), $Tab8_1, 400), array(__("����������"), $Tab8_2, 400));
    $Tab8 = $PHPShopInterfaceDoc->getContent();

    // ����� ����� ��������
    $PHPShopGUI->setTab(array(__("��������"), $Tab1, 450), array(__("��������"), $Tab2, 450), array(__("���������"), $Tab7, 450), array(__("�������������"), $Tab8, 450));


    // ���������� �������� �������������� ���� ��� ������������
    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['categories']);
    $subcategory_data = $PHPShopOrm->select(array('id'), array('parent_to' => '=' . intval($data['id'])), false, array('limit' => 2));
    if (!is_array($subcategory_data))
        $PHPShopGUI->addTab(array(__("���������c����"), $Tab4, 450));

    // ������
    $Tab10 = $PHPShopGUI->setField(__('�����������'), $PHPShopGUI->setInputText(false, "icon_new", $data['icon'], '450px', false, 'left') .
            $PHPShopGUI->setButton(__('�������'), "../img/icon-move-banner.gif", "100px", '25px', "right", "ReturnPic('icon_new');return false;"));

    $Tab10.=$PHPShopGUI->setField(__('�������� �����������'), $PHPShopGUI->setTextArea('icon_description_new', $data['icon_description']));

    $PHPShopGUI->addTab(array("������", $Tab10, 450));

    // ������ ������ �� ��������
    $PHPShopModules->setAdmHandler($_SERVER["SCRIPT_NAME"], __FUNCTION__, $data);

    // ����� ������ ��������� � ����� � �����
    $ContentFooter =
            $PHPShopGUI->setInput("hidden", "catalogID", $data['id'], "right", 70, "", "but") .
            $PHPShopGUI->setInput("button", "", "������", "right", 70, "return onCancel();", "but") .
            $PHPShopGUI->setInput("button", "delID", "�������", "right", 70, "return onDelete('" . __('�� ������������� ������ �������? ��������! ������������ ������ � ������������ ����� ���������� �� ��������� �����.') . "')", "but", "actionDelete.cat_prod.remove") .
            $PHPShopGUI->setInput("submit", "editID", "���������", "right", 70, "", "but", "actionUpdate.cat_prod.edit") .
            $PHPShopGUI->setInput("submit", "saveID", "���������", "right", 80, "", "but", "actionSave.cat_prod.edit");

    // �����
    $PHPShopGUI->setFooter($ContentFooter);
    return true;
}

/**
 * ���� ��������
 * @param int $category �� ���������
 * @return string 
 */
function getCatPath($category) {

    $PHPShopCategoryArray = new PHPShopCategoryArray();
    $i = 1;
    $str = __('������');
    while ($i < 10) {
        $parent = $PHPShopCategoryArray->getParam($category . '.parent_to');
        if (isset($parent)) {
            $path[$category] = $PHPShopCategoryArray->getParam($category . '.name');
            $category = $parent;
        }
        $i++;
    }

    if (is_array($path)) {
        $path = array_reverse($path);

        foreach ($path as $val)
            $str.=' -> ' . $val;

        return $str;
    }
}

/**
 * ����� ����������
 */
function actionSave() {
    global $PHPShopGUI;

    // ���������� ������
    actionUpdate();

    $PHPShopGUI->setAction($_POST['catalogID'], 'actionStart', 'none');
}

/**
 * ����� ����������
 * @return bool 
 */
function actionUpdate() {
    global $PHPShopModules, $PHPShopBase;

    // �������� ���� ��������������
    if ($PHPShopBase->Rule->CheckedRules('cat_prod', 'rule')) {

        $sq_new = null;
        $counter = 0;
        $selected = 0;
        if (is_array($_POST['seq']))
            foreach ($_POST['seq'] as $crid => $value) {
                $sq_new.='i' . $crid . '-' . $value . 'i';
                $counter++;
                if ($value) {
                    $selected++;
                }
                if (!empty($_POST['seq']['9999'])) {
                    $sq_new = '';
                    break;
                }
            }
        if (empty($selected) || ($counter == $selected)) {
            $sq_new = '';
        }
        $_POST['secure_groups_new'] = $sq_new;
    }

    // �������� ������
    $PHPShopModules->setAdmHandler($_SERVER["SCRIPT_NAME"], __FUNCTION__, $_POST);

    if (empty($_POST['vid_new']))
        $_POST['vid_new'] = 0;

    if (empty($_POST['skin_enabled_new']))
        $_POST['skin_enabled_new'] = 0;

    // ��������������
    $_POST['sort_new'] = serialize($_POST['sort_new']);

    // ��������
    if (isset($_POST['EditorContent1']))
        $_POST['content_new'] = $_POST['EditorContent1'];

    // ����������
    $_POST['servers_new'] = null;
    if (is_array($_POST['servers']))
        foreach ($_POST['servers'] as $v)
            $_POST['servers_new'].="i" . $v . "i";

    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['categories']);
    $PHPShopOrm->debug = false;
    $action = $PHPShopOrm->update($_POST, array('id' => '=' . $_POST['catalogID']));
    $PHPShopOrm->clean();

    return $action;
}

// ������� ��������
function actionDelete() {
    global $PHPShopOrm, $PHPShopModules;

    // �������� ������
    $PHPShopModules->setAdmHandler($_SERVER["SCRIPT_NAME"], __FUNCTION__, $_POST);
    $action = $PHPShopOrm->delete(array('id' => '=' . intval($_POST['catalogID'])));

    // ��������� ������������ � ��������� �������� �� ��������� �����
    $PHPShopOrm->clean();
    $PHPShopOrm->update(array("parent_to" => "1000003", "skin_enabled" => "1"), array("parent_to" => "=" . $_POST['catalogID']), false);

    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['products']);
    $PHPShopOrm->update(array("category" => "1000004", "enabled" => '0'), array("category" => "=" . $_POST['catalogID']), false);

    return $action;
}

// ����� ����� ��� ������
$PHPShopGUI->setAction($_GET['catalogID'], 'actionStart', 'none');

// ��������� �������
$PHPShopGUI->getAction();
?>