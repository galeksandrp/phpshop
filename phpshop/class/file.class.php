<?php

/**
 * ���������� ��� ������ � �������
 * @author PHPShop Software
 * @version 1.1
 * @package PHPShopClass
 */
class PHPShopFile {

    /**
     * ����� �� ������ �����
     * @param string $file ��� �����
     */
    function chmod($file, $error=false) {
        if (function_exists('chmod')) {
            if(@chmod($file, 0775))
                    return true;
            elseif($error) echo '��� ����� '.$file;
        }
        elseif($error) echo __FUNCTION__.'() ���������';
    }
    

    /**
     * ������ ������ � ����
     * @param string $file ���� �� �����
     * @param string $csv ������ ��� ������
     * @param string $type �������� ������
     * @param bool $error ����� ������
     */
    function write($file, $csv, $type = 'w+', $error=false) {
        $fp = @fopen($file, $type);
        if ($fp) {
            //stream_set_write_buffer($fp, 0);
            fputs($fp, $csv);
            fclose($fp);
        }
        elseif($error) echo '��� ����� '.$file;
    }

    /**
     * ������ ������ � csv ����
     * ������������ ����������� ������� php fputcsv
     * @param string $file ���� �� �����
     * @param array $csv ������ ��� ������
     * @param bool $error ����� ������
     */
    function writeCsv($file, $csv, $error=false) {
        $fp = @fopen($file, "w+");
        if ($fp) {
            foreach ($csv as $value) {
                fputcsv($fp, $value, ';', '"');
            }
            //stream_set_write_buffer($fp, 0);
            fclose($fp);
        }
        elseif($error) echo '��� ����� '.$file;
    }

    /**
     * ������ CSV �����
     * @param string $file ����� �����
     * @param string $function ��� ������� ����������� 
     */
    function readCsv($file, $function) {
        $fp = fopen($file, "r");
        while (($data = fgetcsv($fp, 1000, ";")) !== FALSE) {
            call_user_func($function, $data);
        }
        fclose($fp);
    }

    /**
     * GZIP ��������� �����
     * @param string $source ���� �� �����
     * @param int $level ������� ������
     * @return bool
     */
    function gzcompressfile($source, $level = false) {
        $dest = $source . '.gz';
        $mode = 'wb' . $level;
        $error = false;
        if ($fp_out = gzopen($dest, $mode)) {
            if ($fp_in = fopen($source, 'rb')) {
                while (!feof($fp_in))
                    gzwrite($fp_out, fread($fp_in, 1024 * 512));
                fclose($fp_in);
            }
            else
                $error = true;
            gzclose($fp_out);
            unlink($source);
            rename($dest, $source . '.bz2');
        }
        else
            $error = true;
        if ($error)
            return false;
        else
            return $dest;
    }

}

?>