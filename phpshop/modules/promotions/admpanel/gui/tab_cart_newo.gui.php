<?php

/**
 * ������ ���������� �������� ������
 * @param array $row ������ ������
 * @return string 
 */
function tab_cart_newo($data, $option = false) {
    global $PHPShopInterface, $PHPShopGUI;


    $PHPShopInterface->action_title['cart-value-edit'] = '�������������';
    $PHPShopInterface->action_title['cart-value-remove'] = '�������';


    // ���������� ������
    $PHPShopOrder = new PHPShopOrderFunction($data['id']);

    $order = unserialize($data['orders']);
    $status = unserialize($data['status']);

    $CART = $order['Cart'];
    $PERSON = $order['Person'];
    $cart = $CART['cart'];
    $_SESSION['selectCart']=$cart;
    $num = $data_id = $sum = null;
    $n = 1;
    
    // ���� �����
    if ($PHPShopOrder->default_valuta_iso == 'RUB')
        $currency = ' <span class="rubznak">p</span>';
    else $currency = $PHPShopOrder->default_valuta_iso;

    $PHPShopInterface->_CODE = '';
    $PHPShopInterface->checkbox_action = false;
    $PHPShopInterface->dropdown_action_form = false;
    $PHPShopInterface->setCaption(array("������������", "50%"), array("����", "15%"), array('���-��', "10%", array('align' => 'center')), array(null, "10%"), array('�����', '15%', array('align' => 'right')));

    if (sizeof($cart) != 0)
        if (is_array($cart))
            foreach ($cart as $val) {

                $sum = $val['price'] * $val['num'];
                if($val['discount']!='') {
                    if($val['discount_tip']!='%') {
                        $price_discount = $val['price'] - ($val['discount']);
                        $ted = ($val['discount']*$val['num']).' '.$val['discount_tip'];
                        $sumitog = $price_discount*$val['num'];
                    }
                    else {
                        $di = $val['discount']/100;
                        $price_discount = $val['price'] - ($sum*$di);
                        $ted = $val['discount'].$val['discount_tip'];
                        $sumitog = $price_discount*$val['num'];
                    }
                    $text_di = '<p>'.$price_discount.$currency.' <strike style="color:#ccc;">'.$val['price'].$currency.'</strike></p><i style="color:#808080;">������ '.$ted.'</i>';

                }
                else {
                    $text_di = $val['price'].$currency;
                    $sumitog = $val['num'] * $val['price'];
                }

                if (!empty($val['id'])) {
                    
                    if (!empty($val['uid']))
                        $code = '�������: ' . $val['uid'];
                    else
                        $code = '���: ' . $val['id'];

                    $name = '
<div class="media">
  <div class="media-left">
    <a href="?path=product&id=' . $val['id'] . '" >
      <img class="media-object" src="' . $val['pic_small'] . '" alt="' . $val['name'] . '" onerror="imgerror()">
    </a>
  </div>
   <div class="media-body">
    <div class="media-heading"><a href="?path=product&id=' . $val['id'] . '" >' . $val['name'] . '</a></div>
    ' . $code . '
  </div>
</div>';


                    $PHPShopInterface->setRow(array('name' => $name, 'align' => 'left'), $text_di, array('name' => $val['num'], 'align' => 'center'), array('action' => array('cart-value-edit', '|', 'cart-value-remove', 'id' => $val['id']), 'align' => 'center'), array('name' => $sumitog.$currency, 'align' => 'right'));

                    $n++;
                    $num+=$val['num'];
                    $sum+=$val['price'] * $val['num'];
                }
            }

    if($PERSON['discount']>0) {
      $discount = $PERSON['discount'].'%';
    }
    else {
      $discount = ($PERSON['tip_disc']==1 ? $PERSON['discount_promo'].'%' : $PERSON['discount_promo'].' ���.'); 
    }


      $total = '<table class="pull-right totals">
      <tbody>
      <tr>
      <td>&nbsp;</td>
      <td class="text-right"><h4>�����</h4></td>
      </tr>
      <tr>
      <td>��������:</td>
      <td class="text-right">
      ' . $PHPShopOrder->getDeliverySumma().  $currency. '
      </td>
      </tr>

      
      <tr>
      <td><h5>�����:</h5></td>
      <td class="text-right">
      <h5 class="text-success">' . ($PHPShopOrder->getTotal(false, ' ')) . $currency . '</h5>
      </td>
      </tr>
      </tbody>
      </table>';
    
    // ������
    if(!empty($PERSON['discount']))
        $discount = $PERSON['discount'];
    else $discount=null;



    // ����� ������
    $blank.=$PHPShopGUI->setButton(__('����� ������'), 'print', 'btn-print-order','/phpshop/modules/promotions/admpanel/formso/forma.php?orderID=' . $data['id']);

    // �������� ���
    $blank.=$PHPShopGUI->setButton(__('�������� ���'), 'bookmark', 'btn-print-order','/phpshop/modules/promotions/admpanel/formso/forma2.php?orderID=' . $data['id']);

    // ����
    $blank.=$PHPShopGUI->setButton(__('���� � ����'), 'credit-card', 'btn-print-order','/phpshop/modules/promotions/admpanel/formso/account/forma.html?orderId='.$data['id'].'&tip=2&datas='.$data['datas']);

    // ���� � ��������
    $blank.=$PHPShopGUI->setButton(__('��������'), 'list-alt', 'btn-print-order','../../../phpshop/forms/receipt/forma.html?orderId='.$data['id'].'&tip=2&datas='.$data['datas']);
    
    // ����-�������
    $blank.=$PHPShopGUI->setButton(__('����-�������'), 'barcode', 'btn-print-order','/phpshop/modules/promotions/admpanel/formso/forma4.php?orderID=' . $data['id'] );
    
        // ����-12
    $blank.=$PHPShopGUI->setButton(__('����-12'), 'qrcode', 'btn-print-order','/phpshop/modules/promotions/admpanel/formso/forma5.php?orderID=' . $data['id']);
    
     // ��������
    $blank.=$PHPShopGUI->setButton(__('��������'), 'briefcase', 'btn-print-order','forms/forma3.php?orderID=' . $data['id']);

    $disp = '<div id="blank" style="display:none;">'.$blank.'</div>';

    $disp .= '<table class="table table-hover cart-list">' . $PHPShopInterface->getContent() . '</table>
<div class="row">
  <div class="col-md-9">
   <button  class="btn btn-default btn-sm cart-add"><span class="glyphicon glyphicon-plus"></span> ' . __('�������� ������') . '</button>
  </div>
  <div class="col-md-3">
    <div class="input-group ">
      <span class="input-group-addon input-sm">%</span>
      <input type="text" class="form-control input-sm discount-value" placeholder="'.__('������').'" value="'.$discount.'"> 
      <span class="input-group-btn">
        <button class="btn btn-default btn-sm discount" type="button">'.__('���������').'</button>
     </span>
    </div>
  </div>
</div>
<p class="clearfix"> </p>
'.$total.'
<p class="clearfix"> </p>
<div class="row">
  <div class="col-md-6">
  <label for="dop_info">���������� ����������</label>
  <textarea class="form-control" id="dop_info" name="dop_info_new">'.$data['dop_info'].'</textarea>
  </div>
  <div class="col-md-6">
    <label for="status_maneger">���������� ��������������</label>
    <textarea class="form-control" id="status_maneger" name="status[maneger]">'.$status['maneger'].'</textarea>
  </div>
</div>
<style>
.sidebarcontainer .nav-pills li:first-child {
  display:none;
}
</style>
<script>

$("#tabs-0").addClass("active in fade");
$("#tabs-1").removeClass("active in fade");

$(document).ready(function(){
  $("#letterheads").html( $("#blank").html() );
});



</script>
';

    return $disp;
}

?>
