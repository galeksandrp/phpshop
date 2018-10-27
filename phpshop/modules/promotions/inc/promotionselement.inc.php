<?php

if (!defined("OBJENABLED"))
    exit(header('Location: /?error=OBJENABLED'));

/**
 * � ��������� ������
 */
function promotion_fix_array($in) {
    $data = array();
    $data[0] = $in;
    
    return $data;
}

/**
 * ���������� ���� ������ ���� �������� ��� 0
 */
function promotion_conv_date($date) {
    $arr = explode('-', $date);
    $date_new = $arr[2] . $arr[1] . $arr[0];
    if(is_numeric($date_new)){
        return intval($date_new);
    } else {
        return 0;
    }   
}

/**
 * ��������� ���������� ����������, ���������� 1 - ������� ��� 0 - ���������
 */
function promotion_check_activity($active, $start, $end) {
    // ��-��������� ��������
    $result = 1;
    $now = intval(date('Ymd')); 
    
    // ���� ����� ��������� ������ � �������� ����
    if($active == 1) {
        $date_start = promotion_conv_date($start);     
        $date_end = promotion_conv_date($end);
        
        if(!empty($date_start) || !empty($date_end)) {
            // ���� ������� ���� ������ ���� ��������� ����������
            if($now > $date_end && !empty($date_end)) {
                $result = 0;
            }
            // ���� ������� ���� ������ ���� ������ ����������
            if($now < $date_start) {
                $result = 0;
            }        
        }     
    } 
    // ���������� ��������
    return $result;    
}

/**
 * ��������� ������� ������� ���������� � ���������� � ����������
 */
function promotion_check_userstatus($active, $statuses) {
    // ��-��������� 
    $result = true;
    if($active == 1 && is_array($statuses)) {
        if(isset($_SESSION['UsersStatus'])) {
            $us = $_SESSION['UsersStatus'];   
        } else {
            $us = '-';
        }
        $result = in_array($us, $statuses);   
    }
    return $result;    
}

/**
 * ���������� ���������� � ������� �� ����������� �����������
 * $with_desc - ���������� �������� (��� �������� ������) 
 */
function promotion_get_discount($row, $with_desc = false) {
    global $promotionslist, $promotionslistCode;
    
    //��������� ������ ���� ������ ����
    if (!isset($promotionslist[0]['code'])) {
        $data[0] = $promotionslist;
    } else {
        $data = $promotionslist;    
    }
    
    //������� ���������� �� ������� �� ���������� �� �������� ������
    if ($with_desc) {
        if (!empty($promotionslistCode)) {
            if (!isset($promotionslistCode[0]['code'])) {
                $data[] = $promotionslistCode;
            } else {
                foreach ($promotionslistCode as $pro)
                    $data[] = $pro;
            }
        }
    }
    
    $promo_discount = $promo_discountsum = 0; 
    $description = $lab = '';
    $labels = $descriptions = array();
    
    if (isset($data)) {
        foreach ($data as $key => $pro) {
            // �������� ���������� ����������                
            $date_act = promotion_check_activity($pro['active_check'], $pro['active_date_ot'], $pro['active_date_do']);
            $user_act = promotion_check_userstatus($pro['status_check'], unserialize($pro['statuses']));
            
            if($date_act == 1 && $user_act) {
                //������ ��������� ��� ����� ����
                if ($pro['categories_check'] == 1):
                    //��������� ������
                    $category_ar = explode(',', $pro['categories']);
                endif;

                if ($pro['products_check'] == 1):
                    //��������� ������
                    $products_ar = explode(',', $pro['products']);
                endif;

                $sumche = $sumchep = 0;
                // �� ������� ���� ��� �������� ����� �������� ������� ����
                if (empty($row['price_n']) or empty($pro['block_old_price'])) {
                    
                    //������ �� ����� ����������
                    if (isset($category_ar)) {
                        foreach ($category_ar as $val_c) {
                            if ($val_c == $row['category']) {
                                $sumche = 1;
                                break;
                            } else {
                                $sumche = 0;
                            }
                        }
                    }
    
                    //������ �� ����� �������
                    if (isset($products_ar)) {
                        foreach ($products_ar as $val_p) {
                            if ($val_p == $row['id']) {
                                $sumchep = 1;
                                break;
                            } else {
                                $sumchep = 0;
                            }
                        }
                    }
                }
                
                //�������� ��������� � ������
                unset($category_ar);
                unset($products_ar);
                
                if ($sumche == 1 || $sumchep == 1) {
                    //���� �������
                    if ($pro['discount_tip'] == 1) {
                        $discount[] = $pro['discount'];
                        $labels[$pro['discount']] = $pro['label'];
                        if ($with_desc) $descriptions[$pro['id']] = '<div>' . $pro['description'] . '</div>';
                    }
                    if ($pro['discount_tip'] == 0) {
                        $discountsum[] = $pro['discount'];
                        $labels[$pro['discount']] = $pro['label'];
                        if ($with_desc) $descriptions[$pro['id']] = '<div>' . $pro['description'] . '</div>';
                    }
                }
            }
        }
        
        //����� ����� ������� ������
        if (isset($discount)) {
            $promo_discount = max($discount) / 100;
            $lab = $labels[$promo_discount*100];
        }

        if (isset($discountsum)) {
            $promo_discountsum = max($discountsum);
            $lab = $labels[$promo_discountsum];            
        }
        
        if ($with_desc && !empty($descriptions))
            $description = implode('', $descriptions);
    }
    
    return array('percent' => $promo_discount, 'sum' => $promo_discountsum, 'label' => $lab, 'description' => $description);
}

class AddToTemplateRegionElement extends PHPShopElements {

    var $debug = false;

    function display() {
        global $PHPShopModules;

            $PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.promotions.promotions_forms"));
            $PHPShopOrm->debug=false;
            $where['code'] = '="'.PHPShopSecurity::TotalClean(trim('*')).'"';
            $where['enabled'] = '="1"';
            $GLOBALS['promotionslist'] = $promotionslist = $PHPShopOrm->select(array('*'),$where,array('order'=>'id'));

            $whereCode['code'] = '!="*"';
            $whereCode['enabled'] = '="1"';
            $GLOBALS['promotionslistCode'] = $promotionslistCode = $PHPShopOrm->select(array('*'),$whereCode,array('order'=>'id'),array('limit'=>'300'));

    }

}

$AddToTemplateRegionElement = new AddToTemplateRegionElement();
$AddToTemplateRegionElement->display();
?>