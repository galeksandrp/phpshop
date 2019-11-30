<?php

/**
 * ���������� SEO ������ � �������� �� �������
 */
function index_newselement_seourl_hook($obj, $dt, $rout) {


    if ($rout == 'START') {
        $dis = null;

        // ���������� ������ �� ������� ��������
        if ($obj->disp_only_index) {
            if ($obj->PHPShopNav->index())
                $view = true;
            else
                $view = false;
        }
        else
            $view = true;

        if (!empty($view)) {

            // ��������� ������
            include_once(dirname(__FILE__) . '/mod_option.hook.php');
            $PHPShopSeourlOption = new PHPShopSeourlOption();
            $seourl_option = $PHPShopSeourlOption->getArray();

            if ($seourl_option["seo_news_enabled"] != 2)
                return false;

        $where['datau'] = '<' . time();

        // ����������
        if (defined("HostID"))
            $where['servers'] = " REGEXP 'i" . HostID . "i'";
        elseif (defined("HostMain"))
            $where['datau'].= ' and (servers ="" or servers REGEXP "i1000i")';


            $result = $obj->PHPShopOrm->select(array('*'), $where, array('order' => 'id DESC'), array("limit" => $obj->limit));

            // �������� �� �������� ������
            if ($obj->limit > 1)
                $data = $result;
            else
                $data[] = $result;

            if (is_array($data))
                foreach ($data as $row) {

                    // ���������� ����������
                    $obj->set('newsId', $row['id']);
                    $obj->set('newsZag', $row['zag']);
                    $obj->set('newsData', $row['datas']);
                    $obj->set('newsKratko', $row['kratko']);
                    $obj->set('newsIcon', $row['icon']);

                    // ���������� ������
                    $dis.=$obj->parseTemplate($obj->getValue('templates.news_main_mini'));
                    if (!empty($row["news_seo_name"]))
                        $dis = str_replace("news/ID_" . $row['id'] . ".html", "news/" . $row['news_seo_name'] . ".html", $dis);
                    else {
                        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['news']);
                        $seoURL = $GLOBALS['PHPShopSeoPro']->setLatin($row['zag']);
                        $PHPShopOrm->update(array("news_seo_name_new" => "$seoURL"), array("id=" => $row["id"]));

                        $dis = str_replace("news/ID_" . $row['id'] . ".html", "news/" . PHPShopString::toLatin($row['zag']) . ".html", $dis);
                    }
                }

            return $dis;
        }
    }
}

$addHandler = array
    (
    'index' => 'index_newselement_seourl_hook'
);
?>