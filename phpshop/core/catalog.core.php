<?
/**
 * ���������� �������
 * @author PHPShop Software
 * @version 1.0
 * @package PHPShopCore
 */
class PHPShopCatalog extends PHPShopCore {

    /**
     * �����������
     */
    function PHPShopCatalog() {

        // ��� ��
        $this->objBase=$GLOBALS['SysValue']['base']['products'];

        // �������
        $this->debug=false;

        // ����������
        $this->path='/'.$GLOBALS['SysValue']['nav']['path'];

        // ������
        $this->PHPShopValuta=$GLOBALS['PHPShopValuta'];

        PHPShopObj::loadClass('product');

        // ������ �������
        $this->action=array("nav"=>"CID");
        parent::PHPShopCore();

        $this->page=$this->PHPShopNav->getPage();
        if(strlen($this->page)==0) $this->page=1;
    }

    /**
     * ����� �� ���������, ����� ������ �� ��������
     * @return string
     */
    function index() {
        global $PHPShopModules;

        // ������������
        $link=PHPShopSecurity::TotalClean($this->PHPShopNav->getName(),2);

        // ������� ������
        $row=parent::getFullInfoItem(array('*'),array('link'=>"='$link'",'enabled'=>"!='0'"));

        // ���������� �������� �� �����
        if($row['category'] == 2000)  return $this->setError404();
        elseif(empty($row['id'])) return $this->setError404();

        // ���������� ���������
        $this->set('pageContent',Parser($row['content']));
        $this->set('pageTitle',$row['name']);

        // ����
        if(empty($row['title'])) $title=$row['name'];
        else $title=$row['title'];
        $this->title=$title." - ".$this->PHPShopSystem->getValue("name");
        $this->description=$row['description'];
        $this->keywords=$row['keywords'];
        $this->lastmodified=$row['date'];

        // ��������� ������� ������
        $this->navigation($row['category'],$row['name']);

        // �������� ������
        //$PHPShopModules->setHookHandler(__CLASS__,__FUNCTION__, $this, $row);

        // ���������� ������
        $this->parseTemplate($this->getValue('templates.page_page_list'));
    }

    /**
     * ����� ������� ��������� ���������� ��� ������� ���������� ��������� CID
     */
    function CID() {

        // ID ���������
        $this->category=PHPShopSecurity::TotalClean($this->PHPShopNav->getId(),1);
        $this->PHPShopCategory = &new PHPShopCategory($this->category);
        $this->category_name=$this->PHPShopCategory->getName();

        $PHPShopOrm = &new PHPShopOrm($this->getValue('base.categories'));
        $PHPShopOrm->debug=$this->debug;
        $row=$PHPShopOrm->select(array('id,name'),array('parent_to'=>"=".$this->category),false,array('limit'=>1));

        // ���� ��������
        if(empty($row['id'])) {

            $this->ListProduct();
        }
        // ���� ��������
        else {

            $this->ListCategory();
        }
    }

    /**
     * �������� ������ Multibase
     */
    function checkMultibase($pic_small) {
        $base_host = $this->PHPShopSystem->getSerilizeParam('admoption.base_host');
        if($this->PHPShopSystem->getSerilizeParam('admoption.base_enabled') == 1 and !empty($base_host))
            $this->set('productImg',eregi_replace("/UserFiles/","http://". $base_host."/UserFiles/",$pic_small));
    }



