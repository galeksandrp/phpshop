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
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.partner.partner_system"));

// ���������� ������ ������
function actionBaseUpdate() {
    global $PHPShopModules, $PHPShopOrm;
    $PHPShopOrm->clean();
    $option = $PHPShopOrm->select();
    $new_version = $PHPShopModules->getUpdate($option['version']);
    $PHPShopOrm->clean();
    $action = $PHPShopOrm->update(array('version_new' => $new_version));
    echo $new_version;
    return $action;
}

// ������� ����������
function actionUpdate() {
    global $PHPShopOrm;
    if (empty($_POST['enabled_new']))
        $_POST['enabled_new'] = 0;
    if (empty($_POST['key_enabled_new']))
        $_POST['key_enabled_new'] = 0;
    $action = $PHPShopOrm->update($_POST);
    return $action;
}

function getStatus($status_id) {
    global $PHPShopGUI;
    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['order_status']);
    $data = $PHPShopOrm->select(array('*'), false, false, array('limit' => 100));
    if (is_array($data))
        foreach ($data as $row) {
            if ($row['id'] == $status_id)
                $sel = 'selected';
            else
                $sel = null;
            $value[] = array($row['name'], $row['id'], $sel);
        }

    return $PHPShopGUI->setSelect('order_status_new', $value, 200, false, '������ ������ �������:');
}

// ��������� ������� ��������
function actionStart() {
    global $PHPShopGUI, $_classPath, $PHPShopOrm;

    $PHPShopGUI->dir = $_classPath . "admpanel/";
    $PHPShopGUI->title = "��������� ������";

    // �������
    $data = $PHPShopOrm->select();
    @extract($data);


    // ����������� ��������� ����
    $PHPShopGUI->setHeader("��������� ������ 'Partner'", "���������", $PHPShopGUI->dir . "img/i_display_settings_med[1].gif");


    $Tab1 = $PHPShopGUI->setCheckbox('enabled_new', 1, '���� ��������� ���������', $enabled);
    $Tab1.=$PHPShopGUI->setCheckbox('key_enabled_new', 1, '���� ������������ ������ API', $key_enabled);
    $Tab1.=$PHPShopGUI->setInputText('���������� ���������', 'percent_new', $percent, '50', '% �� ������');
    $Tab1.=getStatus($order_status);
    $Info = '�������� ����� � ����������� ������ ��������� �� ������: http://' . $_SERVER['SERVER_NAME'] . '/partner/<br>
        ���������� �� ����� ����� �������� ��� ������ ��� �������������.
        <p>
������� ����������� � ����������� ��������� �������� �� ������
        http://' . $_SERVER['SERVER_NAME'] . '/rulepartner/
     <p>
     ������� ���������� ��������� � ����� /phpshop/modules/partner/templates/<br>
     �������� ���� �� ������ /phpshop/modules/partner/inc/config.ini � ����� [lang]
     <p>
     ��� ���������� ������������ ����� � ����� ����������� ������������� �������������� ���� /phpshop/modules/partner/templates/partner_forma_register.tpl,
     �������� ����������� ���� � ��������� dop_, �������� dop_icq.

';

    $Tab1.=$PHPShopGUI->setInfo($Info, '200', '97%');

    // ���������� �������� 2
    $Tab2 = $PHPShopGUI->setPay($serial, false, $version, true);

    $Tab3 = $PHPShopGUI->setTextarea('rule_new', $rule, false, '99%', 320);
    $Tab3.=$PHPShopGUI->setText('* ����������� ���������� @partnerPercent@ ��� ����������� % ��������������.');


    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1, 350), array("����� ������� �������", $Tab3, 350), array("� ������", $Tab2, 350));

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


