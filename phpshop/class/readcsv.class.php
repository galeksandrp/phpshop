<?php

/**
 * ���������� ������ CSV ������ � ������ html �����
 * @author PHPShop Software
 * @version 1.5
 * @package PHPShopClass
 */
class PHPShopReadCsvPro extends PHPShopReadCsv{
    var $CsvContent;
    var $ReadCsvRow;
    var $TableName;
    var $CsvToArray;

    function PHPShopReadCsvPro() {
        $this->ReadCsvRow();
        $this->CsvToArray();
    }

    function ReadCsvRow() {
        $csv_lines  = $this->CsvContent;
        array_shift($csv_lines);
        if(is_array($csv_lines)) {
            //������ csv
            $cnt = count($csv_lines);
            for($i = 0; $i < $cnt; $i++) {
                $line = $csv_lines[$i];
                $line = trim($line);
                //��������� �� ��, ��� ����� ���� �������� ������ ������ �������
                $first_char = true;
                //����� �������
                $col_num = 0;
                $length = strlen($line);
                for($b = 0; $b < $length; $b++) {
                    //���������� $skip_char ���������� ������������ �� ������ ������
                    if($skip_char != true) {
                        //���������� ������������/�� ������������ ������
                        $process = true;
                        //���������� ������ ��������� ������� �� ������� �������
                        if($first_char == true) {
                            if($line[$b] == '"') {
                                $terminator = '";';
                                $process = false;
                            }
                            else
                                $terminator = ';';
                            $first_char = false;
                        }

                        //������������� ������ �������, ��������� �� �������
                        if($line[$b] == '"') {
                            $next_char = $line[$b + 1];
                            //��������� �������
                            if($next_char == '"')
                                $skip_char = true;
                            //������ ����� �������
                            elseif($next_char == ';') {
                                if($terminator == '";') {
                                    $first_char = true;
                                    $process = false;
                                    $skip_char = true;
                                }
                            }
                        }

                        //���������� ������� ����� � �������
                        if($process == true) {
                            if($line[$b] == ';') {
                                if($terminator == ';') {

                                    $first_char = true;
                                    $process = false;
                                }
                            }
                        }

                        if($process == true)
                            $column .= $line[$b];

                        if($b == ($length - 1)) {
                            $first_char = true;
                        }

                        if($first_char == true) {

                            $values[$i][$col_num] = $column;
                            $column = '';
                            $col_num++;
                        }
                    }
                    else
                        $skip_char = false;
                }
            }
            $this->CsvToArray=$values;
        }

    }

    function CsvToArray() {
        return $this->CsvToArray;
    }


    function readFile($file) {
        if(is_file($file)) return file($file);
        else echo ("�� ���� ��������� ���� ".$file);
    }

}


/**
 * ���������� ������ CSV ������
 * @author PHPShop Software
 * @version 1.5
 * @package PHPShopClass
 */
class PHPShopReadCsv {
    var $CsvContent;
    var $ReadCsvRow;
    var $TableName;
    var $CsvToArray;

    function PHPShopReadCsv() {
        $this->ReadCsvRow();
        $this->CsvToArray();
    }

    function ReadCsvRow() {
        $this->ReadCsvRow = split("\n",$this->CsvContent);
        array_shift($this->ReadCsvRow);
        array_pop($this->ReadCsvRow);
    }

    function CleanStr($str) {
        $a= str_replace("\"", "", $str);
        $a= str_replace("\\", "", $a);
        return str_replace("'", "", $a);
    }

    function CsvToArray() {
        while (list($key, $val) = each($this->ReadCsvRow)) {
            $array1=split(";",$val);

            if(!(@$OutArray[$array1[0]])) $OutArray[$array1[0]]=$this->CleanStr($array1);
            else $OutArray[]=$this->CleanStr($array1);
        }

        $this->CsvToArray = $OutArray;
        return $OutArray;
    }


    function CheckUid($uid) {
        $num=0;
        $sql="select id from ".$this->TableName." where uid='$uid'";
        $result=mysql_query($sql);
        $num=mysql_num_rows($result);
        return $num;
    }

    function CheckId($id) {
        $num=0;
        $sql="select id from ".$this->TableName." where id='$id'";
        $result=mysql_query($sql);
        $num=mysql_num_rows($result);
        return $num;
    }

    function readFile($file) {
        @$fp = fopen($file, "r");
        if ($fp) {
            $fstat = fstat($fp);
            $fread=fread($fp,$fstat['size']);
            fclose($fp);
            return $fread;
        } else echo ("�� ���� ��������� ���� ".$file);
    }
}


?>