<?
$_classPath="../../../";
include($_classPath."class/obj.class.php");
PHPShopObj::loadClass("base");
PHPShopObj::loadClass("system");
PHPShopObj::loadClass("security");
PHPShopObj::loadClass("orm");
PHPShopObj::loadClass("file");

$PHPShopBase = new PHPShopBase($_classPath."inc/config.ini");
include($_classPath."admpanel/enter_to_admin.php");


// ��������� ������
PHPShopObj::loadClass("modules");
$PHPShopModules = new PHPShopModules($_classPath."modules/");


// ��������
PHPShopObj::loadClass("admgui");
$PHPShopGUI = new PHPShopGUI();

// SQL
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.pbrf.pbrf_system"));


// ������� ����������
function actionUpdate() {
    global $PHPShopOrm;

    $_POST['data_new'] = serialize($_POST['data']);

    $action = $PHPShopOrm->update($_POST);
    return $action;
}

// ��������� ������� ��������
function actionStart() {
    global $PHPShopGUI,$PHPShopSystem,$SysValue,$_classPath,$PHPShopOrm,$PHPShopModules,$GLOBALS;

    $PHPShopGUI->dir=$_classPath."admpanel/";
    $PHPShopGUI->title="��������� ������";
    $PHPShopGUI->size="500,450";

    // ����������� ��������� ����
    $PHPShopGUI->setHeader("��������� ������ '�������� ������ pbrf.ru'","���������",$PHPShopGUI->dir."img/i_display_settings_med[1].gif");

    //��������� ���������
    $data = $PHPShopOrm->select();
    //@extract($data);

    $data_person = unserialize($data['data']);

    $Tab1 .= $PHPShopGUI->setLine() . $PHPShopGUI->setField('���� API:', 
        $PHPShopGUI->setInputText(false, 'key_new', $data['key'], 220) . 
        $PHPShopGUI->setLine(false, 10) .
        $PHPShopGUI->setImage('../../../admpanel/icon/icon_info.gif', 16, 16) .
            __('<i>��������: <b>11234536951ecd6ab1e9d18e9f3b5088</b></i>'), 'left', 0, 0, array('width' => '98%'));

    $Tab1 .= $PHPShopGUI->setLine() . $PHPShopGUI->setField('���� ������ ��� ������:', 
        $PHPShopGUI->setInputText('��������&nbsp;&nbsp; ', 'data[surname]', $data_person['surname'], 120, false , 'left') . 
        $PHPShopGUI->setInputText('���&nbsp;&nbsp; ', 'data[name]', $data_person['name'], 120, false , 'left') . 
        $PHPShopGUI->setInputText('��������&nbsp;&nbsp; ', 'data[name2]', $data_person['name2'], 120) . 
        $PHPShopGUI->setInputText('������&nbsp;&nbsp; ', 'data[country]', $data_person['country'], 125 , false , 'left') . 
        $PHPShopGUI->setInputText('�������, �����', 'data[region]', $data_person['region'], 127, false , 'left') . 
        $PHPShopGUI->setInputText('�����&nbsp;&nbsp; ', 'data[city]', $data_person['city'], 127) . 
        $PHPShopGUI->setInputText('�����&nbsp;&nbsp; ', 'data[street]', $data_person['street'], 120 , false , 'left') . 
        $PHPShopGUI->setInputText('���&nbsp;&nbsp; ', 'data[build]', $data_person['build'], 40 , false , 'left') . 
        $PHPShopGUI->setInputText('��������&nbsp;&nbsp; ', 'data[appartment]', $data_person['appartment'], 40) . 
        $PHPShopGUI->setInputText('�������� ������&nbsp;&nbsp; ', 'data[zip]', $data_person['zip'], 120) .
        $PHPShopGUI->setInputText('������� ��� sms&nbsp;&nbsp; +7', 'data[tel]', $data_person['tel'], 108)
    , 'left', 0, 0, array('width' => '98%'));

    $Tab1 .= $PHPShopGUI->setLine() . $PHPShopGUI->setField('������������� ��������:', 
        $PHPShopGUI->setInputText('������������ ���������&nbsp;&nbsp; ', 'data[document]', $data_person['document'], 120) . 
        $PHPShopGUI->setInputText('�����&nbsp;&nbsp; ', 'data[document_serial]', $data_person['document_serial'], 70, false , 'left') . 
        $PHPShopGUI->setInputText('�&nbsp;&nbsp; ', 'data[document_number]', $data_person['document_number'], 115) . 
        $PHPShopGUI->setInputText('�����&nbsp;&nbsp; ', 'data[document_day]', $data_person['document_day'], 70 , false , 'left') . 
        $PHPShopGUI->setInputText('20&nbsp;&nbsp; ', 'data[document_year]', $data_person['document_year'], 100,'�.') . 
        $PHPShopGUI->setInputText('������������ ���������� ��������� ��������&nbsp;&nbsp; ', 'data[document_issued_by]', $data_person['document_issued_by'], 220 , false , 'left')
    , 'left', 0, 0, array('width' => '98%'));


    // ���������� �������� 3
    $Info = '<div style="font-size:12px;"><b><u>���������� ������� pbrf.ru</u></b>
    <p><b>��� ��������� ����� ����������:</b>
    <ul>
        <li>����������������� �� <a target="_blank" href="http://pbrf.ru/������������/�����">pbrf.ru</a></li>
        <li>�������������� �� �������</li>
        <li>�������� ���� ������� � ������ �������� <i>(������� API)</i></li>
        <li>������ ���� ���� � ���� "���� API" �� ������� "���������" � ���� ����</li>
    </ul>
    </p>
    <p><b>�����!</b> - �������� ������ ��� �������� ����� ���������� ��������� ������� ������, ���� ���� ������� �������� � ��� �� ���������.</p>
    <p><b>�������� � API ������� pbrf.ru �������� ������ �� ��������� ������� �������. ��������� <a target="_blank" href="http://pbrf.ru/������/�������-�����">��������</a> �� ����� ��������.</b></p></div>';
    $Tab3=$PHPShopGUI->setInfo($Info, 250, '95%');

    // ���������� �������� 4
    $Tab4=$PHPShopGUI->setPay('� ������',false);

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("���������",$Tab1,430), array("����������",$Tab3,430), array("� ������",$Tab4,430));

    // ����� ������ ��������� � ����� � �����
    $ContentFooter=
            $PHPShopGUI->setInput("hidden","newsID",$id,"right",70,"","but").
            $PHPShopGUI->setInput("button","","������","right",70,"return onCancel();","but").
            $PHPShopGUI->setInput("submit","editID","��","right",70,"","but","actionUpdate");

    $PHPShopGUI->setFooter($ContentFooter);
    return true;
}

if($UserChek->statusPHPSHOP < 2) {

    // ����� ����� ��� ������
    $PHPShopGUI->setLoader($_POST['editID'],'actionStart');

    // ��������� �������
    $PHPShopGUI->getAction();

}else $UserChek->BadUserFormaWindow();

?>


