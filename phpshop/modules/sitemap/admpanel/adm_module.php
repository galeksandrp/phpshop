<?php

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
    $data = $PHPShopOrm->select(array('*'), array('skin_enabled' => "='0'"), false, array('limit' => 10000));

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
                    $url = '/' . str_replace("_", "-", PHPShopString::toLatin($row['name']));
                else
                    $url = '/' . $row['cat_seo_name'];
            }

            $stat_products.= '<url>' . "\n";
            $stat_products.= '<loc>http://' . $_SERVER['SERVER_NAME'] . $url . '.html</loc>' . "\n";
            $stat_products.= '<changefreq>weekly</changefreq>' . "\n";
            $stat_products.= '<priority>0.5</priority>' . "\n";
            $stat_products.= '</url>' . "\n";
        }


    $sitemap = $title . $stat_pages . $stat_news . $stat_products . '</urlset>';

    // ������ � ����
    if(fwrite(@fopen('../../UserFiles/Files/sitemap.xml', "w+"), $sitemap))
             echo '<div class="alert alert-success" id="rules-message"  role="alert">���� <strong>sitemap.xm</strong> ������� ������.</div>';
    else echo '<div class="alert alert-danger" id="rules-message"  role="alert">������ ���������� ����� � ����� UserFiles/File !</div>';
}

// ������� ����������
function actionUpdate() {

    setGeneration();
}

// ��������� ������� ��������
function actionStart() {
    global $PHPShopGUI, $PHPShopOrm, $TitlePage, $select_name;

    $PHPShopGUI->action_button['�������'] = array(
        'name' => '������� Sitemap',
        'action' => 'saveID',
        'class' => 'btn  btn-default btn-sm navbar-btn',
        'type' => 'submit',
        'icon' => 'glyphicon glyphicon-import'
    );

    $PHPShopGUI->action_button['�������'] = array(
        'name' => '������� Sitemap',
        'action' => '../../UserFiles/Files/sitemap.xml',
        'class' => 'btn  btn-default btn-sm navbar-btn btn-action-panel-blank',
        'type' => 'button',
        'icon' => 'glyphicon glyphicon-export'
    );

    $PHPShopGUI->setActionPanel($TitlePage, $select_name, array('�������', '�������', '�������'));

// �������
    $data = $PHPShopOrm->select();

    $Info = "
   1. ��� ��������������� �������� sitemap.xml ���������� ������ <kbd>Cron</kbd> � �������� � ���� ����� ������ � �������
        ������������ �����:<br>  <code>phpshop/modules/sitemap/cron/sitemap_generator.php</code>
        <p>
   2. � ����������� ������� ����� <code>http://" . $_SERVER['SERVER_NAME'] . "/UserFiles/Files/sitemap.xml</code> ��� �������������� ��������� ���������� ������.
       </p>
   3. ���������� ����� CHMOD 775 �� ����� /UserFiles/Files/ ��� ������ � ��� ����� sitemap.xml";
    $Tab1 = $PHPShopGUI->setInfo($Info);

    $Tab2 = $PHPShopGUI->setPay();

// ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1), array("� ������", $Tab2));

// ����� ������ ��������� � ����� � �����
    $ContentFooter =
            $PHPShopGUI->setInput("hidden", "rowID", $data['id']) .
            $PHPShopGUI->setInput("submit", "saveID", "���������", "right", 80, "", "but", "actionUpdate.modules.edit");

    $PHPShopGUI->setFooter($ContentFooter);
    return true;
}

// ��������� �������
$PHPShopGUI->getAction();

// ����� ����� ��� ������
$PHPShopGUI->setLoader($_POST['editID'], 'actionStart');
?>