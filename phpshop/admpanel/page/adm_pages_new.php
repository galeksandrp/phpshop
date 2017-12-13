<?php

$_classPath = "../../";
include($_classPath . "class/obj.class.php");
PHPShopObj::loadClass("base");
PHPShopObj::loadClass("system");
PHPShopObj::loadClass("array");
PHPShopObj::loadClass("page");
PHPShopObj::loadClass("category");

$PHPShopBase = new PHPShopBase($_classPath . "inc/config.ini");
$PHPShopBase->chekAdmin();
$PHPShopSystem = new PHPShopSystem();

// �������� GUI
PHPShopObj::loadClass("admgui");
$PHPShopGUI = new PHPShopGUI();
$PHPShopGUI->title = "�������� �������";
$PHPShopGUI->reload = "right";

// SQL
PHPShopObj::loadClass("orm");
$PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['page']);

// ������
PHPShopObj::loadClass("modules");
$PHPShopModules = new PHPShopModules($_classPath . "modules/");

function actionStart() {
    global $PHPShopGUI, $PHPShopSystem, $SysValue, $_classPath, $PHPShopModules;

    // ��� ����
    if ($_COOKIE['winOpenType'] == 'default')
        $dot = ".";
    else
        $dot = false;

    // ��������� ������
    $data = array();
    if (!empty($_GET['categoryID']))
        $data['category'] = $_GET['categoryID'];

    $num = 1;
    $enabled = 1;

    $PHPShopGUI->dir = "../";
    //$PHPShopGUI->size="650,600";
    // ����������� ��������� ����
    $PHPShopGUI->setHeader("�������� �������", "������� ������ ��� ������ � ����.", $PHPShopGUI->dir . "img/i_website_tab[1].gif");

    // �������� 1
    $PHPShopGUI->setEditor($PHPShopSystem->getSerilizeParam("admoption.editor"));
    $oFCKeditor = new Editor('content_new');
    $oFCKeditor->Height = '400';
    $oFCKeditor->Config['EditorAreaCSS'] = $_classPath . "templates" . chr(47) . $PHPShopSystem->getParam("skin") . chr(47) . $SysValue['css']['default'];
    $oFCKeditor->ToolbarSet = 'Normal';
    $oFCKeditor->Value = $content;

    // ���������� �������� 1
    $Tab1 = $PHPShopGUI->setField("�������:", $PHPShopGUI->setInput("text", "parent_name", getCatPath($_GET['categoryID']), "left", 450) .
                    $PHPShopGUI->setInput("hidden", "category_new", $data['category'], "left", 450) .
                    $PHPShopGUI->setButton("�������", "../icon/folder_edit.gif", "100px", "�������", "none", "miniWin('" . $dot . "./page/adm_cat.php?category=" . $category . "',300,400);return false;"), "none") .
            $PHPShopGUI->setLine() .
            $PHPShopGUI->setField("���������:", $PHPShopGUI->setInput("text", "name_new", $name, "left", 400), "left") .
            $PHPShopGUI->setField("������� ������:", $PHPShopGUI->setInput("text", "num_new", $num, "left", 50), "none", 5) .
            $PHPShopGUI->setLine() .
            $PHPShopGUI->setField("������:", $PHPShopGUI->setInputText('/page/', "link_new", $link, 200, '.html'), "left");

    $SelectValue[] = array('����� � ��������', 1, $enabled);
    $SelectValue[] = array('�������������', 0, $enabled);

    $Tab1.= $PHPShopGUI->setField("�����:", $PHPShopGUI->setSelect("enabled_new", $SelectValue, 150), "none", 5);

    // ���������� �������� 2
    $Tab2 = $oFCKeditor->AddGUI();

    // ���������� �������� 3
    $Tab3 = $PHPShopGUI->setField("Title: ", $PHPShopGUI->setTextarea("title_new", $title), "none");
    $Tab3.=$PHPShopGUI->setField("Description: ", $PHPShopGUI->setTextarea("description_new", $description), "none");
    $Tab3.=$PHPShopGUI->setField("Keywords: ", $PHPShopGUI->setTextarea("keywords_new", $keywords), "none");

    // �����������
    $Tab4 = $PHPShopGUI->loadLib('tab_secure', $data);

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("����������", $Tab2, 400), array("����������", $Tab1, 400), array("���������", $Tab3, 400), array(__("������������"), $Tab4, 400));

    // ������ ������ �� ��������
    $PHPShopModules->setAdmHandler($_SERVER["SCRIPT_NAME"], __FUNCTION__, $data);

    // ����� ������ ��������� � ����� � �����
    $ContentFooter =
            $PHPShopGUI->setInput("button", "", "������", "right", 70, "return onCancel();", "but") .
            $PHPShopGUI->setInput("reset", "", "��������", "right", 70, "", "but") .
            $PHPShopGUI->setInput("submit", "editID", "��", "right", 70, "", "but", "actionInsert.page_site.create");

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
    $PHPShopCategoryArray = new PHPShopPageCategoryArray();
    $PHPShopCategoryArray->objArray[1000] = array('id'=>1000,'parent_to'=>3000,'name'=>'������� ���� �����');
    $PHPShopCategoryArray->objArray[3000] = array('id'=>3000,'parent_to'=>0,'name'=>'����');
    $PHPShopCategoryArray->objArray[2000] = array('id'=>2000,'parent_to'=>3000,'name'=>'��������� ��������');

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

// ������� ����������
function actionInsert() {
    global $PHPShopModules, $PHPShopBase, $PHPShopOrm;

    // �������� ���� ��������������
    if ($PHPShopBase->Rule->CheckedRules('page_site', 'edit')) {
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

    $_POST['date_new'] = date('U');

    // ������������� ������ ��������
    $PHPShopOrm->updateZeroVars('enabled_new');

    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['page']);
    $action = $PHPShopOrm->insert($_POST);

    return $action;
}

// ����� ����� ��� ������
$PHPShopGUI->setLoader($_POST['editID'], 'actionStart');

// ��������� �������
$PHPShopGUI->getAction();
?>
