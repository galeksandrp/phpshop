<?php
/**
 * ���������� �����-������
 * @author PHPShop Software
 * @version 1.1
 * @package PHPShopShopCore
 */
class PHPShopPrice extends PHPShopShopCore {
    /**
     * ���� ���� �������
     * @var string  
     */
    var $color_product='#ffffff';
    var $debug=false;
    var $memory=true;

    function PHPShopPrice() {

        // ������ �������
        $this->action=array("nav"=>array("CAT"));
        parent::PHPShopShopCore();

        $this->title=$this->lang('price_title').' - '.$this->PHPShopSystem->getValue("title");
    }

    /**
     * ����� ������
     */
    function index() {

        // �������� ������
        if($this->setHook(__CLASS__,__FUNCTION__,false,'START'))
            return true;

        // ����� ��������� ��� ������
        $this->category_select();

        // �������� ������
        $this->setHook(__CLASS__,__FUNCTION__,false,'END');

        // ���������� ������
        $this->parseTemplate($this->getValue('templates.price_page_list'));
    }


    /**
     * ����� ��������� ��� ������
     */
    function category_select() {

        // �������� ������
        if($this->setHook(__CLASS__,__FUNCTION__,false,'START'))
            return true;

        $PHPShopCategoryArray = new PHPShopCategoryArray();
        $Catalog=$PHPShopCategoryArray->getArray();
        $CatalogKeys=$PHPShopCategoryArray->getKey('id.parent_to');

        // ���������� ������ ���� ������� ��� ������� ����
        if($_SESSION['max_item']<1000)
            $value[]=array($this->lang('search_all_cat'),'ALL',false);

        if(is_array($CatalogKeys))
            foreach($CatalogKeys as $cat=>$val) {
                $podcatalog_id = array_keys($CatalogKeys,$cat);
                if(count($podcatalog_id)==0) {
                    $parent=$Catalog[$cat]['parent_to'];
                    if ($this->category==$cat) {
                        $sel="selected";
                        $this->category_name=$Catalog[$parent]['name']." / ".$Catalog[$cat]['name'];
                    }
                    else $sel="";
                    $value[]=array($Catalog[$parent]['name']." / ".$Catalog[$cat]['name'],$cat,$sel);

                    // ������ ��� ������ ���� �������
                    $this->category_array[$cat]=$Catalog[$parent]['name']." / ".$Catalog[$cat]['name'];
                }
            }

        // �������� ������
        $this->setHook(__CLASS__,__FUNCTION__,false,'END');

        $this->set('searchPageCategory',PHPShopText::select('catId',$value,$width,$float="none"));
    }

    /**
     * ������ ����� �������
     * @return string
     */
    function tr() {
        $Arg=func_get_args();
        $colspan=null;

        if(empty($Arg[0])) {
            $style='class="bgprice"';
            $colspan=3;
        }
        else $style='bgcolor="'.$Arg[0].'"';

        $tr='<tr '.$style.'>';
        foreach($Arg as $key=>$val) {
            if($key>0) {
                if($key == 2 ) $width=70;
                elseif($key == 3 ) $width=20;
                else $width=false;
                $tr.=$this->td($val,$width,$colspan);
            }
        }
        $tr.='</tr>';
        return $tr;
    }

     /**
     * ������ ����� �������
     * @return string
     */
    function td($string,$width,$colspan=false) {
        return '<td width="'.$width.'" colspan="'.$colspan.'">'.$string.'</td>';
    }


  /**
   * ������� ��� ��� ������
   * @param array $row ������ ������
   * @return string
   */
    function seourl($row) {

        // �������� ������, ��������� � ������ ������� ������ ��� ����������� �����������
        if($this->memory_get(__CLASS__.'.'.__FUNCTION__,true)) {
            $hook=$this->setHook(__CLASS__,__FUNCTION__,$row);
            if($hook) {
                return $hook;
            } else $this->memory_set(__CLASS__.'.'.__FUNCTION__,0);
        }

        return '../shop/UID_'.$row['id'].'.html';
    }

    /**
     * ����� ������� �� ���������
     */
    function product($category) {

        // �������� ������
        if($this->setHook(__CLASS__,__FUNCTION__,$category,'START'))
            return true;

        // 404
        if(!PHPShopSecurity::true_num($category)) return $this->setError404();

        // ������� ������
        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['products']);
        $PHPShopOrm->debug=$this->debug;
        $data=$PHPShopOrm->select(array('*'),array('category'=>'='.$category,'enabled'=>"='1'",'parent_enabled'=>"='0'"),array('order'=>'num'),array('limit'=>500));

        if(!empty($this->category_name))
            $dis=$this->tr(false,$this->category_name);
        
        if($this->PHPShopSystem->getSerilizeParam('admoption.user_price_activate') == 1 and empty($_SESSION['UsersId'])) 
                $user_price_activate=true;
                

        // ��������� � ������ ������ � ��������
        if(is_array($data))
            foreach($data as $row) {
                $name=PHPShopText::a($this->seourl($row),$row['name']);
                if(empty($row['sklad']) and empty($user_price_activate))
                $cart=PHPShopText::a('javascript:AddToCart('.$row['id'].')',PHPShopText::img('images/shop/basket_put.gif',false,'absMiddle'),$this->lang('product_sale'));
                else $cart=PHPShopText::a('../users/notice.html?productId='.$row['id'],PHPShopText::img('images/shop/date.gif',false,'absMiddle'),$this->lang('product_notice'));
                
                if(empty($user_price_activate))
                    $price=$this->price($row).' '.$this->currency();
                else $price=PHPShopText::a('../users/register.html',PHPShopText::img('images/shop/icon_user.gif',false,'absMiddle'),$this->lang('user_register_title'));
                
                
                $dis.=$this->tr('#ffffff',$name,$price,$cart);
            }

        // �������� ������
        $hook=$this->setHook(__CLASS__,__FUNCTION__,$data,'END');
        if($hook) $dis=$hook;

        $this->add(PHPShopText::table($dis,3,1,'center','98%','#D2D2D2'),true);
    }

    /**
     * ����� ������ ������� ��� ������ ���������
     */
    function CAT() {

        $this->category=$GLOBALS['SysValue']['nav']['page'];

        // ����� ��������
        $this->category_select();

        // ���� ������� ����� ������� ���
        if($this->category == 'ALL' or $GLOBALS['SysValue']['nav']['id'] == 'ALL') {

            foreach($this->category_array as $key=>$val) {
                $dis=$this->tr(false,$val);
                $this->add(PHPShopText::table($dis,3,1,'center','98%','#D2D2D2'),true);
                $this->product($key);
            }
        }
        else {

            $this->product($this->category);
        }

        $this->set('PageCategory',$this->category);

        // �������� ������
        $this->setHook(__CLASS__,__FUNCTION__,$this->category_array);

        // ���������� ������
        $this->parseTemplate($this->getValue('templates.price_page_list'));
    }
}
?>