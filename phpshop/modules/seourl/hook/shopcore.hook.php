<?php

/*
 * SEO ��������� ��������� �� ������������ BDBD
 */

function set_meta_seourl_hook($obj, $row) {
    global $seourl_option;

    if ($seourl_option['paginator'] == 2) {
        if ($obj->PHPShopNav->getPage() > 1) {
            $obj->doLoadFunction('PHPShopShop', 'set_meta', $row);
            $obj->description.= ' ����� ' . $obj->PHPShopNav->getPage();
            $obj->title.=' �������� ' . $obj->PHPShopNav->getPage();
            return true;
        } elseif ($obj->PHPShopNav->getPage() == 'ALL') {
            $obj->doLoadFunction('PHPShopShop', 'set_meta', $row);
            $obj->title.=' ��� ��������';
            $obj->set('catalogCategory', ' - ��� ��������', true);
            return true;
        }
    }
}

/*
 * SEO ��������� ������ � ������ ������� /shop/
 */

function CID_Product_seourl_hook($obj, $row, $rout) {
    global $seourl_option;

    $catalog_name = $obj->PHPShopCategory->getName();
    $seo_name = $GLOBALS['seourl_pref'] . PHPShopString::toLatin($catalog_name);

    // ��������� ������
    include_once(dirname(__FILE__) . '/mod_option.hook.php');
    $PHPShopSeourlOption = new PHPShopSeourlOption();
    $seourl_option = $PHPShopSeourlOption->getArray();

    // �������� ������������ SEO ������
    if ($rout == 'START') {
        $url = $obj->PHPShopNav->getName(true);
        $url_true = '/shop/CID_' . $obj->PHPShopNav->getId() . $seo_name;
        $url_pack = '/shop/CID_' . $obj->PHPShopNav->getId();
        $url_nav = '/shop/CID_' . $obj->PHPShopNav->getId() . '_' . $obj->PHPShopNav->getPage();
        $url_true_nav = '/shop/CID_' . $obj->PHPShopNav->getId() . '_' . $obj->PHPShopNav->getPage() . $seo_name;

        
        // Query
        if(!empty($_SERVER["QUERY_STRING"]))
            $url_query='?'.$_SERVER["QUERY_STRING"];
        else $url_query=null;
        

        // ���� ������ �� ��������
        if ($url != $url_true and $url != $url_pack and $url != $url_nav and $url != $url_true_nav) {
            $obj->ListInfoItems = parseTemplateReturn($obj->getValue('templates.error_page_forma'));
            $obj->setError404();
            return true;
        } elseif ($url == $url_pack or $url != $url_true_nav) {
            header('Location: ' . $obj->getValue('dir.dir') . $url_true_nav . '.html'.$url_query, true, 301);
            return true;
        }
    }

    if ($rout == 'END') {
        $obj->set('nameLat', $seo_name);
        $page = $obj->PHPShopNav->getPage();

        // ������������ BDBD
        if ($seourl_option['paginator'] == 2){
            if ($obj->PHPShopNav->getPage() > 1) {

                // ���������� �������� �������� � ����������
                $obj->set('catalogContent', null);

                // ���������� ������ ������� � ��� ��������
                $obj->set('catalogCategory', ' - �������� ' . $obj->PHPShopNav->getPage(), true);

            }
            
                // �������� ���������� ������� ������ canonical ��� ���������� ������
            if(!empty($_SERVER["QUERY_STRING"]))
                $obj->set('seourl_canonical', '<link rel="canonical" href="http://' . $_SERVER['SERVER_NAME'] . $obj->get('ShopDir') . '/shop/CID_' . $obj->PHPShopNav->getId() . '_' . $obj->PHPShopNav->getPage() . $seo_name . '.html">');
            
        }

        // SEO ���������� �� ���������������
        $vendorSelectDisp = '
<script>
function ReturnSortSeoUrl(v){
    var s,url="";
    if(v>0){
        s=document.getElementById(v).value;
        if(s!="") url="v["+v+"]="+s+"&";
    }
    return url;
}

function GetSortAll(){
    var url="/shop/CID_"+arguments[0]+"' . $seo_name . '.html?";
    var i=1;
    var c=arguments.length;
    for(i=1; i<c; i++)
        if(document.getElementById(arguments[i])) url=url+ReturnSortSeoUrl(arguments[i]);
    location.replace(url);
}
</script>
' . $obj->get('vendorSelectDisp');

        $vendorSelectDisp = str_replace('GetSortAll', 'GetSortAllSeo', $vendorSelectDisp);
        $obj->set('vendorSelectDisp', $vendorSelectDisp);

        // SEO ������� ������
        navigation_seourl($obj, $obj->PHPShopCategory->getName());
    }
}

/**
 * SEO ��������� ������ ���������
 */
