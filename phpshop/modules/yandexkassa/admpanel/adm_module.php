<?php


// SQL
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.yandexkassa.yandexkassa_system"));

// ���������� ������ ������
function actionBaseUpdate() {
    global $PHPShopModules, $PHPShopOrm;
    $PHPShopOrm->clean();
    $option = $PHPShopOrm->select();
    $new_version = $PHPShopModules->getUpdate($option['version']);
    $PHPShopOrm->clean();
    $action = $PHPShopOrm->update(array('version_new' => $new_version));
    header('Location: ?path=modules&id='.$_GET['id']);
    return $action;
}

// ������� ����������
function actionUpdate() {
    global $PHPShopOrm,$PHPShopModules;
    
    // ��������� �������
    $PHPShopModules->updateOption($_GET['id'], $_POST['servers']);

    if (is_array($_POST['pay_variants_new']))
        $_POST['pay_variants_new'] = serialize($_POST['pay_variants_new']);
    if (!isset($_POST['test_new']))
        $_POST['test_new'] = 0;

    $PHPShopOrm->debug = false;
    $action = $PHPShopOrm->update($_POST);
    header('Location: ?path=modules&id='.$_GET['id']);
    return $action;
}

function actionStart() {
    global $PHPShopGUI, $PHPShopOrm;
    
    PHPShopObj::loadClass('order');

    // �������
    $data = $PHPShopOrm->select();


    $Tab1 = $PHPShopGUI->setField('������ �� ������', $PHPShopGUI->setInputText(false, 'title_new', $data['title']));
    $Tab1 .= $PHPShopGUI->setField('�������� �����', $PHPShopGUI->setCheckbox('test_new', 1, '�������� �������� �����', $data['test']));
    $Tab1.=$PHPShopGUI->setField('ShopID', $PHPShopGUI->setInputText(false, 'merchant_id_new', $data['merchant_id'], 300));
    $Tab1.=$PHPShopGUI->setField('Scid', $PHPShopGUI->setInputText(false, 'merchant_scid_new', $data['merchant_scid'], 300));
    $Tab1.=$PHPShopGUI->setField('��������� �����', $PHPShopGUI->setInputText(false, 'merchant_sig_new', $data['merchant_sig'], 300));

    // �������� ������� �������
    $PHPShopOrderStatusArray = new PHPShopOrderStatusArray();
    $OrderStatusArray = $PHPShopOrderStatusArray->getArray();
    $order_status_value[] = array(__('����� �����'), 0, $data['status']);
    if (is_array($OrderStatusArray))
        foreach ($OrderStatusArray as $order_status)
            $order_status_value[] = array($order_status['name'], $order_status['id'], $data['status']);

    // ������ ������
    $Tab1.= $PHPShopGUI->setField('������ ��� �������', $PHPShopGUI->setSelect('status_new', $order_status_value, 3000));

    $Tab1.=$PHPShopGUI->setField('�������� ������', $PHPShopGUI->setTextarea('title_end_new', $data['title_end']));

    // ��������� ������
    require_once(dirname(__FILE__) . '/../hook/mod_option.hook.php');
    $PHPShopYandexkassaArray = new PHPShopYandexkassaArray();
    $value = $PHPShopYandexkassaArray->get_pay_variants_array(unserialize($data['pay_variants']));

    $Tab1.=$PHPShopGUI->setField('������� ������', $PHPShopGUI->setSelect('pay_variants_new[]', $value,'100%', null, false, true, false, 1, true));


    // ����� �����������
    $Tab3 = $PHPShopGUI->setPay(false, false, $data['version'], false);

    $info = '
        <h4>��� ������������ � ������.�����?</h4>
        <ol>
<li>������� ������ �� ����������� �� ������ <a href="https://money.yandex.ru/joinups/?source=phpshop" target="_blank">https://money.yandex.ru/joinups/?source=phpshop</a> � �������� ������ � ������ �������.</li>
<li>��������� ������.</li>
<li>�������� ������ �����������.</li>
<li>��������� �������.</li>
</ol>

<h4>����������� ������ ����������� ��� ����������� � ����������� � ������.�����</h4>
            <p>CheckOrder URL: <code>https://' . $_SERVER['SERVER_NAME'] . '/phpshop/modules/yandexkassa/payment/check.php</code> <br>
            PaymentAviso URL: <code>https://' . $_SERVER['SERVER_NAME'] . '/phpshop/modules/yandexkassa/payment/aviso.php</code><br>
            SuccessURL: <code>http://' . $_SERVER['SERVER_NAME'] . '/yandexkassa/?act=success</code><br>
            FailURL URL: <code>http://' . $_SERVER['SERVER_NAME'] . '/yandexkassa/?act=fail</code></p>
                <p>����������� �������� ����� �� ������� "��������" ��� ���������� �������� ��������. ���� "��������� �����" ����������� ������� ���������� � ���� "shopPassword" ��� ����������� � �������. ���� "<b>ShopID</b>" � "<b>Scid</b>" ��� ������� ��������� ������.����� ����� �����������.</p>
                <p>� ��������� "������ ��� �������" �������� ������ ������, ��� ������� ������������ ������ ��������� ����������� �������� ����� ������ ��������. ���� ������ ������ "����� �����", ������������ ������ �������� ����� ����� ����� ����������. ��������� �������� � ���� "�������� ������" ��������� ����� ���������� ������ � ������, ����� ������ ������ �� ��������� �� �������� ��������� � ��������� "������ ��� �������".</p>
                <p>� ������ "������� ������" �������� ��, ������� ������ ������������ �� ����� �����.</p>
                
        <h4>��������� ��������</h4>
        <p>�������� ������ ��� ��� �������� ����� ��������� � �������� �������������� ��������.
        </p>


                <h4>������� �������</h4>
                <p>������ ������ ���������� � �������� ������� ����� ���������: <code>phpshop/modules/yandexkassa/templates/payment_forma.tpl</code><br>
                ������ ��������� �� �������� ������: <code>phpshop/modules/yandexkassa/templates/success_forma.tpl</code><br>
                ������ ��������� �� �������� ������: <code>phpshop/modules/yandexkassa/templates/fail_forma.tpl</code></p>
    ';

    $Tab2 .= $PHPShopGUI->setInfo($info);

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1,true), array("����������", $Tab2), array("� ������", $Tab3));

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
$PHPShopGUI->setLoader($_POST['saveID'], 'actionStart');
?>