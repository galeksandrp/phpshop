<?php

function template_CID_Product($obj, $data, $rout) {
    global $PHPShopNav;


    if ($rout == 'START') {

        // Фасетный фильтр
        $obj->sort_template = 'sorttemplatehook';

        // Виртуальные каталоги
        $obj->cat_template = 'sortсattemplatehook';


        switch ($_GET['gridChange']) {
            case 1:
                $obj->set('gridSetAactive', 'active');
                break;
            case 2:
                $obj->set('gridSetBactive', 'active');
                break;
            default: if ($obj->cell == 1)
                    $obj->set('gridSetAactive', 'active');
                else
                    $obj->set('gridSetBactive', 'active');
        }


        switch ($_GET['s']) {
            case 1:
                $obj->set('sSetAactive', 'active');
                break;
            case 2:
                $obj->set('sSetBactive', 'active');
                break;
            default: $obj->set('sSetCactive', 'active');
        }


        switch ($_GET['f']) {
            case 1:
                $obj->set('fSetAactive', 'active');
                break;
            case 2:
                $obj->set('fSetBactive', 'active');
                break;
            //default: $obj->set('fSetAactive', 'active');
        }
    } else if ($rout == 'END') {

        if (!empty($_GET['lego_s'])) {
            $_SESSION['editor'][SkinName]['s'] = intval($_GET['lego_s']);
            header('Location: ' . $PHPShopNav->objNav['truepath']);
        }

        // Фильтр
        if (!empty($_SESSION['editor'][SkinName]['s'])) {
            $s = intval($_SESSION['editor'][SkinName]['s']);
        }
        else
            $s = $_SESSION['editor'][SkinName]['s'] = 1;

        if (PHPShopParser::checkFile('filter/filter_' . $s . '.tpl')) {
            PHPShopParser::set('filter', PHPShopParser::file($GLOBALS['SysValue']['dir']['templates'] . chr(47) . $_SESSION['skin'] . '/filter/filter_' . $s . '.tpl', true, false));
        }
    }
}

/**
 * Вывод подтипов в подробном описании 
 */
function template_parent($obj, $dataArray, $rout) {

    if ($rout == 'END') {

        $currency = $obj->currency;

        $true_color_array = $true_size_color_array = $color_array = array();
        $size = $color = null;

        if (@count($obj->select_value > 0)) {

            foreach ($obj->select_value as $value) {

                $row = $value[3];
                if (!empty($row['parent_enabled'])) {

                    $row['price_n'] = number_format($obj->price($row, true), $obj->format, '.', ' ');
                    $row['price'] = number_format($obj->price($row), $obj->format, '.', ' ');

                    // Цена для YML ?option=ID
                    if (!empty($_GET['option'])) {
                        if ($value[1] == $_GET['option'])
                            $obj->set('productPrice', $row['price']);
                    } else
                        $obj->set('productPrice', number_format($obj->price($dataArray), $obj->format, '.', ' '));

                    $obj->set('productValutaName', $currency);
                    $obj->set('parentName', $value[0]);
                    $obj->set('parentCheckedId', $value[1]);

                    // Единица измерения
                    if (empty($row['ed_izm']))
                        $row['ed_izm'] = $obj->lang('product_on_sklad_i');

                    $size_color_array[$value[3]['id']] = array('id' => $row['id'], 'size' => $row['parent'], 'price' => $row['price'], 'color' => array($row['parent2']), 'image' => $row['pic_small'], 'price_n' => $row['price_n'], 'items' => $row['items'], 'ed_izm' => $row['ed_izm']);

                    if (!empty($value[3]['color']))
                        $color_array[$value[3]['parent2']] = $value[3]['color'];
                    else if (!empty($value[3]['parent2']))
                        $color_array[$value[3]['parent2']] = PHPShopString::getColor($value[3]['parent2']);
                }
            }


            if (is_array($size_color_array)) {
                foreach ($size_color_array as $v) {

                    if (empty($true_size_color_array[$v['size']])) {
                        $true_size_color_array[$v['size']] = $v;
                    } else {
                        $true_size_color_array[$v['size']]['color'][] = $v['color'][0];
                    }
                }
            }


            if (is_array($true_size_color_array) and count($true_size_color_array) > 0) {
                $parentSizeEnabled = true;
                foreach ($true_size_color_array as $key => $val) {

                    // Размер
                    if (empty($key)) {
                        $obj->set('parentSizeHide', 'hide hidden');
                        $obj->set('parentSizeChecked', 'checked');
                        $parentSizeEnabled = false;
                    } else {
                        $obj->set('parentSizeChecked', null);
                    }

                    $obj->set('parentSize', $key);
                    $obj->set('parentId', $val['id']);
                    $obj->set('parentPrice', $val['price']);
                    $obj->set('parentImage', $size_color_array[$val['id']]['image']);
                    $obj->set('parentItems', $obj->lang('product_on_sklad') . " " . $val['items'] . " " . $val['ed_izm']);

                    if (!empty($size_color_array[$val['id']]['price_n']))
                        $obj->set('parentPriceOld', $size_color_array[$val['id']]['price_n']);
                    else
                        $obj->set('parentPriceOld', '');


                    $size .= ParseTemplateReturn("product/product_odnotip_product_parent_one.tpl");

                    // Цвет
                    foreach ($val['color'] as $colors) {
                        $true_color_array[$colors][] = $val['id'];
                    }
                }
            }

            if (is_array($color_array)) {

                foreach ($color_array as $true_name => $true_colors) {
                    $obj->set('parentColor', $true_colors);
                    $obj->set('parentName', $true_name);
                    $id = null;

                    if (is_array($true_color_array[$true_name]))
                        foreach ($true_color_array[$true_name] as $ids) {
                            $id .= ' select-color-' . $ids;
                        }

                    $obj->set('parentColorId', $id);
                    $color .= ParseTemplateReturn("product/product_odnotip_product_parent_one_color.tpl");
                }
            }

            // Отладка
            /*
              print_r($true_size_color_array);
              print_r($true_color_array);
              print_r($color_array);
             */

            if ($parentSizeEnabled)
                $obj->set('parentListSizeTitle', $obj->parent_title);

            $obj->set('parentListSize', $size, true);

            if (!empty($color))
                $obj->set('parentListColorTitle', __('Цвет'));

            $obj->set('parentListColor', $color, true);
            $obj->set('parentSizeMessage', $obj->lang('select_size'));

            // Наличие
            if (!$obj->get('elementCartOptionHide'))
                $obj->set('elementCartOptionHide', null);

            $obj->set('ComStartCart', null);
            $obj->set('ComEndCart', null);
            //$obj->set('productParentJson',json_safe_encode($true_color_array));
            $obj->set('productParentList', ParseTemplateReturn("product/product_odnotip_product_parent.tpl"));
        }
    }
}

