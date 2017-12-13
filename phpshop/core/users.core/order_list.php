<?php
/**
 * ����� ������� ������������
 * @author PHPShop Software
 * @version 1.1
 * @package PHPShopCoreFunction
 * @param obj $obj ������ ������
 * @param Int $tip ���� ������ [1 - ������ �������], [2 - ������ �������� ������]
 * @param int $uid  �� ������
 */
function order_list($obj,$tip,$uid=null) {
    $tr=null;

    // ����� ������� ��������
    if($tip==1)
        $where=array('user'=>'='.$obj->UsersId);
    // ����� �������� ������
    elseif($tip==2 and !empty($uid))
        $where=array('uid'=>'="'.htmlspecialchars($uid).'"');

    $PHPShopOrm = new PHPShopOrm($obj->getValue('base.orders'));
    $data=$PHPShopOrm->select(array('*'),$where,array('order'=>'datas desc'),array('limit'=>100));

    // ���������� ������ � �������
    $PHPShopOrderFunction= new PHPShopOrderFunction(false);

    // ������
    $currency=$PHPShopOrderFunction->default_valuta_code;

    // ������� �������
    $PHPShopOrderStatusArray = new PHPShopOrderStatusArray();

    if(is_array($data))
        foreach($data as $row) {

            // ����������� ������
            $PHPShopOrderFunction->import($row);



            if($tip==1) $link="?order_info=".$row['uid']."#Order";
            else $link="/users/register.html";

            $icon=PHPShopText::img('phpshop/lib/templates/icon/accept.png',$hspace=5,$align='absmiddle');

            $td1=PHPShopText::a($link,$icon.$row['uid'],$obj->locale['order_info'].$row['uid'],false,false,false,'b');
            $td2=PHPShopDate::dataV($row['datas']);
            $td3=$PHPShopOrderFunction->getNum();
            $td4=''.$PHPShopOrderFunction->getDiscount();
            $td5=$PHPShopOrderFunction->getTotal().' '.$currency;
            $td6=PHPShopText::b($PHPShopOrderFunction->getStatus($PHPShopOrderStatusArray),'color:'.$PHPShopOrderFunction->getStatusColor($PHPShopOrderStatusArray));

            $tr.=$obj->tr($td1,$td2,$td3,$td4,$td5,$td6);
        }


    $title=PHPShopText::div(PHPShopText::img('images/shop/date.gif',5,'absmiddle').PHPShopText::b(__('����� �������')),$align="left",$style=false,$id='allspec');
    $caption=$obj->caption($obj->locale['order_table_title_1'],$obj->locale['order_table_title_2'],$obj->locale['order_table_title_3'],
            $obj->locale['order_table_title_4'],$obj->locale['order_table_title_5'],$obj->locale['order_table_title_6']);

    $table=$title.PHPShopText::p(PHPShopText::table($caption.$tr,3,1,'center','99%',false,0,'allspecwhite'));

    $obj->set('formaTitle',$obj->lang('user_order_title'));
    $obj->set('formaContent',$table);
}

?>