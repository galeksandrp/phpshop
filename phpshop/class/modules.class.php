<?php
/**
 * ����������� �������
 * @author PHPShop Software
 * @version 1.2
 * @package PHPShopClass
 */

class PHPShopModules {
    /**
     * @var mixed ������ ��������� �������� �������
     */
    var $ModValue;
    /**
     * @var string ������������� ���������� �������
     */
    var $ModDir;
    /**
     * @var bool ����� �������
     */
    var $debug=false;
    /**
     * �����������
     * @param string $ModDir  ������������� ���������� �������
     */
    function PHPShopModules($ModDir="phpshop/modules/") {
        $this->ModDir=$ModDir;
        $this->objBase=$GLOBALS['SysValue']['base']['modules'];
        
        $this->PHPShopOrm = &new PHPShopOrm($this->objBase);
        $this->PHPShopOrm->debug=$this->debug;
        
        $data=$this->PHPShopOrm->select(array('*'),false,false,array('limit'=>100));
        if(is_array($data))
            foreach($data as $row) {
                $path=$row['path'];
                $this->getIni($path);
            }
    }
    
    /**
     * ��������� �������� ������� �������
     * @param string $path ���� �� ������������ ������
     */
    function getIni($path) {
        $ini=$this->ModDir.$path."/inc/config.ini";
        if(file_exists($ini)) {
            $SysValue = parse_ini_file($ini,1);
            
            if(is_array($SysValue['autoload']))
                foreach($SysValue['autoload'] as $k=>$v) $this->ModValue['autoload'][$k]=$v;
            
            if(is_array($SysValue['core']))
                foreach($SysValue['core'] as $k=>$v) $this->ModValue['core'][$k]=$v;

            if(is_array($SysValue['class']))
                foreach($SysValue['class'] as $k=>$v) $GLOBALS['SysValue']['class'][$k]=$v;

            if(is_array($SysValue['lang']))
                foreach($SysValue['lang'] as $k=>$v) $GLOBALS['SysValue']['lang'][$k]=$v;

            if(is_array($SysValue['admpanel']))
                foreach($SysValue['admpanel'] as $k=>$v) $this->ModValue['admpanel'][$k]=$v;

            
            $this->ModValue['templates']=$SysValue['templates'];
            $GLOBALS['SysValue']['templates'][$path]=$SysValue['templates'];
            $this->ModValue['base'][$path]=$SysValue['base'];
            $GLOBALS['SysValue']['base'][$path]=$SysValue['base'];
            $this->ModValue['class']=$SysValue['class'];
            $this->ModValue['field'][$path]=$SysValue['field'];

        }
    }
    
    /**
     * �������� ��������� ������������ �������
     */
    function doLoad() {
        global $SysValue,$PHPShopSystem,$PHPShopNav;
        if(is_array($this->ModValue['autoload']))
            foreach($this->ModValue['autoload'] as $k=>$v) {
                if(file_exists($v)) require_once($v);
                else echo("������ �������� ������ ".$k."<br>����: ".$v);
            }
    }
    
    /**
     * �������� ���� �������
     * @param string $path ���� ���������� core ����� ������
     * @return <type> 
     */
    function doLoadPath($path) {
        global $SysValue;
        if(!empty($this->ModValue['core'][$path])) {
            if(is_file($this->ModValue['core'][$path])) {
                require_once($this->ModValue['core'][$path]);
                $classname = 'PHPShop'.ucfirst($SysValue['nav']['path']);
                
                if(class_exists($classname)) {
                    $PHPShopCore = new $classname ();
                    $PHPShopCore->loadActions();
                    return true;
                } else echo PHPShopCore::setError($classname,"�� ��������� ����� phpshop/modules/*/core/$classname.core.php");
            }
            else PHPShopCore::setError($path,"������ �������� ������ ".$path."<br>����: ".$this->ModValue['core'][$path]);
        }else return false;
    }
    /**
     * ������ ���������������� �������� �������
     * @param string ��� ��������� ����� ������.������������ [������.���������.������������]
     * @return <type> 
     */
    function getParam($param) {
        $param=explode(".",$param);
        if(count($param)>2) return $this->ModValue[$param[0]][$param[1]][$param[2]];
        return $this->ModValue[$param[0]][$param[1]];
    }
    /**
     * ������ ���������������� �������� �������
     * @return array 
     */
    function getModValue() {
        return $this->ModValue;
    }
    
    /**
     * ������ � ������� ������ �� ����
     * <code>
     * // example: 
     * $PHPShopModules->Parser(array('page'=>'market'),'catalog_page_1');
     * </code>
     * @param array $preg ������ ���������� ��������
     * @param string $TemplateName ��� �������
     * @return string 
     */
    function Parser($preg,$TemplateName) {
        $file = newGetFile($GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47).$TemplateName);
        
        // ������
        foreach($preg as $k=>$v)
            $file = str_replace($k, $v, $file);
        
        $dis = newParser($file);
        return @$dis;
    }
    
    /**
     * ������ XML ������� ������
     * @param string $path ���� �� xml �������� ������
     * @return array
     */
    function getXml($path) {
        PHPShopObj::loadClass("xml");
        if(function_exists("xml_parser_create")) {
            if(@$db=readDatabase($path,"module")) {
                
                if(count($db)>1) return $db;
                else return $db[0];
            }
        }
    }
    /**
     * �������� �� ����������� ��������� ������
     * @param string $serial �������� �����
     * @return bool
     */
    function true_serial($serial) {
        if (preg_match('/^\d{5}-\d{5}-\d{5}$/',$serial)) {
            return true;
        }
    }

    /**
     * �������� �� ���������� ����� ��� ������ ����������
     * @param string $path ��� �����
     * @param string $function_name ��� ������� ��� ����������
     * @param array $data ������
     * @return string
     */
    function setAdmHandler($path,$function_name,$data){
        global $PHPShopGUI;
        $file=pathinfo($path);
        $mod=$this->ModValue['admpanel'][substr($file['basename'],0,-4)];
        if($mod) 
            if(is_file($this->ModDir.$mod)){
                include_once($this->ModDir.$mod);
                $addHandler[$function_name];
            }
            else $this->PHPShopOrm->setError('setAdmHandler',"������ ���������� ������ ".$this->ModDir.$mod);
    }
}

?>