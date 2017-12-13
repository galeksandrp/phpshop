<?php

/**
 * ���������� �������� � �� �� ������ �������� ���� �������
 * @author PHPShop Software
 * @version 1.7
 * @package PHPShopClass
 */
class PHPShopOrm {

    /**
     * ��� ����
     * @var string 
     */
    var $Base;

    /**
     * ����� �������
     * @var bool
     */
    var $debug = false;

    /**
     * ����������� ��� ���������
     * @var bool 
     */
    var $comment = false;

    /**
     * �������� ���������
     * @var bool 
     */
    var $install = true;

    /**
     * ����������� ������
     * @var bool 
     */
    var $cache = false;

    /**
     * ������ �������������� ������ � ���� ��� ��������
     * @var array 
     */
    var $cache_format = array();
    var $cache_sort = 'id';

    /**
     * ����� ��������� � ����
     * @var integer 
     */
    var $cache_limit = 100;
    var $_SQL;
    var $_DATA;

    /**
     * �����������
     * @param string $Base ��� �������
     */
    function PHPShopOrm($Base = false) {
        $this->objBase = $Base;
        $this->Option['where'] = " and ";
        $this->nWhere = 1;
        $this->nSelect = 1;
        $this->sql = false;
        $this->Items = &$GLOBALS['Cache'];
    }

    /**
     * ������ ������� �� ����
     */
    function cache_get($params, $orm_array = false) {
        $param = explode(".", str_replace('"', '', $params));
        if ($this->cache_check($param)) {
            if (is_array($orm_array)) {
                $this->comment = '����������� - ' . $param[0] . '.' . @$param[1] . '.' . $this->cache_sort . '.' . $orm_array['class_name'] . '.' . $orm_array['function_name'];
                $result = $this->select_native($orm_array['select'], $orm_array['where'], $orm_array['order'], $orm_array['option']);

                if (is_array($result)) {
                    if ($orm_array['option']['limit'] > 1) {
                        foreach ($result as $row)
                            $this->cache_set($this->objBase . '.' . @$row['id'], $row);
                    }
                    else
                        $this->cache_set($this->objBase . '.' . @$result['id'], $result);
                }
            }
        }
        else {

            if ($orm_array['select'][0] == '*')
                $result = $this->Items[$param[0]][$param[1]];
            else {
                $select = explode(",", $orm_array['select'][0]);
                foreach ($select as $val)
                    $result[$val] = trim($this->Items[$param[0]][$param[1]][$val]);
            }
        }
        return $result;
    }

    /**
     * �������� �� ������� ������
     */
    function cache_check($param) {
        if (!is_array(@$this->Items[$param[0]][$param[1]])) {
            return true;
        }
        return false;
    }

    /**
     * ���������� �������� � ������
     */
    function cache_set($param, $value) {
        $param = explode(".", $param);

        // �������� �� ����� ����
        if (count(@$this->Items[$param[0]]) < $this->cache_limit) {
            $this->Items[$param[0]][$param[1]] = $value;

            // �������������� �������
            if (is_array($this->cache_format))
                foreach ($this->cache_format as $val)
                    $this->Items[$param[0]][$param[1]][$val] = null;
        }
    }

    /**
     * ������� �� �� SELECT �� �������� ���������� � ��������� ����
     * @param array $select ������ ����� ��� �������
     * @param array $where ������ ��������� whree
     * @param array $order ������ ��������� order by
     * @param array $option ������ ��������� �������������� ����� [limit]
     * @param string $class_name ��� ����� ��� �������
     * @param string $function_name ��� ������ ��� �������
     * @return array
     */
    function select_cache($select, $where = false, $order = false, $option = false, $class_name = false, $function_name = false) {
        $memory_name = null;
        if (!empty($where['id'])) {
            $memory_name = $this->objBase . '.' . str_replace('=', '', $where[$this->cache_sort]);
        }

        $result = $this->cache_get($memory_name, array('select' => $select, 'where' => $where,
            'order' => $order, 'option' => $option, 'class_name' => $class_name, 'function_name' => $function_name));
        return $result;
    }

    function select($select = array('*'), $where = false, $order = false, $option = false, $class_name = false, $function_name = false) {

        if ($this->cache) {
            $result = $this->select_cache($select, $where, $order, $option, $class_name, $function_name);
            $this->clean();
        } else {
            $result = $this->select_native($select, $where, $order, $option, $class_name, $function_name);
            $this->clean();
        }

        return $result;
    }

