<?php
/**
 * ����� ������ ����������� ������������
 * @author PHPShop Software
 * @version 1.0
 * @package PHPShopCoreFunction
 * @param obj $obj ������ ������
 */
function notice_list($obj) {
    $tr=null;
    $PHPShopOrm = new PHPShopOrm($obj->getValue('base.notice'));

    // ������� �����������
    $PHPShopOrm->debug=$obj->debug;
    $data=$PHPShopOrm->select(array('*'),array('user_id'=>'='.$obj->UsersId,'enabled'=>"='0'"),array('order'=>'datas desc'),array('limit'=>100));

    if(is_array($data)) {
        foreach($data as $row) {

            if(PHPShopSecurity::true_num($row['product_id'])) {
                $link='../shop/UID_'.$row['product_id'].'.html';
                $PHPShopProduct = new PHPShopProduct($row['product_id']);
                $td1=PHPShopText::a($link,$PHPShopProduct->getName(),$PHPShopProduct->getName(),false,false,false,'b');
            }

            $td2=PHPShopDate::dataV($row['datas_start']).' - '.PHPShopDate::dataV($row['datas']);
            $icon_del=PHPShopText::img('phpshop/lib/templates/icon/cancel.png',$hspace=5,$align='absmiddle');
            $td3=$icon_del.PHPShopText::a('javascript:NoticeDel('.$row['id'].')',__('�������'));
            $tr.=$obj->tr($td1,$td2,$td3);
        }

        $title=PHPShopText::div(PHPShopText::img('images/shop/date.gif',5,'absmiddle').PHPShopText::b(__('������� ������')),$align="left",$style=false,$id='allspec');
        $caption=$obj->caption(__('������������'),__('������'),__('������'));

        $table=$title.PHPShopText::p(PHPShopText::table($caption.$tr,3,1,'center','99%',false,0,'allspecwhite'));
    }

    // ����� �����������
    $PHPShopOrm ->clean();
    $data=$PHPShopOrm->select(array('*'),array('user_id'=>'='.$obj->UsersId,'enabled'=>"='1'"),array('order'=>'datas desc'),array('limit'=>100));
    $tr=null;
    if(is_array($data)) {
        foreach($data as $row) {
            
            if(PHPShopSecurity::true_num($row['product_id'])) {
                $link='../shop/UID_'.$row['product_id'].'.html';
                $PHPShopProduct = new PHPShopProduct($row['product_id']);
                $td1=PHPShopText::a($link,$PHPShopProduct->getName(),$PHPShopProduct->getName(),false,false,false,'b');
            }
            
            $td2=PHPShopDate::dataV($row['datas_start']).' - '.PHPShopDate::dataV($row['datas']);
            $icon_del=PHPShopText::img('phpshop/lib/templates/icon/accept.png',$hspace=5,$align='absmiddle');
            $td3=$icon_del.__('���������');
            $tr.=$obj->tr($td1,$td2,$td3);
        }
        
        $title=PHPShopText::div(PHPShopText::img('images/shop/date.gif',5,'absmiddle').PHPShopText::b(__('�����')),$align="left",$style=false,$id='allspec');
        $caption=$obj->caption(__('������������'),__('������'),__('������'));
        
        $table_archive=$title.PHPShopText::p(PHPShopText::table($caption.$tr,3,1,'center','99%',false,0,'allspecwhite'));
    }


    $obj->set('formaTitle',__('�����������'));
    $obj->set('formaContent',$table.$table_archive);
    $obj->ParseTemplate($obj->getValue('templates.users_page_list'));
}

?>