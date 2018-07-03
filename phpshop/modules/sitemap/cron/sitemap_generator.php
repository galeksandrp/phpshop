<?php

$_classPath = "../../../";
include($_classPath . "class/obj.class.php");
PHPShopObj::loadClass("base");
PHPShopObj::loadClass("system");
PHPShopObj::loadClass("orm");
PHPShopObj::loadClass("date");

$PHPShopBase = new PHPShopBase($_classPath . "inc/config.ini");

// ��������� ������
PHPShopObj::loadClass("modules");
$PHPShopModules = new PHPShopModules($_classPath . "modules/");

$seourl_enabled = false;
$seourlpro_enabled = false;
$seo_news_enabled = false;
$seo_page_enabled = false;


// ���� ������ SEOURL
if (!empty($GLOBALS['SysValue']['base']['seourl']['seourl_system'])) {
    $seourl_enabled = true;
}

// ���� ������ SEOURLPRO
if (!empty($GLOBALS['SysValue']['base']['seourlpro']['seourlpro_system'])) {
    $seourlpro_enabled = true;

    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['seourlpro']['seourlpro_system']);
    $settings = $PHPShopOrm->select(array('seo_news_enabled, seo_page_enabled'), array('id' => "='1'"));
    if($settings['seo_news_enabled'] == 2)
        $seo_news_enabled = true;
    if($settings['seo_page_enabled'] == 2)
        $seo_page_enabled = true;
}

function sitemaptime($nowtime) {
    return PHPShopDate::dataV($nowtime, false, true);
}

// ����������
$title = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
$title.= '<urlset xmlns="http://www.google.com/schemas/sitemap/0.84">' . "\n";
$title.= '<url>' . "\n";
$title.= '<loc>http://' . $_SERVER['SERVER_NAME'] . '</loc>' . "\n";
$title.= '<changefreq>weekly</changefreq>' . "\n";
$title.= '<priority>1.0</priority>' . "\n";
$title.= '</url>' . "\n";

// ��������
$PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['table_name11']);
$data = $PHPShopOrm->select(array('id,datas,link'), array('enabled' => "!='0'", 'category' => '!=2000'), array('order' => 'datas DESC'), array('limit' => 10000));

if (is_array($data))
    foreach ($data as $row) {
        $stat_pages.= '<url>' . "\n";
        $stat_pages.= '<loc>http://' . $_SERVER['SERVER_NAME'] . '/page/' . $row['link'] . '.html</loc>' . "\n";
        $stat_pages.= '<lastmod>' . sitemaptime($row['datas'], false) . '</lastmod>' . "\n";
        $stat_pages.= '<changefreq>weekly</changefreq>' . "\n";
        $stat_pages.= '<priority>1.0</priority>' . "\n";
        $stat_pages.= '</url>' . "\n";
    }

// �������� ��������
$PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['page_categories']);
$data = $PHPShopOrm->select(array('*'), false, false, array('limit' => 10000));
$seourl = null;
if (is_array($data))
    foreach ($data as $row) {

        // ����������� url
        $url = '/page/CID_' . $row['id'];

        if ($seourl_enabled)
            $url = '/page/CID_' . $row['id'] . '_' . PHPShopString::toLatin($row['name']);

        //  SEOURLPRO
        if (!empty($seourlpro_enabled) && !empty($seo_page_enabled)) {
            if (empty($row['page_cat_seo_name']))
                $url = '/page/' . PHPShopString::toLatin($row['name']);
            else
                $url = '/page/' . $row['page_cat_seo_name'];
        }

        $stat_pages.= '<url>' . "\n";
        $stat_pages.= '<loc>http://' . $_SERVER['SERVER_NAME'] . $url . '.html</loc>' . "\n";
        $stat_pages.= '<changefreq>weekly</changefreq>' . "\n";
        $stat_pages.= '<priority>0.5</priority>' . "\n";
        $stat_pages.= '</url>' . "\n";
    }

