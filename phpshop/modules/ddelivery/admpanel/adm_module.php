<?php

if (substr(phpversion(), 0, 3) > 5.2) {
    include_once( $_SERVER['DOCUMENT_ROOT'] . '/phpshop/modules/ddelivery/class/application/bootstrap.php');
    include_once( $_SERVER['DOCUMENT_ROOT'] . '/phpshop/modules/ddelivery/class/mrozk/IntegratorShop.php' );
}

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
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.ddelivery.ddelivery_system"));

// ������� ����������
function actionUpdate() {
    global $PHPShopOrm;

    $PHPShopOrm->debug = false;
    $_POST['pvz_companies_new'] = serialize($_POST['pvz_companies_new']);
    $_POST['cur_companies_new'] = serialize($_POST['cur_companies_new']);


    $_POST['courier_list_new'] = serialize($_POST['courier_list_new']);
    $_POST['self_list_new'] = serialize($_POST['self_list_new']);

    if (!is_array($_POST['self_way_new'])) {
        $_POST['self_way_new'] = array();
    }

    if (!is_array($_POST['courier_way_new'])) {
        $_POST['courier_way_new'] = array();
    }

    $_POST['settings_new'] = json_encode(array('self_way' => $_POST['self_way_new'],
        'courier_way' => $_POST['courier_way_new']));

    if ($_POST['zabor_new'] != '1') {
        $_POST['zabor_new'] = 0;
    }
    $action = $PHPShopOrm->update($_POST);
    return $action;
}

/**
 * ����� ����������
 */
function actionSave() {
    global $PHPShopGUI;

    // ���������� ������
    actionUpdate();

    $PHPShopGUI->setAction(1, 'actionStart', 'none');
}

function _prepareSelect($val, $arrVals) {
    for ($i = 0; $i < count($arrVals); $i++) {

        if ($arrVals[$i][1] == $val) {
            $arrVals[$i][] = 'selected';
        } else {
            $arrVals[$i][] = '';
        }
    }
    return $arrVals;
}

