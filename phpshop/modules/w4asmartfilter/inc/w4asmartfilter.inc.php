<?php
 /*
 ***** 
 * ������ "�����-������" ��� PHPShop Enterprise 3.6
 * Copyright � WEB for ALL, 20010-2014 
 * @author "WEB for ALL" (www.web4.su) 
 * @version 1.0
 *****
 */
 /*
 * ������ ������������ ����������������� ���������� �� ���� ��������� 
 * �� ����������� /smart/ (��� ���� ������, �.�. ������� �� �������.)
 * ������������: 
 * ��� �������� �������� �������� �:
 * �������: /modules/w4asmartfilter/templates/
 * �����: modules/w4asmartfilter/css/
 * Javascript: modules/w4asmartfilter/javascript/
 */
class PHPShopSmartForm extends PHPShopShopCore {

    var $debug = false;
    var $smart = 'sf_'; // ������� � ����� ������� ��� �������� ������ �� �����.

    /**
     * �����������
     */

    function PHPShopSmartForm() {

        // ���������
        $this->system();

        parent::PHPShopShopCore();
        $this->PHPShopOrm->cache_format = $this->cache_format;
    }

    /**
     * ���������
     */
    function system() {
        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['w4asmartfilter']['w4asmartfilter_system']);
        $this->system = $PHPShopOrm->select();
    }

    // ����� ������������ � ����� ���� ����� ���������� (����������� �����)
    function leftMenu_w4asmartfilter_select() {
        global $SysValue;

        $sql = "select * from  phpshop_modules_w4asmartfilter_categories where id_sort > 0 order by id";
        $res = mysql_query($sql);
        while ($row = mysql_fetch_array($res)) {

            $sql2 = "select `name` from " . $SysValue['base']['table_name20'] . " where id = " . intval($row['id_sort']) . " limit 0,1";
            $row2 = mysql_fetch_array(mysql_query($sql2));
            $name = $row2['name'];
            $sql2 = "select * from " . $SysValue['base']['table_name21'] . " where category = " . intval($row['id_sort']) . " order by num";
            $res2 = mysql_query($sql2);
            while ($row2 = mysql_fetch_array($res2)) {
                if (empty($dis))
                    $dis = '<option value="0">' . $name . '</option>';
                $dis .='<option value="' . $row2['id'] . '">' . $row2['name'] . '</option>';
            }
            $diss .='<select name="sf_field_' . $row['id'] . '" id="sf_field_' . $row['id'] . '">' . $dis . '</select><br>';
            if (empty($i))
                $list = $row['id'];
            else
                $list.=',' . $row['id'];
            $dis = '';
            $i++;
        }

        $disp = '
											<form action="/smart/" class="clearfix" method="GET" name="sort2">
												' . $diss . '
												
												<input type="button" onClick="w4a_smartFilter(' . $list . ')" value="��" class="fl btn btn-gray" style="width:60px">
												<input type="reset" onClick="location.replace(\'/\');" value="�������� ������" class="fr btn btn-small btn-white">
											</form>

					';

        return $disp;
    }

    function leftMenu_w4asmartfilter() {
        global $SysValue;

        $system = $this->system;
        if ($system['price_enabled'] == '1') {
            $dis = $GLOBALS['SysValue']['other']['w4aSmartFilter'];
            $dis.=$this->w4a_price_disp() . $this->w4a_smart_vendor_disp() . $this->w4a_smart_vendor_select_disp();
        } else {
            $dis = $GLOBALS['SysValue']['other']['w4aSmartFilter'];
            $dis.=$this->w4a_smart_vendor_disp() . $this->w4a_smart_vendor_select_disp();
        }


        $this->set('w4aSmartFilterForm', $dis);

        $disp = parseTemplateReturn($GLOBALS['SysValue']['templates']['w4asmartfilter']['smart_filter'], true);

        $this->set('w4aSmartFilterModWin', '<div class="w4a_smart_modal_0"> <div class="w4a_smart_modal_1" id="w4asmart">�������: <span id="w4asmart_num"></span> ��.
				<a href="javascript:document.sort2.submit()" >��������</a></div></div>');
        //$this->set('w4aSmartFilter',$disp);	

        return $disp;
    }

    /**
     * ���������� ������ ��� �� � �� ��� ������� �� GET-����������
     * $pice_arr=false - �� ������� (�� ��������� ����)
     * $pice_arr(from=>0,till=>1000) - �� 0 �� 1000
     * $pice_arr(from=>1000,till=>1000) - ����� 1000
     * false - � GET-���������� ����������� �������� ���� ��� ��� �����������
     */
    function get_price() {

        // ����� ����������� � ����� ps & pf (price start & price finish)
        $ps = $_GET['ps'];
        $pf = $_GET['pf'];

        if (empty($pf) or $pf < $ps or $pf <= 0) { // ���� ��������� ������ � ���� ��� ���������� ���� ����������
            $price_arr = false;
        } else {
            if (empty($ps) or $ps < 0)
                $ps = 0;
            $price_arr = array('from' => $ps, 'till' => $pf);
        }

        return $price_arr;
    }

    // ����� ��������� ����� ������� 
    function w4a_smart_vendor_disp() {
        global $SysValue;
        $system = $this->system;

        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['w4asmartfilter']['w4asmartfilter_categories']);
        $d = $PHPShopOrm->select(array("*"), array('id_sort' => '>0'));

        if (empty($d[0])) {
            $data[0] = $d; // ���� �������������� � �����-������� ������ 1
        } else {
            $data = $d;
        }

        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['table_name21']);

        $PHPShopOrm2 = new PHPShopOrm($GLOBALS['SysValue']['base']['table_name20']);
        // ��������
        PHPShopObj::loadClass("text");
        $PHPShopText = new PHPShopText();

        foreach ($data as $val) {

            $row = $PHPShopOrm2->select(array("*"), array('id' => '=' . intval($val['id_sort'])));
            $name = $row['name'];
            $id_sort = $row['id'];
            $row = $PHPShopOrm->select(array("*"), array('category' => '=' . intval($val['id_sort'])), array('order' => 'num ASC'));

            if ($val['id'] == $system['color']) {
                foreach ($row as $v) {
                    if ($_GET[$this->smart . '' . $v['id']] == $val['id']) {
                        // ACHTUNG!!! 
                        // class="w4asmart_color" - Impotant!!! 
                        // �� ���� ���������� ������� ������ �������������� ����� JavaSript						
                        $input = '<input type="hidden" name="' . $this->smart . $v['id'] . '" id="' . $this->smart . $v['id'] . '" value="' . $val['id'] . '" class="w4asmart_color">';
                        $style = 'style="background-color:#' . $v['code'] . ';"';
                        $class = ' active';
                    } else {
                        $input = '';
                        $style = 'style="background-color:#' . $v['code'] . ';"';
                        $class = '';
                    }
                    $diss .= '
					<a href="javascript:w4a_smart_get_color(' . $v['id'] . ',' . $val['id'] . ',\'' . $this->smart . '\');w4a_smart_get_num(\'' . $this->smart . '\');" title="' . $v['name'] . '">
					<div class="smart_color' . $class . '"  id="div_' . $v['id'] . '" ' . $style . '></div></a>
					<span id="input_' . $v['id'] . '" style="display:none;">' . $input . '</span>
					';
                }

                $this->set('w4aSmartName', $name);
                $this->set('w4aSmartValues', $diss);

                $disp .= parseTemplateReturn($GLOBALS['SysValue']['templates']['w4asmartfilter']['smart_vendor_element'], true);
                $diss = '';
            } else {

                if(is_array($row))
                foreach ($row as $v) {

                    if ($_GET[$this->smart . '' . $v['id']] == $val['id']) {
                        $checker = '" checked style="margin-top:4px;';
                    } else {
                        $checker = '" style="margin-top:4px;';
                    }
                    if ($i == 5) {
                        $diss.='<div style="display:none;" id="add_el_' . $id_sort . '">';

                        $this->set('w4aSmartValueHidderEnd', '</div><div style="text-align: right; padding-right: 10px;"><span style=" cursor:pointer; border-bottom: 1px dotted #CCC; text-decoretion:none;" onClick="w4a_show_smart_element(' . $id_sort . ');"  id="link_' . $id_sort . '">�������� ���</span></div>');
                    }

                    $diss.= $PHPShopText->setInput('checkbox" onClick="w4a_smart_get_num(\'' . $this->smart . '\');"', $this->smart . '' . $v['id'] . '', $val['id'] . $checker, $float = "none", $size = 200, $onclick = "return true", $class = false, $caption = false, $description = $v['name']);

                    $i++;
                }

                $this->set('w4aSmartName', $name);
                $this->set('w4aSmartValues', $diss);

                $disp .= parseTemplateReturn($GLOBALS['SysValue']['templates']['w4asmartfilter']['smart_vendor_element'], true);
                $diss = '';
                $i = 0;
                $this->set('w4aSmartValueHidderEnd', '');
            }
        }

        return '<td class="" id="" colspan="">' . $disp . '</td>';
    }

    // ���������� ������ �������
    function w4a_smart_vendor_select_disp() {

        $disp = parseTemplateReturn($GLOBALS['SysValue']['templates']['w4asmartfilter']['smart_vendor_select_disp'], true);
        return $disp;
    }

    // ���������� ����� ����� ��� ����
    function w4a_price_disp() {

        //������������� ���� � ��� �������� �������
        //$price_max_min_arr = $this->get_price_max_min();
        //������������� OT � DO �������� �� GET-����������
        $price_arr = $this->get_price();
        if (is_array($price_arr)) {
            $this->set('w4aSmartPriceS', $price_arr['from']);
            $this->set('w4aSmartPriceF', $price_arr['till']);
        } else {
            //$this->set('w4aSmartPriceS',$price_max_min_arr['min']);
            //$this->set('w4aSmartPriceF',$price_max_min_arr['max']);
            $this->set('w4aSmartPriceS', '');
            $this->set('w4aSmartPriceF', '');
        }
        $disp = parseTemplateReturn($GLOBALS['SysValue']['templates']['w4asmartfilter']['smart_price_element'], true);
        return $disp;
    }

}

