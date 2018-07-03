<?php

$TitlePage = __('������������') . ' / ' . __("���������");

function format_mysql_date($datetime, $style = "y.m.d h:i:s") {
    if (mb_strlen($datetime, "UTF-8") != 19)
        return $datetime;
    $ex = explode(" ", $datetime);
    $ex_date = explode("-", $ex[0]);
    $ex_time = explode(":", $ex[1]);
    if ((count($ex_date) == 3) && (count($ex_time) == 3)) {
        $text_month = "";
        switch ($ex_date[1]) {
            case 1: $text_month = "������";
                break;
            case 2: $text_month = "�������";
                break;
            case 3: $text_month = "�����";
                break;
            case 4: $text_month = "������";
                break;
            case 5: $text_month = "���";
                break;
            case 6: $text_month = "����";
                break;
            case 7: $text_month = "����";
                break;
            case 8: $text_month = "�������";
                break;
            case 9: $text_month = "��������";
                break;
            case 10: $text_month = "�������";
                break;
            case 11: $text_month = "������";
                break;
            case 12: $text_month = "�������";
                break;
        }
        $style = str_replace("y", $ex_date[0], $style);
        $style = str_replace("m", $ex_date[1], $style);
        $style = str_replace("d", $ex_date[2], $style);
        $style = str_replace("f", $text_month, $style);
        $style = str_replace("h", $ex_time[0], $style);
        $style = str_replace("i", $ex_time[1], $style);
        $style = str_replace("s", $ex_time[2], $style);
        return $style;
    }
    return $datetime;
}

function actionStart() {
    global $PHPShopInterface;


    $PHPShopInterface->addJSFiles('./shopusers/gui/shopusers.gui.js');
    $PHPShopInterface->setActionPanel(__('������������') . ' / ' . __("���������"), array('������� ���������'), false);
    $PHPShopInterface->setCaption(array(null, "2%"), array("���", "20%"), array("E-mail", "15%"), array("����", "40%"), array("����", "10%"), array("", "10%"), array("������ &nbsp;&nbsp;&nbsp;", "10%", array('align' => 'right')));

    // ������� � �������
    $PHPShopOrm = new PHPShopOrm();
    $PHPShopOrm->debug = false;
    $PHPShopOrm->sql = 'SELECT a.*, b.name, b.login FROM ' . $GLOBALS['SysValue']['base']['messages'] . ' AS a 
        JOIN ' . $GLOBALS['SysValue']['base']['shopusers'] . ' AS b ON a.UID = b.id     
            limit 1000';

    $data = $PHPShopOrm->select();
    if (is_array($data))
        foreach ($data as $row) {
        
        if(empty($row['enabled']))
            $status='<span class="glyphicon glyphicon-envelope" style="color:red"></span>';
        else $status='<span class="glyphicon glyphicon-envelope"></span>';
        
            $PHPShopInterface->setRow(
                    $row['ID'], array('name' => $row['name'], 'link' => '?path=shopusers.messages&id=' . $row['ID'], 'align' => 'left'), array('name' => $row['login'], 'link' => '?path=shopusers&id=' . $row['UID'].'&return='.$_GET['path']), $row['Subject'], array('name'=> format_mysql_date($row['DateTime'],'d-m-y h:i')), array('action' => array('edit', 'delete', 'id' => $row['ID']), 'align' => 'center'), array('name'=>$status,'align'=>'right'));
        }
    $PHPShopInterface->Compile();
}

?>