<?php

$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.tinkoff.tinkoff_system"));

/**
 * ���������� ������ ������
 * @return mixed
 */
function actionBaseUpdate()
{
    global $PHPShopModules, $PHPShopOrm;

    $PHPShopOrm->clean();
    $option = $PHPShopOrm->select();
    $new_version = $PHPShopModules->getUpdate($option['version']);
    $PHPShopOrm->clean();
    $action = $PHPShopOrm->update(array('version_new' => $new_version));
}

/**
 * ���������� ��������
 * @return mixed
 */
function actionUpdate()
{
    global $PHPShopOrm;

    $PHPShopOrm->debug = false;
    $action = $PHPShopOrm->update($_POST);
    header('Location: ?path=modules&install=check');

    return $action;
}

/**
 * ����������� �������� ������
 * @return bool
 */
function actionStart()
{
    global $PHPShopGUI, $PHPShopOrm;

    $PHPShopOrm->objBase = $GLOBALS['SysValue']['base']['tinkoff']['tinkoff_system'];
    $data = $PHPShopOrm->select();

    $Tab1 = $PHPShopGUI->setField('������������ ���� ������', $PHPShopGUI->setInputText(false, 'title_new', $data['title']));
    $Tab1 .= $PHPShopGUI->setField('����', $PHPShopGUI->setInputText(false, 'gateway_new', $data['gateway'], 300));
    $Tab1 .= $PHPShopGUI->setField('��������', $PHPShopGUI->setInputText(false, 'terminal_new', $data['terminal'], 300));
    $Tab1 .= $PHPShopGUI->setField('��������� ����', $PHPShopGUI->setInputText(false, 'secret_key_new', $data['secret_key'], 300));

    $onclick = "function toggleTaxation() { document.getElementsByClassName('tinkoff-taxation')[0].classList.toggle('hidden'); }     
        toggleTaxation();";

    $Tab1 .= $PHPShopGUI->setField("���������� ������ ��� ������������ ����", $PHPShopGUI->setRadio("enabled_taxation_new", 1, "��", $data['enabled_taxation'], $onclick)
        . $PHPShopGUI->setRadio("enabled_taxation_new", 0, "���", $data['enabled_taxation'], $onclick));
    
    
    // ����������
    $info = '
        <h4>��������� ������</h4>
        <ol>
<li>������������ ����������� ��������� � ��������� ������� � <a href="https://www.tinkoff.ru/business/?utm_source=partner_rko_sme&utm_medium=ptr.act&utm_campaign=sme.partners&partnerId=5-IV4AJGWE#form-application" target="blank">��������</a>.</li>
<li>�� �������� ��������� ������ ��������������� ������ �������� ����� "�����", ��� "���������" � "��������� ����".</li>
<li>������� ����� ��������������� ������� ��� ���������� ����� �������� ������ ������ ��� ������������ ����.</a></li>
<li>������� ����� ��������������� �������� � �������� �������������� ��������.</a></li>
<li>� ������ �������� �������� � ������� "��������" ������� ����� ��� ����������� � �������� ����� <code>http://' . $_SERVER['SERVER_NAME'] . '/phpshop/modules/tinkoff/payment/notification.php</code></li>
<li>� ������ �������� �������� � ������� "��������" ������� URL �������� ��������� ������� <code>http://' . $_SERVER['SERVER_NAME'] . '/success/?payment=tinkoff</code></li>
<li>� ������ �������� �������� � ������� "��������" ������� URL �������� ����������� ������� <code>http://' . $_SERVER['SERVER_NAME'] . '/fail/</code></li>
</ol>';

    $taxation = array(
        array('����� ��', 'osn', $data['taxation']),
        array('���������� �� (������)', 'usn_income', $data['taxation']),
        array('���������� �� (������ ����� �������) ', 'usn_income_outcome', $data['taxation']),
        array('������ ����� �� ��������� �����', 'envd', $data['taxation']),
        array('������ �������������������� �����', 'esn', $data['taxation']),
        array('��������� ��', 'patent', $data['taxation']),
    );
    $taxationSelect = $PHPShopGUI->setSelect('taxation_new', $taxation, 300);
    $Tab1 .= $PHPShopGUI->setField('������� ���������������', $taxationSelect, 1, null, 'tinkoff-taxation' . ($data['enabled_taxation'] ? '' : ' hidden'));

    // ����� �����������
    $Tab3 = $PHPShopGUI->setPay(null, false, $data['version'], true);
    
    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1,true),array("����������", $PHPShopGUI->setInfo($info)),array("� ������", $Tab3));

    // ����� ������ ��������� � ����� � �����
    $ContentFooter =
        $PHPShopGUI->setInput("hidden", "rowID", $data['id']) .
        $PHPShopGUI->setInput("submit", "saveID", "���������", "right", 80, "", "but", "actionUpdate.modules.edit");

    $PHPShopGUI->setFooter($ContentFooter);

    return true;
}

// ��������� �������
$PHPShopGUI->getAction();

// ����� ����� ��� ������
$PHPShopGUI->setAction($_GET['id'], 'actionStart');
