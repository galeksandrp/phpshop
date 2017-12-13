<?php

/**
 * ����� ������� ��������
 * @package PHPShopCoreFunction
 * @param int $deliveryID �� ��������
 * @return string
 */
function delivery($obj, $deliveryID) {
    global $SysValue;

    $pred = $br = $my = $alldone = $waytodo = null;

    if (empty($SysValue['nav'])) {
        $engineinc = 0;
        $pathTemplate = '/' . chr(47) . $GLOBALS['SysValue']['dir']['templates'] . chr(47) . $_SESSION['skin'] . chr(47); // ���� �� �������
    } else {
        $engineinc = 1;
        $pathTemplate = '';
    }

    $table = $SysValue['base']['table_name30'];

    if ($deliveryID > 0) {
        $sql = "select * from " . $table . " where (enabled='1' and id='" . $deliveryID . "') order by num,city";
        $result = mysql_query($sql);
        $row = mysql_fetch_array($result);
        $isfolder = $row['is_folder'];
        $PID = $row['PID'];
        $sqlvariants = "select * from " . $table . " where (enabled='1' and PID='" . $row['PID'] . "') order by num,city";

        if ($isfolder) { //���� �������� �����, �� �������� ����� ������� �����
            $sqlvariants = "select * from " . $table . " where (enabled='1' and PID='" . $deliveryID . "') order by num,city";
            $PIDpr = $deliveryID; //��������� ������, ��� �����������
            $stop = 0;
        } else { //���� �������� �������, �� �������� ����� ������
            $sqlvariants = "select * from " . $table . " where (enabled='1' and PID='" . $row['PID'] . "') order by num,city";
            $PIDpr = $row['PID']; //��������� ������, ��� �����������
            $stop = 1;
        }
    } else { //���� �� ��������, ������ ��������� ����� ��� �������� ��������
        $stop = 0;
        $isfolder = 1; //���� �� �������� ID, ������ �������� 0 �������������, ������� �������� ������ ��������
        $PID = false;
        $deliveryID = 0; //����������� ������� �������������, ���� ������ �� ��������
        $sqlvariants = "select * from " . $table . " where (enabled='1' and PID='0') order by num,city";
    }
    $resultvariants = mysql_query($sqlvariants); // ��������� ��������
    $varamount = mysql_num_rows($resultvariants);


    if ($PID !== false) { //���� ���� ������, ��������� ���������
        $pred = '';
        $ii = 0;
        $num = 0;
        while ($PIDpr != 0) {//������ ���� �� ������ �� ������ �������� ������
            $num++;

            //�������� ������� ������
            $sqlpr = "select * from " . $SysValue['base']['table_name30'] . " where (enabled='1' and id='" . $PIDpr . "') order by num,city";
            $resultpr = mysql_query($sqlpr);
            $rowpr = mysql_fetch_array($resultpr);

            $PIDpr = $rowpr['PID']; //������ ������������� ������. �� ������� ����
            $city = $rowpr['city'];
            $predok = $rowpr['city'] . ' > ' . $predok; //�������, ������� ����� ���������� ������� ��������
            //�������� ���������� ������� � ������������.
            $sqlprr = "select * from " . $SysValue['base']['table_name30'] . " where (enabled='1' and PID='" . $PIDpr . "') order by num,city";
            $resultprr = mysql_query($sqlprr);
            $ii = 0;
            while ($rowsos = mysql_fetch_array($resultprr)) {
                $sqlsosed = "select * from " . $SysValue['base']['table_name30'] . " where (enabled='1' and PID='" . $rowsos['id'] . "') order by num,city";
                $resultsosed = mysql_query($sqlsosed);
                $sosed = mysql_num_rows($resultsosed);
                $sosfolder = $rowsos['is_folder'];
                if ($sosfolder) {
                    if ($sosed) {
                        $ii++;
                    }
                } else {
                    $ii++;
                }
            }

            //���� ((���� ������, �.�. �� ������� ������ ����� ������� ���-�� ������)
            // � (������� �������� ������ �������)), �� ���������� ����������� ������� �� ������� ����
            if (($ii > 1) && ($num > 0)) { //���������� ������ "�����" ���� ������ 1 ������� ������ � �������� � (���� ���� ������� ���� ������� �������� ������ �������)
                $pred = '�������: ' . $city . ' <A href="javascript:UpdateDeliveryJq(' . $PIDpr . ',this)" title="������� ������ ������ ��������"><img src="../' . $pathTemplate . '/images/shop/icon-activate.gif" alt=""  border="0" align="absmiddle">������� ������ ������ ��������</A> <BR> ' . $pred;
            }
        }
        if (strlen($pred)) {
            $br = '<BR>';
        } else {
            $br = '';
        } //���� ���� ���� ����������� ����, �� ���������� �������� ������,
    } //���� ���� ������, ��������� ���������


    $varamount = 0;
    $chkdone = 0; //�� ������� ������������� �������� �� �������
    while ($row = mysql_fetch_array($resultvariants)) {

        if (!empty($deliveryID)) {//���� ��������� �������������
            if ($row['id'] == $deliveryID) {
                $chk = "checked";
            } else {
                $chk = "";

                if ($isfolder) { //���� ���������� ������������� ����� � �������� ��������� ����
                    if ($row['flag'] == 1) { //�� ������ �������� �� ���������
                        $chk = "checked";
                        $chkdone = $row['id']; //���� ��������� ������������� ��������, �� �������� ��� ����� ��������
                    } else {
                        $chk = "";
                    }
                }
            }
        } elseif ($engineinc) {//���� �� ��������� �������������, �� ������������ ��������� ������
            if ($row['flag'] == 1) { //�� ������ �������� �� ���������
                $chk = "checked";
                $chkdone = $row['id']; //���� ��������� ������������� ��������, �� �������� ��� ����� ��������
            } else {
                $chk = "";
            }
        }

        // �������� ���������� ������� � ������������.
        $sqlpot = "select * from " . $SysValue['base']['table_name30'] . " where (enabled='1' and PID='" . $row['id'] . "') order by num,city";
        $resultpot = mysql_query($sqlpot);
        $pot = mysql_num_rows($resultpot);


        $city = $row['city'];
        if ((!$row['is_folder']) || ($pot)) {
            // ����� � �������
            //@$disp.='&nbsp;<input type=radio value=' . $row['id'] . ' ' . $chk . '  name="dostavka_metod" id="dostavka_metod" > ' . $predok . $city . '<br>';
            // ����� ��� ������
            if ($row['icon'])
                $img = "&nbsp;<img src='{$row['icon']}' title='$city' height='30'>&nbsp;";
            else
                $img = "";
            @$disp .= '<span class="delivOneEl">&nbsp;<input type=radio value=' . $row['id'] . ' ' . $chk . '  name="dostavka_metod" id="dostavka_metod" > <span class="deliveryName" for="' . $row['id'] . '">' . $img . $city . '</span></span>';
            $varamount++;
            $curid = $row['id'];
        }
    }


    $query = "select data_fields,city_select from " . $SysValue['base']['table_name30'] . " where id=$deliveryID";
    $row = mysql_fetch_array(mysql_query($query));
    $adresDisp_save = getAdresFields(unserialize($row['data_fields']), $row['city_select']);
    $adresDisp = "��� ���������� ������, ����������, �������� ������� ������ ��������.";
    //$adresDisp_save = print_r(unserialize($row['data_fields']),1);

    if ($varamount === 0) {
        $makechoise = '&nbsp;<input type=radio value=0  name="dostavka_metod" id="dostavka_metod">[�������� �� ���������]';
        $alldone = '<INPUT TYPE="HIDDEN" id="makeyourchoise" VALUE="DONE">';
        $adresDisp = $adresDisp_save;
        $deliveryID = 0;
        $curid = $deliveryID;
    } elseif ($varamount >= 1) {
        //$makechoise = '<OPTION value="' . $deliveryID . '" id="makeyourchoise">�������� ��������</OPTION>';
        $alldone = '';
    } else {
        $alldone = '<INPUT TYPE="HIDDEN" id="makeyourchoise" VALUE="DONE">';
        $adresDisp = $adresDisp_save;
    }


    if ($varamount == 1) {
        if (!(($curid == $deliveryID)))
            $waytodo = '<IMG onload="UpdateDeliveryJq(' . $curid . ',this);" SRC="../' . $pathTemplate . '/images/shop/flag_green.gif" style="display:none;">';
    }

    if ($stop) {
        $makechoise = '';
        $alldone = '<INPUT TYPE="HIDDEN" id="makeyourchoise" VALUE="DONE">';
        $adresDisp = $adresDisp_save;
    } else {
        if ($chkdone)
            $waytodo = '<IMG onload="UpdateDeliveryJq(' . $chkdone . ',this);" SRC="../' . $pathTemplate . '/images/shop/flag_green.gif"  style="display:none;">';
    }




    $disp = '<DIV id="seldelivery">' . $pred . $br . $my . '
' . $makechoise . '
' . $disp . '
' . $alldone . $waytodo . '</DIV>';

    if ($obj)
        $obj->set('orderDelivery', $disp);
    else {
        return array("dellist" => $disp, "adresList" => $adresDisp);
    }
}

