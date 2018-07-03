<?php

// SQL
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.socauth.socauth_system"));

// ������� ����������
function actionUpdate() {
    global $PHPShopOrm;

    $upArr['authConfig_new'] = serialize($_POST['authConfig']);
    // ����������� ������ �� ��� �����
    $action = $PHPShopOrm->update($upArr, array('id' => '= 1'));
    header('Location: ?path=modules&install=check');
    return $action;
}

// ��������� ������� ��������
function actionStart() {
    global $PHPShopGUI, $PHPShopOrm;


// �������
    $data = $PHPShopOrm->select();

    $authConfig = unserialize($data['authConfig']);
    $fcCongif = $authConfig['facebook'];
    $twCongif = $authConfig['twitter'];
    $vkCongif = $authConfig['vk'];

    $Tab1 = $PHPShopGUI->setCollapse('��������� Facebook', $PHPShopGUI->setField('App ID', $PHPShopGUI->setInput("text", "authConfig[facebook][appid]", $fcCongif['appid'], '', 300)) . $PHPShopGUI->setField('Secret ID', $PHPShopGUI->setInput("text", "authConfig[facebook][secret]", $fcCongif['secret'], '', 300)));

    $Tab1.= $PHPShopGUI->setCollapse('��������� Twitter', $PHPShopGUI->setField('Consumer key', $PHPShopGUI->setInput("text", "authConfig[twitter][key]", $twCongif['key'], '', 300)) . $PHPShopGUI->setField('Consumer secret', $PHPShopGUI->setInput("text", "authConfig[twitter][secretkey]", $twCongif['secretkey'], '', 300)));

    $Tab1.= $PHPShopGUI->setCollapse('��������� ���������', $PHPShopGUI->setField('ID ����������', $PHPShopGUI->setInput("text", "authConfig[vk][client_id]", $vkCongif['client_id'], '', 300)) . $PHPShopGUI->setField('���������� ����', $PHPShopGUI->setInput("text", "authConfig[vk][client_secret]", $vkCongif['client_secret'], '', 300)));



    $Info = '<h4>��������� �������</h4>
����� �������� ������ �� ����������� ����� ���������� ���� � ����� ����������� �� �����, ����� � ������� <code>users/users_forma.tpl</code>
�������� �����:<br> <kbd>@facebookAuth@</kbd>, <kbd>@twitterAuth@</kbd>, <kbd>@vkontakteAuth@</kbd>.
<h4>��������� twitter.com</h4>
<ol>
<li>�������������� � ��������</li>
<li>������� �� ������ <a href="https://dev.twitter.com/apps/new?from=phpshop" target="_blank">https://dev.twitter.com/apps/new</a></li>
<li>��������� ��� ���� �� ��� ����������, ����� ���� "Callback URL:"</li>
<li>� "Callback URL:" ���������� ������� ������ �������� �� ��� ����: <code>http://��������.��/socauth/twitter/</code>
<li>� ���� "WebSite: *" ����� ������� ����� ������ �����: <code>http://��������.��</code>
<li>����� ����, ��� ���������� ����������, ��������� �������� ��������
<li>������ ���� ������������� �� ���� ����������
<li>�� �������� �������� ���������� ����� ��������� <b>Consumer key</b>, <b>Consumer secret</b>
<li>��������� � ���������� ���� ���������, ���������� ��������� � ��������������� ���� � ��������� ������ ����������� ����� ������� �� ������� "��������"
</ol>
<h4>��������� facebook.com</h4>
<ol>
<li>�������������� � ��������
<li>������� �� ������ <a href="https://developers.facebook.com/apps" target="_blank">https://developers.facebook.com/apps</a>
<li>������� ���������� (App Name ����� ���� �����)
<li>��������� ���� �� ������� �������� ���������� ������� �������
<li>� ���� "App Domains" ���������� ������� ��� ����� (���� ���� ����� �� ���������, ����� ��������� ������ ��������), ��������: 
���� ����� �� test.phpshop-partners.ru, ����� ������� phpshop-partners.ru
<li>��� ���� ���� ������� �������� ������ �������� ��� ���������, ����� ���� "Site URL"<br><br>
<li>� ���� "Site URL" ���������� ������� ��������� ����� ������ ������, ��������: http://test.phpshop-partners.ru
<li>�� ���������� ���������� ����� ������ <b>App ID</b>, <b>App Secret</b>
<li>��������� � ���������� ���� ���������, ���������� ��������� � ��������������� ���� � ��������� ������ ����������� ����� ������� �� ������� "��������"
</ol>
<h4>��������� vk.com</h4>
<ol>
<li>�������������� � vk.com
<li>������� �� ������ <a href="http://vk.com/editapp?act=create" target="_blank">http://vk.com/editapp?act=create</a>
<li>������� ���������� ���� ���-���� (�������� ����� ���� �����)
<li> � ���� "����� �����" ���������� ������� ��������� ����� ������ ������, ��������: http://test.phpshop-partners.ru
<li>� ���� "������� �����" ���������� ������� ��� ����� (���� ���� ����� �� ���������, ����� ��������� ������ ��������), ��������: ���� ����� �� test.phpshop-partners.ru, ����� ������� phpshop-partners.ru
<li>�� ���������� ���������� ����� ������ <b>ID ����������</b>, <b>���������� ����</b>
<li>��������� � ���������� ���� ��������� ���������� ��������� � ��������������� ���� � ��������� ������ ����������� ����� ������� �� ������� "��������"
</ol>';

    $Tab2.=$PHPShopGUI->setInfo($Info);

    $Tab3 = $PHPShopGUI->setPay();

    // ������� ���������
    $Tab3.= $PHPShopGUI->setHistory();


// ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1), array("����������", $Tab2), array("� ������", $Tab3));

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


