<?php

$_classPath = "../../../";
include($_classPath . "class/obj.class.php");
PHPShopObj::loadClass("base");
PHPShopObj::loadClass("system");
PHPShopObj::loadClass("orm");

$PHPShopBase = new PHPShopBase($_classPath . "inc/config.ini");
include($_classPath . "admpanel/enter_to_admin.php");


// ��������� ������
PHPShopObj::loadClass("modules");
$PHPShopModules = new PHPShopModules($_classPath . "modules/");

PHPShopObj::loadClass("date");

// ��������
PHPShopObj::loadClass("admgui");
$PHPShopGUI = new PHPShopGUI();

// SQL
$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.sitemap.sitemap_system"));

function sitemaptime($nowtime) {
    return PHPShopDate::dataV($nowtime, false, true);
}

// �������� sitemap
function setGeneration() {
    global $PHPShopModules;

    $stat_products = null;
    $stat_pages = null;
    $stat_news = null;
    $stat_catalog = null;
    $seourl_enabled = false;
    $seourlpro_enabled = false;


    // ���� ������ SEOURL
    if (!empty($GLOBALS['SysValue']['base']['seourl']['seourl_system'])) {
        $seourl_enabled = true;
    }

    // ���� ������ SEOURLPRO
    if (!empty($GLOBALS['SysValue']['base']['seourlpro']['seourlpro_system'])) {
        $seourlpro_enabled = true;
    }


    // ����������
    $title = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    $title.= '<urlset xmlns="http://www.google.com/schemas/sitemap/0.84">' . "\n";

    // ��������
    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['table_name11']);
    $data = $PHPShopOrm->select(array('id,datas,link'), array('enabled' => "!='0'", 'category' => '!=2000'), array('order' => 'datas DESC'), array('limit' => 10000));

    if (is_array($data))
        foreach ($data as $row) {
            $stat_pages.= '<url>' . "\n";
            $stat_pages.= '<loc>http://' . $_SERVER['SERVER_NAME'] . '/page/' . $row['link'] . '.html</loc>' . "\n";
            $stat_pages.= '<lastmod>' . sitemaptime($row['datas']) . '</lastmod>' . "\n";
            $stat_pages.= '<changefreq>weekly</changefreq>' . "\n";
            $stat_pages.= '<priority>1.0</priority>' . "\n";
            $stat_pages.= '</url>' . "\n";
        }

    // �������� ��������
    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['page_categories']);
    $data = $PHPShopOrm->select(array('id,name'), false, false, array('limit' => 10000));

    $seourl = null;
    if (is_array($data))
        foreach ($data as $row) {


            if ($seourl_enabled)
                $seourl = '_' . PHPShopString::toLatin($row['name']);

            $stat_pages.= '<url>' . "\n";
            $stat_pages.= '<loc>http://' . $_SERVER['SERVER_NAME'] . '/page/CID_' . $row['id'] . $seourl . '.html</loc>' . "\n";
            $stat_pages.= '<changefreq>weekly</changefreq>' . "\n";
            $stat_pages.= '<priority>0.5</priority>' . "\n";
            $stat_pages.= '</url>' . "\n";
        }

    // �������
    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['table_name8']);
    $data = $PHPShopOrm->select(array('id,datas,zag'), false, array('order' => 'datas DESC'), array('limit' => 10000));

    $seourl = null;
    if (is_array($data))
        foreach ($data as $row) {

            if ($seourl_enabled)
                $seourl = '_' . PHPShopString::toLatin($row['zag']);

            $stat_news.= '<url>' . "\n";
            $stat_news.= '<loc>http://' . $_SERVER['SERVER_NAME'] . '/news/ID_' . $row['id'] . $seourl . '.html</loc>' . "\n";
            $stat_news.= '<lastmod>' . sitemaptime(PHPShopDate::GetUnixTime($row['datas'])) . '</lastmod>' . "\n";
            $stat_news.= '<changefreq>daily</changefreq>' . "\n";
            $stat_news.= '<priority>0.5</priority>' . "\n";
            $stat_news.= '</url>' . "\n";
        }

    // ������
    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['products']);
    $data = $PHPShopOrm->select(array('*'), array('enabled' => "='1'", 'parent_enabled' => "='0'"), array('order' => 'datas DESC'), array('limit' => 100000));


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
}

// ������� ����������
function actionUpdate() {
    global $PHPShopOrm;

    // �������� sitemap
    if (!empty($_POST['generation']))
        setGeneration();

    return true;
}

// ��������� ������� ��������
function actionStart() {
    global $PHPShopGUI, $PHPShopSystem, $SysValue, $_classPath, $PHPShopOrm;


    $PHPShopGUI->dir = $_classPath . "admpanel/";
    $PHPShopGUI->title = "��������� ������";
    $PHPShopGUI->size = "500,450";


// �������
    $data = $PHPShopOrm->select();
    @extract($data);


// ����������� ��������� ����
    $PHPShopGUI->setHeader("��������� ������ 'Sitemap'", "���������", $PHPShopGUI->dir . "img/i_display_settings_med[1].gif");

// ������� ������� ��� �����
    $ContentField1 = $PHPShopGUI->setCheckbox("generation", 1, "��������� ������������� ��������� ����� Sitemap.", false);
    $ContentField1.=$PHPShopGUI->setLine();
    $ContentField1.=$PHPShopGUI->setInput("button", "", "������� ���� sitemap.xml", "left", 150, "return window.open('../../../../UserFiles/Files/sitemap.xml');", "but");

    $Info = "
   1. ��� ��������������� �������� sitemap.xml ���������� ������ <b>Cron</b> � �������� � ���� ����� ������ � �������
        ������������ �����  <b>phpshop/modules/sitemap/cron/sitemap_generator.php</b>
        <p>
   2. � ����������� ������� ����� http://" . $_SERVER['SERVER_NAME'] . "/UserFiles/Files/sitemap.xml
       </p>
   3. ���������� ����� CHMOD 775 �� ����� /UserFiles/Files/ ��� ������ � ��� sitemap.xml";
    $ContentField2 = $PHPShopGUI->setInfo($Info, 130, '95%');

// ���������� �������� 1
    $Tab1 = $PHPShopGUI->setField("�������� �����", $ContentField1);
    $Tab1.=$PHPShopGUI->setField("���������", $ContentField2);

    $Tab3 = $PHPShopGUI->setPay($serial, false);

// ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1, 270), array("� ������", $Tab3, 270));

// ����� ������ ��������� � ����� � �����
    $ContentFooter =
            $PHPShopGUI->setInput("hidden", "newsID", $id, "right", 70, "", "but") .
            $PHPShopGUI->setInput("button", "", "������", "right", 70, "return onCancel();", "but") .
            $PHPShopGUI->setInput("submit", "editID", "��", "right", 70, "", "but", "actionUpdate");

    $PHPShopGUI->setFooter($ContentFooter);
    return true;
}

if ($UserChek->statusPHPSHOP < 2) {

// ����� ����� ��� ������
    $PHPShopGUI->setLoader($_POST['editID'], 'actionStart');

// ��������� �������
    $PHPShopGUI->getAction();
}
else
    $UserChek->BadUserFormaWindow();
?>


