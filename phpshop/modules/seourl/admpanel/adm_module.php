<?php

$_classPath = "../../../";
include($_classPath . "class/obj.class.php");
PHPShopObj::loadClass("base");
PHPShopObj::loadClass("system");
PHPShopObj::loadClass("security");
PHPShopObj::loadClass("orm");

$PHPShopBase = new PHPShopBase($_classPath . "inc/config.ini");
include($_classPath . "admpanel/enter_to_admin.php");


// ��������� ������
PHPShopObj::loadClass("modules");
$PHPShopModules = new PHPShopModules($_classPath . "modules/");


// ��������
PHPShopObj::loadClass("admgui");
$PHPShopGUI = new PHPShopGUI();

// SQL
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.seourl.seourl_system"));

// ���������� ������ ������
function actionBaseUpdate() {
    global $PHPShopModules, $PHPShopOrm;
    $PHPShopOrm->clean();
    $option = $PHPShopOrm->select();
    $new_version = $PHPShopModules->getUpdate($option['version']);
    $PHPShopOrm->clean();
    $action = $PHPShopOrm->update(array('version_new' => $new_version));
    return $action;
}


// ������� ����������
function actionUpdate() {
    global $PHPShopOrm;


    if (empty($_POST['enabled_new']))
        $_POST['enabled_new'] = 0;

    $PHPShopOrm->debug = false;
    $action = $PHPShopOrm->update($_POST);
    return $action;
}

function actionStart() {
    global $PHPShopGUI, $_classPath, $PHPShopOrm;


    $PHPShopGUI->dir = $_classPath . "admpanel/";
    $PHPShopGUI->title = "��������� ������ SEO Url";
    $PHPShopGUI->size = "500,450";


    // �������
    $data = $PHPShopOrm->select();
    @extract($data);

    if ($enabled == 1)
        $enabled = "checked"; else
        $enabled = "";
    if ($flag == 1)
        $s2 = "selected";
    else
        $s1 = "selected";


    $Select[] = array("�����", 0, $s1);
    $Select[] = array("������", 1, $s2);

    // ����������� ��������� ����
    $PHPShopGUI->setHeader("��������� ������ 'SEO Url'", "��������� �����������", $PHPShopGUI->dir . "img/i_display_settings_med[1].gif");

    // ���������� ��������
    $Info = '
<p>������ ������� SEO ������ ��� �������, ��������� �������, ��������� ������� � �������� ����� ����������� � ��� �����

��� ������ ������ ��������� ������ ��������� � ������ �������. ���� � ��� ����� ������� 2012 ����( aqua, skyblue, lime � �.�.),
�� ���������� ����������� ����������� ����� ������� �� ����� �� ftp <b>/phpshop/modules/seourl/tepmplates/seo/</b> � ����� �� ����� ��������.
������� �������� ���� ����� ������ �������, ������ � ��������. ����� ��� ����� ��� �� �����������.
<p>���� � ��� ������ ������� �� 2012 ����, �� ��� ������ ������ ��������� �������� ���������� <b>@nameLat@</b> � ������� ������ ������� � ����� phpshop/templates/��� �������/product/:
   <ol>
   <li>main_product_forma_1.tpl
   <li>main_product_forma_2.tpl
   <li>main_product_forma_3.tpl
   <li>main_product_forma_4.tpl
   <li>main_spec_forma_icon.tpl
   <li>product_page_list.tpl
   </ol>
> ������:<p>
"/shop/UID_@productUid@.html" �������� �� /shop/UID_@productUid@<b>@nameLat@</b>.html</p>
> ������ ��� product_page_list.tpl:<p>
"./CID_@productId@_@productPageThis@.html" �������� �� ./CID_@productId@_@productPageThis@<b>@nameLat@</b>.html</p>

�� �������� ��������� �������� ���������� @nameLat@ � ������� ������ ��������� � ����� phpshop/templates/��� �������/catalog/:
   <ol>
   <li>catalog_forma_2.tpl
   <li>catalog_forma_3.tpl
   <li>catalog_table_forma.tpl
   <li>podcatalog_forma.tpl
   <li>podcatalog_page_forma.tpl
   <li>catalog_page_forma_2.tpl
   </ol>
   
> ������:<p>
"/shop/CID_@catalogId@.html" �������� �� /shop/CID_@catalogId@<b>@nameLat@</b>.html</p>

�� �������� ��������� �������� ���������� @nameLat@ � ������� ������ �������� � ����� phpshop/templates/��� �������/news/:
   <ol>
   <li>main_news_forma.tpl
   <li>news_main_mini.tpl
   </ol>
<p>��� ��������� ������ "SEO ���������" ������� �������� ���������� <b>@seourl_canonical@</b> � ������ phpshop/templates/��� �������/main/shop.tpl, � ���������� ����� ��������� ������ link rel="canonical" � ������ ������� ��� ���������� ������ ������� �������� ������ �������.</p>
';
    $Tab1=$PHPShopGUI->setField('SEO ���������', $PHPShopGUI->setRadio('paginator_new', 2, '��������', $paginator).$PHPShopGUI->setRadio('paginator_new', 1, '���������', $paginator));
    $Tab1.= $PHPShopGUI->setLine('<br>').$PHPShopGUI->setInfo($Info, 190, '95%');

    // ����� �����������
        $Tab2 = $PHPShopGUI->setPay($serial, false, $version, true);

    // ������� ���������
    if(method_exists($PHPShopGUI,'setLine'))
    $Tab2.= $PHPShopGUI->setLine('<br>').$PHPShopGUI->setHistory();

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1, 270), array("� ������", $Tab2, 270));

    // ����� ������ ��������� � ����� � �����
    $ContentFooter =
            $PHPShopGUI->setInput("hidden", "newsID", $id, "right", 70, "", "but") .
            $PHPShopGUI->setInput("button", "", "������", "right", 70, "return onCancel();", "but") .
            $PHPShopGUI->setInput("submit", "editID", "��", "right", 70, "", "but", "actionUpdate");

    $PHPShopGUI->setFooter($ContentFooter);
    return true;
}

if ($UserChek->statusPHPSHOP < 2) {

    // ����� ����� ��� ������
    $PHPShopGUI->setLoader($_POST['editID'], 'actionStart');

    // ��������� ������� 
    $PHPShopGUI->getAction();
}else
    $UserChek->BadUserFormaWindow();
?>