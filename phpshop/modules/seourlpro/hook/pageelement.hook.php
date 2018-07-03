<?php

/**
 * SEO ������ ��� �������� ��������� ����������� �������
 */
function subcatalog_page_seourl_hook($obj, $data, $rout) {

    if ($rout == 'START') {
        $dis = null;
        $i = 0;
        if (is_array($data))
            foreach ($data as $row) {

                // ���������� ����������
                $obj->set('catalogId', $row['parent_to']);
                $obj->set('catalogUid', $row['id']);
                $obj->set('catalogI', $i);
                $obj->set('catalogLink', 'CID_' . $row['id']);
                $obj->set('catalogTemplates', $obj->getValue('dir.templates') . chr(47) . $obj->PHPShopSystem->getValue('skin') . chr(47));
                $obj->set('catalogName', $row['name']);
                $i++;

                // ���������� ������
                $dis.=$obj->parseTemplate($obj->getValue('templates.podcatalog_page_forma'));

                if (!empty($row["page_cat_seo_name"]))
                    $dis = str_replace("page/CID_" . $row['id'] . ".html", "page/" . $row['page_cat_seo_name'] . ".html", $dis);
                else {
                    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['page_categories']);
                    $seoURL = $GLOBALS['PHPShopSeoPro']->setLatin($row['name']);
                    $PHPShopOrm->update(array('page_cat_seo_name_new' => "$seoURL"), array('id=' => $row['id']));
                    $dis = str_replace("page/CID_" . $row['id'] . ".html", "page/" . $GLOBALS['PHPShopSeoPro']->setLatin($row['name']) . ".html", $dis);
                }
            }

        return $dis;
    }
}

/**
 * SEO ������ ��� �������� ��������� �������� �������
 */
function pageCatal_seourl_hook($obj, $data, $rout) {
    
    if ($rout == "START") {

        // ��������� ������
        include_once(dirname(__FILE__) . '/mod_option.hook.php');
        $PHPShopSeourlOption = new PHPShopSeourlOption();
        $seourl_option = $PHPShopSeourlOption->getArray();

        if ($seourl_option["seo_page_enabled"] != 2)
            return false;

            $dis = null;
            $i = 0;

            if (is_array($data))
                foreach ($data as $row) {

                    // ���������� ����������
                    $obj->set('catalogId', $row['id']);
                    $obj->set('catalogI', $i);
                    $obj->set('catalogTemplates', $obj->getValue('dir.templates') . chr(47) . $obj->PHPShopSystem->getValue('skin') . chr(47));

                    // ���� ���� ��������
                    if ($obj->chek($row['id'])) {

                        $obj->set('catalogName', $row['name']);
                        $obj->set('catalogId', $row['id']);
                        $obj->set('catalogPodcatalog', null);

                        $dis.=$obj->parseTemplate($obj->getValue('templates.catalog_page_forma_2'));
                    } else {
                        $obj->set('catalogPodcatalog', $obj->subcatalog($row['id']));
                        $obj->set('catalogName', $row['name']);

                        $dis.=$obj->parseTemplate($obj->getValue('templates.catalog_page_forma'));
                    }

                    if (!empty($row["page_cat_seo_name"]))
                        $dis = str_replace("page/CID_" . $row['id'] . ".html", "page/" . $row['page_cat_seo_name'] . ".html", $dis);
                    else {
                        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['page_categories']);
                        $seoURL = $GLOBALS['PHPShopSeoPro']->setLatin($row['name']);
                        $PHPShopOrm->update(array('page_cat_seo_name_new' => "$seoURL"), array('id=' => $row['id']));
                        $dis = str_replace("page/CID_" . $row['id'] . ".html", "page/" . $GLOBALS['PHPShopSeoPro']->setLatin($row['name']) . ".html", $dis);
                    }
                    $i++;
                }
            return $dis;
        }
    }

    $addHandler = array
        (
        'subcatalog' => 'subcatalog_page_seourl_hook',
        'pageCatal' => 'pageCatal_seourl_hook'
    );
?>