function CID_Category_seourl_hook($obj, $dataArray, $rout) {

    $catalog_name = $obj->PHPShopCategory->getName();
    $seo_name = $GLOBALS['seourl_pref'] . PHPShopString::toLatin($catalog_name);

    // �������� ������������ SEO ������
    if ($rout == 'START') {
        $url = $obj->PHPShopNav->getName(true);
        $url_true = '/shop/CID_' . $obj->PHPShopNav->getId() . $seo_name;
        $url_pack = '/shop/CID_' . $obj->PHPShopNav->getId();

        // ���� ������ �� ��������
        if ($url != $url_true and $url != $url_pack) {
            $obj->ListInfoItems = parseTemplateReturn($obj->getValue('templates.error_page_forma'));
            $obj->setError404();
            return true;
        } elseif ($url == $url_pack) {
            header('Location: ' . $obj->getValue('dir.dir') . $url_true . '.html', true, 301);
            return true;
        }
    }

    if ($rout == 'END') {
        $dis = null;

        if (empty($GLOBALS['SysValue']['base']['iconcat']['iconcat_system'])) {

            if (is_array($dataArray))
                foreach ($dataArray as $row) {
                    $dis.=PHPShopText::li($row['name'], '/' . $obj->PHPShopNav->getPath() . '/CID_' . $row['id'] . $GLOBALS['seourl_pref'] . PHPShopString::toLatin($row['name']) . '.html');
                }
            $disp = PHPShopText::ul($dis);
            $obj->set('catalogList', $disp);
        }

        // SEO ������� ������
        navigation_seourl($obj, $obj->category_name);
    }
}

/**
 * SEO ��������� ������� ������
 */
function navigation_seourl($obj, $name) {
    $dis = null;

    // ������� ����������� ���������
    $spliter = ParseTemplateReturn($obj->getValue('templates.breadcrumbs_splitter'));
    $home = ParseTemplateReturn($obj->getValue('templates.breadcrumbs_home'));

    // ���� ��� ������� ������������
    if (empty($spliter))
        $spliter = ' / ';
    if (empty($home))
        $home = PHPShopText::a('/', __('�������'));

    if (is_array($obj->navigation_array))
        $arrayPath = array_reverse($obj->navigation_array);

    if (is_array($arrayPath)) {
        foreach ($arrayPath as $v) {
            $dis.= $spliter . PHPShopText::a('/' . $obj->PHPShopNav->getPath() . '/CID_' . $v['id'] . $GLOBALS['seourl_pref'] . PHPShopString::toLatin($v['name']) . '.html', $v['name']);
        }
    }

    $dis = $home . $dis . $spliter . PHPShopText::b($name);
    $obj->set('breadCrumbs', $dis);
}

/**
 * SEO ������ ��� �������������� ���������
 */
function other_cat_navigation_seourl_hook($obj, $parent, $rout) {
    if ($rout == 'END') {
        $dataArray = array();
        $dis = null;

        // ������������� ����������� ����
        foreach ($GLOBALS['Cache'][$GLOBALS['SysValue']['base']['categories']] as $val) {
            if ($val['parent_to'] == $parent)
                $dataArray[] = $val;
        }

        if (count($dataArray) > 1) {
            foreach ($dataArray as $row) {

                if ($row['id'] == $obj->category)
                    $class = 'activ_catalog';
                else
                    $class = null;

                $dis.=PHPShopText::a('/' . $GLOBALS['SysValue']['nav']['path'] . '/CID_' . $row['id'] . $GLOBALS['seourl_pref'] . PHPShopString::toLatin($row['name']) . '.html', $row['name'], false, false, false, false, $class);
                $dis.=' | ';
            }
        }

        $obj->set('DispCatNav', $dis);
        return true;
    }
}

/**
 * �������� ������������ SEO ����� ������
 */
function UID_seourl_hook($obj, $row, $rout) {
    if ($rout == 'END') {
        $url = $obj->PHPShopNav->getName(true);
        $url_true = '/shop/UID_' . $obj->PHPShopNav->getId() . $GLOBALS['seourl_pref'] . PHPShopString::toLatin($row['name']);
        $url_pack = '/shop/UID_' . $obj->PHPShopNav->getId();

        // ���� ������ �� ��������
        if ($url != $url_true and $url != $url_pack) {
            $obj->ListInfoItems = parseTemplateReturn($obj->getValue('templates.error_page_forma'));
            $obj->set('breadCrumbs', null);
            $obj->set('odnotipDisp', null);
            $obj->setError404();
        } elseif ($url == $url_pack) {
            header('Location: ' . $obj->getValue('dir.dir') . $url_true . '.html', true, 301);
            return true;
        }

        // SEO ������� ������
        navigation_seourl($obj, $row['name']);
    }
}

$addHandler = array(
    'UID' => 'UID_seourl_hook',
    'other_cat_navigation' => 'other_cat_navigation_seourl_hook',
    'CID_Category' => 'CID_Category_seourl_hook',
    'CID_Product' => 'CID_Product_seourl_hook',
    'set_meta' => 'set_meta_seourl_hook'
);
?>