function actionStart() {
    global $PHPShopGUI, $PHPShopSystem, $SysValue, $_classPath, $PHPShopOrm;
    
    if (substr(phpversion(), 0, 3) < 5.3)
            exit("PHP ".phpversion()." is not supported");

    $PHPShopGUI->dir = $_classPath . "admpanel/";
    $PHPShopGUI->title = "���������";
    $PHPShopGUI->size = "1550,750";

    // �������
    $data = $PHPShopOrm->select();
    @extract($data);


    $type_value[] = array('��� � ���������� ��������', '0');
    $type_value[] = array('���', '1');
    $type_value[] = array('���������� ��������', '2');
    $type_value[] = array('��������� ��� � ���������� ��������', '3');


    $type_value = _prepareSelect($type, $type_value);


    $rezhim_value[] = array('������������ (stage.ddelivery.ru)', '0');
    $rezhim_value[] = array('������� (cabinet.ddelivery.ru)', '1');
    $rezhim_value = _prepareSelect($rezhim, $rezhim_value);

    // ����������� ��������� ����
    $PHPShopGUI->setHeader("��������� ������ 'DD'", "��������� ����������", $PHPShopGUI->dir . "img/i_display_settings_med[1].gif");

    $Tab1 = $PHPShopGUI->setText('<b>���� ����� �������� � ������ ��������
                                  DDelivery.ru, ������������������� �� �����.</b>', 'none');
    $Tab1 .= $PHPShopGUI->setField('API ���� �� ������� ��������', $PHPShopGUI->setInputText(false, 'api_new', $api, 300));


    if (!isset($settings) || empty($settings)) {
        $settings = array('self_way' => array(), 'courier_way' => array());
    } else {
        $settings = json_decode($settings, true);
    }
    $self_way = $settings['self_way'];
    $courier_way = $settings['courier_way'];


    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['delivery']);
    $data = $PHPShopOrm->select(array('id', 'city'), array('PID' => " != " . "0", 'enabled' => " = '" . "1'"), false /* , array('limit' => 1) */);

    $courier_way_select = '<select name="courier_way_new[]" size="8" multiple>';
    $self_way_select = '<select name="self_way_new[]" size="8" multiple>';

    if (is_array($data)) {
        foreach ($data as $item) {

            if (in_array($item['id'], $courier_way)) {
                $selected_c = 'selected="selected"';
            } else {
                $selected_c = '';
            }

            if (in_array($item['id'], $self_way)) {
                $selected_s = 'selected="selected"';
            } else {
                $selected_s = '';
            }
            $courier_way_select .= '<option ' . $selected_c . ' value="' . $item['id'] . '">' . $item['city'] . '</option>';
            $self_way_select .= '<option ' . $selected_s . ' value="' . $item['id'] . '">' . $item['city'] . '</option>';
        }
    }
    $courier_way_select .= '</select>';
    $self_way_select .= '</select>';



    $Tab1 .= $PHPShopGUI->setField('��������� ������� �������� ������', $PHPShopGUI->setSelect('type_new', $type_value, 400));
    $Tab1 .= $PHPShopGUI->setField('������������ ������� �������� � DDelivery ��� ����������', $self_way_select, 'left');
    $Tab1 .= $PHPShopGUI->setField('������������ ������� �������� � DDelivery ��� �������', $courier_way_select);


    $Tab1 .= $PHPShopGUI->setText('<b>��� ������� ������, ����������, ����������� ����� ������������!</b>', 'none');
    $Tab1.=$PHPShopGUI->setField('����� ������', $PHPShopGUI->setSelect('rezhim_new', $rezhim_value, 400));

    $Tab1 .= $PHPShopGUI->setText('<b>�� ������ ������� ��������� ��������� ��������, �� ���� �������� �������� ���������.</b>', 'none');
    $Tab1.=$PHPShopGUI->setField('����� % �� ��������� ������ ����������?', $PHPShopGUI->setInputText(false, 'declared_new', $declared, 300));

    $objBase = $GLOBALS['SysValue']['base']['table_name48'];
    $PHPShopOrm2 = new PHPShopOrm($objBase);
    $payment_base = $PHPShopOrm2->select();
    if (count($payment_base)) {
        foreach ($payment_base as $item) {
            if ($item['enabled']) {
                if ($item['id'] == $payment) {
                    $s = 'selected';
                } else {
                    $s = '';
                }
                $payment_value[] = array($item['name'], $item['id'], $s);
            }
        }
    }
    $objBase = $GLOBALS['SysValue']['base']['order_status'];
    $PHPShopOrm3 = new PHPShopOrm($objBase);
    $status_base = $PHPShopOrm3->select();
    if (count($status_base)) {
        foreach ($status_base as $item) {
            if ($item['id'] == $status) {
                $s = 'selected';
            } else {
                $s = '';
            }
            $status_value[] = array($item['name'], $item['id'], $s);
        }
    }


    $Tab5 = $PHPShopGUI->setText('<b>�������� ����, ��������������� ������� ������ "������ �� �����".
                                      �������� "������ �������". � ��� � ������� ����� ���� ������ 1 ����� ������.</b>', 'none');
    $Tab5 .= $PHPShopGUI->setField('������ �� �����', $PHPShopGUI->setSelect('payment_new', $payment_value, 400));
    $self_list = unserialize($self_list);
    $courier_list = unserialize($courier_list);
    $payment_courier = '<select name="courier_list_new[]">';
    //$payment_self = '<select name="self_list_new[]" size="8" multiple>';
    foreach ($payment_value as $item) {
        if (@in_array($item[1], $courier_list)) {
            $selected_c = 'selected="selected"';
        } else {
            $selected_c = '';
        }
        if (@in_array($item[1], $self_list)) {
            $selected_s = 'selected="selected"';
        } else {
            $selected_s = '';
        }
        $payment_courier .= '<option ' . $selected_c . ' value="' . $item[1] . '">' . $item[0] . '</option>';
        $payment_self .= '<option ' . $selected_s . ' value="' . $item[1] . '">' . $item[0] . '</option>';
    }
    $payment_courier .= '</select>';
    $payment_self .= '</select>';

    //$Tab5 .= $PHPShopGUI->setField('��������� ������� ������ ��� ���������� ��������', $payment_courier, 'left');
    //$Tab5 .= $PHPShopGUI->setField('��������� ������� ������ ��� ����������', $payment_self, 'left');


    $Tab5 .= $PHPShopGUI->setLine();
    $Tab5 .= $PHPShopGUI->setText('<b>�������� ������, ��� ������� ������ �� ����� ������� ����� ������� � DDelivery.
                                      �������, ��� �������� �������� ���������� ��������� ����� �� ��������� ������� ����!</b>', 'none');
    $Tab5 .= $PHPShopGUI->setField('������ ��� ��������', $PHPShopGUI->setSelect('status_new', $status_value, 400));


    $Tab5.= $PHPShopGUI->setText('<b>�������� �� ���������</b>', 'none');
    $Tab5 .= $PHPShopGUI->setText('<b>������ �������� ������������ ��� ����������� ���� �������� � ������, ���� �
                                      ������ �� ��������� �������. ����������� ��������� ����.</b>', 'none');
    $Tab5 .= $PHPShopGUI->setField('������, ��', $PHPShopGUI->setInputText(false, 'def_width_new', $def_width, 300), 'left');

    $Tab5 .= $PHPShopGUI->setField('�����, ��', $PHPShopGUI->setInputText(false, 'def_lenght_new', $def_lenght, 300), 'left');
    $Tab5 .= $PHPShopGUI->setField('������, ��', $PHPShopGUI->setInputText(false, 'def_height_new', $def_height, 300), 'left');
    $Tab5 .= $PHPShopGUI->setField('���, ��', $PHPShopGUI->setInputText(false, 'def_weight_new', $def_weight, 300), 'left');

    $pvz_companies = unserialize($pvz_companies);

    $cur_companies = unserialize($cur_companies);

    $pvz_companies_list = null;
    $companiesArray = \DDelivery\DDeliveryUI::getCompanySubInfo();
    if (count($companiesArray)) {
        foreach ($companiesArray as $key => $value) {
            $pvz_companies_list.= $PHPShopGUI->setCheckbox('pvz_companies_new[]', $key, iconv('UTF-8', 'windows-1251', $value['name']), (@in_array($key, $pvz_companies) ? 1 : 0));
        }
    }

    $Tab2.=$PHPShopGUI->setField('<b>�������� �������� ���, ������� ����� �������� ����� ��������:</b>', $pvz_companies_list);

    $cur_companies_list = null;
    if (count($companiesArray)) {
        foreach ($companiesArray as $key => $value) {
            $cur_companies_list.= $PHPShopGUI->setCheckbox('cur_companies_new[]', $key, iconv('UTF-8', 'windows-1251', $value['name']), (@in_array($key, $cur_companies) ? 1 : 0));
        }
    }

    $Tab2.=$PHPShopGUI->setField('<b>�������� �������� ���������� ��������, ������� ����� �������� ����� ��������:</b>', $cur_companies_list);


    $Tab3 = $PHPShopGUI->setText('<b>��� �������� ��������� ��������, � ����������� �� ������� ������ � ������.
                                       �� ������ ����� ��������� ������� ��������, ����� ������ ����
                                       ������������� ��������.</b>', 'none');

    $method1_value[] = array('������ ���������� ���', '1');
    $method1_value[] = array('������� ���������� ���', '2');
    $method1_value[] = array('������� ���������� ������� �� ��������� ��������', '3');
    $method1_value[] = array('������� ���������� ���������� ����� �� ��������. ���� ����� ������, �� ��� ��������', '4');


    $Tab3 .= $PHPShopGUI->setField('��', $PHPShopGUI->setInputText(false, 'from1_new', $from1, 100), 'left');

    $Tab3 .= $PHPShopGUI->setField('��', $PHPShopGUI->setInputText(false, 'to1_new', $to1, 100), 'left');


    $method1_value = _prepareSelect($method1, $method1_value);
    $Tab3 .=$PHPShopGUI->setField('��������', $PHPShopGUI->setSelect('method1_new', $method1_value, 150), 'left');


    $Tab3 .= $PHPShopGUI->setField('�����', $PHPShopGUI->setInputText(false, 'methodval1_new', $methodval1, 100), 'left');

    $Tab3 .=$PHPShopGUI->setLine();

    $Tab3 .= $PHPShopGUI->setField('��', $PHPShopGUI->setInputText(false, 'from2_new', $from2, 100), 'left');

    $Tab3 .= $PHPShopGUI->setField('��', $PHPShopGUI->setInputText(false, 'to2_new', $to2, 100), 'left');

    $method2_value = _prepareSelect($method2, $method1_value);
    $Tab3 .=$PHPShopGUI->setField('��������', $PHPShopGUI->setSelect('method2_new', $method2_value, 150), 'left');
    $Tab3 .= $PHPShopGUI->setField('�����', $PHPShopGUI->setInputText(false, 'methodval2_new', $methodval2, 100), 'left');

    $Tab3 .=$PHPShopGUI->setLine();

    $Tab3 .= $PHPShopGUI->setField('��', $PHPShopGUI->setInputText(false, 'from3_new', $from3, 100), 'left');
    $Tab3 .= $PHPShopGUI->setField('��', $PHPShopGUI->setInputText(false, 'to3_new', $to3, 100), 'left');


    $method3_value = _prepareSelect($method3, $method1_value);

    $Tab3 .=$PHPShopGUI->setField('��������', $PHPShopGUI->setSelect('method3_new', $method3_value, 150), 'left');
    $Tab3 .= $PHPShopGUI->setField('�����', $PHPShopGUI->setInputText(false, 'methodval3_new', $methodval3, 100), 'left');
    $Tab3 .=$PHPShopGUI->setLine();
    $okrugl_value[] = array('��������� � ������� �������', '0');
    $okrugl_value[] = array('��������� � ������� �������', '1');
    $okrugl_value[] = array('��������� ����  �������������', '2');

    $okrugl_value = _prepareSelect($okrugl, $okrugl_value);

    $Tab3 .=$PHPShopGUI->setField('���������� ���� �������� ��� ����������', $PHPShopGUI->setSelect('okrugl_new', $okrugl_value, 150), 'left');
    $Tab3.= $PHPShopGUI->setText('���', 'left');
    $Tab3 .= $PHPShopGUI->setField('���', $PHPShopGUI->setInputText(false, 'shag_new', $shag, 100));

    $Tab3 .= $PHPShopGUI->setText('<b>� ��������� ������� ���� ������������� �������� ���� ������</b>', 'none');
    $Tab3 .= $PHPShopGUI->setCheckbox('zabor_new', 1, '�������� ��������� ������ � ���� ��������', (($zabor == '1') ? 1 : 0));



    $Tab4 = $PHPShopGUI->setText('<b>���������� ��������</b>', 'none');
    //$Tab4 .=$PHPShopGUI->setField('',$PHPShopGUI->setSelect('city1_new',$method3_value,100));
    $Tab4.=$PHPShopGUI->setField('������� �����', $PHPShopGUI->setInputText(false, 'city1_new', $city1, 300, ''), 'left');
    $Tab4.=$PHPShopGUI->setField('���� ��������', $PHPShopGUI->setInputText(false, 'curprice1_new', $curprice1, 300, ''), 'left');


    $Tab4.=$PHPShopGUI->setField('������� �����', $PHPShopGUI->setInputText(false, 'city2_new', $city2, 300, ''), 'left');
    $Tab4.=$PHPShopGUI->setField('���� ��������', $PHPShopGUI->setInputText(false, 'curprice2_new', $curprice2, 300, ''), 'left');


    $Tab4.=$PHPShopGUI->setField('������� �����', $PHPShopGUI->setInputText(false, 'city3_new', $city3, 300, ''), 'left');
    $Tab4.=$PHPShopGUI->setField('���� ��������', $PHPShopGUI->setInputText(false, 'curprice3_new', $curprice3, 300, ''));

    $Tab4.= $PHPShopGUI->setText('<b>���</b>', 'none');
    $Tab4.=$PHPShopGUI->setField('', $PHPShopGUI->setTextarea('custom_point_new', $custom_point));



    $info = '��������� ������������! �� ����������� ������� ��������� �������� �������,
           �� ��� ��������� ���� ����������� ��������� ����. ���� ��� ���������
           �������� �����-���� ��������, ������ ��������� � ����������� ������� DDelivery. � ������, ����
           ��� ����������� ������ ��������, ��� �� ������ ��������� � ���������� ������� <b>info@ddelivery.ru</b>, Skype - <b>ddelivery</b>.
           ';

    $Tab7 = $PHPShopGUI->setInfo($info, 100, '96%');
    $Tab7.=$PHPShopGUI->setButton(__('���������� �� ��������� DDelivery'), '../install/icon.png', 250, 30, 'none', 'window.open(\'http://faq.phpshop.ru/page/ddelivery.html\');return false;');

    // ����� �����������
    $Tab8 = $PHPShopGUI->setPay($serial, false);



    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1, 500), array("��������������", $Tab5, 500), array("��������� �������� ��������", $Tab2, 500), array("��������� ���� ��������", $Tab3, 500), array("��������", $Tab7, 500), array("� ������", $Tab8, 500) /* , array("���������� ����������� ����� ��������",$Tab4,320) */);

    // ����� ������ ��������� � ����� � �����
    $ContentFooter =
            $PHPShopGUI->setInput("hidden", "newsID", $id, "right", 70, "", "but") .
            $PHPShopGUI->setInput("button", "", "������", "right", 70, "return onCancel();", "but") .
            $PHPShopGUI->setInput("submit", "editID", "OK", "right", 70, "", "but", "actionUpdate");
    //$PHPShopGUI->setInput("submit", "saveID", "���������", "right", 80, "", "but", "actionUpdate");
    $PHPShopGUI->setFooter($ContentFooter);
    return true;
}

if ($UserChek->statusPHPSHOP < 2) {

    // ����� ����� ��� ������
    $PHPShopGUI->setLoader($_POST['editID'], 'actionStart');

    // ��������� �������
    $PHPShopGUI->getAction();
}
else
    $UserChek->BadUserFormaWindow();
?>