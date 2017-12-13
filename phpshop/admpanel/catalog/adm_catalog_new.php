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
$PHPShopGUI->title = __("�������� ��������");
$PHPShopGUI->reload = "left";

// SQL
PHPShopObj::loadClass("orm");
$PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['categories']);

// ������
PHPShopObj::loadClass("modules");
$PHPShopModules = new PHPShopModules($_classPath . "modules/");

function actionStart() {
    global $PHPShopGUI, $PHPShopModules, $PHPShopOrm, $PHPShopSystem, $PHPShopBase;

    // ��� ����
    if ($_COOKIE['winOpenType'] == 'default')
        $dot = ".";
    else
        $dot = false;

    // ��������� ������
    $data = array();
    if (!empty($_GET['categoryID']))
        $data['category'] = $_GET['categoryID'];
    $data['name'] = __('����� �������');
    // ��-��� ������ �� �������� ��������.. ������ 0 ��� ��������� ��������� ��������������� ������� �����.
    $data['num_cow'] = 0;
    //$data['num_cow'] = $PHPShopSystem->getParam('num_row');
    $data['num_row'] = 3;
    $data['num'] = 1;

    $PHPShopGUI->dir = "../";
    //$PHPShopGUI->size = "700,650";
    // ����������� ��������� ����
    $PHPShopGUI->setHeader(__("�������� ��������"), __(""), $PHPShopGUI->dir . "img/i_actionlog_med[1].gif");

    // ������������
    $Tab1 = $PHPShopGUI->setField(__("������������:"), $PHPShopGUI->setInputText(false, 'name_new', $data['name'], '100%'));

    // ����� ��������
    $Tab1.= $PHPShopGUI->setField(__("�������:"), $PHPShopGUI->setInputText(false, "parent_name", getCatPath($_GET['categoryID']), '450px', false, 'left') .
            $PHPShopGUI->setInput("hidden", "parent_to_new", $_GET['categoryID'], "left", 400) .
            $PHPShopGUI->setButton(__('�������'), "../img/icon-move-banner.gif", "100px", '25px', "right", "miniWin('" . $dot . "./catalog/adm_cat.php?category=" . $_GET['categoryID'] . "',300,400);return false;"));

    // �����
    $num_row_area = $PHPShopGUI->setRadio('num_row_new', 1, 1, $data['num_row']);
    $num_row_area.=$PHPShopGUI->setRadio('num_row_new', 2, 2, $data['num_row']);
    $num_row_area.=$PHPShopGUI->setRadio('num_row_new', 3, 3, $data['num_row']);
    $num_row_area.=$PHPShopGUI->setRadio('num_row_new', 4, 4, $data['num_row']);
    $Tab1.=$PHPShopGUI->setField(__("������� � �����:"), $num_row_area, 'left');

    // �����
    $Tab1.=$PHPShopGUI->setField(__("����� ������:"), $PHPShopGUI->setCheckbox('vid_new', 1, __('�������� ����������� ������� � �������� ����'), $data['vid']) .
            $PHPShopGUI->setCheckbox('skin_enabled_new', 1, __('������ �������'), $data['skin_enabled']));
    // ������� �� ��������
    $Tab1.=$PHPShopGUI->setLine() . $PHPShopGUI->setField(__("������� �� ��������:"), $PHPShopGUI->setInputText(false, 'num_cow_new', $data['num_cow'], '50px', __('��.')), 'left');

    // ��� ����������
    $order_by_value[] = array('�� �����', 1, 0);
    $order_by_value[] = array('�� ����', 2, 0);
    $order_by_value[] = array('�� ������', 3, 3);
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
    $PHPShopGUI->setTab(array(__("��������"), $Tab1, 450), array(__("��������"), $Tab2, 450), array(__("���������"), $Tab7, 450), array(__("�������������"), $Tab8, 450), array(__("���������c����"), $Tab4, 450));

    // ������
    $Tab10 = $PHPShopGUI->setField(__('�����������'), $PHPShopGUI->setInputText(false, "icon_new", $data['icon'], '450px', false, 'left') .
            $PHPShopGUI->setButton(__('�������'), "../img/icon-move-banner.gif", "100px", '25px', "right", "ReturnPic('icon_new');return false;"));

    $Tab10.=$PHPShopGUI->setField(__('�������� �����������'), $PHPShopGUI->setTextArea('icon_description_new', $data['icon_description']));

    $PHPShopGUI->addTab(array("������", $Tab10, 450));

    // ������ ������ �� ��������
    $PHPShopModules->setAdmHandler($_SERVER["SCRIPT_NAME"], __FUNCTION__, $data);

    // ����� ������ ��������� � ����� � �����
    $ContentFooter =
            $PHPShopGUI->setInput("button", "", "������", "right", 70, "return onCancel();", "but") .
            $PHPShopGUI->setInput("reset", "", "��������", "right", 70, "", "but") .
            $PHPShopGUI->setInput("submit", "editID", "��", "right", 70, "", "but", "actionInsert.cat_prod.create");

    // �����
    $PHPShopGUI->setFooter($ContentFooter);
    return true;
}

/**
 * ����� ����������
 * @return bool 
 */
function actionInsert() {
    global $PHPShopModules, $PHPShopOrm, $PHPShopBase;

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

    if (empty($_POST['yml_new']))
        $_POST['yml_new'] = 0;

    // ��������������
    $_POST['sort_new'] = serialize($_POST['sort_new']);

    // ����������
    $_POST['servers_new'] = null;
    if (is_array($_POST['servers']))
        foreach ($_POST['servers'] as $v)
            $_POST['servers_new'].="i" . $v . "i";

    $action = $PHPShopOrm->insert($_POST);


    // ���� ������� �������� ������������ �������� �������� ������, �� ��������� ��� � �����������.
    if ($_POST['parent_to_new'] AND $_POST[parent_to_new] != "undefined") {
        $PHPShopOrmProd = new PHPShopOrm($GLOBALS['SysValue']['base']['products']);
        $data = $PHPShopOrmProd->select(array('id'), array('category' => '=' . $_POST['parent_to_new']));
        if (is_array($data) AND count($data)) {
            $PHPShopOrmProd->clean();
            $catNewId = mysql_insert_id();
            $PHPShopOrmProd->update(array('category' => $catNewId), array('category' => '=' . $_POST['parent_to_new']), '');
        }
    }

    header('Location: ?path=' . $_GET['path']);
    return $action;
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

// ����� ����� ��� ������
$PHPShopGUI->setLoader($_POST['editID'], 'actionStart');

// ��������� �������
$PHPShopGUI->getAction();
?>