// ��������� � ������ �������
if ($PHPShopNav->notPath(array('smart'))) {
    $PHPShopSmartForm = new PHPShopSmartForm();
    //print_r($PHPShopSmartForm->system);
    //$diss=$PHPShopSmartForm->leftMenu_w4asmartfilter_select();
    $diss = $PHPShopSmartForm->leftMenu_w4asmartfilter();
    $disp = '					
					<script type="text/javascript" src="phpshop/modules/w4asmartfilter/javascript/js.w4asmartfilter.js"></script>
					<link href="phpshop/modules/w4asmartfilter/css/style.w4asmartfilter.css" type="text/css" rel="stylesheet">
					<div style="display:none">���������� �� X:<input type="text" id="mouseX"><br>
						���������� �� Y:<input type="text" id="mouseY"></div>
						
							' . $diss . '
							

							';
} else {
    // ��������� JS & CSS
    $disp = '
				<script type="text/javascript" src="phpshop/modules/w4asmartfilter/javascript/js.w4asmartfilter.js"></script>
				<link href="phpshop/modules/w4asmartfilter/css/style.w4asmartfilter.css" type="text/css" rel="stylesheet">
				<div style="display:none">���������� �� X:<input type="text" id="mouseX"><br>
						���������� �� Y:<input type="text" id="mouseY"></div>';
}

$GLOBALS['SysValue']['other']['w4aSmartFilter'] = $disp;
?>
