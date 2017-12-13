<?
/**
 * ���������� ����������� � ��
 * @author PHPShop Software
 * @version 1.0
 * @package PHPShopClass
 * @param string $iniPath ���� �� ����������������� ����� config.ini
 */
class PHPShopBase {
    /**
     * @var string ���� �� ����������������� ����� config.ini
     */
    var $iniPath;
    /**
     * @var array ������ ������ �������� �������
     */
    var $SysValue;
    /**
     * @var string ��������� ����
     */
    var $codBase="cp1251";
    /**
     * @var bool ����� �������
     */
    var $debug=true;
    /**
     * ����������� � ��
     * @param string $iniPath ���� �� ����������������� ����� config.ini
     */
    function PHPShopBase($iniPath) {
        $this->iniPath=$iniPath;
        $this->SysValue=parse_ini_file($this->iniPath,1);
        $GLOBALS['SysValue']=$this->SysValue;
        $this->connect();
    }
    /**
     * ������ ��������� ���������� �������
     * @return array
     */
    function getSysValue() {
        return $this->SysValue;
    }
    /**
     * ������ ��������� ���������� �������
     * <code>
     * // example
     * $PHPShopBase= new PHPShopBase('./inc/config.ini');
     * $PHPShopBase->getParam('base.table_name');
     * </code>
     * @param mixed $param ��� ���������
     * @return string
     */
    function getParam($param) {
        $param=explode(".",$param);
        if(count($param)>2) return $this->SysValue[$param[0]][$param[1]][$param[2]];
        return $this->SysValue[$param[0]][$param[1]];
    }
    /**
     * �������� ��������
     * <code>
     * // example
     * $PHPShopBase= new PHPShopBase('./inc/config.ini');
     * $PHPShopBase->setParam('base.table_name','mybase');
     * </code>
     * @param string $param ��� ���������
     * @param mixed $value �������� ���������
     */
    function setParam($param,$value) {
        $param=explode(".",$param);
        if($param[0] == "var") $param[0]="other";
        $GLOBALS['SysValue'][$param[0]][$param[1]]=$value;
    }
    /**
     * ����� ��������� �� ������
     * @param int $e ����� ���������� ������
     * @param string $message ����� ���������
     * @param string $error ����� ������
     */
    function errorConnect($e=false,$message="��� ���������� � �����",$error=false) {
        echo "<strong>$message</strong> ( <a href='http://www.phpshopcms.ru/help/Content/install/phpshop.html#6' target='_blank'>Error $e</a> )<br>";
        echo "<em>������: ".$error.mysql_error()."</em>";
        echo '<script>window.open("http://www.phpshopcms.ru/help/Content/install/phpshop.html#6");</script>';
        exit();
    }
    /**
     * ���������� � �� MySQL
     */
    function connect() {
        $SysValue=$this->SysValue;
        mysql_connect($this->getParam("connect.host"),$this->getParam("connect.user_db"),$this->getParam("connect.pass_db")) or die( $this->errorConnect(101));
        mysql_select_db($SysValue['connect']['dbase']) or die( $this->errorConnect(102));
        mysql_query("SET NAMES '".$this->codBase."'");
    }

    /**
     * �������� ���� ��������������
     * @param bool $require �������� ������������ �����
     */
    function chekAdmin($require=true) {
        global $UserChek,$UserStatus;
        $adminPath = explode("../",$this->iniPath);
        $i=2;
        while(count($adminPath) > $i) {
            @$aPath.="../";
            $i++;
        }
        @$loadPath=$aPath."enter_to_admin.php";
        if($require) require_once($loadPath);
        else return $loadPath;
    }

    /**
     * ������ ���-�� ����� � �������
     * @param string $from_base ��� �������
     * @param string $query SQL ������
     * @return int
     */
    function getNumRows($from_base,$query) {
        global $SysValue;
        $num=0;
        $sql="select COUNT('id') as count from ".$this->SysValue['base'][$from_base]." ".$query;
        $result=mysql_query($sql);
        $row = mysql_fetch_array(@$result);
        $num=$row['count'];
        return $num;
    }

}
?>