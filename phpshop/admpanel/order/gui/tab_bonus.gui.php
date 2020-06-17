<?php

/**
 * Панель файлов к заказу
 * @param array $row массив данных
 * @return string 
 */
function tab_bonus($data) {
    global $PHPShopGUI;

    $cartArray = unserialize($data['orders']);
    $disp = $PHPShopGUI->setDiv('left', "<p>".__('Потрачено бонусов').": <span class='label label-default'>" . $data['bonus_minus'] . "</span></p>");

    $bonusP = '0';
    $bonusPlus = '0';

    if ($data['bonus_plus'] == 0) {
        $BonusCount = new BonusCount();
        $bonusP = $BonusCount->amountBonus($cartArray['Cart']['cart']);
    } else {
        $bonusP = $data['bonus_plus'];
    }

    if (4 == $data['statusi']) {
        $bonusPlus = $bonusP;
    }

    $disp .= $PHPShopGUI->setDiv('left', "<p>".__('Начислено бонусов').": <span class='label label-default'>" . $bonusPlus . "</span><input name='bonus_plus_new' type='hidden' value=" . $bonusP . "></p>");

    return $disp;
}

?>