<?php

/**
 * ���������� ����������� �����
 * @version 1.2
 * @package PHPShopClass
 * @tutorial http://doc.phpshop.ru/PHPShopClass/PHPShopMail.html
 * <code>
 * // example:
 * $PHPShopMail= new PHPShopMail('user@localhost','admin@localhost','Test','Hi, user!');
 * </code>
 * @param string $to ����
 * @param string $from �� ����
 * @param string $zag ��������� ������
 * @param string $content ���������� ������
 * @param boolean $type ��� ������, ����� ��� html, true ='text/html', false = text/plain
 * @param boolean $noSend true - �� �������� ������ ��� �������� ���������� ������. 
 */
class PHPShopMail {

    /**
     * @var string ��������� ������
     */
    var $codepage = "windows-1251";

    /**
     * @var string MIME ���
     */
    var $mime = "1.0";

    /**
     * @var string ��� ����������
     */
    var $type = "text/plain";

    /**
     * �����������
     * @param string $to ����
     * @param string $from �� ����
     * @param string $zag ��������� ������
     * @param string $content ��������� ������
     * @param boolean $type ��� ������, ����� ��� html, true ='text/html', false = text/plain
     * @param boolean $noSend true - �� �������� ������ ��� �������� ���������� ������. � ��������� ����� ������ �������� � ��������� ������� ��������� ������� sendMailNow
     */
    function PHPShopMail($to, $from, $zag, $content, $type = false, $noSend = false) {

        if (!empty($type))
            $this->type = 'text/html';

        if (class_exists('PHPShopSystem') and $noSend)
            $this->PHPShopSystem = new PHPShopSystem();

        $this->from = $from;
        $this->zag = "=?" . $this->codepage . "?B?" . base64_encode($zag) . "?=";
        $this->to = $to;
        $header = $this->getHeader();
        if (!$noSend)
            $this->sendMail($content, $header);
        else {
            $this->header = $header;
            $this->setOrgData();
        }
    }

    /**
     * ��������� ������
     * @return string
     */
    function getHeader() {
        $header = "MIME-Version: " . $this->mime . "\n";
        if($this->PHPShopSystem)
        $header.= "From:  " . $this->PHPShopSystem->getParam('name') . " <" . $this->from . ">\n";
        else  $header.= "From: <" . $this->from . ">\n";
        $header.= "Reply-To: $this->from\n";
        $header.= "Content-Type: " . $this->type . "; charset=" . $this->codepage . "\n";
        $header.= "Content-Transfer-Encoding: 8bit\n";
        return $header;
    }

    /**
     * ������������� ����� ������ ��������
     */
    function setOrgData() {

        $GLOBALS['SysValue']['other']['adminMail'] = $this->PHPShopSystem->getParam('adminmail2');
        $GLOBALS['SysValue']['other']['telNum'] = $this->PHPShopSystem->getParam('tel');
        $GLOBALS['SysValue']['other']['org_name'] = $this->PHPShopSystem->getSerilizeParam('bank.org_name');
        $GLOBALS['SysValue']['other']['org_adres'] = $this->PHPShopSystem->getSerilizeParam('bank.org_adres');
        $GLOBALS['SysValue']['other']['logo'] = $this->PHPShopSystem->getParam('logo');

        $GLOBALS['SysValue']['other']['shopName'] = $this->PHPShopSystem->getName();
        $GLOBALS['SysValue']['other']['serverPath'] = $_SERVER['SERVER_NAME'] . "/" . $GLOBALS['SysValue']['dir']['dir'];
        $GLOBALS['SysValue']['other']['date'] = date("d-m-y H:i a");

    }

    /**
     * ����������� ������ ����� php mail
     * @param string $content ����������
     */
    function sendMailNow($content) {
        mail($this->to, $this->zag, $content, $this->header);
    }

    /**
     * ����������� ������ ����� php mail
     * @param string $content ����������
     * @param strong $header ���������
     */
    function sendMail($content, $header) {
        mail($this->to, $this->zag, $content, $header);
    }

    /**
     * ������� ���������
     * @return string
     */
    function getCopyright() {
        $s = "
	 
	 
Powered & Developed by www.PHPShop.ru
" . $GLOBALS['SysValue']['license']['product_name'];
        return $s;
    }

}

class PHPShopMailFile {

    var $codepage = "windows-1251";

    function PHPShopMailFile($to, $from, $zag, $content, $filename, $file) {
        $this->from = $from;
        $this->un = strtoupper(uniqid(time()));
        $this->to = $to;
        $this->filename = $filename;
        $this->file = $file;
        $this->zag = $this->getZag($content);
        $header = $this->getHeader();
        //mail($this->to,$this->from,$this->zag,$header);
        $this->subj = $zag;
        mail($this->to, $this->subj, $this->zag, $header);
    }

    function getZag($text) {
        $f = fopen($this->file, "rb");
        $zag = "------------" . $this->un . "\nContent-Type:text/html; charset=" . $this->codepage . "\n";
        $zag.= "Content-Transfer-Encoding: 8bit\n\n$text\n\n";
        $zag.= "------------" . $this->un . "\n";
        $zag.= "Content-Type: application/octet-stream;";
        $zag.= "name=\"" . $this->filename . "\"\n";
        $zag.= "Content-Transfer-Encoding:base64\n";
        $zag.= "Content-Disposition:attachment;";
        $zag.= "filename=\"" . $this->filename . "\"\n\n";
        $zag.= chunk_split(base64_encode(fread($f, filesize($this->file)))) . "\n";
        return $zag;
    }

    function getHeader() {
        $head = "From: $this->from\n";
        $head.= "To: $this->to\n";
        $head.= "X-Mailer: PHPMail Tool\n";
        $head.= "Reply-To: $this->from\n";
        $head.= "Mime-Version: 1.0\n";
        $head.= "Content-Type:multipart/mixed;";
        $head.= "boundary=\"----------" . $this->un . "\"\n\n";
        return $head;
    }

}

?>