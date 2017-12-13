<?
$_classPath="../../../";
include($_classPath."class/obj.class.php");
include("../class/PHPechkin.php");
PHPShopObj::loadClass("base");
PHPShopObj::loadClass("system");
PHPShopObj::loadClass("orm");
PHPShopObj::loadClass("string");


$PHPShopBase = new PHPShopBase($_classPath."inc/config.ini");
include($_classPath."admpanel/enter_to_admin.php");


// ��������� ������
PHPShopObj::loadClass("modules");
$PHPShopModules = new PHPShopModules($_classPath."modules/");


// ��������
PHPShopObj::loadClass("admgui");
$PHPShopGUI = new PHPShopGUI();

// ������� ����������
function actionUpdate() {
    global $PHPShopOrm;
    //if(empty($_POST['enabled_new'])) $_POST['enabled_new']=0;
    //$action = $PHPShopOrm->update($_POST);
    return $action;
}


// ��������� ������� ��������
function actionStart() {
    global $PHPShopGUI,$PHPShopSystem,$SysValue,$_classPath,$PHPShopOrm;

    $PHPShopGUI->dir=$_classPath."admpanel/";
    $PHPShopGUI->title="������� �������";
    $PHPShopGUI->size="500,590";

    //���������� JS �������������
    $PHPShopGUI->addJSFiles('../js/jquery-1.7.1.min.js','../js/pechkin-admin.js');
    $PHPShopGUI->addCSSFiles('../css/pechkin-admin.css');

    // ����������� ��������� ����
    $PHPShopGUI->setHeader("������� ������� '������'","������� �������","../img/email_go.png");

    //���� ������ ������������� (�������)
    $select = 'SELECT * FROM `phpshop_shopusers_status`';
    $query = mysql_query($select);
    $status = mysql_fetch_array($query);
    do {
        $status_html .= $PHPShopGUI->setInput("checkbox", "status_new", $status['id'], false, false, false, "status_new", false, false, $status['name']);
    }
    while ($status = mysql_fetch_array($query));


    // ���������� �������� 1
    if($_SESSION['pechkinLogin']=='') {
        $Tab1=$PHPShopGUI->setField('��������!', 
            '�� <b><u>�� �����</u></b> � ������� ������ ��� ������������. ���������� ���������� ����������� � ���������� ������ ��� �������� ������� � �������� ����.<br><br>'
            , false, false, '10');
    }

    if($_SESSION['pechkinLogin']!='') {
        $Tab1.=$PHPShopGUI->setField('������ ������������� ��� ��������', 
            $PHPShopGUI->setInput("checkbox", "status_new", '0', false, false, false, "status_new", false, false, '��� �������') .
            $status_html
            , false, false, '10');

        //����� ������ ���� ���� �����������
        if(isset($_SESSION['pechkinLogin'])) {
            $PHPechkin = new PHPechkin();
            $PHPechkin->__construct($_SESSION['pechkinLogin'],$_SESSION['pechkinPass']);
            $lists_get = $PHPechkin->lists_get();

            if($lists_get['row']['id']!='') {
                $lists_get_new[0] = $lists_get['row'];
            }
            else {
                $lists_get_new = $lists_get['row'];
            }

            if(isset($lists_get_new)) {
                foreach ($lists_get_new as $value) {
                    $name_base[$value['id']][0] = PHPShopString::utf8_win1251($value['name']);
                    $name_base[$value['id']][1] = PHPShopString::utf8_win1251($value['id']);
                }
            }
        }

        //���. ���������
        $value_merge_option[] = array('- �� ���������� ��������',0);
        $value_merge_option[] = array('���� �����������','datas');
        $value_merge_option[] = array('���','name');
        //���. ��������� �� �������
        $value_merge_option[] = array('�������','tel_new');
        $value_merge_option[] = array('������','country_new');
        $value_merge_option[] = array('������','state_new');
        $value_merge_option[] = array('�����','city_new');
        $value_merge_option[] = array('������','index_new');
        $value_merge_option[] = array('�����','street_new');
        $value_merge_option[] = array('���','house_new_new');
        $value_merge_option[] = array('�������','porch_new_new');
        $value_merge_option[] = array('��������','flat_new');


        $Tab1.=$PHPShopGUI->setField('�������� ������ ��� �������� � <u>pechkin-mail.ru</u>', 
                '�������������� ���� 1 '.$PHPShopGUI->setSelect('merge1_new',$value_merge_option,200) . '<br>' .
                '�������������� ���� 2 '.$PHPShopGUI->setSelect('merge2_new',$value_merge_option,200) . '<br>' .
                '�������������� ���� 3 '.$PHPShopGUI->setSelect('merge3_new',$value_merge_option,200) . '<br>' .
                '�������������� ���� 4 '.$PHPShopGUI->setSelect('merge4_new',$value_merge_option,200) . '<br>' .
                '�������������� ���� 5 '.$PHPShopGUI->setSelect('merge5_new',$value_merge_option,200) . '<br>' .
                '<p>'.$PHPShopGUI->setImage('../../../admpanel/icon/icon_info.gif', 16, 16, false, false, 'margin-top:-1px; vertical-align:middle;') .
                            __('�������� �������������� ���� ����� �� ������ <a href="https://web.pechkin-mail.ru/?page=lists">https://web.pechkin-mail.ru/?page=lists</a></p>')
        ,false,false,'10' );
    
    
        $Tab1.=$PHPShopGUI->setField('�������� ���� � <u>pechkin-mail.ru</u>', 
                '�������� ���� '.$PHPShopGUI->setSelect('adress_base_new',$name_base,200) . '<br>' .
                '<p>'.$PHPShopGUI->setImage('../../../admpanel/icon/icon_info.gif', 16, 16, false, false, 'margin-top:-1px; vertical-align:middle;') .
                            __('�������� ������ �������� ����� �� ������ <a href="https://web.pechkin-mail.ru/?page=lists">https://web.pechkin-mail.ru/?page=lists</a></p>') .
                $PHPShopGUI->setInput("checkbox", "autoload_new", '0', false, false, false, "autoload_new", false, false, '��������� �������������') .
                $PHPShopGUI->setInput("button","","���������","left",100,"importShopUsers()","but",false, false, '<span id="text_status"></span> <img src="../img/zoomloader.gif" id="loader_auth">')
        ,false,false,'10' );
    }

    //���� ������ ������������� (�������)
    $select = 'SELECT * FROM `phpshop_shopusers_status`';
    $query = mysql_query($select);
    $status = mysql_fetch_array($query);
    do {
        $status_html_subscribe .= $PHPShopGUI->setInput("checkbox", "status_subscribe_new", $status['id'], false, false, false, "status_new", false, false, $status['name']);
    }
    while ($status = mysql_fetch_array($query));

    if($_SESSION['pechkinLogin']=='') {
        $Tab2=$PHPShopGUI->setField('��������!', 
            '�� <b><u>�� �����</u></b> � ������� ������ ��� ������������. ���������� ���������� ����������� � ���������� ������ ��� �������� ������� � �������� ����.<br><br>'
            , false, false, '10');
    }
    else {
        // ���������� �������� 2
        $Tab2.=$PHPShopGUI->setField('������ ������������� ��� ��������', 
            $PHPShopGUI->setInput("checkbox", "status_subscribe_new", '0', false, false, false, "status_subscribe_new", false, false, '��� �������') .
            $status_html_subscribe
            , false, false, '10');

        //����� ������ ���� ���� �����������
        if(isset($_SESSION['pechkinLogin'])) {
            $PHPechkin = new PHPechkin();
            $PHPechkin->__construct($_SESSION['pechkinLogin'],$_SESSION['pechkinPass']);
            $lists_get = $PHPechkin->lists_get();

            if($lists_get['row']['id']!='') {
                $lists_get_new[0] = $lists_get['row'];
            }
            else {
                $lists_get_new = $lists_get['row'];
            }

            if(isset($lists_get_new)) {
                foreach ($lists_get_new as $value) {
                    $name_base[$value['id']][0] = PHPShopString::utf8_win1251($value['name']);
                    $name_base[$value['id']][1] = PHPShopString::utf8_win1251($value['id']);
                }
            }
        }


        $Tab2.=$PHPShopGUI->setField('�������� ������ ��� �������� � <u>pechkin-mail.ru</u>', 
                '�������������� ���� 1 '.$PHPShopGUI->setSelect('merge1_subscribe_new',$value_merge_option,200) . '<br>' .
                '�������������� ���� 2 '.$PHPShopGUI->setSelect('merge2_subscribe_new',$value_merge_option,200) . '<br>' .
                '�������������� ���� 3 '.$PHPShopGUI->setSelect('merge3_subscribe_new',$value_merge_option,200) . '<br>' .
                '�������������� ���� 4 '.$PHPShopGUI->setSelect('merge4_subscribe_new',$value_merge_option,200) . '<br>' .
                '�������������� ���� 5 '.$PHPShopGUI->setSelect('merge5_subscribe_new',$value_merge_option,200) . '<br>' .
                '<p>'.$PHPShopGUI->setImage('../../../admpanel/icon/icon_info.gif', 16, 16, false, false, 'margin-top:-1px; vertical-align:middle;') .
                            __('�������� �������������� ���� ����� �� ������ <a href="https://web.pechkin-mail.ru/?page=lists">https://web.pechkin-mail.ru/?page=lists</a></p>')
        ,false,false,'10' );
        
        $Tab2.=$PHPShopGUI->setField('�������� ���� � <u>pechkin-mail.ru</u>', 
                '�������� ���� '.$PHPShopGUI->setSelect('adress_base_subscribe_new',$name_base,200) . '<br>' .
                '<p>'.$PHPShopGUI->setImage('../../../admpanel/icon/icon_info.gif', 16, 16, false, false, 'margin-top:-1px; vertical-align:middle;') .
                            __('�������� ������ �������� ����� �� ������ <a href="https://web.pechkin-mail.ru/?page=lists">https://web.pechkin-mail.ru/?page=lists</a></p>') .
                $PHPShopGUI->setInput("checkbox", "autoload2_new", '0', false, false, false, "autoload_new", false, false, '��������� �������������') .
                $PHPShopGUI->setInput("button","","���������","left",100,"importShopUsersSubscribe()","but",false, false, '<span id="text_status_subscribe"></span> <img src="../img/zoomloader.gif" id="loader_auth_subscribe">')
        ,false,false,'10' );

    }
    
    
    // ����� ����� ��������
    $PHPShopGUI->setTab(array("������� �������������",$Tab1,490), array("������� �����������",$Tab2,490) );

    // ����� ������ ��������� � ����� � �����
    $ContentFooter=
            $PHPShopGUI->setInput("hidden","newsID",$id,"right",70,"","but").
            $PHPShopGUI->setInput("button","","������","right",70,"return onCancel();","but").

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