function template_UID($obj, $dataArray, $rout) {
    global $PHPShopNav;

    if ($rout == 'MIDDLE') {


        if (!empty($_GET['lego_p'])) {
            $_SESSION['editor'][SkinName]['p'] = intval($_GET['lego_p']);
            header('Location: ' . $PHPShopNav->objNav['truepath']);
        }

        // Форма товара
        if (!empty($_SESSION['editor'][SkinName]['p']))
            $p = intval($_SESSION['editor'][SkinName]['p']);
        else
            $p = $_SESSION['editor'][SkinName]['p'] = 1;

        if (PHPShopParser::checkFile('product/main_product_forma_full_' . $p . '.tpl')) {
            $obj->setValue('templates.main_product_forma_full', 'product/main_product_forma_full_' . $p . '.tpl');
        }

        if ($obj->get('optionsDisp') != '' and $obj->get('parentList') == '') {
            //$obj->set('ComStart','<!--');
            $obj->set('ComStartCart', '<!--');
            $obj->set('ComEndCart', '-->');
            //$obj->set('ComEnd','-->');
            $obj->set('optionsDisp', ParseTemplateReturn("product/product_option_product.tpl"));
        }
        // ‘пецпредложениЯ
        if (!empty($dataArray['spec']))
            $obj->set('specIcon', ParseTemplateReturn('product/specIcon.tpl'));
        else
            $obj->set('specIcon', '');

        // Ќовинки
        if (!empty($dataArray['newtip']))
            $obj->set('newtipIcon', ParseTemplateReturn('product/newtipIcon.tpl'));
        else
            $obj->set('newtipIcon', '');
    }
}

/**
 * Шаблон вывода характеристик виртуальные каталоги
 */
function sortсattemplatehook($value, $n, $title, $vendor) {
    $disp = null;
    if (is_array($value)) {
        foreach ($value as $p) {

            $text = $p[0];
            $checked = null;
            if (is_array($vendor)) {
                foreach ($vendor as $v) {
                    if (is_array($v))
                        foreach ($v as $s)
                            if ($s == $p[1])
                                $checked = 'active';
                }
            }
            if ($p[3] != null)
                $text .= ' (' . $p[3] . ')';

            $disp.= '<a style="background-image: url(' . $p[4] . ');" class="sortcat btn btn-default ' . $checked . '" href="?v[' . $n . '][0]=' . $p[1] . '">' . $text . '</a> ';
        }
    }

    return '<p>' . $disp . '</p>';
}

