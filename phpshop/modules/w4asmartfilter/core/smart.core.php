<?php

/*
 * **** 
 * ������ "�����-������" ��� PHPShop Enterprise 3.6
 * Copyright � WEB for ALL, 20010-2014 
 * @author "WEB for ALL" (www.web4.su) 
 * @version 1.0
 * ****
 */
/*
 * ���������� �������� Smart Filter
 */

class PHPShopSmart extends PHPShopShopCore {

    var $debug = false;
    var $cache = true;
    var $cell;
    var $num_row;
    var $smart = 'sf_'; // ������� � ����� ������� ��� �������� ������ �� �����.
    var $ALL = 200; // ������������ �������� ������ ������� ��� "�������� ���"

    /**
     * �����������
     */

    function PHPShopSmart() {

        // ���������
        $this->system();

        // ������� �� ��
        $this->sql_sort = $this->sql_sort();

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

    /**
     * ����� ������ �������
     */
    function index() {

        $system = $this->system;
        // �������� ������
        if ($this->setHook(__CLASS__, __FUNCTION__, false, 'START'))
            return true;

        // ���� ��� ���������
        $this->objPath = './page_';

        // ������
        $this->set('productValutaName', $this->currency());

        $this->set('catalogCategory', '����� ������');

        // ���������� �����
        if (empty($this->cell))
            $this->cell = $this->PHPShopSystem->getValue('num_vitrina');

        if (empty($this->num_row))
            $this->num_row = $this->PHPShopSystem->getValue('num_row');

        // ������� �� �� 
        //$sql_sort = $this->sql_sort;
        //������������
        $this->set('vendorDisp', $this->w4a_smart_vendor_disp());
        //$this->set('vendorSelectDisp',$this->w4a_smart_vendor_select_disp());



        if ($system['price_enabled'] == '1') {
            $dis = $GLOBALS['SysValue']['other']['w4aSmartFilter'];
            $dis.=$this->w4a_price_disp() . $this->w4a_smart_vendor_disp() . $this->w4a_smart_vendor_select_disp();
        } else {
            $dis = $GLOBALS['SysValue']['other']['w4aSmartFilter'];
            $dis.=$this->w4a_smart_vendor_disp() . $this->w4a_smart_vendor_select_disp();
        }

        $this->set('w4aSmartFilterForm', $dis);

        $diss = parseTemplateReturn($GLOBALS['SysValue']['templates']['w4asmartfilter']['smart_filter'], true);
        $disp = '
							' . $diss . '
							
						
			';
        $this->set('w4aSmartFilterModWin', '<div class="w4a_smart_modal_0"><div class="w4a_smart_modal_1" id="w4asmart">�������: <span id="w4asmart_num"></span> ��.
				<a href="javascript:document.sort2.submit()" >��������</a></div></div>');
        $this->set('w4aSmartFilter', $disp);


        // ������ ����������
        $order = $this->query_filter();

        // ������� ������
        if (is_array($order)) {
            $this->dataArray = parent::getListInfoItem(array('*'), array('enabled' => "='1'"), $order, __CLASS__, __FUNCTION__);
        } else {
            // ������� ������
            $this->PHPShopOrm->sql = $order;
            $this->PHPShopOrm->comment = __CLASS__ . '.' . __FUNCTION__;
            $this->dataArray = $this->PHPShopOrm->select();
            $this->PHPShopOrm->clean();
        }


        // ���������
        if (is_array($order)) {
            $this->setPaginator(count($this->dataArray));
        } else {
            $this->setPaginator($this->num_row, $this->sql_sort);
        }

        // 
        $smart_arr = $this->get_smart();
        if (is_array($smart_arr)) {
            foreach ($smart_arr as $key => $val) {
                foreach ($val as $k => $v) {
                    $smart_get .= '&amp;' . $this->smart . $k . '=' . $key;
                }
            }
            $this->set('productVendor', $smart_get);
        }



        // ��������� � ���������� GET-��������� (���!!! �� ������ ����� �������, �� � ���������� �� ����/������������)
        // ���������� ���������� ������� � �������
        $sql = "SELECT count(id) as count FROM " . $GLOBALS['SysValue']['base']['table_name2'] . " WHERE " . $this->sql_sort;
        $count = mysql_fetch_array(mysql_query($sql));
        $page_max = ceil($count['count'] / $this->num_row);

        // ������ ���������
        for ($i = 0; $i <= $page_max; $i++) {
            $GLOBALS['SysValue']['other']['productPageNav'] = str_replace($this->objPath . $i . '.html', $this->objPath . $i . '.html?' . $GLOBALS['SysValue']['nav']['querystring'], $GLOBALS['SysValue']['other']['productPageNav']);
        }
        $GLOBALS['SysValue']['other']['productPageNav'] = str_replace($this->objPath . 'ALL.html', $this->objPath . 'ALL.html?' . $GLOBALS['SysValue']['nav']['querystring'], $GLOBALS['SysValue']['other']['productPageNav']);
        $GLOBALS['SysValue']['other']['productPageNav'] = str_replace('page.html', 'page.html?' . $GLOBALS['SysValue']['nav']['querystring'], $GLOBALS['SysValue']['other']['productPageNav']);

        // ��������� � ������ ������ � ��������
        $grid = $this->product_grid($this->dataArray, $this->cell);
        if (empty($grid))
            $grid = PHPShopText::h2($this->lang('empty_product_list'));
        $this->add($grid, true);

        // ���������
        $this->title = "����� ������ - " . $this->PHPShopSystem->getParam('title');

        // �������� ������
        $this->setHook(__CLASS__, __FUNCTION__, $this->dataArray, 'END');

        // ���������� ������
        $this->parseTemplate($GLOBALS['SysValue']['templates']['w4asmartfilter']['smart_page_list'], true);
    }

    /**
     * ��������� SQL ������� �� �������� ��������� � ���������
     * @return mixed
     */
    function query_filter($where = false) {

        // �������� ������
        $hook = $this->setHook(__CLASS__, __FUNCTION__, $where);

        $system = $this->system;

        if (!empty($hook))
            return $hook;

        //������� �� ��
        $sort = $this->sql_sort;

        // ���� ���������
        $page = $GLOBALS['SysValue']['nav']['id'];
        if ($page == 'ALL') {
            $limit = 'limit 0,' . $this->ALL;
        } elseif ($page > 1) {
            $limit = 'limit ' . (($page - 1) * ($this->num_row)) . ',' . $this->num_row;
        } else {
            $limit = 'limit 0,' . $this->num_row;
        }



        // ����������
        if (!empty($_GET['ss']) and !empty($_GET['fs'])) { // ������� ���������� ���������
            if ($_GET['ss'] == 1) {
                $order = 'ORDER BY name';
            } elseif ($_GET['ss'] == 2) {
                $order = 'ORDER BY price';
            } else {
                $order = 'ORDER BY name';
            }

            if ($_GET['fs'] == 1) {
                $order .= ' DESC';
            } elseif ($_GET['fs'] == 2) {
                $order .= ' ASC';
            } else {
                $order .= ' ASC';
            }
        } else {

            $order = 'ORDER BY name ASC';
        }

        if (!empty($sort)) {
            $sql = "SELECT * FROM " . $GLOBALS['SysValue']['base']['table_name2'] . " where $sort  $order $limit";
            //	print_r($sql);
        } else {
            $sql = array('order' => 'num');
        }

        return $sql;
    }

    function sql_sort($flag = false) {
        $system = $this->system;
        $smart_arr = $this->get_smart();
        $price_arr = $this->get_price();

        if (is_array($smart_arr)) { // ���� ���� GET-��������� ������������� 
            $ii = 0;
            foreach ($smart_arr as $key => $val) {

                $i = 0;
                foreach ($val as $k => $v) {

                    if ($i == 0) {
                        $sort_or = "var_id_" . intval($key) . "=" . intval($k);
                    } else {
                        $sort_or .= " OR var_id_" . intval($key) . "=" . intval($k);
                    }

                    $i++;
                }

                if ($ii == 0) {
                    $sort = "($sort_or)";
                } else {
                    $sort .= " AND ($sort_or)";
                }
                $sort_or = '';
                $ii++;
            }

            if (is_array($price_arr)) {

                $price = " AND price between " . intval($price_arr['from']) . " and " . intval($price_arr['till']);
            } else {
                $price = '';
            }

            if ($flag === false) {
                $sql = "id in(
					SELECT product_id
					FROM `phpshop_modules_w4asmartfilter`
					WHERE $sort $price
					GROUP BY product_id
					)";
            } else {
                $sql = "id in(
					SELECT product_id
					FROM `phpshop_modules_w4asmartfilter`
					WHERE $sort $price
					GROUP BY product_id
					)";
            }
        }
        else
            $sql = false;

        return $sql;
    }

