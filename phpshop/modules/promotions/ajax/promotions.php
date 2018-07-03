<?php

/**
 * ����������
 * @package PHPShopAjaxElements
 */
session_start();

$_classPath = "../../../";
include($_classPath . "class/obj.class.php");
PHPShopObj::loadClass("base");
$PHPShopBase = new PHPShopBase($_classPath . "inc/config.ini");
PHPShopObj::loadClass("order");
PHPShopObj::loadClass("modules");
PHPShopObj::loadClass("array");
PHPShopObj::loadClass("orm");
PHPShopObj::loadClass("product");
PHPShopObj::loadClass("system");
PHPShopObj::loadClass("valuta");
PHPShopObj::loadClass("string");
PHPShopObj::loadClass("cart");
PHPShopObj::loadClass("security");
PHPShopObj::loadClass("user");

// ���������� ���������� ��������� JsHttpRequest
if($_REQUEST['type'] != 'json'){
require_once $_classPath . "/lib/Subsys/JsHttpRequest/Php.php";
$JsHttpRequest = new Subsys_JsHttpRequest_Php("windows-1251");
}
else{
    $_REQUEST['promocode']=PHPShopString::utf8_win1251($_REQUEST['promocode']);
    $_REQUEST['sum']=PHPShopString::utf8_win1251($_REQUEST['sum']);
    $_REQUEST['ssum']=PHPShopString::utf8_win1251($_REQUEST['ssum']);
    $_REQUEST['tipoplcheck']=PHPShopString::utf8_win1251($_REQUEST['tipoplcheck']);
    $_REQUEST['wsum']=PHPShopString::utf8_win1251($_REQUEST['wsum']);
}


// ���������� ���������� ��������
require_once $_classPath . "core/order.core/delivery.php";

// ������� ��� ������
$PHPShopOrder = new PHPShopOrderFunction();

// ������
$PHPShopModules = new PHPShopModules($_classPath . "modules/");

// ��������� ���������
$PHPShopSystem = new PHPShopSystem();

function GetDeliveryPrice($deliveryID, $sum, $weight = 0) {
    global $SysValue,$link_db;

    if (!empty($deliveryID)) {
        $sql = "select * from " . $SysValue['base']['table_name30'] . " where id='$deliveryID' and enabled='1'";
        $result = mysqli_query($link_db,$sql);
        $num = mysqli_num_rows($result);
        $row = mysqli_fetch_array($result);

        if ($num == 0) {
            $sql = "select * from " . $SysValue['base']['table_name30'] . " where flag='1' and enabled='1'";
            $result = mysqli_query($link_db,$sql);
            $row = mysqli_fetch_array($result);
        }
    } else {
        $sql = "select * from " . $SysValue['base']['table_name30'] . " where flag='1' and enabled='1'";
        $result = mysqli_query($link_db,$sql);
        $row = mysqli_fetch_array($result);
    }

    if ($row['price_null_enabled'] == 1 and $sum >= $row['price_null']) {
        return 0;
    } else {
        if ($row['taxa'] > 0) {
            $addweight = $weight - 500;
            if ($addweight < 0) {
                $addweight = 0;
                $at = '';
            } else {
                $at = '';
                //$at='���: '.$weight.' ��. ����������: '.$addweight.' ��. ���������:'.ceil($addweight/500).' = ';
            }
            $addweight = ceil($addweight / 500) * $row['taxa'];
            $endprice = $row['price'] + $addweight;
            return $at . $endprice;
        } else {
            return $row['price'];
        }
    }
}


$PHPShopOrm = new PHPShopOrm($PHPShopModules->getParam("base.promotions.promotions_forms"));
$PHPShopOrm->debug=false;
$where['code'] = '="'.PHPShopSecurity::TotalClean(trim($_REQUEST['promocode'])).'"';
$where['enabled'] = '="1"';
$data = $PHPShopOrm->select(array('*'),$where,array('order'=>'id'));

