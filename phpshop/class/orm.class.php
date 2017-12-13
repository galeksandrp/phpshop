<?php

class PHPShopOrm {
    var $Base;
    var $_SQL;
    var $Option;
    var $debug;
    var $comment;
    var $install=true;

    function PHPShopOrm($Base=false) {
        $this->objBase = $Base;
        $this->Option['where']=" and ";
        $this->nWhere=1;
        $this->nSelect=1;
        $this->debug=false;
        $this->sql=false;
        $this->comment=false;
    }

    function select($select=array('*'),$where=false,$order=false,$option=false) {

        // ������� �� ���������� SELECT
        if(is_array($select)) {
            $this->_SQL.='select ';
            foreach($select as $value) {
                $this->_SQL.=$value;
                if($this->nSelect<count($select)) $this->_SQL.=',';
                $this->nSelect++;
            }
        }

        $this->_SQL.=' from '.$this->objBase;

        // ������� �� ���������� WHERE
        if(!empty($where) and is_array($where)) {
            $this->_SQL.=' where ';
            foreach($where as $pole=>$value) {
                $this->_SQL.=$pole.$value;
                if($this->nWhere<count($where)) $this->_SQL.=$this->Option['where'];
                $this->nWhere++;
            }
        }

        // ����������
        if(!empty($order) and is_array($order))
            foreach($order as $pole=>$value) {
                $this->_SQL.=' '.$pole.' by '.$value;
                if(!empty($option['order'])) $this->_SQL.=' '.$option['order'].' ';
            }

        // ����� LIMIT
        if(!empty($option['limit'])) $this->_SQL.=' limit '.$option['limit'];

        // ��������� ������
        if(!empty($this->sql)) $this->_SQL=$this->sql;

        // �����������
        if($this->debug) $this->setError("SQL ������: ",$this->_SQL);

        // ���������� ������ � ���� �������
        if($this->install)
        $result=mysql_query($this->_SQL) or die ($this->setError("SQL ������ ��� [".$this->_SQL."] ",mysql_error().""));
          else $result=mysql_query($this->_SQL) or die (PHPShopBase::errorConnect(102));

        $num=mysql_numrows($result);
        while($row = mysql_fetch_assoc($result))
            if($num>1 or $option['limit']>1 or strlen($option['limit'])>1) $this->_DATA[] = $row;
            else $this->_DATA = $row;

        // ������� ��������
        $GLOBALS['SysValue']['sql']['num']++;

        return $this->_DATA;
    }




        function setError($name,$action) {
            global $_classPath;
            
        $error='<p style="BORDER: #000000 1px dashed;padding-top:10px;padding-bottom:10px;background-color:#FFFFFF;color:000000;font-size:12px">
<img hspace="10" style="padding-left:10px" align="left" src="'.$_classPath.'admpanel/img/i_display_settings_med[1].gif"
width="32" height="32" alt="PHPShopOrm Debug On"/ ><strong>'.$name.'</strong>
	 <br><em>'.$action.'</em>';
        if($this->comment) $error.='<em style="color:green"><br>�����������: '.$this->comment.'</em>';
             else $error.='</p>';
        echo $error;
    }


    function var_export() {
        foreach($this->_DATA as $var)
            foreach($var as $name=>$value) $GLOBALS[$$name]=$value;
    }

    function update($value,$where=false,$prefix='_new') {
        $this->_SQL='update '.$this->objBase.' set ';
        $_KEY=$this->findKey();

        foreach($_KEY as $key=>$v)
            if(isset($value[$key.$prefix])) {
                $this->_SQL.=$key."='".$value[$key.$prefix]."',";
            }
        $this->_SQL=substr($this->_SQL,0,strlen($this->_SQL)-1);

        // ������� �� ���������� WHERE
        if(!empty($where) and is_array($where)) {
            $this->_SQL.=' where ';
            foreach($where as $pole=>$value) {
                $this->_SQL.=$pole.$value;
                if($this->nWhere<count($where)) $this->_SQL.=$this->Option['where'];
                $this->nWhere++;
            }
        }

        // ��������� ������
        if(!empty($this->sql)) $this->_SQL=$this->sql;

        // �����������
        if($this->debug) $this->setError("SQL ������: ",$this->_SQL);

        // ����������
        if(mysql_query($this->_SQL)) return true;
        else return mysql_error();
    }

    // ������ ����
    function findKey() {
        $result=mysql_query('select * from '.$this->objBase.' limit 1');
        $num=mysql_numrows($result);
        if($num>0) $row = mysql_fetch_assoc($result);
        else {
            $fields = mysql_list_fields($GLOBALS['SysValue']['connect']['dbase'],$this->objBase);
            $columns = mysql_num_fields($fields);
            for ($i = 0; $i < $columns; $i++){
                $row_name = mysql_field_name($fields, $i);
                $row[$row_name]="";
            }
        }
        return $row;
    }

    function delete($where) {
        $this->_SQL='delete from '.$this->objBase;

        // ������� �� ���������� WHERE
        if(!empty($where) and is_array($where)) {
            $this->_SQL.=' where ';
            foreach($where as $pole=>$value) {
                $this->_SQL.=$pole.$value;
                if($this->nWhere<count($where)) $this->_SQL.=$this->Option['where'];
                $this->nWhere++;
            }
        }

        // ��������� ������
        if(!empty($this->sql)) $this->_SQL=$this->sql;

        // �����������
        if($this->debug) $this->setError("SQL ������: ",$this->_SQL);

        // ����������
        if(mysql_query($this->_SQL)) return true;
        else return mysql_error();
    }


    // ������������� ������
    function query($sql) {
        $this->_SQL=$sql;

        // �����������
        if($this->debug) $this->setError("SQL ������: ",$this->_SQL);

        $result=mysql_query($this->_SQL) or die ($this->setError("SQL ������ ��� [".$this->_SQL."] ",mysql_error().""));

        // ������� ��������
        $GLOBALS['SysValue']['sql']['num']++;

        return $result;
    }


    function trace($var){
        echo '<pre style="BORDER: #000000 1px dashed;padding-top:10px;padding-bottom:10px;background-color:#FFFFFF;color:000000;font-size:12px">';
        print_r($var);
        echo "</pre>";
    }

    function insert($value,$prefix='_new') {
        $this->_SQL='insert into '.$this->objBase.' set ';
        $_KEY=$this->findKey();
        foreach($_KEY as $key=>$v)
            if(!empty($value[$key.$prefix])) {
                $this->_SQL.=$key."='".$value[$key.$prefix]."',";
            }
        $this->_SQL=substr($this->_SQL,0,strlen($this->_SQL)-1);

        // ��������� ������
        if(!empty($this->sql)) $this->_SQL=$this->sql;

        // �����������
        if($this->debug) $this->setError("SQL ������: ",$this->_SQL);

        // ����������
        if(mysql_query($this->_SQL)) return true;
        else return mysql_error();
    }
}

/* ������

$PHPShopOrm->select(array('id','name'),array('id'=>'=10'),array('order'=>'id DESC'),array('limit'=>1));
���
$PHPShopOrm->sql='select id,name from phpshop_categories where id=1 order by id DESC limit 1';

$PHPShopOrm->update($_REQUEST,array('id'=>'=10'));

$PHPShopOrm->insert(array('name_new'=>'Hi Test2'));

$PHPShopOrm->delete(array('id'=>'=10'));
*/
?>