/**
 * ?????? ?????? ?????????????
 */
function sorttemplatehook($value, $n, $title, $vendor) {
    $limit = 5;
    $disp = null;
    $num = 0;

    if (is_array($value)) {
        foreach ($value as $p) {

            $text = $p[0];
            $checked = null;
            if (is_array($vendor)) {
                foreach ($vendor as $v) {
                    if (is_array($v))
                        foreach ($v as $s)
                            if ($s == $p[1])
                                $checked = 'checked';
                }
            }

            if ($p[3] != null)
                $text .= ' (' . $p[3] . ')';

            // ??????????? ?????
            if ($text[0] == '#')
                $text = '<div class="filter-color" style="background:' . $text . '; border:1px solid ' . $text . '"></div>';

            $disp .= '<div class="checkbox">
  <label>
    <input type="checkbox" value="1" name="' . $n . '-' . $p[1] . '" ' . $checked . ' data-url="v[' . $n . ']=' . $p[1] . '"  data-name="' . $n . '-' . $p[1] . '">
    <span class="filter-item"  title="' . $p[0] . '">' . $text . '</span>
  </label>
</div>';
            $num++;
        }
    }

    if ($num > $limit) {
        $style = "collapse";
        $chevron = 'fa fa-chevron-down';
        $help = '????????';
    } else {
        $style = "collapse in";
        $chevron = 'fa fa-chevron-up';
        $help = '??????';
    }

    return '<div class="faset-filter-block-wrapper grid-item"><h4>' . $title . '</h4><div>' . $disp . '<div class="clearfix"></div></div></div></div>';
}

/**
 *  ???????????
 */
function template_image_gallery($obj, $array) {

    $bxslider = $bxsliderbig = $bxpager = null;
    $PHPShopOrm = new PHPShopOrm($obj->getValue('base.foto'));
    $data = $PHPShopOrm->select(array('*'), array('parent' => '=' . $array['id']), array('order' => 'num'), array('limit' => 100));
    $i = 0;
    $s = 1;

    // Нет данных в галерее
    if (!is_array($data) and !empty($array['pic_big']))
        $data[] = array('name' => $array['pic_big']);

    if (is_array($data)) {

        // ??????????
        foreach ($data as $k => $v) {

            if ($v['name'] == $array['pic_big'])
                $sort_data[0] = $v;
            else
                $sort_data[$s] = $v;

            $s++;
        }

        ksort($sort_data);

        foreach ($sort_data as $k => $row) {
            $name = $row['name'];
            $name_s = str_replace(".", "s.", $name);
            $name_bigstr = str_replace(".", "_big.", $name);

            // ?????? ????????? ???????????
            if (!file_exists($_SERVER['DOCUMENT_ROOT'] . $name_bigstr))
                $name_bigstr = $name;

            $bxslider .= '<div><div class="zoom" data-zoom-image="' . $name_bigstr . '"><a class href="#"><img  data-src="' . $name . '" /></a></div></div>';
            $bxsliderbig .= '<li><a class href=\'#\'><img src=\'' . $name_bigstr . '\'></a></li>';
            $bxpager .= '<a data-slide-index=\'' . $i . '\' href=\'\'><img class=\'img-thumbnail\'  data-src=\'' . $name_s . '\'></a>';
            $i++;
        }


        if ($i < 2)
            $bxpager = null;


        $obj->set('productFotoList', '<img itemprop="image" content="http://' . $_SERVER['SERVER_NAME'] . $array['pic_big'] . '" class="bxslider-pre" alt="' . $array['name'] . '" src="' . $array['pic_big'] . '" /><div class="bxslider hide bigslider">' . $bxslider . '</div><div class="bx-pager">' . $bxpager . '</div>');
        $obj->set('productFotoListBig', '<ul class="bxsliderbig" data-content="' . $bxsliderbig . '" data-page="' . $bxpager . '"></ul><div class="bx-pager-big">' . $bxpager . '</div>');
        return true;
    }
}

$addHandler = array
    (
    'CID_Product' => 'template_CID_Product',
    'parent' => 'template_parent',
    'UID' => 'template_UID',
    'image_gallery' => 'template_image_gallery'
);
?>