    /**
     * �������� �������������� ������ ������ �� ������
     * @param array $row ����� ������ �� ������
     */
    function checkStore($row) {
        
        // ������� ����
        if(!empty($row['parent'])) {
            $this->set('ComStart','<!--');
            $this->set('ComEnd','-->');

        }else {
            $this->set('ComStart','');
            $this->set('ComEnd','');
        }


        // ���������� ��������� ������
        if($this->PHPShopSystem->getSerilizeParam('admoption.sklad_enabled') == 1 and $row['items'] > 0)
            $this->set('productSklad',$this->SysValue['lang']['product_on_sklad']." ".$row['items']." ".$this->SysValue['lang']['product_on_sklad_i']);
        else $this->set('productSklad','');

        // ���� ����� �� ������
        if(empty($row['sklad'])) {

            $this->set('Notice','');
            $this->set('ComStartCart','');
            $this->set('ComEndCart','');
            $this->set('ComStartNotice','<!--');
            $this->set('ComEndNotice','-->');

            // ���� ��� ����� ����
            if(empty($row['price_n'])) {
                $this->set('productPrice',PHPShopProductFunction::GetPriceValuta($row['id'],$row['price'],false,$row['baseinputvaluta']));
                $this->set('productPriceRub','');
            }

            // ���� ���� ����� ����
            else {
                $productPrice=PHPShopProductFunction::GetPriceValuta($row['id'],$row['price'],false,$row['baseinputvaluta']);
                $this->set('productPrice',$productPrice);
                $this->set('productPriceRub',PHPShopText::strike($productPrice.' '.$this->PHPShopValuta[$row['baseinputvaluta']['code']]));
            }
        }

        // ����� ��� �����
        else {
            $this->set('productPrice',PHPShopProductFunction::GetPriceValuta($row['id'],$row['price'],false,$row['baseinputvaluta']));
            $this->set('productPriceRub',$this->SysValue['lang']['sklad_mesage']);
            $this->set('ComStartNotice','');
            $this->set('ComEndNotice','');
            $this->set('ComStartCart',PHPShopText::comment('<'));
            $this->set('ComEndCart',PHPShopText::comment('>'));
            $this->set('productNotice',$this->SysValue['lang']['product_notice']);
        }

        // ���� ���� ���������� ������ ����� ����������
        if($this->PHPShopSystem->getSerilizeParam('admoption.user_price_activate') == 1 and empty($_SESSION['UsersId'])) {
            $this->set('ComStartCart',PHPShopText::comment('<'));
            $this->set('ComEndCart',PHPShopText::comment('>'));
            $this->set('productPrice',PHPShopText::comment('<'));
            $this->set('productValutaName',PHPShopText::comment('>'));
        }
    }

    /**
     * �������� ����� � ��������
     * @return string
     */
    function setCell() {
        $Arg=func_get_args();
        $item=1;
        $panel=array('panel_l','panel_r','panel_l','panel_r');
        $tr='<tr>';
        foreach($Arg as $key=>$val) {
            if(!empty($val)) {
                $tr.='<td class="'.$panel[$key].'" valign="top">'.$val.'</td>';
                $chek=($key)/2;
                if(empty($chek))
                    $tr.='<td class="setka" height="1"><img height="1" src="images/spacer.gif" width="1"></td>';
            }
        }
        $tr.='</tr>';
        $tr.='<tr><td class="setka" colspan="3" height="1"><img height="1" src="images/spacer.gif" width="1"></td></tr>';
        return $tr;
    }


    /**
     * �������� ����� ������
     */
    function checkProductOption(){

        $DispCatOptionsTest=DispCatOptionsTest($this->category);
        if($DispCatOptionsTest == 1) {
            $this->set('ComStartCart',PHPShopText::comment('<'));
            $this->set('ComEndCart',PHPShopText::comment('>'));
        }
    }

