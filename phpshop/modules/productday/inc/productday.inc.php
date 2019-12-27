<?php

if (!defined("OBJENABLED"))
    exit(header('Location: /?error=OBJENABLED'));

class ProductDay extends PHPShopProductElements {

    var $debug = false;

    /**
     * ���������
     */
    function option() {
        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['productday']['productday_system']);
        $PHPShopOrm->debug = $this->debug;
        $this->option = $PHPShopOrm->select();
    }

    function productdayview() {

        $this->option();

        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['products']);
        $PHPShopOrm->debug = false;

        if ($this->option['status'] == 3)
            $where['spec'] = "='1'";
        else
            $where['productday'] = "='1'";


        $productday = $PHPShopOrm->select(array('*'), $where, array('order' => 'datas desc'), array('limit' => 1));

        $hour = date("H");
        $minute = date("i");
        $second = date("s");
        $hour_good = ($this->option['time'] - $hour);
        $minute_good = (60 - $minute);
        $second_good = (60 - $second);
        
        if ($hour_good < 0 and is_array($productday) and $this->option['status'] == 1) {

            // ������� ����� �� �����
            if (empty($productday['price_n']))
                $productday['price_n'] = $productday['price'];

            $PHPShopOrm->update(array('productday_new' => 0, 'price_n_new' => 0, 'price_new' => $productday['price_n']), array('id' => '=' . $productday['id']));

            return true;
        }


        if (is_array($productday)) {
            PHPShopParser::set('productDayId', $productday['id']);
            PHPShopParser::set('productDayName', $productday['name']);
            PHPShopParser::set('productDayDescription', $productday['description']);
            PHPShopParser::set('productDayPrice', PHPShopProductFunction::GetPriceValuta($productday['id'], $productday['price']));
            PHPShopParser::set('productDayPriceN', PHPShopProductFunction::GetPriceValuta($productday['id'], $productday['price_n']));
            PHPShopParser::set('productDayPicBig', $productday['pic_big']);
            PHPShopParser::set('productDayPicBigSource', str_replace(".", "_big.", $productday['pic_big']));
            PHPShopParser::set('productDayPicSmall', $productday['pic_small']);
            PHPShopParser::set('productDayHourGood', $hour_good);
            PHPShopParser::set('productDayMinuteGood', $minute_good);
            PHPShopParser::set('productDaySecondGood', $second_good);
            PHPShopParser::set('productDayTimeGood', intval($this->option['time']));
            PHPShopParser::set('productDayCurrency', $this->currency);
            $this->doLoadFunction(__CLASS__, 'comment_rate', array("row" => $productday, "type" => "CID"), 'shop');
            PHPShopParser::set('productDay', PHPShopParser::file($GLOBALS['SysValue']['templates']['productday']['product_day'], true, false, true));
        }
    }

}

// ��������� � ������ �������
$GLOBALS['ProductDay'] = new ProductDay();
$GLOBALS['ProductDay']->productdayview();
?>