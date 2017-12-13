<?php
/**
 * ����� ���������� ��� ������� ��������
 * @author PHPShop Software
 * @version 1.2
 * @package PHPShopCoreFunction
 * @param obj $obj ������ ������
 * @return mixed
 */
function sort_table($obj,$row) {
    global $SysValue;

    $sort = $obj->PHPShopCategory->unserializeParam('sort');
    $vendor_array = unserialize($row['vendor_array']);
    $dis = null;

    if (is_array($sort))
        foreach ($sort as $v) {
            $sortCat.=' id='.$v.' OR';
        }
    $sortCat = substr($sortCat, 0, strlen($sortCat)-2);

    if(!empty($sortCat)) {

        // ������ ���� �������������
        $PHPShopOrm = new PHPShopOrm();
        $PHPShopOrm->debug=$obj->debug;
        $result=$PHPShopOrm->query("select * from ".$SysValue['base']['table_name20']." where ($sortCat and goodoption!='1') order by num");
        while (@$row = mysql_fetch_assoc($result)) {
            $arrayVendor[$row['id']]=$row;
        }

        if (is_array($vendor_array))
            foreach($vendor_array as $v) {
                foreach($v as $value)
                    if(is_numeric($value))
                        $sortValue.=' id='.$value.' OR';
            }
        $sortValue = substr($sortValue, 0, strlen($sortValue)-2);

        if(!empty($sortValue)) {

            // ������ �������� �������������
            $PHPShopOrm = new PHPShopOrm();
            $PHPShopOrm->debug=$obj->debug;
            $result=$PHPShopOrm->query("select * from ".$SysValue['base']['table_name21']." where $sortValue order by num");
            while (@$row = mysql_fetch_array($result)) {
                $arrayVendorValue[$row['category']]['name'] .= ", ".$row['name'];
            }


            // ������� ������� ������������� � ������ ����������
            foreach($arrayVendor as $idCategory=>$value)
                if(!empty($arrayVendorValue[$idCategory]['name'])) {
                    if(!empty($value['page']))
                        $dis.=PHPShopText::tr(PHPShopText::b($value['name']).': ',PHPShopText::a('../page/'.$value['page'].'.html',substr($arrayVendorValue[$idCategory]['name'],2)));
                    else
                        $dis.=PHPShopText::tr(PHPShopText::b($value['name']).': ',substr($arrayVendorValue[$idCategory]['name'],2));
                }

            $disp = PHPShopText::table($dis);
            $obj->set('vendorDisp',$disp);
        }
    }
}
?>