    /**
     * ����� ������ �������
     * @return string
     */
    function ListProduct() {
        $j=1;
        $item=1;

        // ���������� ����� ��� ������ ������
        $cell=$this->LoadItems['Podcatalog'][$this->category]['num_row'];

        debug($this->LoadItems['Podcatalog']);

        // ������� ������
        $this->dataArray=parent::getListInfoItem(array('*'),array('category'=>'='.$this->category),array('order'=>'id DESC'));

        // 404
        if(!isset($this->dataArray)) return $this->setError404();

        // ���������
        $this->setPaginator();

        if(is_array($this->dataArray))
            foreach($this->dataArray as $row) {

                // ���������� ����������
                $this->set('productName',$row['name']);
                $this->set('productArt',$row['uid']);
                $this->set('productDes',$row['description']);

                // ������ ��������
                if(empty($row['pic_small']))
                    $this->set('productImg','images/shop/no_photo.gif');
                else $this->set('productImg',$row['pic_small']);

                // �������� ������ Multibase
                $this->checkMultibase($row['pic_small']);

                $this->set('productImgBigFoto',$row['pic_big']);
                $this->set('productPriceMoney',$this->PHPShopSystem->getValue('dengi'));
                $this->set('productSale',$this->SysValue['lang']['product_sale']);
                $this->set('productSale',$this->SysValue['lang']['product_info']);
                $this->set('productValutaName',GetValuta());
                $this->set('productId',$this->category);
                $this->set('productUid',$row['id']);
                $this->set('catalog',$this->SysValue['lang']['catalog']);


                // ����� ������
                $this->checkStore($row);

                // ���������� ������ ������ ������
                $dis=ParseTemplateReturn($this->getValue('templates.main_product_forma_'.$cell));

                // ������ � �������� (1-4)
                if($j<$cell) {
                    $cell_name='d'.$j;
                    $$cell_name=$dis;
                    $j++;
                    if($item == $this->num_page)
                        $table.=$this->setCell($d1);
                }
                else {
                    $cell_name='d'.$j;
                    $$cell_name=$dis;
                    $table.=$this->setCell($d1,$d2,$d3,$d4);
                    $j=1;

                }
                $item++;
            }

        // ��������� � ������ ������ � ��������
        $this->add($table,true);

        // ����
        $this->title="������� - ".$this->PHPShopSystem->getValue("name");

        // ���������� ������
        $this->parseTemplate($this->getValue('templates.product_page_list'));
    }

    /**
     * ����� ������ ���������
     */
    function ListCategory() {
        global $PHPShopModules;

        // ID ���������
        $this->category=PHPShopSecurity::TotalClean($this->PHPShopNav->getId(),1);
        $this->PHPShopCategory = &new PHPShopCategory($this->category);
        $this->category_name=$this->PHPShopCategory->getName();

        // ������� ������
        $PHPShopOrm = &new PHPShopOrm($this->getValue('base.categories'));
        $PHPShopOrm->debug=$this->debug;
        $dataArray=$PHPShopOrm->select(array('name','id'),array('parent_to'=>'='.$this->category),array('order'=>'num'),array('limit'=>100));
        if(is_array($dataArray))
            foreach($dataArray as $row) {
                $dis.=PHPShopText::li($row['name'],$this->path.'/CID_'.$row['id'].'.html');
            }


        // ���� ���� �������� ��������
        //if(!empty($this->LoadItems['Catalog'][$this->category]['content_enabled']))
        $this->set('catalogContent',$this->PHPShopCategory->getContent());

        $disp.="<ul>$dis</ul>";

        $this->set('catalogName',$this->category_name);
        $this->set('catalogList',$disp);

        // ����
        $this->title=$this->category_name." - ".$this->PHPShopSystem->getValue("name");

        // ��������� ������� ������
        if(!empty($this->LoadItems['Catalog'][$this->category]['parent_to']))
            $this->navigation($this->LoadItems['Catalog'][$this->category]['parent_to'],$this->category_name);
        else $this->navigation($this->category,$this->category_name);


        // �������� ������
        //$PHPShopModules->setHookHandler(__CLASS__,__FUNCTION__, $this, $row);

        // ���������� ������
        $this->parseTemplate($this->getValue('templates.catalog_info_forma'));
    }

    function meta() {
        global $PHPShopModules;
        parent::meta();

        // �������� ������
        //$PHPShopModules->setHookHandler(__CLASS__,__FUNCTION__, $this);
    }
}
?>