//���� ����� ��� ����������
if($_REQUEST['promocode']!='*') {

    //���� ��� ��������
    if($data['code']!=''):
        //���� �� ������
        if($data['discount_check']==1):
            //��������� ��������� ���� ������
            if($_REQUEST['tipoplcheck']!=$data['delivery_method'] and $data['delivery_method_check']==1) {

                //������ ��� ������
                $sq_pay = 'select name from '.$SysValue['base']['payment_systems'].' where id='.$data['delivery_method'];
                $qu_pay = mysqli_query($link_db,$sq_pay);
                $ro_pay = mysqli_fetch_array($qu_pay);

                $messageinfo = '<b style="color:#7e7a13;">�� �������� ��� ������!</b><br> ��� ������� �����-���� ��� ������ ����� ���� ������ <b>'.$ro_pay['name'].'</b>. �������� ���� ��� ������ � ������� ����� ������ �� ��� ���������� ������';
                $action = '1'; //�������� ��������������� �� ������ �����
                $status = '0'; //�� ��������� ������
            }
            else {
                //������ ��������� ��� ����� ����
                if($data['categories_check']==1):
                    //��������� ������
                    $category_ar = explode(',', $data['categories']);
                endif;

                if($data['products_check']==1):
                    //��������� ������
                    $products_ar = explode(',', $data['products']);
                endif;

                foreach ($_SESSION['cart'] as $rs=>$valuecart) {

                    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['table_name2']);
                    $row = $PHPShopOrm->select(array('*'), array('id' => '='.intval($valuecart['id']) ), array('order' => 'id desc'), array('limit' => 1));

                    //������ �� ����� ���������� ����� ������ �� �������
                    if(isset($category_ar)) {
                        foreach ($category_ar as $val_c) {
                            if($val_c==$row['category']) {
                                $sumche = 1;
                                $info_prod_d_f .= $row['name'].', ';
                                break;
                            }
                            else {
                                $sumche = 0;
                            }
                        }
                    }

                    //������ �� ����� ������� ����� ������ �� �������
                    if(isset($products_ar)) {
                        foreach ($products_ar as $val_p) {
                            if($val_p==$row['id']) {
                                $sumchep = 1;
                                $info_prod_d_f .= $row['name'].', ';
                                break;
                            }
                            else {
                                $sumchep = 0;
                            }
                        }
                    }
                    
                    if($sumche==1 or $sumchep==1):
                        $sumnew += $valuecart['price']*$valuecart['num'];

                        //���� �������
                        if($data['discount_tip']==1) {
                            // ������ � ���
                            $discount = $data['discount'];
                            $tip_disc = '%';
                            $idgg = intval($valuecart['id']);
                            if($idgg>=1) {
                                // ������ � ������ (���-�� | ���)
                                $_SESSION['cart'][$rs]['discount'] = $discount;
                                $_SESSION['cart'][$rs]['discount_tip'] = $tip_disc;
                            }
                        }
                        else { //���� �����
                            //������ � ���
                            $discount_sum = $data['discount'];
                            $tip_disc = '���.';
                            $idgg = intval($valuecart['id']);
                            if($idgg>=1) {
                                // ������ � ������ (���-�� | ���)
                                $_SESSION['cart'][$rs]['discount_sum'] = $discount;
                                $_SESSION['cart'][$rs]['discount_tip_sum'] = $tip_disc;
                            }
                        }
                    else:
                        $sumoldi += $valuecart['price']*$valuecart['num'];
                    endif;
                }
                //���������� � ������� � ������� ��������� ������
                if($info_prod_d_f!='') {
                    $info_prod_d = '<hr><b>������ ��������� ��� �������:</b> '.$info_prod_d_f;
                }

                //���� �������
                if($data['discount_tip']==1) {
                    //������� ������
                    $discount = $data['discount']/100;
                    //����� �� ������� ���������� ������
                    $sumtot_new = $sumnew - ($sumnew * $discount);
                    //����� ��� ������
                    $sumtot_old = $sumoldi;
                    //��� ������
                    $tip_disc = '%';
                    //���������� � �������
                    $discountAll = $data['discount'].' '.$tip_disc;
                    //������ � ������
                    $_SESSION['discpromo'] = $data['discount'];
                    $_SESSION['tip_disc'] = 1;
                }
                else { //���� �����
                    //����� ������
                    $discount_sum = $data['discount'];
                    //����� �� ������� ���������� ������
                    $sumtot_new = $sumnew - $discount_sum;
                    //���� ����� ����� ���� � �����, �� ������ ����
                    if($sumtot_new<0) {
                        $sumtot_new = 0;
                    }
                    //����� ��� ������
                    $sumtot_old = $sumoldi;
                    //��� ������
                    $tip_disc = '���.';
                    //���������� � �������
                    $discountAll = $data['discount'].' '.$tip_disc;
                    $_SESSION['discpromo'] = $data['discount'];
                    $_SESSION['tip_disc'] = 0;
                }


                $versphp = phpversion(); //5.3.0
                //$versphp = "4.1.1";
                $version_status = version_compare($versphp,"5.3.0");

                if($version_status!='-1') {
                    //�������� ���������� �� ����
                    if($data['active_check']==1) {
                        //���� �������
                        $date_today = date("d-m-Y");
                        //���� �� � ��
                        $date_ot = $data['active_date_ot'];
                        $date_do = $data['active_date_do'];
                        //����� ������ �� � ��
                        $d_ot_ar = explode('-', $data['active_date_ot']);
                        $d_do_ar = explode('-', $data['active_date_do']);
                        $date_f_ot = $d_ot_ar[2].'-'.$d_ot_ar[1].'-'.$d_ot_ar[0];
                        $date_f_do = $d_do_ar[2].'-'.$d_do_ar[1].'-'.$d_do_ar[0];
                        //������ ���
                        $begin = new DateTime( $date_f_ot );
                        $end = new DateTime( $date_f_do );
                        $end = $end->modify( '+1 day' ); 
                        $interval = new DateInterval('P1D');
                        $daterange = new DatePeriod($begin, $interval ,$end);

                        if(isset($daterange)) {
                            foreach($daterange as $date){
                                $data_interval = $date->format("d-m-Y");
                                if($date_today==$data_interval) {
                                    $date_act = 1;
                                    break;
                                }
                            }
                        }
                    }
                    else {
                        $date_act=1; //������ ������������� ���������� ���� ����� ���� ��������� � ����������
                    }
                }
                else {
                        $date_act=1; //������ ������������� ���������� ���� ����� ���� ��������� � ����������
                }

                //���� �� ��������� ������
                if($sumtot_new!=''):
                    //���� ���� ������� � ����������
                    if($date_act==1) {
                        //����� �����
                        $totalsumma_t = $sumtot_new + $sumtot_old;
                        //��������� ����� ��
                        if($data['sum_order_check']==1):
                            if($totalsumma_t>=$data['sum_order']) {
                                $sumordercheck = 1;
                            }
                            else {
                                $sumordercheck = 0;
                            }
                        else:
                            $sumordercheck = 1; //������ �������� ����� �� ���� ������� � ���������� �� �����������
                        endif;

                        //��������� ���������� ��������
                        if($data['free_delivery']==1):
                            $freedelivery = 0;
                            $_SESSION['freedelivery'] = 0;
                        else:
                            //������� ������ ��� ���������� ��������
                            $_SESSION['freedelivery'] = 1;
                            $dostavka = GetDeliveryPrice(intval($_REQUEST['dostavka']), $totalsumma_t, $_REQUEST['wsum']);
                        endif;

                        if($sumordercheck==1):
                            $status = '1'; //������ ���������
                            
                            //������� ������
                            if($data['delivery_method_check']==1) {
                                $delivery_method_check = 1;
                                $totalsumma = $sumtot_new + $sumtot_old + $dostavka;
                                $totalsummainput = $sumtot_new + $sumtot_old + $dostavka;
                            }
                            else {
                                $totalsumma = $sumtot_new + $sumtot_old + $dostavka;
                                if($_REQUEST['sum']>$totalsumma) {
                                    $delivery_method_check = 0;
                                    $totalsummainput = $sumtot_new + $sumtot_old;
                                    $_SESSION['totalsumma'] = $totalsumma;
                                    $_SESSION['promocode'] = $data['code'];
                                    $_SESSION['codetip'] = $data['code_tip'];
                                    //������� ���� ��� ������
                                    foreach ($_SESSION['cart'] as $is=>$valcar) {
                                        //������� ���� � ������
                                        unset($_SESSION['cart'][$is]['discount']);
                                        unset($_SESSION['cart'][$is]['discount_tip']);
                                        unset($_SESSION['cart'][$is]['id_sys']);
                                    }
                                    $messageinfo = '<b style="color:#137e15;">����������� � �������������!</b><br> ����� ��� ������ �����! ���� ������ '.$data['discount'].' '.$tip_disc.$info_cat_d.$info_prod_d;  
                                }
                                else {
                                    $totalsumma = $_REQUEST['sum'];
                                    $totalsummainput = $_REQUEST['sum'];
                                }
                                  
                            }
                        else:
                            $messageinfo = '<b style="color:#7e7a13;">�� ���������!</b><br> ����� ��� ������ �����.<br> �� ����� ������ ������ ���� �� '.$data['sum_order']. ' ���.';
                            $status = '0'; //������ �� ���������
                            $_SESSION['totalsumma'] = '0';
                        endif;
                    }
                    else { //���� ���� �� �������
                        $messageinfo = '<b style="color:#7e7a13;">�� ���������!</b><br> ����� ��� ������ �����.<br> �� ���� �������� ����� ��������';
                        $status = '0'; //������ �� ���������
                        $_SESSION['totalsumma'] = '0';
                    }
                else:
                    $messageinfo = '<b style="color:#7e7a13;">�� ���������!</b><br> ����� ��� ������ �����.<br> �� �� ���� �� ������� � ����� ������� �� ��������� � �����';
                    $status = '0'; //������ �� ���������
                    $_SESSION['totalsumma'] = '0';
                endif;
            }
        else:
            $messageinfo = '<b style="color:#7e7a13;">������!</b><br> ������ ��� ��������� �� �����������, ��������� � ���� ��� ��������� ����������!';
            $status = '0'; //�� ��������� ������
            $_SESSION['totalsumma'] = '0';
        endif;
    else:
        $messageinfo = '<b style="color:#7e7a13;">������!</b><br> ������� �����-���� � ���� ������ �� ����������!';
        $status = '0'; //�� ��������� ������
    endif;

    //������� ������ ������ ��� JS
    $numc = 3; //��� ��������� ������� �������
    foreach ($_SESSION['cart'] as $cartjs) {
        $discountcart[$cartjs['id']]['n'] = $numc;
        $numc++;
    }
}
elseif($_REQUEST['promocode']=='*') {//���� ��������� ��� ����� ���� ������

    //��������� ������ ���� ������ ����
    if($data[0]['code']=='') {
        $data[0] = $data;
    }

    foreach ($_SESSION['cart'] as $is=>$valcar) {
        //������� ���� � ������
        $id = intval($valcar['id']);
        
        if($id>=1) {
            unset($_SESSION['cart'][$is]['discount']);
            unset($_SESSION['cart'][$is]['discount_tip']);
            unset($_SESSION['cart'][$is]['id_sys']);
        }
    }

    foreach ($data as $pro) {
        //��������� ��������� ���� ������
        if($_REQUEST['tipoplcheck']!=$pro['delivery_method'] and $pro['delivery_method_check']==1) {
            //������ ������ �� ������, ���� ��� ������ �� ��������
        }
        else {
            

            $sumpo_s = '';
            $sumpo_p = '';

            foreach ($_SESSION['cart'] as $valuecart) {

                $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['table_name2']);
                $row = $PHPShopOrm->select(array('*'), array('id' => '='.intval($valuecart['id']) ), array('order' => 'id desc'), array('limit' => 1));

                //������ ��������� ��� ����� ����
                if($pro['categories_check']==1):
                    //��������� ������
                    $category_ar = explode(',', $pro['categories']);
                endif;

                if($pro['products_check']==1):
                    //��������� ������
                    $products_ar = explode(',', $pro['products']);
                endif;

                $sumche = 0;
                $sumchep = 0;

                //������ �� ����� ���������� ����� ������ �� �������
                if(isset($category_ar)) {
                    foreach ($category_ar as $val_c) {
                        if($val_c==$row['category']) {
                            $sumche = 1;
                            $info_prod_d_f .= $row['name'].', ';
                            break;
                        }
                        else {
                            $sumche = 0;
                        }
                    }
                }

                //������ �� ����� ������� ����� ������ �� �������
                if(isset($products_ar)) {
                    foreach ($products_ar as $val_p) {
                        if($val_p==$row['id']) {
                            $sumchep = 1;
                            $info_prod_d_f .= $row['name'].', ';
                            break;
                        }
                        else {
                            $sumchep = 0;
                        }
                    }
                }

                unset($category_ar);
                unset($products_ar);
                
                if($sumche==1 or $sumchep==1) {
                    $sumnew += $valuecart['price']*$valuecart['num'];

                    //���� �������
                    if($pro['discount_tip']==1) {
                        // ������ � ���
                        $discount = $pro['discount'];
                        $tip_disc = '%';
                        // ������ � ������ (���-�� | ���)
                        //���� ������ ����, �� ����������
                        if($_SESSION['cart'][$valuecart['id']]['discount']!='') {
                            if($tip_disc==$_SESSION['cart'][$valuecart['id']]['discount_tip']) {
                                $ddnew = max($_SESSION['cart'][$valuecart['id']]['discount'], $discount);
                                $discount_v_p = $ddnew;
                                $tip_disc_v_p = $tip_disc;
                            }
                            else {
                                $discount_v_p = $discount;
                                $tip_disc_v_p = $tip_disc;
                            }
                        }
                        else {
                            $discount_v_p = $discount;
                            $tip_disc_v_p = $tip_disc;
                        }
                        $dispr = $discount/100;
                        $sumpo_p = ($valuecart['price']*$valuecart['num']) - ( ($valuecart['price']*$valuecart['num']) * $dispr );
                    }

                    if($pro['discount_tip']==0) { //���� �����
                        //������ � ���
                        $discount_sum = $pro['discount'];
                        $tip_disc = '���.';
                        // ������ � ������ (���-�� | ���)
                        
                        if($_SESSION['cart'][$valuecart['id']]['discount']!='') {
                            if($tip_disc==$_SESSION['cart'][$valuecart['id']]['discount_tip']) {
                                //���� �������� ���� (���� �� ��������, ������ ��������� ��� ����, �.� �������)
                                $ddnew = max($_SESSION['cart'][$valuecart['id']]['discount'], $discount_sum);
                                $discount_v_s = $ddnew;
                                $tip_disc_v_s = $tip_disc;
                            }
                            else {
                                $discount_v_s = $discount_sum;
                                $tip_disc_v_s = $tip_disc;
                            }
                        }
                        else {
                            $discount_v_s = $discount_sum;
                            $tip_disc_v_s = $tip_disc;
                        }

                        $sumpo_s = ($valuecart['price']*$valuecart['num']) - $discount_sum;
                    }

                    //�������� ������ ������
                    if($sumpo_s=='') {
                        $sumpo_s = ($valuecart['price']*$valuecart['num'])*100;
                    }
                    if($sumpo_p=='') {
                        $sumpo_p = ($valuecart['price']*$valuecart['num'])*100;
                    }

                    //������ ����������� �����
                    $sumitogn = min($sumpo_s, $sumpo_p);

                    $sumitogn.'|'.$sumpo_p.'!';
                    $sumitogn.'|'.$sumpo_s.'!';

                    //�������� ����� ������ ���������
                    if($sumitogn==$sumpo_p) {
                        $_SESSION['cart'][$valuecart['id']]['discount'] = $discount_v_p;
                        $_SESSION['cart'][$valuecart['id']]['discount_tip'] = $tip_disc_v_p;
                    }
                    if($sumitogn==$sumpo_s) {
                        $_SESSION['cart'][$valuecart['id']]['discount'] = $discount_v_s;
                        $_SESSION['cart'][$valuecart['id']]['discount_tip'] = $tip_disc_v_s;
                        $_SESSION['cart'][$valuecart['id']]['id_sys'] = $pro['id'];
                    }

                }
                else {
                    $sumoldi += $valuecart['price']*$valuecart['num'];
                }
            }
            //���������� � ������� � ������� ��������� ������
            if($info_prod_d_f!='') {
                $info_prod_d = '<hr><b>������ ��������� ��� �������:</b> '.$info_prod_d_f;
            }

            //���� �������
            if($pro['discount_tip']==1) {
                //������� ������
                $discount = $pro['discount']/100;
                //����� �� ������� ���������� ������
                $sumtot_new = $sumnew - ($sumnew * $discount);
                //����� ��� ������
                $sumtot_old = $sumoldi;
                //��� ������
                $tip_disc = '%';
                //���������� � �������
                $discountAll = '�����';
                //������ � ������
                $_SESSION['discpromo'] = $pro['discount'];
                $_SESSION['tip_disc'] = 1;
            }
            else { //���� �����
                //����� ������
                $discount_sum = $pro['discount'];
                //����� �� ������� ���������� ������
                $sumtot_new = $sumnew - $discount_sum;
                //���� ����� ����� ���� � �����, �� ������ ����
                if($sumtot_new<0) {
                    $sumtot_new = 0;
                }
                //����� ��� ������
                $sumtot_old = $sumoldi;
                //��� ������
                $tip_disc = '���.';
                //���������� � �������
                $discountAll = '�����';
                $_SESSION['discpromo'] = $pro['discount'];
                $_SESSION['tip_disc'] = 0;
            }

            //�������� ���������� �� ����
            if($pro['active_check']==1) {
                //���� �������
                $date_today = date("d-m-Y");
                //���� �� � ��
                $date_ot = $pro['active_date_ot'];
                $date_do = $pro['active_date_do'];
                //����� ������ �� � ��
                $d_ot_ar = explode('-', $pro['active_date_ot']);
                $d_do_ar = explode('-', $pro['active_date_do']);
                $date_f_ot = $d_ot_ar[2].'-'.$d_ot_ar[1].'-'.$d_ot_ar[0];
                $date_f_do = $d_do_ar[2].'-'.$d_do_ar[1].'-'.$d_do_ar[0];
                //������ ���
                $begin = new DateTime( $date_f_ot );
                $end = new DateTime( $date_f_do );
                $end = $end->modify( '+1 day' ); 
                $interval = new DateInterval('P1D');
                $daterange = new DatePeriod($begin, $interval ,$end);

                if(isset($daterange)) {
                    foreach($daterange as $date){
                        $data_interval = $date->format("d-m-Y");
                        if($date_today==$data_interval) {
                            $date_act = 1;
                            break;
                        }
                        else {
                            $date_act = 0;
                        }
                    }
                }
            }
            else {
                $date_act=1; //������ ������������� ���������� ���� ����� ���� ��������� � ����������
            }


            //���� �� ��������� ������
            if($sumtot_new!='0'):
                //���� ���� ������� � ����������
                if($date_act==1) {
                    //����� �����
                    $totalsumma_t = $sumtot_new + $sumtot_old;
                    //��������� ����� ��
                    if($pro['sum_order_check']==1):
                        if($totalsumma_t>=$pro['sum_order']) {
                            $sumordercheck = 1;
                        }
                        else {
                            $sumordercheck = 0;
                        }
                    else:
                        $sumordercheck = 1; //������ �������� ����� �� ���� ������� � ���������� �� �����������
                    endif;

                    //��������� ���������� ��������
                    if($pro['free_delivery']==1):
                        $free_delivery_inf = 1;
                    endif;

                    if($sumordercheck==1):
                        $status = '9'; //������ ���������, �����
                        $_SESSION['promocode'] = $pro['code'];
                        $_SESSION['codetip'] = $pro['code_tip'];
                        //������� ������
                        if($pro['delivery_method_check']==1) {
                            $delivery_method_check = 1;
                        }
                        else {
                            $delivery_method_check = 0;
                        }
                    else:
                        $status = '0'; //������ �� ���������
                    endif;
                }
                else { //���� ���� �� �������
                    $status = '0'; //������ �� ���������
                }
            else:
                $status = '0'; //������ �� ���������
            endif;
        }
    }

    //����������� ������ ���� � �����
    $nr = 1;
    foreach ($_SESSION['cart'] as $ca) {
        if(intval($ca['id_sys'])>=1) {
            $ndiscsum_ar[$ca['id_sys']] += $nr;
        }
    }

    //�������������� session ���� � �����
    foreach ($_SESSION['cart'] as $caupd) {
        if(intval($caupd['id_sys'])>=1) {
            $count_d = $ndiscsum_ar[ $caupd['id_sys'] ];
            if($count_d>=2) {
                $sum_sd = $_SESSION['cart'][$caupd['id']]['discount'];
                $_SESSION['cart'][$caupd['id']]['discount'] = round($sum_sd, 2);
            }
        }
    }


    //������� ������ ������ ��� JS
    $numc = 3; //��� ��������� ������� �������
    $totalsumma = '0'; //�������� �� ������
    foreach ($_SESSION['cart'] as $cartjs) {
        $discountcart[$cartjs['id']]['n'] = $numc;
        $discountcart[$cartjs['id']]['discount'] = $cartjs['discount'];
        $discountcart[$cartjs['id']]['discount_tip'] = PHPShopString::win_utf8($cartjs['discount_tip']);
        $discountcart[$cartjs['id']]['num_product'] = $cartjs['num'];
        
        unset($tsumItogAr);

        //������ � ����� ����� ����������� ���
        if($cartjs['discount_tip']=='%') {
            $sucart = $cartjs['price']*$cartjs['num'];
            $dit = $cartjs['discount']/100;
            $tsumItogAr[] = $sucart - ($sucart*$dit);
        }

        if($cartjs['discount_tip']=='���.') {
            if($cartjs['discount']!='') {
                $tsumItogAr[] = ($cartjs['price']*$cartjs['num']) - ($cartjs['discount']*$cartjs['num']);
            }
            else {
                 $tsumItogAr[] = $cartjs['price']*$cartjs['num'];
            }
            if($tsum<0) {
                $tsumItogAr[] = 0;
            }
        }

        if($cartjs['discount_tip']=='') {
            $tsumItogAr[] = $cartjs['price']*$cartjs['num'];
        }

        if(isset($tsumItogAr))
            $tsumItog = min($tsumItogAr);

        $tsum = $tsumItog;

        $totalsumma += $tsum;
        $numc++;
    }
    $_SESSION['totalsumma'] = $totalsumma;
    $totalsummainput = $totalsumma;

    if($_SESSION['promocode']=='*') {
        $status = 9; //��������� ������
    }
    else {
        $status = 0; //�� ���������
    }

    //��������� ���������� ��������
    if($free_delivery_inf==1):
        $freedelivery = 0;
        $_SESSION['freedelivery'] = 0;
    else:
        //������� ������ ��� ���������� ��������
        $_SESSION['freedelivery'] = 1;
    endif;

}


// ���������
$_RESULT = array(
    'delivery' => $GetDeliveryPrice,
    'dellist' => $dellist,
    'adresList' => $adresList,
    'total' => $totalsumma,
    'discount' => $data['discount'],
    'discountall' => $discountAll,
    'mes' => $messageinfo,
    'action' => $action,
    'status' => $status,
    'freedelivery' => $freedelivery,
    'totalsummainput' => $totalsummainput,
    'deliverymethodcheck' => $delivery_method_check,
    'discountcart' => $discountcart,
    'success' => 1
);


// JSON 
if($_REQUEST['type'] == 'json') {
    $_RESULT['mes']=PHPShopString::win_utf8($_RESULT['mes']);
    $_RESULT['discountall']=PHPShopString::win_utf8($_RESULT['discountall']);
    $_RESULT['mesclean']=  strip_tags($_RESULT['mes']);
    //$_RESULT['discountcart']=PHPShopString::win_utf8($_RESULT['discountcart']);
}
    echo json_encode($_RESULT);
?>