    /**
     * ������� �� �� SELECT �� �������� ����������
     * <code>
     * // example:
     * $PHPShopOrm= new PHPShopOrm('phpshop_categories');
     * $PHPShopOrm->select(array('id','name'),array('id'=>'=10'),array('order'=>'id DESC'),array('limit'=>1));
     * </code>
     * @param array $select ������ ����� ��� �������
     * @param array $where ������ ��������� whree
     * @param array $order ������ ��������� order by
     * @param array $option ������ ��������� �������������� ����� [limit]
     * @return array
     */
    function select_native($select = array('*'), $where = false, $order = false, $option = false, $class_name = false, $function_name = false) {

        // ������� �� ���������� SELECT
        if (is_array($select)) {
            $this->_SQL.='select ';
            foreach ($select as $value) {
                $this->_SQL.=$value;
                if ($this->nSelect < count($select))
                    $this->_SQL.=',';
                $this->nSelect++;
            }
        }

        $this->_SQL.=' from ' . $this->objBase;

        // ������� �� ���������� WHERE
        if (!empty($where) and is_array($where)) {
            $this->_SQL.=' where ';
            foreach ($where as $pole => $value) {
                $this->_SQL.=$pole . $value;
                if ($this->nWhere < count($where))
                    $this->_SQL.=$this->Option['where'];
                $this->nWhere++;
            }
        }

        // ����������
        if (!empty($order) and is_array($order))
            foreach ($order as $pole => $value) {
                $this->_SQL.=' ' . $pole . ' by ' . $value;
                if (!empty($option['order']))
                    $this->_SQL.=' ' . $option['order'] . ' ';
            }

        // ����� LIMIT
        if (!empty($option['limit']))
            $this->_SQL.=' limit ' . $option['limit'];

        // ��������� ������
        if (!empty($this->sql)) {
            $option['limit'] = 1000;
            $this->_SQL = $this->sql;
        }


        // �����������
        if ($this->debug) {
            if (empty($this->cache) and !empty($class_name))
                $this->comment = $class_name . '.' . $function_name;
            $this->setError("SQL ������: ", $this->_SQL);
        }

        // ���������� ������ � ���� �������
        if ($this->install)
            $result = mysql_query($this->_SQL) or die($this->setError("SQL ������ ��� [" . $this->_SQL . "] ", mysql_error() . ""));
        else
            $result = mysql_query($this->_SQL) or die(PHPShopBase::errorConnect(102));

        $num = mysql_numrows($result);
        $this->numrows = $num;
        while ($row = mysql_fetch_assoc($result))
            if ($num > 1 or $option['limit'] > 1 or strlen($option['limit']) > 1)
                $this->_DATA[] = $row;
            else
                $this->_DATA = $row;


        // ������� ��������
        @$GLOBALS['SysValue']['sql']['num']++;

        // �������� �� ������� ������, ��������� ������ �� ����� ��� �������� ������
        if ($num > 1000)
            return $this->_DATA;
        elseif (!empty($this->_DATA))
            return stripslashes_deep($this->_DATA);
    }

    /**
     * ����� ��������� �� ������
     * @param string $name ��� �������
     * @param string $action ������
     */
    function setError($name, $action) {
        global $_classPath;

        $error = '<p style="BORDER: #000000 1px dashed;padding-top:10px;padding-bottom:10px;background-color:#FFFFFF;color:000000;font-size:12px">
<img hspace="10" style="padding-left:10px" align="left" src=".' . $_classPath . 'admpanel/img/i_display_settings_med[1].gif"
width="32" height="32" alt="PHPShopOrm Debug On"/ ><strong>' . $name . '</strong>
	 <br><em>' . $action . '</em>';
        if ($this->comment)
            $error.='<em style="color:green"><br>�����������: ' . $this->comment . '</em></p>';
        else
            $error.='</p>';
        echo $error;
    }

    /**
     * ���������� ������� � ���������� ����������
     */
    function var_export() {
        foreach ($this->_DATA as $var)
            foreach ($var as $name => $value)
                $GLOBALS[$$name] = $value;
    }

    /**
     * ���������� �� update
     * <code>
     * // example:
     * $PHPShopOrm= new PHPShopOrm('phpshop_categories');
     * $PHPShopOrm->update($_POST,array('id'=>'=10'));
     * </code>
     * @param array $value ������ ��������
     * @param array $where ������ ��������� whree
     * @param string $prefix ������� ����� � ����� [_new]
     * @return mixed
     */
    function update($value, $where = false, $prefix = '_new') {
        $this->_SQL = 'update ' . $this->objBase . ' set ';
        $_KEY = $this->findKey();

        foreach ($_KEY as $key => $v)
            if (isset($value[$key . $prefix])) {
                $this->_SQL.="`" . $key . "`='" . addslashes($value[$key . $prefix]) . "',";
            }
        $this->_SQL = substr($this->_SQL, 0, strlen($this->_SQL) - 1);

        // ������� �� ���������� WHERE
        if (!empty($where) and is_array($where)) {
            $this->_SQL.=' where ';
            foreach ($where as $pole => $value) {
                $this->_SQL.=$pole . $value;
                if ($this->nWhere < count($where))
                    $this->_SQL.=$this->Option['where'];
                $this->nWhere++;
            }
        }

        // ��������� ������
        if (!empty($this->sql))
            $this->_SQL = $this->sql;

        // �����������
        if ($this->debug)
            $this->setError("SQL ������: ", $this->_SQL);

        // ����������
        if (mysql_query($this->_SQL)){
            $this->clean();
            return true;
        }
        else
            return mysql_error();
    }

