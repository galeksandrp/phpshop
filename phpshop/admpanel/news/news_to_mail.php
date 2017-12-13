<?php

$_classPath = "../../";
include($_classPath . "class/obj.class.php");
PHPShopObj::loadClass("base");
PHPShopObj::loadClass("mail");
PHPShopObj::loadClass("system");

$PHPShopBase = new PHPShopBase($_classPath . "inc/config.ini");
$PHPShopBase->chekAdmin();
$PHPShopSystem = new PHPShopSystem();

// �������� GUI
PHPShopObj::loadClass("admgui");
$PHPShopGUI = new PHPShopGUI();
$PHPShopGUI->title = "��������";

// SQL
PHPShopObj::loadClass("orm");
$PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['table_name9']);

// ������
PHPShopObj::loadClass("modules");
$PHPShopModules = new PHPShopModules($_classPath . "modules/");

function actionStart() {
    global $PHPShopGUI, $PHPShopModules;

    $PHPShopGUI->dir = "../";
    $PHPShopGUI->size = "400,300";


    // ����������� ��������� ����
    $PHPShopGUI->setHeader("�������� �������� �� '" . $_GET['data'] . "'", "������� ������ ��� ������ � ����.", $PHPShopGUI->dir . "img/i_mail_forward_med[1].gif");


    // �������� ������
    $time = explode(' ', microtime());
    $start_time = $time[1] + $time[0];

    $num = 0;
    $content = Ras_data_content($_GET['data']);
    Ras_data_mail($content, $num);

    // ��������� ������
    $time = explode(' ', microtime());
    $seconds = ($time[1] + $time[0] - $start_time);
    $seconds = substr($seconds, 0, 6);


    // ���������� �������� 1
    $Tab1 = $PHPShopGUI->setDiv('left', "�������� ����������� �� <b>" . $num . "</b> ������(��).<br>
	����� ��������� �������: $seconds sec.");

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1, 120));

    // ������ ������ �� ��������
    $PHPShopModules->setAdmHandler($_SERVER["SCRIPT_NAME"], __FUNCTION__, false);

    // ����� ������ ��������� � ����� � �����
    $ContentFooter = $PHPShopGUI->setInput("button", "", "�������", "right", 70, "return onCancel();", "but");

    // �����
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

// ������ ��������
function Ras_data_content($data) {
    global $PHPShopSystem, $PHPShopModules;
    $content = null;
    $sql = "select * from " . $GLOBALS['SysValue']['base']['table_name8'] . "  where date='$data' and content IS NOT NULL";
    $result = mysql_query($sql);
    while ($row = mysql_fetch_array($result)) {
        $data = $row['date'];
        $kratko = strip_tags($row['description']);
        $podrob = $row['content'];
        if (!empty($podrob)) {

            // �������� ������ Seourl
            if (!empty($row['seo_name']))
                $link = __("�����������") . ": http://" . $_SERVER['SERVER_NAME'] . "/news/ID_" . $row['seo_name'] . ".html";
            else
                $link = __("�����������") . ": http://" . $_SERVER['SERVER_NAME'] . "/news/ID_" . $row['id'] . ".html";
        }
        else {
            $link = null;
        }
        $content.=
                $kratko . "
" . $link;
    }
    $disp = "
" . __("������������, ������������ ������� � �����") . "\"" . strtoupper($PHPShopSystem->getParam('name')) . "

" . $content . "

------------
" . __("� ���������,") . "
" . __("���������") . " " . strtoupper($PHPShopSystem->getParam('company')) . "
";
    return $disp;
}

// ��������
function Ras_data_mail($content, &$num) {
    global $PHPShopSystem;
    $num = 0;
    $zag = __("������ ��������") . " " . $PHPShopSystem->getParam('name');
    $sql = "select distinct mail from " . $GLOBALS['SysValue']['base']['table_name9'] . " order by id";
    $result = mysql_query($sql);
    while ($row = mysql_fetch_array($result)) {
        $mail_to = $row['mail'];
        $unwrite = '
' . __('��� ������ �� �������� �������� ��������� �� ������') . ': http://' . $_SERVER['SERVER_NAME'] . '/news/?news_del=true&mail=' . $mail_to;
        new PHPShopMail($mail_to, $PHPShopSystem->getParam('admin_mail'), $zag, $content . $unwrite);
        $num++;
    }
}

?>