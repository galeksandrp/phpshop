<?php
/**
 * ���������� �������� ������
 * @author PHPShop Software
 * @version 1.0
 * @package PHPShopClass
 */

class PHPShopParser {

    function file($path,$return=false) {
        $string=null;
        if(is_file($path)) $string = @file_get_contents($path);
        else echo "Error Tmp File: $path";
        $newstring = @preg_replace("/@([a-zA-Z0-9_]+)@/e", '$GLOBALS["SysValue"]["other"]["\1"]', $string);

        if(!empty($return)) return $newstring;
        else
            echo $newstring;
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