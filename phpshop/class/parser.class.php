<?php
/**
 * ���������� �������� ������
 * @author PHPShop Software
 * @version 1.1
 * @package PHPShopClass
 */
class PHPShopParser {
    /**
     * ��������� ����� �������, ������� �����������
     * @param string $path ���� � ����� �������
     * @param bool $return ����� ������ ���������� ��� �������� ����������
     * @return string
     */
    function file($path,$return=false) {

        $string=null;
        if(is_file($path)) $string = @file_get_contents($path);
        else echo "Error Tmp File: $path";
        $replaces = array(
                "/images\//i" => $GLOBALS['SysValue']['dir']['dir'].$GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']."/images/",
                "/java\//i" => "/java/",
                "/css\//i" => "/css/",
                "/phpshop\//i" => "/phpshop/",
        );

        $string = @preg_replace("/@([a-zA-Z0-9_]+)@/e", '$GLOBALS["SysValue"]["other"]["\1"]', $string);
        $string = preg_replace(array_keys($replaces), array_values($replaces), $string);
        if(!empty($return)) return $string;
        else
            echo $string;
    }

    /**
     * �������� ��������� ���������� ��� ��������
     * @param string $name ���
     * @param mixed $value ��������
     * @param bool $flag [1] - ��������, [0] - ����������
     */
    function set($name,$value,$flag=false) {
        if($flag) $GLOBALS['SysValue']['other'][$name].=$value;
        else $GLOBALS['SysValue']['other'][$name]=$value;
    }

    /**
     * ������ ��������� ����������
     * @param string $name
     * @return string
     */
    function get($name) {
        return $GLOBALS['SysValue']['other'][$name];
    }

}

?>