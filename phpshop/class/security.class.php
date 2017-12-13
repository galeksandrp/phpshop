<?php
/*
+-------------------------------------+
|  ���: PHPShopSecurity               |
|  �����������: PHPShop Software      |
|  �������������: Enterprise          |
|  ����������: ������������           |
|  ������: 1.0                        |
|  ���: class                         |
|  �����������: ���                   |
|  �����: Function                    |
+-------------------------------------+
*/

class PHPShopSecurity {

    // �������� ���������� �����
    function getExt($sFileName) {
        $sTmp=$sFileName;
        while($sTmp!="") {
            $sTmp=strstr($sTmp,".");
            if($sTmp!="") {
                $sTmp=substr($sTmp,1);
                $sExt=$sTmp;
            }
        }
        $pos=stristr($sFileName, "php");
        if($pos === false) return strtolower($sExt);
    }

    function CleanStr($str) {
        $str=str_replace("/","",$str);
        $a= str_replace("\"", "", $str);
        return str_replace("'", "", $a);
    }

    // ������ ����
    function CleanOut($str) {
        $str = preg_replace('([\r\n\t])', '', $str);
        $str = @html_entity_decode($str);
        return $str;
    }


    // �������� ������
    function CleanSearch($search) {
        $search=strtolower($search);
        $search=str_replace("'", "", $search);
        if (preg_match("/union/i", $search)) $search = str_replace("union", "", $search);
        if (preg_match("/select/i", $search)) $search = str_replace("select", "", $search);
        if (preg_match("/insert/i", $search)) $search = str_replace("insert", "", $search);
        if (preg_match("/delete/i", $search)) $search = str_replace("delete", "", $search);
        if (preg_match("/update/i", $search)) $search = str_replace("update", "", $search);
        return $search;
    }

    function true_email($email) {
        if(strlen($email)>100) return FALSE;
        return preg_match("/^([a-z0-9_\.-]+@[a-z0-9_\.\-]+\.[a-z0-9_-]{2,6})$/i",$email);
    }

    function true_login($login) {
        return ereg("^[a-zA-Z0-9_\.]{2,20}$",$login);
    }

    function true_passw($passw) {
        return ereg("^[a-zA-Z0-9_]{4,20}$",$passw);
    }


    function TotalClean($str,$flag)
    /*
    1 - ��������� �������;
    2 - ����������� ��� � ��� html;
    3 - ��������� ����;
    4 - ��������� ���� � �����
    5 - �������� �����
    */ {
        if($flag==1)// �������
        {
            if (!ereg ("([0-9])", $str)) {
                $str="0";
            }
            return abs($str);
        }
        elseif($flag==2)// ������� ����
        {
            return htmlspecialchars(stripslashes($str));
        }
        elseif($flag==3)// ��������� ������ �� ���� � ����
        {
            //�������� �����
            if(!preg_match("/^([a-z0-9_\.-]+@[a-z0-9_\.\-]+\.[a-z0-9_-]{2,6})$/i",$str)) {
                $str="";
            }
            return $str;
        }
        elseif($flag==4)// ��������� ������ �� ����
        {
            if (preg_match("/[^(\w)|(\x7F-\xFF)|(\s)]/",$str)) {
                $str="";
            }
            return  htmlspecialchars(stripslashes($str));
        }
        elseif($flag==5)// �������� �������� ����
        {
            if (preg_match("/[^(0-9)|(\-)|(\.]/",$str)) {
                $str="0";
            }
            return $str;
        }
    }
}


?>