    /**
     * ���������� �� �� ������� ����� � �������� ������
     * @return array
     */
    function findKey() {
        $result = mysql_query('select * from ' . $this->objBase . ' limit 1');
        $num = mysql_numrows($result);
        if ($num > 0)
            $row = mysql_fetch_assoc($result);
        else {
            $fields = mysql_list_fields($GLOBALS['SysValue']['connect']['dbase'], $this->objBase);
            $columns = mysql_num_fields($fields);
            for ($i = 0; $i < $columns; $i++) {
                $row_name = mysql_field_name($fields, $i);
                $row[$row_name] = "";
            }
        }
        return $row;
    }

    /**
     * �������� �� �� delete
     * <code>
     * // example:
     * $PHPShopOrm = new PHPShopOrm('phpshop_categories');
     * $PHPShopOrm->delete(array('id'=>'=10'));
     * </code>
     * @param array $where ������ ��������� whree
     * @return mixed
     */
    function delete($where) {
        $this->_SQL = 'delete from ' . $this->objBase;

        // ������� �� ���������� WHERE
        if (!empty($where) and is_array($where)) {
            $this->_SQL.=' where ';
            foreach ($where as $pole => $value) {
                $this->_SQL.=$pole . $value;
                if ($this->nWhere < count($where))
                    $this->_SQL.=$this->Option['where'];
                $this->nWhere++;
            }
        }

        // ��������� ������
        if (!empty($this->sql))
            $this->_SQL = $this->sql;

        // �����������
        if ($this->debug)
            $this->setError("SQL ������: ", $this->_SQL);

        // ����������
        if (mysql_query($this->_SQL))
            return true;
        else
            return mysql_error();
    }

    /**
     * ������������� ������ � ��
     * // example:
     * $PHPShopOrm = new PHPShopOrm();
     * $PHPShopOrm->query('select id,name from phpshop_categories where id=1 order by id DESC limit 1');
     * </code>
     * @param string $sql ����� � �� � ������� SQL
     * @return mixed
     */
    function query($sql) {
        $this->_SQL = $sql;

        // �����������
        if ($this->debug)
            $this->setError("SQL ������: ", $this->_SQL);

        $result = mysql_query($this->_SQL) or die($this->setError("SQL ������ ��� [" . $this->_SQL . "] ", mysql_error() . ""));

        // ������� ��������
        $GLOBALS['SysValue']['sql']['num']++;

        return $result;
    }

    /**
     * ����� ���������� ����������
     * @param mixed $var ������ ��� ������
     */
    function trace($var) {
        echo '<pre style="BORDER: #000000 1px dashed;padding-top:10px;padding-bottom:10px;background-color:#FFFFFF;color:000000;font-size:12px">';
        print_r($var);
        echo "</pre>";
    }

    /**
     * ������� ������ � �� insert
     * <code>
     * // example:
     * $PHPShopOrm = new PHPShopOrm('phpshop_categories');
     * $PHPShopOrm->insert(array('name_new'=>'Hi Test2'));
     * </code>
     * @param array $value ������ ��������
     * @param <type> $prefix ������� ����� � ����� [_new]
     * @return mixed
     */
    function insert($value, $prefix = '_new') {
        $this->_SQL = 'insert into ' . $this->objBase . ' set ';
        $_KEY = $this->findKey();
        foreach ($_KEY as $key => $v)
            if (isset($value[$key . $prefix])) {
                $this->_SQL.="`" . $key . "`='" . addslashes($value[$key . $prefix]) . "',";
            }
        $this->_SQL = substr($this->_SQL, 0, strlen($this->_SQL) - 1);

        // ��������� ������
        if (!empty($this->sql))
            $this->_SQL = $this->sql;

        // �����������
        if ($this->debug)
            $this->setError("SQL ������: ", $this->_SQL);

        // ����������
        if (mysql_query($this->_SQL))
            return true;
        else
            return mysql_error();
    }

    /**
     * ������� ������
     */
    function clean() {
        $this->nWhere = 1;
        $this->nSelect = 1;
        $this->_SQL = '';
        unset($this->_DATA);
    }

    /**
     * ������������� ������ ��������
     */
    function updateZeroVars() {
        $Arg = func_get_args();
        foreach ($Arg as $value) {
            if (empty($_POST[$value]))
                $_POST[$value] = 0;
        }
    }

}

/**
 * ������� ����� � �������
 * @param array $value ������ ������
 * @return array
 */
function stripslashes_deep($value) {
    $value = is_array($value) ?
            array_map('stripslashes_deep', $value) :
            stripslashes($value);
    return $value;
}

/*
  ������ ���������� ORM:

  1. �������
  $PHPShopOrm->select(array('id','name'),array('id'=>'=10'),array('order'=>'id DESC'),array('limit'=>1));
  ���
  $PHPShopOrm->sql='select id,name from phpshop_categories where id=1 order by id DESC limit 1';
  $PHPShopOrm->select();

  2. ����������
  $PHPShopOrm->update($_REQUEST,array('id'=>'=10'));

  3. �������
  $PHPShopOrm->insert(array('name_new'=>'Hi Test2'));

  4. ��������
  $PHPShopOrm->delete(array('id'=>'=10'));
 */
?>