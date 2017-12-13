<?php
/**
 * ��������� ���������
 * @package PHPShopElementsDepricated
 * @param int $year ���
 * @param int $month �����
 * @return string
 */
function makeCalendar($year, $month) {
    global $SysValue;
    // �������� ����� ��� ������ ��� 1 ����� ������. ������������
    // ���, ����� ����������� ��������������� ����� 7, � �� ����� 0.
    if (function_exists(GregorianToJD))
        $wday = JDDayOfWeek(GregorianToJD($month, 1, $year), 0);
    if ($wday == 0) $wday = 7;
    // �������� � ����� ����� � ������ (���� ������ ����
    // ��� ������ ����� ������, ����� � ��������� ����� �������).
    $n = - ($wday - 2);
    $cal = array();

    for ($y=0; $y<6; $y++) {

        $row = array();
        $notEmpty = false;
        // ���� ������ ������ �� ���� ������.
        for ($x=0; $x<7; $x++, $n++) {
            // ������� ����� >0 � < ����� ������?
            if (checkdate($month, $n, $year)) {
                // ��. ��������� ������.
                $timeststart=mktime(0,0,0,$month,$n,$year);
                $timestend=mktime(23,59,59,$month,$n,$year);
                $sql="select * from ".$SysValue['base']['table_name8']." where ((datau>=".$timeststart.") AND (datau<=".$timestend."));";
                $result=mysql_query($sql);
                @$SysValue['sql']['num']++;
                @$num_rows=mysql_num_rows($result);
                if ($num_rows) {
                    $row[]='<A href="../news/?timestamp='.$timeststart.'"><B>'.$n.'</B></A>';
                } else {
                    $row[]= $n;
                }


                $notEmpty = true;
            } else {
                // ���. ������ �����.
                $row[] = "";
            }
        }

        // ���� � ������ ������ ��� �� ������ ��������� ��������,
        // ������, ����� ��������.
        if (!$notEmpty) break;
        // ��������� ������ � ������.
        $cal[] = $row;
    }
    return $cal;
}

/**
 * ������
 * @package PHPShopElementsDepricated
 * @param int $mo �������� ����������� �����
 * @return string
 */
function moname($mo="1") {

    if ($mo=="12") return "�������";
    if ($mo=="11") return "������";
    if ($mo=="10") return "�������";
    if ($mo=="9") return "��������";
    if ($mo=="8") return "������";
    if ($mo=="7") return "����";
    if ($mo=="6") return "����";
    if ($mo=="5") return "���";
    if ($mo=="4") return "������";
    if ($mo=="3") return "����";
    if ($mo=="2") return "�������";
    if ($mo=="1") return "������";

    return $mo;
}

/**
 * ������� ���������
 * @package PHPShopElementsDepricated
 * @author PHPShop Software
 * @param int $year ���
 * @param int $month �����
 * @return string
 */
