<?php

function PacMetod($tip) {
    global $SysValue;
    if ($tip == 1)
        return $SysValue['oplata']['pac'];
    else
        return 0;
}

function OplataMetod($tip) {
    global $SysValue;
    return $SysValue['Lang']['Order'][$tip];
}

function ReturnSumma($sum, $disc) {
    $kurs = GetKursOrder();
    $sum*=$kurs;
    $sum = $sum - ($sum * $disc / 100);
    return number_format($sum, "2", ".", "");
}

// ����� ������
function UpdateNumOrder($uid) {
    $all_num = explode("-", $uid);
    $ferst_num = $all_num[0];
    $last_num = $all_num[1];
    return $ferst_num . $last_num;
}

// �������� ������������ �������
function CheckPayment($id) {
    global $SysValue;
    $id = UpdateNumOrder($id);
    $sql = "select * from " . $SysValue['base']['table_name33'] . " where uid=" . $id;
    @$result = mysql_query($sql);
    $num = mysql_numrows(@$result);
    return $num;
}

function Visitor($pole1, $pole2, $words, $liststr) {// ����� �����������
    global $table_name1;

    $sec = md5(date('y-m-d') . $_SESSION['pasPHPSHOP']);

    // ����������� ���� ��� ������
    $list_array = explode("|", $liststr);
    $list = $list_array[0];
    $search = $list_array[1];

    if (empty($pole1))
        $pole1 = date("U") - 86400;
    else
        $pole1 = GetUnicTime($pole1) - 86400;
    if (empty($pole2))
        $pole2 = date("U") + 86400;
    else
        $pole2 = GetUnicTime($pole2) + 86400;


    /////// �������� ������ ������������ ���������.
    $sql = "select id, name, parent_to from phpshop_categories WHERE 1";
    $result = mysql_query($sql);
    while (@$row = mysql_fetch_array(@$result)) {
        $massCatData[$row['id']]['name'] = $row['name'];
        $massCatData[$row['id']]['parent_to'] = $row['parent_to'];
    }
    //////////////////////
    /////// �������� ������ �������� .
    $sql = "select id, name from phpshop_shopusers WHERE 1";
    $result = mysql_query($sql);
    while (@$row = mysql_fetch_array(@$result)) {
        $massShopUsersData[$row['id']] = $row['name'];
    }
    //////////////////////
    /////// �������� ������ ���������� .
    $sql = "select id, name from phpshop_users WHERE 1";
    $result = mysql_query($sql);
    while (@$row = mysql_fetch_array(@$result)) {
        $massAdminData[$row['id']] = $row['name'];
    }
    //////////////////////
    /////// �������� ������ �������������� ������ � ���������
    $sql = "select id, category from phpshop_products WHERE 1";
    $result = mysql_query($sql);
    while (@$row = mysql_fetch_array(@$result)) {
        $massProdCats[$row['id']] = $row['category'];
    }
    //////////////////////
    /////// �������� ������ ����� �����
    $sql = "select id, name from phpshop_payment_systems WHERE 1";
    $result = mysql_query($sql);
    while (@$row = mysql_fetch_array(@$result)) {
        $massPayments[$row['id']] = $row['name'];
    }
    //////////////////////


    $sql = "select * from $table_name1 where datas<'$pole2' and datas>'$pole1' and statusi>0 order by id desc";

    @$result = mysql_query($sql);
    while (@$row = mysql_fetch_array(@$result)) {
        $id = $row['id'];
        $datas = $row['datas'];
        $uid = $row['uid'];
        $user = $row['user'];
        $admin = $row['admin'];
        $order = unserialize($row['orders']);
        $status = unserialize($row['status']);
        $statusi = $row['statusi'];

        $order['Person']['discount'];


        foreach ($order[Cart][cart] as $id => $data) {
            if ($words AND $words != $massProdCats[$id])
                continue;

            switch ($list) {
                // ������
                case 1:

                    if (empty($search)) {

                        // ������ ���� ��� �������� ��������
                        $catName = $massCatData[$massProdCats[$id]]['name'];
                        //�������
                        $table[$catName][1] += ($data['price'] * $data['num'] * 0.3);
                        // ���-��
                        $table[$catName][2] += $data['num'];
                        // �������
                        $table[$catName][3] += ($data['price'] * $data['num']);
                        $rowName = "��������� �������";
                        $grName = "����� �� ���������� �������";
                        
                    } 
                    // ����� �� ����� ��� �������� ��� ID
                    elseif(stristr($data['name'],$search) or $search == $data['uid'] or $search == $data['id']){
                        
                        // ������ ���� ��� �������� ��������
                        $catName = $data['name'];
                        //�������
                        $table[$catName][1] += ($data['price'] * $data['num'] * 0.3);
                        // ���-��
                        $table[$catName][2] += $data['num'];
                        // �������
                        $table[$catName][3] += ($data['price'] * $data['num']);
                        $rowName = "������������";
                        $grName = "����� �� ���������� �������";
                    }




                    break;
                // �������
                case 2:
                    //�������
                    $table[$massShopUsersData[$user]][1] += ($data['price'] * $data['num'] * 0.3);
                    // ���-��
                    $table[$massShopUsersData[$user]][2] += $data['num'];
                    // �������
                    $table[$massShopUsersData[$user]][3] += ($data['price'] * $data['num']);
                    $rowName = "�������";
                    $grName = "����� �� ��������";
                    break;
                // ����������
                case 3:
                    //�������
                    $table[$massAdminData[$admin]][1] += ($data['price'] * $data['num'] * 0.3);
                    // ���-��
                    $table[$massAdminData[$admin]][2] += $data['num'];
                    // �������
                    $table[$massAdminData[$admin]][3] += ($data['price'] * $data['num']);
                    $rowName = "���������";
                    $grName = "����� �� �����������";
                    break;
                // ���� �����
                case 4:
                    //�������
                    $table[$massPayments[$order['Person']['order_metod']]][1] += ($data['price'] * $data['num'] * 0.3);
                    // ���-��
                    $table[$massPayments[$order['Person']['order_metod']]][2] += $data['num'];
                    // �������
                    $table[$massPayments[$order['Person']['order_metod']]][3] += ($data['price'] * $data['num']);
                    $rowName = "��� �����";
                    $grName = "����� �� ����� �����";
                    break;

                default:
                    break;
            }
        }


        @$i++;
    }

    /// ������ ���� ������� ��� ������ � ������� � ���� csv �����

    foreach ($table as $key => $value) {
        @$disp.='
	<tr class="row padding">
	
    <td>' . $key . '</td>
	<td>
	' . $value[3] . ' </td>
	<td>
	' . $value[2] . ' </td>
	<td>
	' . $value[1] . ' </td>

    </tr>
	';

        $value1sum += $value[1];
        $value2sum += $value[2];
        $value3sum += $value[3];

        $csvDisp .= "$key;{$value[3]};{$value[2]};{$value[1]}\n";
    }

    // ������� �����
    if ($disp)
        @$disp.='
        	
	<tr class="row padding">
	
    <td><b>�����:</b></td>
	<td><b>
	' . $value3sum . '</b> </td>
	<td><b>
	' . $value2sum . '</b> </td>
	<td><b>
	' . $value1sum . '</b> </td>

    </tr>
	';


    // ��������� ���������� csv �����

    $csv = "$rowName;�������;���������� ������ ������;�������\n$csvDisp �����;$value3sum;$value2sum;$value1sum\n";

    // ������ ����
    $file = "orders_stat1_" . $sec . ".csv";
    @$fp = fopen("../csv/" . $file, "w+");
    if ($fp) {
        //stream_set_write_buffer($fp, 0);
        fputs($fp, $csv);
        fclose($fp);
    }




    // ��������� ������ ��� �������
    require_once '../../lib/chart/open-flash-chart.php';


    $bar_1 = new bar(50, '#' . gencolor());
    $bar_1->key(cp1251_to_utf8('�������'), 10);

    $bar_2 = new bar(50, '#' . gencolor());
    $bar_2->key(cp1251_to_utf8('�������'), 10);

    $bar_3 = new bar(50, '#' . gencolor());
    $bar_3->key(cp1251_to_utf8('���������� (x1000)'), 10);


    foreach ($table as $key => $value) {
        $colNames[] = cp1251_to_utf8($key);
        $bar_1->data[] = $value[1];
        $bar_2->data[] = $value[3];
        $bar_3->data[] = $value[2] * 1000;
        if ($value[1] > $yMax)
            $yMax = $value[1];
        if ($value[2] > $yMax)
            $yMax = $value[2];
        if ($value[3] > $yMax)
            $yMax = $value[3];
    }

// create the chart:
    $g = new graph();
    $g->title(cp1251_to_utf8($grName), '{font-size: 26px;}');

// add the 3 bar charts to it:
    $g->data_sets[] = $bar_2;
    $g->data_sets[] = $bar_1;
    $g->data_sets[] = $bar_3;


//
    $g->set_x_labels($colNames);
// set the X axis to show every 2nd label:
    $g->set_x_label_style(10, '#9933CC', 0, 1);
// and tick every second value:
    $g->set_x_axis_steps(2);
//

    $g->set_y_max($yMax * 1.2);
    $g->y_label_steps(10);
    $g->set_y_legend(cp1251_to_utf8('RUR / RUR / quantity'), 12, '0x736AFF');
    $graphContent = $g->render();



    // ������ ����
    $file = "orders_stat1_graph_" . $sec . ".csv";
    @$fp = fopen("../csv/" . $file, "w+");
    if ($fp) {
        //stream_set_write_buffer($fp, 0);
        fputs($fp, $graphContent);
        fclose($fp);
    }
    ////////////////////////


    require_once '../../lib/chart/open_flash_chart_object.php';
    $baseURL = "/phpshop/lib/chart/";

    if ($i > 30)
        $razmer = "height:600;";

    if (empty($_COOKIE['stat_graph']))
        $stat_graph_style = 'display:none;';
    else
        $stat_graph_style = 'display:block;';

    $_Return = ('
        
    <div id="graph"  style="' . $stat_graph_style . 'width:100%; text-align:center;padding-left:5px;"> 
        ' . open_flash_chart_object('100%', 350, './csv/orders_stat1_graph_' . $sec . '.csv', false, $baseURL) . ' 
    </div>
<div align="left" id="interfacesWin" name="interfacesWin"  style="width:100%;' . @$razmer . ';overflow:auto"> 


<table width="100%"  cellpadding="0" cellspacing="0" style="border: 1px;">
<tr>
	<td valign="top">

<table cellpadding="0" cellspacing="1" width="100%" border="0">
<tr>
	<td width="100" id="pane" align="center"><img  src="icon/blank.gif"  width="1" height="1" border="0"  align="left"><img src=img/arrow_d.gif width=7 height=7 border=0 hspace=5><span name=txtLang id=txtLang>' . $rowName . '</span></td>
	<td id="pane" width="130" align="center"><img src=img/arrow_d.gif width=7 height=7 border=0 hspace=5><span name=txtLang id=txtLang>�������</span></td>
	<td id="pane" width="130" align="center"><img src=img/arrow_d.gif width=7 height=7 border=0 hspace=5><span name=txtLang id=txtLang>���������� ������ ������</span></td>
	<td id="pane" width="130" align="center"><img src=img/arrow_d.gif width=7 height=7 border=0 hspace=5><span name=txtLang id=txtLang>�������</span></td>
</tr>
' . @$disp . '
</table>
    </td>
</tr>
</table>
</form>
</div>
 ' . '
 ');
    return $_Return;
}

function gencolor() { //������� ��������� ��������� ������
    for ($i = 0; $i <= 6 - 1; $i++) {
        $randint = rand(0, 1);
        if ($randint == 0) {
            $gencodint = chr(rand(48, 57));
            $pass = $pass . $gencodint;
        }
        if ($randint == 1) {
            $gencodstrn = chr(rand(97, 102));
            $pass = $pass . $gencodstrn;
        }
    }

    return $pass;
}

?>