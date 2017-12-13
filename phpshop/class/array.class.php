<?php
/**
 * ���������� ������ � ��������� ������
 * <code>
 * // example:
 *class PHPShopCategoryArray extends PHPShopArray{
 *	 function PHPShopCategoryArray(){
 *	 $this->objBase=$GLOBALS['SysValue']['base']['table_name'];
 *	 parent::PHPShopArray("id","name","PID");
 *	 }
 }
 * </code>
 * @author PHPShop Software
 * @version 1.0
 * @package PHPShopClass
 */
class PHPShopArray {
    /**
     * @var string ��� �� 
     */
    var $objBase;
    /**
     * @var bool ����� �������
     */
    var $debug=false;
    /**
     * @var int ����������� [1] ��� ���������� ����� [2]
     */
    var $objType=1;
    function PHPShopArray() {
        $this->objArg=func_get_args();
        $this->objArgNum=func_num_args();
        $this->setArray();
    }
    /**
     * �������� ������� ��������� ��������� �� ��
     * @param mixed $param ��� ��������� ����� �������
     */
    function setArray() {
        if($this->objArgNum>0) {
            $sql_str="";
            foreach($this->objArg as $v) $sql_str.=$v.",";
            $sql_str=substr($sql_str,0,strlen($sql_str)-1);
        }
        else $sql_str="*";


        $PHPShopOrm = &new PHPShopOrm($this->objBase);
        $PHPShopOrm->debug=$this->debug;
        $objResult = $PHPShopOrm->query("select ".$sql_str." from ".$this->objBase." ".$this->objSQL);


        while ($objRow = mysql_fetch_array($objResult)) {
            switch($this->objType) {
                case(1):
                    foreach($this->objArg as $val) $_array[$val]=$objRow[$val];
                    $array[$objRow[$this->objArg[0]]]=$_array;
                    break;

                case(2):
                    $array[$objRow[$this->objArg[0]]]=$objRow[$this->objArg[1]];
                    break;

                case(3):
                    foreach($this->objArg as $val) $array[$val]=$objRow[$val];
                    break;
            }
        }
        $this->objArray=$array;
    }
    /**
     * ������ ������ �������
     * @return array
     */
    function getArray() {
        return $this->objArray;
    }
    /**
     * ������ �������� �������
     * @param string $param ��� ���������
     * @return string
     */
    function getParam($param) {
        $param=explode(".",$param);
        return $this->objArray[$param[0]][$param[1]];
    }

    //
    /**
     * �������������� � �������� ������ �� ������� ��������� ��� �������� ������
     * @param string $param ��� ���������
     * @return array
     */
    function getKey($param) {
        $param=explode(".",$param);
        $array = $this->objArray;
        if(is_array($array))
            foreach($array as $val)
                foreach($val as $key=>$v)
                    if($key == $param[1]) $newArray[$val[$param[0]]]=$v;
        return $newArray;
    }
}

?>