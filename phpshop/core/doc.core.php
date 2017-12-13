<?php
/**
 * ���������� ������������ html ������
 * @author PHPShop Software
 * @version 1.1
 * @package PHPShopCore
 */
class PHPShopDoc extends PHPShopCore {

    /**
     * �����������
     */
    function PHPShopDoc() {
        parent::PHPShopCore();
    }

    /**
     * ������� ����������� �����
     * @global array $SysValue ���������
     * @param string $pages ��� ����� ��� ����������
     * @return string
     */
    function OpenHTML($pages) {

        $dir="pageHTML/";
        $pages=$pages.".html";
        $handle=opendir($dir);
        while ($file = readdir($handle)) {
            if($file==$pages) {
                $urlfile=fopen ("$dir$file","r");
                $text=fread($urlfile,1000000);
                return $text;
            }
        }
        return false;
    }
    /**
     * ����� �� ���������
     */
    function index() {

        // ������ ����
        if($dis = $this->OpenHTML($this->SysValue['nav']['name'])) {

            $this->meta=$this->getMeta($dis);

            // ����
            $this->title=$this->meta['title'].' - '.$this->PHPShopSystem->getValue("name");
            $this->description=$this->meta['description'];
            $this->keywords=$this->meta['keywords'];

            // ���������� ���������
            $this->set('pageContent',$dis);
            $this->set('pageTitle',$this->meta['title']);


            // ���������� ������
            $this->parseTemplate($this->getValue('templates.page_page_list'));
        }
        else  $this->setError404();

    }

    function getMeta($content) {

        // Title
        $patern="/<H1>(.*)<\/H1>/i";
        preg_match($patern,$content,$matches);
        $title = $matches[1];

        // Description
        $patern="/<desc>(.*)<\/desc>/i";
        preg_match($patern,$content,$matches);
        $description = $matches[1];

        // Keywords
        $patern="/<key>(.*)<\/key>/i";
        preg_match($patern,$content,$matches);
        $keywords = $matches[1];

        return array('title'=>$title,'description'=>$description,'keywords'=>$keywords);
    }
}

?>