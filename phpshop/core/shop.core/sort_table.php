<?php

/**
 * ����� ���������� ��� ������� ��������
 * @author PHPShop Software
 * @version 1.7
 * @package PHPShopCoreFunction
 * @param obj $obj ������ ������
 * @return mixed
 */
function sort_table($obj, $row) {
    global $SysValue;

    $sort = $obj->PHPShopCategory->unserializeParam('sort');
    $vendor_array = unserialize($row['vendor_array']);
    $dis = $sortCat = $sortValue = null;
    $arrayVendorValue = array();
    $odnotip = $row['odnotip'];

    if (is_array($sort))
        foreach ($sort as $v) {
            $sortCat.=intval($v) . ',';
        }

    if (!empty($sortCat)) {

        // ������ ���� �������������
        $PHPShopOrm = new PHPShopOrm();
        $PHPShopOrm->debug = $obj->debug;
        $result = $PHPShopOrm->query("select * from " . $SysValue['base']['sort_categories'] . " where id IN ( $sortCat 0) order by num");
        while (@$row = mysqli_fetch_assoc($result)) {
            $arrayVendor[$row['id']] = $row;
        }

        if (is_array($vendor_array))
            foreach ($vendor_array as $v) {
                foreach ($v as $value)
                    if (is_numeric($value))
                        $sortValue.=intval($value) . ',';
            }



        if (!empty($sortValue)) {

            // ������ �������� �������������
            $PHPShopOrm = new PHPShopOrm();
            $PHPShopOrm->debug = $obj->debug;
            $result = $PHPShopOrm->query("select * from " . $SysValue['base']['sort'] . " where id IN ( $sortValue 0) order by num");
            while (@$row = mysqli_fetch_array($result)) {

                // ����������� �����
                if ($row['name'][0] == '#')
                    $arrayVendorValue[$row['category']]['name'].= '  <div class="sort-color" style="width:25px;height:25px;background:' . $row['name'] . ';float:left;padding:3px;margin:3px;"></div>  ';
                else
                    $arrayVendorValue[$row['category']]['name'].= ", " . $row['name'];

                $arrayVendorValue[$row['category']]['page'].= $row['page'];
                $arrayVendorValue[$row['category']]['id'].= $row['id'];

                // �����
                if ($arrayVendor[$row['category']]['brand']) {
                    $obj->set('brandIcon', $row['icon']);
                    $obj->set('brandName', $row['name']);
                    if ($row['page']) {
                        $PHPShopOrm->clean();
                        $res = $PHPShopOrm->query("select content from " . $SysValue['base']['page'] . " where link = '$row[page]' LIMIT 1");
                        $page = mysqli_fetch_array($res);
                        $desc = stripslashes($page['content']);
                    }

                    $obj->set('brandPageLink', '/selection/?v[' . $row['category'] . ']=' . $row['id']);
                    if (@$desc) {
                        $obj->set('brandDescr', $desc);
                    } else {
                        $obj->set('brandDescr', '');
                    }

                    $obj->set('brandUidDescription', ParseTemplateReturn('product/brand_uid_description.tpl'), true);
                }
            }


            // ������� ������� ������������� � ������ ����������
            if (is_array($arrayVendor))
                foreach ($arrayVendor as $idCategory => $value) {
                     
                    if (!empty($value['product']) and strstr($odnotip, ',')) {

                        $where['id'] = ' IN (' . $odnotip . ')';
                        $where['enabled'] = "='1'";

                        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['products']);
                        $PHPShopOrm->debug = false;
                        $PHPShopOrm->mysql_error = false;
                        $data = $PHPShopOrm->select(array('*'), $where, false, array('limit' => 100));
                        if (is_array($data)) {
                            $sortValueName = null;
                            foreach ($data as $row) {

                                if (!isset($row['prod_seo_name']))
                                    $p_link = '/shop/UID_' . $row['id'] . '.html';
                                else
                                    $p_link = '/id/' . str_replace("_", "-", PHPShopString::toLatin($row['name'])) . '-' . $row['id'] . '.html';

                                $sortValueName.= PHPShopText::a($p_link, $row['name'],false, false, false, false, 'sort-table-product-link',$row['pic_small']) . '<br>';
                            }
                        }

                        $sortName = PHPShopText::b($value['name']);
                        $dis.=PHPShopText::tr($sortName . ': ', substr($sortValueName, 0, strlen($sortValueName) - 2));
                    }

                    elseif (!empty($arrayVendorValue[$idCategory]['name'])) {
                        if (!empty($value['name'])) {


                            // ��������
                            if (!empty($value['page']))
                                $sortName = PHPShopText::a('/page/' . $value['page'] . '.html', $value['name']);
                            else
                                $sortName = PHPShopText::b($value['name']);

                            if (!empty($value['brand']))
                                $sortValueName = PHPShopText::a('/selection/?v[' . $idCategory . ']=' . $arrayVendorValue[$idCategory]['id'], substr($arrayVendorValue[$idCategory]['name'], 2));
                            else if (!empty($arrayVendorValue[$idCategory]['page']))
                                $sortValueName = PHPShopText::a('/page/' . $arrayVendorValue[$idCategory]['page'] . '.html', substr($arrayVendorValue[$idCategory]['name'], 2));
                            else
                                $sortValueName = substr($arrayVendorValue[$idCategory]['name'], 2);

                            $dis.=PHPShopText::tr($sortName . ': ', $sortValueName);
                        }
                    }
                }

            $disp = PHPShopText::table($dis, $cellpadding = 3, $cellspacing = 3, $align = '', $width = '100%', $bgcolor = false, $border = 0, $id = false, 'vendorenabled');
            $obj->set('vendorDisp', $disp);
        }
    }
}

?>