    /**
     * ���������� ������ ������������� �� GET-����������
     * $smart_arr[k1][k2]
     * k1 - # ���� � ������� smart-�������
     * k2 - ID �������� ��������������
     * false - � GET-���������� ����������� �������� �������������
     */
    function get_smart() {

        // �������� ������ ������������� ������� �� GET- ����������
        foreach ($_GET as $key => $val) {

            // ���� ���� �������� ������� ����������� � �����-�������
            if (strpos($key, $this->smart) !== false) {
                $k1 = $val;
                $k2 = str_replace($this->smart, '', $key);
                // �������� �� ���������� ��������
                if ($k1 != '' and $k2 != '') {
                    $smart_arr[$k1][$k2] = 'true';
                }
            }
        }
        if (is_array($smart_arr))
            return $smart_arr;
        else
            return false;
    }

    //���������� ������ ������. � ���. �������� ���� � �������  
    function get_price_max_min() {

        // �������� ���� id �� prod_id
        $sort = str_replace('id in', 'product_id in', $this->sql_sort);

        $sql = "SELECT min(price) as min, max(price) as max FROM " . $GLOBALS['SysValue']['base']['w4asmartfilter']['w4asmartfilter'] . " WHERE " . $sort;

        $row = mysql_fetch_array(mysql_query($sql));
        if (empty($row['min']))
            $min = 0;
        else
            $min = $row['min'];

        if (empty($row['max']))
            return false;
        else
            $max = $row['max'];

        $price_arr = array('min' => $min, 'max' => $max);

        return $price_arr;
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

                if (is_array($row))
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

?>