function getAdresFields($mass, $city_select = null) {
    global $SysValue;


    if (!is_array($mass))
        return "��� ������� ���� �������� �� ��������� �������������� ������";
    $num = $mass[num];
    asort($num);
    $enabled = $mass[enabled];

    if ($city_select) {
        $disp = "<div id='citylist'>";
        // C�����
        if ($city_select == 2) {
            $disabled = "disabled";
            $query = "SELECT country_id, name FROM " . $SysValue['base']['citylist_country'] . " Order BY name";
            $result = mysql_query($query);
            while ($row = mysql_fetch_array($result)) {
                $disOpt .= "<option value='" . $row['name'] . "' for='" . $row['country_id'] . "'>" . $row['name'] . "</option>";
            }
            if ($enabled['country']['req']) {
                $req = "req";
                $star = '<span class="required">*</span>';
            } else {
                $req = "";
                $star = "";
            }
            $disp .= "$star " . $enabled['country']['name'] . "<br> <select name='country_new' class='citylist $req'><option value='' for='0'>-----------</option>$disOpt</select><br><br>";
        }

        // ������
        $rfId = 3159; // ID �� 
        $disOpt = "";
        $query = "SELECT region_id, name FROM " . $SysValue['base']['citylist_region'] . " WHERE country_id = $rfId Order BY name";
        $result = mysql_query($query);
        while ($row = mysql_fetch_array($result)) {
            $disOpt .= "<option value='" . $row['name'] . "' for='" . $row['region_id'] . "' $ch>" . $row['name'] . "</option>";
        }
        if ($enabled['state']['req']) {
            $req = "req";
            $star = '<span class="required">*</span>';
        } else {
            $req = "";
            $star = "";
        }
        $disp .= "$star " . $enabled['state']['name'] . "<br> <select name='state_new' class='citylist $req' $disabled><option value='' for='0'>-----------</option>$disOpt</select><br><br>";

        //�����
        $disp .= "$star " . $enabled['city']['name'] . "<br> <select name='city_new' class='citylist $req' $disabled><option value='' for='0'>-----------</option></select><br><br></div>";
    }

    foreach ($num as $key => $value) {
        if ($city_select AND ($key == "state" OR $key == "city" OR $key == "country"))
            continue;
        if ($enabled[$key]['enabled'] == 1) {
            if ($enabled[$key]['req']) {
                $req = "class='req'";
                $star = '<span class="required">*</span>';
            } else {
                $req = "";
                $star = "";
            }
            $disp .= $star . " " . $enabled[$key][name] . "<br><input type='text' $req value='' name='" . $key . "_new'><br><br>";
        }
    }
    return $disp;
}

?>