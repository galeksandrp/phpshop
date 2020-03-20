<?php

// API https://yandex.ru/support/partnermarket/elements/promo-gift.html

function setProducts_gift_hook($obj, $row) {

    $gift_array = $obj->PHPShopGift->getGift($row['val']);

    // Есть подарок
    if (is_array($gift_array)) {

        // Несколько подарков
        if (strpos($row['val']['gift'], ',')) {
            $gift_prod_array = explode(",", $row['val']['gift']);
        } else
            $gift_prod_array[] = $row['val']['gift'];

        // A+B
        if ($gift_array['gift'] == 0) {

            // Добавляем подарки
            if (is_array($gift_prod_array)) {
                foreach ($gift_prod_array as $val) {
                    if (!empty($val)) {
                        $PHPShopProduct = new PHPShopProduct($val);
                        if ($PHPShopProduct->getParam('items') > 0 or $obj->PHPShopSystem->getSerilizeParam("admoption.sklad_status") == 1) {
                            $promo_gift .= '<promo-gift offer-id="' . $val . '"/>';
                            $obj->gift_product .= '<gift id="' . $val . '">
                              <name><![CDATA[' . $PHPShopProduct->getName() . ']]></name>
                        </gift>';
                        }
                    }
                }
            }

            if (!empty($promo_gift)) {
                $obj->gift .= '
             <purchase>
            <required-quantity>1</required-quantity>
            <product offer-id="' . $row['val']['id'] . '"/>
        </purchase>
        <promo-gifts>
            ' . $promo_gift . '
        </promo-gifts>';
            }
        }
        // NA+MA
        else {

            $obj->gift2 .= '<purchase>
          <required-quantity>' . $row['val']['gift_check'] . '</required-quantity>
          <free-quantity>' . $row['val']['gift_items'] . '</free-quantity>
          <product offer-id="' . $row['val']['id'] . '"/>
        </purchase>';
        }
    }
    return $row['xml'];
}

function serFooter_gift_hook($obj, $data) {
    $add = $list = $vemdorSort = null;

    // Информация об акции 
    if (is_array($obj->PHPShopGift->giftlist)) {

        if ($obj->gift_product) {
            $add = '<gifts>' .
                    $obj->gift_product .
                    '</gifts>';
        }

        $add .= '<promos>';
        foreach ($obj->PHPShopGift->giftlist as $giftlist) {

            // A+B
            if ($giftlist['discount_tip'] == 0 and $obj->gift) {
                $add .= '<promo id="' . $giftlist['id'] . '" type="gift with purchase">
        <description><![CDATA[' . $giftlist['description'] . ']]></description>
       ' . $obj->gift . '
    </promo>';
            }
            // NA+MA
            elseif ($obj->gift2) {
                $add .= '<promo id="' . $giftlist['id'] . '" type="n plus m">
        <description><![CDATA[' . $giftlist['description'] . ']]></description>
       ' . $obj->gift2 . '
    </promo>';
            }
        }

        return $add . '</promos>';
    }
}

function PHPShopYml_gift_hook($obj) {

    include_once '.' . $GLOBALS['SysValue']['class']['gift'];
    $obj->PHPShopGift = new PHPShopGift();
}

$addHandler = array
    (
    'setProducts' => 'setProducts_gift_hook',
    'serFooter' => 'serFooter_gift_hook',
    '__construct' => 'PHPShopYml_gift_hook'
);
?>