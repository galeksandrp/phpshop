<?php

/**
 * ���������� ������ CSV ������ �� ������ fgetcsv()
 * @author PHPShop Software
 * @version 1.7
 * @package PHPShopClass
 */
class PHPShopReadCsvNative {

    var $delim = ';';
    var $size = 10000;
    var $title_clean = true;
    var $TableName;
    

    function __construct($file) {
        global $link_db;
        $this->read($file);
        $this->link_db = $link_db;
    }

    function read($file) {
        if (file_exists($file)) {
            $fp = @fopen($file, "r");
            $i = 0;
            if ($this->title_clean)
                $i = 0;
            else
                $i = 1;
            while (($data = @fgetcsv($fp, $this->size, $this->delim)) !== FALSE) {
                if ($i > 0)
                    $this->CsvToArray[] = $data;
                $i++;
            }
            fclose($fp);
        }
        else
            echo ("�� ���� ��������� ���� " . $file);
    }

    function CheckUid($uid) {
        $sql = "select id from " . $this->TableName . " where uid='$uid'";
        $result = mysqli_query($this->link_db, $sql);
        return intval(mysqli_num_rows($result));
    }

    function CheckId($id) {
        $sql = "select id from " . $this->TableName . " where id=".intval($id);
        $result = mysqli_query($this->link_db, $sql);
        return intval(mysqli_num_rows($result));
    }

    function __call($name, $arguments) {
        echo "�� ������� ������� " . __CLASS__ . '.' . $name;
    }

    function CsvToArray() {
        return $this->CsvToArray;
    }

}

?>