function calendar($year="",$month="") {
    global $SysValue;

    if (!$year) {
        $year=date("Y");
    } //���� �� �������� ���������� ����� - ������� ������� ���
    if (!$month) {
        $month=date("m");
    }//���� �� �������� ���������� ������� - ������� ������� �����



    $cal = makeCalendar($year, $month); // ��������� ���������
    $timestamp=mktime(0,0,0,$month,1,$year);

    foreach ($cal as $row) {
        $disp.='<tr>';
        foreach ($row as $i=>$v) {
            if ($i==6) {
                $st='style="color:red"';
            } else {
                $st="";
            }
            if (!$v) {
                $v="&nbsp;";
            }
            $disp.='<td '.$st.'>'.$v.'</td>';
        }
        $disp.='</tr>';
    }

    $cmonth=date("m");
    $cyear=date("Y");


    $numyearleft=$year-1;
    $numyearright=$year+1;
    $nummonthleft=$month-1;
    $nummonthright=$month+1;

    // ��������� ���� �� ��� ��� �����
    $timestampyear=mktime(0,0,0,1,1,$year);
    $sql="select * from ".$SysValue['base']['table_name8']." where ((datau<=".$timestampyear."));";
    $result=mysql_query($sql);
    @$SysValue['sql']['num']++;
    @$num_rows=mysql_num_rows($result);
    // ��������� ���� �� ��� ��� �����

    if ($num_rows) {
        if ($year>1) $yearleft='<A href="javascript:calres('.$numyearleft.',12)"><<</A> ';
    }

    if ($year<$cyear) $yearright='<A href="javascript:calres('.$numyearright.',1)">>></A> ';

    // ��������� ���� �� ��� ����� �����
    $timestampyear=mktime(0,0,0,$month,1,$year);
    $sql="select * from ".$SysValue['base']['table_name8']." where ((datau<=".$timestampyear."));";
    $result=mysql_query($sql);
    @$SysValue['sql']['num']++;
    @$num_rows=mysql_num_rows($result);
    //��������� ���� �� ��� ����� �����


    if ($num_rows) {
    //���� ����, ���������� ������ �����, � ������� ��� ����
        $go=0;
        $mm=$month;
        $num_rows=0;
        while (($go==0) && ($mm!=1)) {

            $timestamps=mktime(0,0,0,$mm-1,1,$year);
            $timestampe=mktime(0,0,0,$mm,1,$year);
            $sql="select * from ".$SysValue['base']['table_name8']." where ((datau>=".$timestamps.") AND (datau<=".$timestampe."));";
            $result=mysql_query($sql);
            @$SysValue['sql']['num']++;
            @$num_rows=mysql_num_rows($result);
            if ($num_rows) {
                $go=1;
            } else {
                $mm=$mm-1;
            }
        }
        $nummonthleft=$mm-1;
        if ($month>1) {
            $monthleft='<A href="javascript:calres('.$year.','.$nummonthleft.')"><<</A> ';
        } else {
            $monthleft='<A href="javascript:calres('.$numyearleft.',12)"><<</A> ';
        }
    }


    // ��������� ���� �� ��� ����� ������
    $timestampyear=mktime(0,0,0,$month+1,1,$year);
    $sql="select * from ".$SysValue['base']['table_name8']." where ((datau>=".$timestampyear."));";
    $result=mysql_query($sql);
    @$SysValue['sql']['num']++;
    @$num_rows=mysql_num_rows($result);
    // ��������� ���� �� ��� ����� ������

    if ($num_rows) {
    //���� ����, ���������� ������ �����, � ������� ��� ����

        if (($month>=$cmonth) && ($year==$cyear)) {
            $monthright='';
        }  else {
            if ($month<12) {
                //���� ����, ���������� ������ �����, � ������� ��� ����
                $go=0;
                $mm=$month;
                $num_rows=0;
                while (($go==0) && ($mm!=12) ) {
                    $timestamps=mktime(0,0,0,$mm+1,1,$year);
                    $timestampe=mktime(0,0,0,$mm+2,1,$year);
                    $sql="select * from ".$SysValue['base']['table_name8']." where ((datau>=".$timestamps.") AND (datau<=".$timestampe."));";
                    $result=mysql_query($sql);
                    @$SysValue['sql']['num']++;
                    @$num_rows=mysql_num_rows($result);
                    if ($num_rows) {
                        $go=1;
                    } else {
                        $mm=$mm+1;
                    }
                }
                $nummonthright=$mm+1;

                $monthright='<A href="javascript:calres('.$year.','.$nummonthright.')">>></A> ';
            } else {
                $monthright='<A href="javascript:calres('.$numyearright.',1)">>></A> ';
            }
        }
    }


    setlocale(LC_ALL,'');
    $yearname=strftime('%Y',$timestamp); //�������� ��������� ����
    $monthname=moname($month);


    $SysValue['other']['yearleft']=$yearleft;
    $SysValue['other']['yearname']=$yearname;
    $SysValue['other']['yearright']=$yearright;
    $SysValue['other']['monthleft']=$monthleft;
    $SysValue['other']['monthname']=$monthname;
    $SysValue['other']['monthright']=$monthright;
    $SysValue['other']['dispCalendarDays']=$disp;

    $disp=ParseTemplateReturn("calendar/calendar_main_forma.tpl");

    return $disp;

}

?>