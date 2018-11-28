<?php

/**
 * ����� ������� ��������
 * @package PHPShopCoreFunction
 * @param int $deliveryID �� ��������
 * @return string
 */
function delivery($obj, $deliveryID, $sum = 0) {
    global $SysValue, $link_db;

    $pred = $br = $my = $alldone = $waytodo = $disp = null;

    // ����������
    if (defined("HostID")) {
        $servers= " and servers REGEXP 'i" . HostID . "i'";
    } elseif (defined("HostMain"))
        $servers= " and (servers = '' or servers REGEXP 'i1000i')";
    else $servers = null;

    if (empty($SysValue['nav'])) {
        $engineinc = 0;
        $pathTemplate = $GLOBALS['SysValue']['dir']['dir'] . chr(47) . $GLOBALS['SysValue']['dir']['templates'] . chr(47) . $_SESSION['skin'];
    } else {
        $engineinc = 1;
        $pathTemplate = $GLOBALS['SysValue']['dir']['dir'] . $GLOBALS['SysValue']['dir']['templates'] . chr(47) . $_SESSION['skin'];
    }

    $table = $SysValue['base']['delivery'];

    if ($deliveryID > 0) {
        $sql = "select * from " . $table . " where (enabled='1' and id='" . $deliveryID . "') ".$servers." order by num,city";
        $result = mysqli_query($link_db, $sql);
        $row = mysqli_fetch_array($result);
        $isfolder = $row['is_folder'];
        $PID = $row['PID'];
        $sqlvariants = "select * from " . $table . " where (enabled='1' and PID='" . $row['PID'] . "') ".$servers." order by num,city";

        if ($isfolder) { //���� �������� �����, �� �������� ����� ������� �����
            $sqlvariants = "select * from " . $table . " where (enabled='1' and PID='" . $deliveryID . "') ".$servers." order by num,city";
            $PIDpr = $deliveryID; //��������� ������, ��� �����������
            $stop = 0;
        } else { //���� �������� �������, �� �������� ����� ������
            $sqlvariants = "select * from " . $table . " where (enabled='1' and PID='" . $row['PID'] . "') ".$servers." order by num,city";
            $PIDpr = $row['PID']; //��������� ������, ��� �����������
            $stop = 1;
        }
    } else { //���� �� ��������, ������ ��������� ����� ��� �������� ��������
        $stop = 0;
        $isfolder = 1; //���� �� �������� ID, ������ �������� 0 �������������, ������� �������� ������ ��������
        $PID = false;
        $deliveryID = 0; //����������� ������� �������������, ���� ������ �� ��������
        $sqlvariants = "select * from " . $table . " where (enabled='1' and PID='0') ".$servers." order by num,city";
    }
    
    $resultvariants = mysqli_query($link_db, $sqlvariants); // ��������� ��������
    $varamount = mysqli_num_rows($resultvariants);

    if ($PID !== false) { //���� ���� ������, ��������� ���������
        $pred = '';
        $ii = 0;
        $num = 0;
        while ($PIDpr != 0) {//������ ���� �� ������ �� ������ �������� ������
            $num++;

            //�������� ������� ������
            $sqlpr = "select * from " . $SysValue['base']['delivery'] . " where (enabled='1' and id='" . $PIDpr . "') ".$servers." order by num,city";
            $resultpr = mysqli_query($link_db, $sqlpr);
            $rowpr = mysqli_fetch_array($resultpr);

            $PIDpr = $rowpr['PID']; //������ ������������� ������. �� ������� ����
            $city = $rowpr['city'];
            $predok = $rowpr['city'] . ' > ' . $predok; //�������, ������� ����� ���������� ������� ��������
            //�������� ���������� ������� � ������������.
            $sqlprr = "select * from " . $table . " where (enabled='1' and PID='" . $PIDpr . "') ".$servers." order by num,city";
            $resultprr = mysqli_query($link_db, $sqlprr);
            $ii = 0;
            while ($rowsos = mysqli_fetch_array($resultprr)) {
                $sqlsosed = "select * from " . $table . " where (enabled='1' and PID='" . $rowsos['id'] . "') ".$servers." order by num,city";
                $resultsosed = mysqli_query($link_db, $sqlsosed);
                $sosed = mysqli_num_rows($resultsosed);
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
                $pred = __('�������') . ': ' . $city . ' <A href="javascript:UpdateDeliveryJq(\'' . $PIDpr . '\',this)"><img src="' . $pathTemplate . '/images/shop/icon-activate.gif" alt="" border="0" align="absmiddle">' . __('������� ������ ������ ��������') . '</A> <BR> ' . $pred;
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
    while ($row = mysqli_fetch_array($resultvariants)) {

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
        $sqlpot = "select * from " . $table . " where (enabled='1' and PID='" . $row['id'] . "') ".$servers." order by num,city";
        $resultpot = mysqli_query($link_db, $sqlpot);
        $pot = mysqli_num_rows($resultpot);


        $city = $row['city'];
        if ((empty($row['is_folder'])) || ($pot)) {

            if ($row['icon'])
                $img = "&nbsp;<img src='{$row['icon']}' title='$city' height='30'>&nbsp;";
            else
                $img = "";

            // �������� ������������ �����
            if (!empty($row['sum_max']) and !empty($sum) and $row['sum_max'] <= $sum) {
                $disp .= '<span class="delivOneEl"><label><input type="radio"  value="' . $row['id'] . '" ' . $chk . '  name="dostavka_metod" id="dostavka_metod" data-option="' . $row['payment'] . '" disabled="disabled"> <span class="deliveryName" data-toggle="tooltip" data-placement="top" title="��������� ������������ ����� ������">' . $img . $city . '</span></span></label>';
            } else {
                $disp .= '<span class="delivOneEl"><label><input type="radio" value="' . $row['id'] . '" ' . $chk . '  name="dostavka_metod" id="dostavka_metod" data-option="' . $row['payment'] . '"> <span class="deliveryName" >' . $img . $city . '</span></span></label>';
                $varamount++;
                $curid = $row['id'];
            }
        }
    }

    $query = "select data_fields,city_select from " . $SysValue['base']['delivery'] . " where id=$deliveryID";
    $row = mysqli_fetch_array(mysqli_query($link_db, $query));
    $adresDisp_save = getAdresFields(unserialize($row['data_fields']), $row['city_select']);
    $adresDisp = "��� ���������� ������, ����������, �������� ������� ������ ��������.";

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
            $waytodo = '<IMG onload="UpdateDeliveryJq(' . $curid . ',this);" SRC="' . $pathTemplate . '/images/shop/flag_green.gif" style="display:none;">';
    }

    if ($stop) {
        $makechoise = '';
        $alldone = '<INPUT TYPE="HIDDEN" id="makeyourchoise" VALUE="DONE">';
        $adresDisp = $adresDisp_save;
    } else {
        if ($chkdone)
            $waytodo = '<IMG onload="UpdateDeliveryJq(' . $chkdone . ',this);" SRC="' . $pathTemplate . '/images/shop/flag_green.gif"  style="display:none;">';
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
    global $SysValue, $link_db;

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
            $result = mysqli_query($link_db, $query);
            while ($row = mysqli_fetch_array($result)) {
                $disOpt .= "<option value='" . $row['name'] . "' for='" . $row['country_id'] . "'>" . $row['name'] . "</option>";
            }
            if ($enabled['country']['req']) {
                $req = "req";
                $star = '<span class="required">*</span>';
            } else {
                $req = "";
                $star = "";
            }
            $disp .= "$star " . $enabled['country']['name'] . "<p> <select name='country_new' class='citylist form-control $req '><option value='' for='0'>-----------</option>$disOpt</select></p>";
        }

        // ������
        $rfId = 3159; // ID �� 
        $disOpt = "";
        $query = "SELECT region_id, name FROM " . $SysValue['base']['citylist_region'] . " WHERE country_id = $rfId Order BY name";
        $result = mysqli_query($link_db, $query);
        while ($row = mysqli_fetch_array($result)) {
            $disOpt .= "<option value='" . $row['name'] . "' for='" . $row['region_id'] . "'>" . $row['name'] . "</option>";
        }
        if ($enabled['state']['req']) {
            $req = "req";
            $star = '<span class="required">*</span>';
        } else {
            $req = "";
            $star = "";
        }
        $disp .= "$star " . $enabled['state']['name'] . "<p><select name='state_new' class='citylist form-control $req' $disabled><option value='' for='0'>-----------</option>$disOpt</select></p>";

        //�����
        $disp .= "$star " . $enabled['city']['name'] . "<p> <select name='city_new' class='citylist form-control $req' $disabled><option value='' for='0'>-----------</option></select></p></div>";
    }

    foreach ($num as $key => $value) {
        if ($city_select AND ($key == "state" OR $key == "city" OR $key == "country"))
            continue;
        if ($enabled[$key]['enabled'] == 1) {
            if ($enabled[$key]['req']) {
                $req = "class='req form-control'";
                $star = '<span class="required">*</span>';
                $required = 'required';
            } else {
                $req = "class='form-control'";
                $star = "";
                $required = null;
            }
            $disp .= $star . " " . $enabled[$key][name] . "<p><input type='text' $req value='' name='" . $key . "_new' $required></p>";
        }
    }
    return $disp;
}

?>