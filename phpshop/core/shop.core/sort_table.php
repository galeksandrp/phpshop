<?php

/**
 * ����� ���������� ��� ������� ��������
 * @author PHPShop Software
 * @version 1.5
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

    if (is_array($sort))
        foreach ($sort as $v) {
            $sortCat.=' id=' . $v . ' OR';
        }
    $sortCat = substr($sortCat, 0, strlen($sortCat) - 2);

    if (!empty($sortCat)) {

        // ������ ���� �������������
        $PHPShopOrm = new PHPShopOrm();
        $PHPShopOrm->debug = $obj->debug;
        $result = $PHPShopOrm->query("select * from " . $SysValue['base']['table_name20'] . " where ($sortCat) and goodoption != '1' order by num");
        while (@$row = mysql_fetch_assoc($result)) {
            $arrayVendor[$row['id']] = $row;
        }

        if (is_array($vendor_array))
            foreach ($vendor_array as $v) {
                foreach ($v as $value)
                    if (is_numeric($value))
                        $sortValue.=' id=' . $value . ' OR';
            }
        $sortValue = substr($sortValue, 0, strlen($sortValue) - 2);

        if (!empty($sortValue)) {

            // ������ �������� �������������
            $PHPShopOrm = new PHPShopOrm();
            $PHPShopOrm->debug = $obj->debug;
            $result = $PHPShopOrm->query("select * from " . $SysValue['base']['table_name21'] . " where $sortValue order by num");
            while (@$row = mysql_fetch_array($result)) {

                // ����������� �����
                if ($row['name'][0] == '#')
                    @$arrayVendorValue[$row['category']]['name'].= '  <div class="sort-color" style="width:25px;height:25px;background:' . $row['name'] . ';float:left;padding:3px;margin:3px;"></div>  ';
                else 
                @$arrayVendorValue[$row['category']]['name'].= ", " . $row['name'];
                
                @$arrayVendorValue[$row['category']]['page'].= $row['page'];
                if ($arrayVendor[$row['category']]['brand']) {
                    $obj->set('brandIcon', $row['icon']);
                    $obj->set('brandName', $row['name']);
                    if ($row['page']) {
                        $PHPShopOrm->clean();
                        $res = $PHPShopOrm->query("select content from " . $SysValue['base']['page'] . " where link = '$row[page]' LIMIT 1");
                        $page = mysql_fetch_array($res);
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

                    if (!empty($arrayVendorValue[$idCategory]['name'])) {
                        if (!empty($value['name'])) {

                            if (!empty($value['page']))
                                $sortName = PHPShopText::a('../page/' . $value['page'] . '.html', $value['name']);
                            else
                                $sortName = PHPShopText::b($value['name']);

                            if (!empty($arrayVendorValue[$idCategory]['page']))
                                $sortValueName = PHPShopText::a('../page/' . $arrayVendorValue[$idCategory]['page'] . '.html', substr($arrayVendorValue[$idCategory]['name'], 2));
                            else
                                $sortValueName = substr($arrayVendorValue[$idCategory]['name'], 2);

                            $dis.=PHPShopText::tr($sortName . ': ', $sortValueName);
                        }
                    }
                }

            $disp = PHPShopText::table($dis, $cellpadding = 3, $cellspacing = 1, $align = '', $width = '98%', $bgcolor = false, $border = 0, $id = false, 'vendorenabled');
            $obj->set('vendorDisp', $disp);
        }
    }
}

?>