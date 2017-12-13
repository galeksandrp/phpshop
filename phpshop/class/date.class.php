<?php
/**
 * ���������� ������ � ������
 * @author PHPShop Software
 * @version 1.0
 * @package PHPShopClass
 */
class PHPShopDate {
    /**
     * �������������� ���� �� Unix � ��������� ���
     * @param int $nowtime ������ ���� � Unix
     * @return string
     */
    function dataV($nowtime) {
        $Months = array("01"=>"������","02"=>"�������","03"=>"�����",
                "04"=>"������","05"=>"���","06"=>"����", "07"=>"����",
                "08"=>"�������","09"=>"��������",  "10"=>"�������",
                "11"=>"������","12"=>"�������");
        $curDateM = date("m",$nowtime);
        $t=date("d",$nowtime)."-".$curDateM."-".date("y",$nowtime)." ".date("H:i ",$nowtime);
        return $t;
    }

    /**
     * �������������� ���� �� ���������� ���� � Unix
     * @param string $data ���� � ������� ������
     * @param string $delim ����������� ���� [-] ��� [.]
     * @return <type>
     */
    function GetUnicTime($data,$delim='-') {
        $array=explode($delim,$data);
        return @mktime(12, 0, 0, $array[1], $array[0], $array[2]);
    }

}
?>