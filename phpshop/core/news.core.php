<?php
/**
 * ���������� ��������
 * @author PHPShop Software
 * @version 1.0
 * @package PHPShopCore
 */
class PHPShopNews extends PHPShopCore {

    /**
     * �����������
     */
    function PHPShopNews() {
        // ��� ��
        $this->objBase=$GLOBALS['SysValue']['base']['table_name8'];

        // ���� ��� ���������
        $this->objPath="/news/news_";

        // �������
        $this->debug=false;

        // ������ �������
        $this->action=array("nav"=>"ID","post"=>"news_plus");
        parent::PHPShopCore();

        // ���������
        //$this->calendar();
    }

    /**
     * ����� �� ���������
     */
    function index() {

        // ������� ������
        $this->dataArray=parent::getListInfoItem(array('*'),false,array('order'=>'id DESC'));

        // 404
        if(!isset($this->dataArray)) return $this->setError404();

        if(is_array($this->dataArray))
            foreach($this->dataArray as $row) {

                // ���������� ����������
                $this->set('newsId',$row['id']);
                $this->set('newsData',$row['datas']);
                $this->set('newsZag',$row['zag']);
                $this->set('newsKratko',$row['kratko']);


                // ���������� ������
                $this->addToTemplate($this->getValue('templates.main_news_forma'));
            }

        // ���������
        $this->setPaginator();

        // ����
        $this->title="������� - ".$this->PHPShopSystem->getValue("name");

        // ���������� ������
        $this->parseTemplate($this->getValue('templates.news_page_list'));
    }

    /**
     * ����� ������� ��������� ���������� ��� ������� ���������� ��������� ID
     * @return string
     */
    function ID() {

        // ������������
        if(!PHPShopSecurity::true_num($this->PHPShopNav->getId())) return $this->setError404();

        // ������� ������
        $row=parent::getFullInfoItem(array('*'),array('id'=>'='.$this->PHPShopNav->getId()));

        // 404
        if(!isset($row)) return $this->setError404();

        // ���������� ���������
        $this->set('newsData',$row['datas']);
        $this->set('newsZag',$row['zag']);
        $this->set('newsKratko',$row['kratko']);
        $this->set('newsPodrob',$row['podrob']);

        // ���������� ������
        $this->addToTemplate($this->getValue('templates.main_news_forma_full'));

        // ����
        $this->title=$row['zag']." - ".$this->PHPShopSystem->getValue("name");
        $this->description=strip_tags($row['kratko']);
        $this->lastmodified=PHPShopDate::GetUnicTime($row['datas']);


        // ���������� ������
        $this->parseTemplate($this->getValue('templates.news_page_full'));
    }

    /**
     * ����� ������ ������� ��� ��������� $_POST[news_plus]
     */
    function news_plus() {
        $mail=PHPShopSecurity::TotalClean($_POST['mail'],3);

        switch($_POST['status']) {

            case("1"):
                $this->write($mail);
                break;

            case("0"):
                $this->del($mail);
                break;
        }

        // ����
        $this->title="������� - �������� - ".$this->PHPShopSystem->getValue("name");


        $this->parseTemplate($this->getValue('templates.news_forma_mesage'));
    }


    /**
     * ���� �� ����� � ����
     * @param string $mail �����
     * @return bool
     */
    function chek($mail) {
        $PHPShopOrm = &new PHPShopOrm($this->getValue('base.table_name9'));
        $PHPShopOrm->debug=$this->debug;
        $num=$PHPShopOrm->select(array('id'),array('mail'=>"='$mail'"),false,array('limit'=>1));
        if(empty($num['id'])) return true;
    }

    /**
     * ���������� ������  � ��
     * @param string $mail
     */
    function write($mail) {

        if(!empty($mail)) {

            if($this->chek($mail)) {
                $PHPShopOrm = &new PHPShopOrm($this->getValue('base.table_name9'));
                $PHPShopOrm->debug=$this->debug;
                $PHPShopOrm->insert(array('datas'=>date("d.m.y"),'mail'=>$mail),$prefix='');


                $mes="<FONT style=\"font-size:14px;color:red\">
                    <B>".$this->getValue('lang.good_news_mesage_1')."</B></FONT><BR>".$this->getValue('lang.good_news_mesage_2');
            }else {
                $mes="<FONT style=\"font-size:14px;color:red\">
                    <B>".$this->getValue('lang.bad_news_mesage_1')."</B></FONT><BR>".$this->getValue('lang.good_news_mesage_2');
            }

        }

        else {
            $mes="<FONT style=\"font-size:14px;color:red\">
                    <B>".$this->getValue('lang.bad_news_mesage_3')."</B></FONT><BR>".$this->getValue('lang.good_news_mesage_2');
        }

        $this->set('mesageText',$mes);
    }

    /**
     * �������� ������ �� ��
     * @param string $mail
     */
    function del($mail) {

        if(!$this->chek($mail)) {
            $PHPShopOrm = &new PHPShopOrm($this->getValue('base.table_name9'));
            $PHPShopOrm->debug=$this->debug;
            $PHPShopOrm->delete(array('mail'=>"='$mail'"));
            $mes="<FONT style=\"font-size:14px;color:red\">
                    <B>".$this->getValue('lang.bad_news_mesage_2')."</B></FONT><BR>".$this->getValue('lang.good_news_mesage_2');

        }else {
            $mes="<FONT style=\"font-size:14px;color:red\">
                    <B>".$this->getValue('lang.bad_news_mesage_3')."</B></FONT><BR>".$this->getValue('lang.good_news_mesage_2');
        }

        $this->set('mesageText',$mes);
    }


    /**
     * ��������� ��������
     */
    function calendar() {
        if($this->PHPShopSystem->getSerilizeParam('admoption.user_calendar') == 1) {
            include_once './phpshop/inc/calendar.inc.php';
            $this->set('calendar',calendar());
        }
    }
}
?>