// �������
$PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['table_name8']);
$data = $PHPShopOrm->select(array('*'), false, array('order' => 'datas DESC'), array('limit' => 10000));

if (is_array($data))
    foreach ($data as $row) {

        // ����������� url
        $url = '/news/ID_' . $row['id'];

        if ($seourl_enabled)
            $url = '/news/ID_' . $row['id'] . '_' . PHPShopString::toLatin($row['zag']);

        //  SEOURLPRO
        if (!empty($seourlpro_enabled) && !empty($seo_news_enabled)) {
            if (empty($row['news_seo_name']))
                $url = '/news/' . PHPShopString::toLatin($row['zag']);
            else
                $url = '/news/' . $row['news_seo_name'];
        }

        $stat_news.= '<url>' . "\n";
        $stat_news.= '<loc>http://' . $_SERVER['SERVER_NAME'] . $url . '.html</loc>' . "\n";
        $stat_news.= '<lastmod>' . sitemaptime(PHPShopDate::GetUnixTime($row['datas'])) . '</lastmod>' . "\n";
        $stat_news.= '<changefreq>daily</changefreq>' . "\n";
        $stat_news.= '<priority>0.5</priority>' . "\n";
        $stat_news.= '</url>' . "\n";
    }

// ������
$PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['products']);
$data = $PHPShopOrm->select(array('*'), array('enabled' => "='1'", 'parent_enabled' => "='0'"), array('order' => 'datas DESC'), array('limit' => 10000));

if (is_array($data))
    foreach ($data as $row) {
        $stat_products.= '<url>' . "\n";


        // ����������� ���
        $url = '/shop/UID_' . $row['id'];

        // SEOURL
        if (!empty($seourl_enabled))
            $url.= '_' . PHPShopString::toLatin($row['name']);

        //  SEOURLPRO
        if (!empty($seourlpro_enabled)) {
            if (empty($row['prod_seo_name']))
                $url = '/id/' . str_replace("_", "-", PHPShopString::toLatin($row['name'])) . '-' . $row['id'];
            else
                $url = '/id/' . $row['prod_seo_name'] . '-' . $row['id'];
        }


        $stat_products.= '<loc>http://' . $_SERVER['SERVER_NAME'] . $url . '.html</loc>' . "\n";
        $stat_products.= '<lastmod>' . sitemaptime($row['datas']) . '</lastmod>' . "\n";
        $stat_products.= '<changefreq>daily</changefreq>' . "\n";
        $stat_products.= '<priority>1.0</priority>' . "\n";
        $stat_products.= '</url>' . "\n";
    }

// ��������
$PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['categories']);
$data = $PHPShopOrm->select(array('*'), array('skin_enabled'=>"='0'"), false, array('limit' => 10000));

$seourl = null;
if (is_array($data))
    foreach ($data as $row) {

            // ����������� ���
            $url = '/shop/CID_' . $row['id'];

            // SEOURL
            if ($seourl_enabled)
                $url.= '_' . PHPShopString::toLatin($row['name']);

            //  SEOURLPRO
            if (!empty($seourlpro_enabled)) {
                if (empty($row['cat_seo_name']))
                    $url = '/'.str_replace("_", "-", PHPShopString::toLatin($row['name']));
                else
                    $url = '/'.$row['cat_seo_name'];
            }

            $stat_products.= '<url>' . "\n";
            $stat_products.= '<loc>http://' . $_SERVER['SERVER_NAME'] . $url . '.html</loc>' . "\n";
            $stat_products.= '<changefreq>weekly</changefreq>' . "\n";
            $stat_products.= '<priority>0.5</priority>' . "\n";
            $stat_products.= '</url>' . "\n";
    }


$sitemap = $title . $stat_pages . $stat_news . $stat_products . '</urlset>';


// ������ � ����
@fwrite(@fopen('../../../../UserFiles/Files/sitemap.xml', "w+"), $sitemap);

echo "Sitemap.xml done!";
?>