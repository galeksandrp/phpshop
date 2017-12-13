<?

$_classPath = "../../../";
include($_classPath . "class/obj.class.php");
PHPShopObj::loadClass("base");
PHPShopObj::loadClass("system");
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
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.stockgallery.stockgallery_system"));

// ������� ����������
function actionUpdate() {
    global $PHPShopOrm;
    if (empty($_POST['enabled_new']))
        $_POST['enabled_new'] = 0;
    $action = $PHPShopOrm->update($_POST);
    return $action;
}

// ��������� ������� ��������
function actionStart() {
    global $PHPShopGUI, $_classPath, $PHPShopOrm;


    $PHPShopGUI->dir = $_classPath . "admpanel/";
    $PHPShopGUI->title = "��������� ������";
    $PHPShopGUI->size = "500,450";


    // �������
    $data = $PHPShopOrm->select();
    @extract($data);


    // ����������� ��������� ����
    $PHPShopGUI->setHeader("��������� ������ '�������'", "���������", $PHPShopGUI->dir . "img/i_display_settings_med[1].gif");


    $Tab1 = $PHPShopGUI->setField('�����', $PHPShopGUI->setCheckbox('enabled_new', 1, '�������� � ����� ��������������� �� ������� ��������', $enabled));
    $Tab1.=$PHPShopGUI->setField('������ ��������', $PHPShopGUI->setInputText(false, 'width_new', $width, 30, 'px'), 'left');
    $Tab1.=$PHPShopGUI->setField('������ ����������� ������', $PHPShopGUI->setInputText(false, 'img_width_new', $img_width, 30, 'px'), 'left');
    $Tab1.=$PHPShopGUI->setField('������ ����������� ������', $PHPShopGUI->setInputText(false, 'img_height_new', $img_height, 30, 'px'));
    $Tab1.=$PHPShopGUI->setField('�����', $PHPShopGUI->setInputText(false, 'border_new', $border, 30, 'px'), 'left');
    $Tab1.=$PHPShopGUI->setField('���� �����', $PHPShopGUI->setInputText('#', 'border_color_new', $border_color, 100), 'left');
    $Tab1.=$PHPShopGUI->setField('���������� �������', $PHPShopGUI->setInputText(false, 'limit_new', $limit, 30));

    $info = '��� ������������ ������� �������� ������� ������� ������� ������ "�� ��������" � � ������ ������ �������� ����������
        <b>@stockgallery@</b> � ���� ������. ��� ����� ������ ���������� �������� ��������� ����, ������������� � ����� ��������� ���� (������� - ��������� - ������ - ���������� ��������),
        ������� ����� @stockgallery@ - ������ ���� ����� ���������� � ������ ��� �����.
        <p>��� �������������� ����� ������ �������������� ������ phpshop/modules/stockgallery/templates/stockgallery_forma.tpl</p>
';

    $Tab2 = $PHPShopGUI->setInfo($info, 200, '96%');
    
    // ���������� �������� 3
    $Tab3 = $PHPShopGUI->setPay($serial, false);
    
    $Lib='� ������ ������������ �������� ���������� <a href="http://caroufredsel.frebsite.nl/" target="_blank">jQuery carouFredSel</a><br>
        Copyright (C) 2012 Fred Heusschen.';
    $Tab3.=$PHPShopGUI->setInfo($Lib,50,'95%');

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1, 270),array("����������",$Tab2,270), array("� ������", $Tab3, 270));

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


