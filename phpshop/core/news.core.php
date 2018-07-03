<?php

/**
 * ���������� ��������
 * @author PHPShop Software
 * @tutorial http://wiki.phpshop.ru/index.php/PHPShopNews
 * @version 1.5
 * @package PHPShopCore
 */
class PHPShopNews extends PHPShopCore {

    /**
     * �����������
     */
    function __construct() {

        // ��� ��
        $this->objBase = $GLOBALS['SysValue']['base']['news'];

        // ���� ��� ���������
        $this->objPath = "/news/news_";

        // �������
        $this->debug = false;
        $this->empty_index_action = true;

        // ������ �������
        $this->action = array('get' => 'timestamp', "nav" => array("index", "ID"));
        parent::__construct();
        // ��� ��
        $this->objBase = $GLOBALS['SysValue']['base']['news'];

        // ���������
        $this->calendar();
    }

    /**
     * ����� �� ���������
     */
    function index() {

        // �������� ������
        if ($this->setHook(__CLASS__, __FUNCTION__, false, 'START'))
            return true;

        // ������� ������
        $this->dataArray = parent::getListInfoItem(array('*'), false, array('order' => 'id DESC'));

        // 404
        if (!isset($this->dataArray))
            return $this->setError404();

        if (is_array($this->dataArray))
            foreach ($this->dataArray as $row) {

                // ���������� ����������
                $this->set('newsId', $row['id']);
                $this->set('newsData', $row['datas']);
                $this->set('newsZag', $row['zag']);
                $this->set('newsKratko', $row['kratko']);

                // �������� ������
                $this->setHook(__CLASS__, __FUNCTION__, $row, 'MIDDLE');

                // ���������� ������
                $this->addToTemplate($this->getValue('templates.main_news_forma'));
            }

        // ���������
        $this->setPaginator();

        // ����
        $this->title = __("�������")." - " . $this->PHPShopSystem->getValue("name");
        $this->description = __('�������') . '  ' . $this->PHPShopSystem->getValue("name");
        $this->keywords = __('�������') . ', ' . $this->PHPShopSystem->getValue("name");

        $page = $this->PHPShopNav->getId();
        if ($page > 1) {
            $this->description.= ' ����� ' . $page;
            $this->title.=' - �������� ' . $page;
        }

        // �������� ������
        $this->setHook(__CLASS__, __FUNCTION__, $this->dataArray, 'END');

        // ���������� ������
        return $this->parseTemplate($this->getValue('templates.news_page_list'));
    }

    /**
     * ����� ���������� �������� �� ���� �� ���������
     */
    function timestamp() {

        if (PHPShopSecurity::true_num($_GET['timestamp'])) {
            $year = date("Y", $_GET['timestamp']);
            $month = date("m", $_GET['timestamp']);
            $day = date("d", $_GET['timestamp']);
            $timestampstart = intval($_GET['timestamp']);
            $timestampend = mktime(23, 59, 59, $month, $day, $year);

            // ������� ������
            $this->PHPShopOrm->sql = 'select * from ' . $this->objBase . ' where datau>=' . $timestampstart . ' AND datau<=' . $timestampend . ' order by datau desc';
            $this->dataArray = $this->PHPShopOrm->select();

            // 404
            if (!isset($this->dataArray))
                return $this->setError404();

            if (is_array($this->dataArray))
                foreach ($this->dataArray as $row) {

                    // ���������� ����������
                    $this->set('newsId', $row['id']);
                    $this->set('newsData', $row['datas']);
                    $this->set('newsZag', $row['zag']);
                    $this->set('newsKratko', $row['kratko']);

                    // �������� ������
                    $this->setHook(__CLASS__, __FUNCTION__, $row, 'MIDDLE');


                    // ���������� ������
                    $this->addToTemplate($this->getValue('templates.main_news_forma'));
                }

            // ����
            $this->title = "������� - " . $this->PHPShopSystem->getValue("name");

            // �������� ������
            $this->setHook(__CLASS__, __FUNCTION__, $this->dataArray, 'END');

            // ���������� ������
            $this->parseTemplate($this->getValue('templates.news_page_list'));
        } else {
            $this->setError404();
        }
    }

    /**
     * ����� ������� ��������� ���������� ��� ������� ���������� ��������� ID
     * @return string
     */
    function ID() {

        // �������� ������
        if ($this->setHook(__CLASS__, __FUNCTION__, false, 'START'))
            return true;

        // ������������
        if (!PHPShopSecurity::true_num($this->PHPShopNav->getId()))
            return $this->setError404();

        // ������� ������
        $row = parent::getFullInfoItem(array('*'), array('id' => '=' . $this->PHPShopNav->getId()));

        // 404
        if (!isset($row))
            return $this->setError404();

        // ���������� ���������
        $this->set('newsData', $row['datas']);
        $this->set('newsZag', $row['zag']);
        $this->set('newsKratko', $row['kratko']);
        $this->set('newsPodrob', $row['podrob']);

        // �������� ������
        $this->setHook(__CLASS__, __FUNCTION__, $row, 'MIDDLE');

        // ���������� ������
        $this->addToTemplate($this->getValue('templates.main_news_forma_full'));

        // ����
        $this->title = strip_tags($row['zag']) . " - " . $this->PHPShopSystem->getValue("name");
        $this->description = strip_tags($row['kratko']);
        $this->lastmodified = PHPShopDate::GetUnixTime($row['datas']);

        // ��������� keywords
        include('./phpshop/lib/autokeyword/class.autokeyword.php');
        $this->keywords = callAutokeyword($row['kratko']);

        // �������� ������
        $this->setHook(__CLASS__, __FUNCTION__, $row, 'END');

        // ���������� ������
        $this->parseTemplate($this->getValue('templates.news_page_full'));
    }

    /**
     * ��������� ��������
     * ������� �������� � ��������� ���� news.core/calendar.php
     * @return mixed
     */
    function calendar() {

        // �������� ������
        $hook = $this->setHook(__CLASS__, __FUNCTION__);
        if ($hook)
            return $hook;

        return $this->doLoadFunction(__CLASS__, __FUNCTION__);
    }

}

?>