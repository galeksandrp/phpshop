<?php

/**
 * ��������� � "�������� ����������� � ��������� �������� ������"
 * @param array $obj ������
 */
function image_gallery_nt_hook($obj, $row) {
    if (!empty($row['pic_big'])) {
        $n = $row['id'];
        $pic_big = $row['pic_big'];
        $pic_big_b = str_replace(".", "_big.", $pic_big);
        $pic_big_big = $_SERVER['DOCUMENT_ROOT'] . $pic_big_b;

        // ��������� ������� ������������� ����������� �� �������
        if (!file_exists($pic_big_big))
            $pic_big_b = $pic_big;

        $name_foto = $row['name'];
        $disp = null;
        $PHPShopOrm = new PHPShopOrm($obj->getValue('base.foto'));
        $data = $PHPShopOrm->select(array('*'), array('parent' => '=' . $row['id']), array('order' => 'num'), array('limit' => 100));
        if (is_array($data)) {
            foreach ($data as $row) {

                $name = $row['name'];
                $name_s = str_replace(".", "s.", $name);
                $name_bigstr = str_replace(".", "_big.", $name);
                $name_big = $_SERVER['DOCUMENT_ROOT'] . $name_bigstr;


                // ��������� ������� ������������� ����������� �� �������
                if (file_exists($name_big))
                    $name_b = $name_bigstr;
                else
                    $name_b = $name;

                $id = $row['id'];
                $info = $row['info'];
                $FotoArray[] = array(
                    "id" => $id,
                    "name" => $obj->checkMultibase($name, true),
                    "name_s" => $obj->checkMultibase($name_s, true),
                    "name_b" => $obj->checkMultibase($name_b, true),
                    "info" => $info
                );
            }


            if (is_array($FotoArray))
                $dBig = '<div class="image">
                                <a href="' . $obj->checkMultibase($pic_big_b, true) . '" class="jqzoom" rel="gal1"  title="' . $name_foto . '">
                                    <img src="' . $obj->checkMultibase($pic_big, true) . '" title="' . $name_foto . '" alt="' . $name_foto . '" id="image">
                                </a>
                        </div>
                        

';
            if (count($FotoArray) > 1) {
                foreach ($FotoArray as $key => $value) {
                    if ($pic_big == $value['name'])
                        $class = 'class="zoomThumbActive"';
                    else
                        $class = 'class=""';
                    $disThumb .= '<li>
                                    <a ' . $class . ' href="javascript:void(0);" rel="{gallery: \'gal1\', smallimage: \'' . $value['name'] . '\',largeimage: \'' . $value['name_b'] . '\'}">
                                        <img src="' . $value['name_s'] . '"  alt="' . $value['info'] . '">
                                    </a>
                                  </li>';
                }
                $dBig .= '<div class="image-additional"><ul id="thumblist" class="clearfix">' . $disThumb . '</ul></div>';
            }


            $d = $dBig;
        } else {
            $d = '<a class=highslide onclick="return hs.expand(this)" href="' . $obj->checkMultibase($name_b, true) . '" target=_blank getParams="null"><div align="center" id="IMGloader" style="padding-bottom: 10px">
 <img src="' . $obj->checkMultibase($pic_big, true) . '" border="1" class="imgOn"  onerror="NoFoto2(this)"></a></div>';
        }

        $obj->set('productFotoList', $d);
    }
    return true;
}

function uid_nt_hook($obj, $dataArray, $rout) {

    if ($rout == 'END') {
        $obj->set('UidLeftColHide', 'span12');
    }
}

/**
 * ����� �������� � ��������� �������� � ���� �����������
 */
function parent_nt_hook($obj, $dataArray, $rout) {

    if ($rout == 'END') {
        if (count($obj->select_value > 0)) {
            $obj->set('parentList', '');
            foreach ($obj->select_value as $value) {
                $obj->set('parentName', $value[0]);
                $obj->set('parentId', $value[1]);
                if (!$flag) {
                    $obj->set('checked', 'checked');
                    $flag = 1;
                    $obj->set('parentCheckedId', $value[1]);
                }
                else
                    $obj->set('checked', '');

                $disp = ParseTemplateReturn("product/product_odnotip_product_parent_one.tpl");
                $obj->set('parentList', $disp, true);
            }
            $obj->set('productParentList', ParseTemplateReturn("product/product_odnotip_product_parent.tpl"));
        }
    }
}

function cid_category_nt_hook($obj, $dataArray, $rout) {
    if ($rout == 'END') {
        // ��������� ����� ��������
        if (is_array($dataArray))
            foreach ($dataArray as $val)
                $cat .= "," . $val['id'];

        $cat = "(0$cat)";

        // ���������� ������� ������ ���������������
        $PHPShopProduct_nt_IconElements = new PHPShopProduct_nt_IconElements();
        $PHPShopProduct_nt_IconElements->template = 'main_product_forma_3';

        $spec = $PHPShopProduct_nt_IconElements->specMainIcon_nt(false, $cat, 3, 9, true);

        // ��������� � ���������� ������ ��������� ����� ���������������
        if (!empty($spec) AND strlen($spec) > 10) {
            $obj->set('subCatProdList2', $spec, true);
            $specTemp = ParseTemplateReturn('catalog/catalog_info_forma_newtip.tpl');
            $obj->set('subCatProdList', $specTemp, true);
        }
    }
}

$addHandler = array
    (
    'image_gallery' => 'image_gallery_nt_hook',
    'CID_Category' => 'cid_category_nt_hook',
    'parent' => 'parent_nt_hook',
    'UID' => 'uid_nt_hook'
);

/**
 * ���������� � ������ ��������� ��������������� ������� � 3 ������, ����� 3
 */
class PHPShopProduct_nt_IconElements extends PHPShopProductIconElements {

    function PHPShopProduct_nt_IconElements() {
        parent::PHPShopProductIconElements();
    }

    function specMainIcon_nt($force = false, $category = null, $cell = 1, $limit = null, $line = false) {

        $this->limitspec = $limit;
        $this->cell = $cell;


        // ������� ������ �� �������� ��������

        switch ($GLOBALS['SysValue']['nav']['nav']) {

            // ������ ������ �������
            case "CID":

                if (!empty($category))
                    $where['category'] = " IN " . $category;

                elseif (PHPShopSecurity::true_num($this->PHPShopNav->getId())) {
                    $category = $this->PHPShopNav->getId();
                    $where['category'] = '=' . $category;
                }
                break;

            // ������ ���������� ��������
            case "UID":
                if (empty($force))
                    return false;
                else
                    $where['category'] = '=' . $category;

                $where['id'] = '!=' . $this->PHPShopNav->getId();
                break;
        }

        // ���-�� ������� �� ��������
        if (empty($this->limitspec))
            $this->limitspec = $this->PHPShopSystem->getParam('new_num');

        // �������� ������
        $hook = $this->setHook(__CLASS__, __FUNCTION__);
        if ($hook)
            return $hook;


        // ���������� ���� �������� �����
        if (empty($this->limitspec))
            return false;

        // �������� ������ ��� ������� ���
        //$where['id']=$this->setramdom($limit);
        // ��������� ������� ����� ������ � �������� � �������
        $where['newtip'] = "='1'";
        $where['enabled'] = "='1'";
        $where['parent_enabled'] = "='0'";

        // �������� �� ��������� �������
        if ($limit == 1) {
            $array_pop = true;
            $limit++;
        }

        // ������ ������ ������� ������� �� ���������
        $memory_spec = $this->memory_get('product_spec.' . $category);

        // ������� �������
        if ($memory_spec != 2 and $memory_spec != 3)
            $this->dataArray = $this->select(array('*'), $where, array('order' => 'RAND()'), array('limit' => $this->limitspec), __FUNCTION__);

        // �������� �� ��������� �������
        if (!empty($array_pop) and is_array($this->dataArray)) {
            array_pop($this->dataArray);
        }

        if (!empty($this->dataArray) and is_array($this->dataArray)) {
            $this->product_grid($this->dataArray, $this->cell, $this->template, $line);
            $this->set('specMainTitle', $this->lang('newprod'));

            // ������� � ������
            $this->memory_set('product_spec.' . $category, 1);
        } else {
            // ������� ���������������
            unset($where['newtip']);
            $where['spec'] = "='1'";

            if ($memory_spec != 1 and $memory_spec != 3)
                $this->dataArray = $this->select(array('*'), $where, array('order' => 'RAND()'), array('limit' => $this->limitspec), __FUNCTION__);

            // �������� �� ��������� �������
            if (!empty($array_pop) and is_array($this->dataArray)) {
                array_pop($this->dataArray);
            }

            if (!empty($this->dataArray) and is_array($this->dataArray)) {
                $this->product_grid($this->dataArray, $this->cell, $this->template, $line);
                $this->set('specMainTitle', $this->lang('specprod'));

                // ������� � ������
                $this->memory_set('product_spec.' . $category, 2);
            } else {
                // ������� ��������� ����������� �������
                unset($where['id']);
                unset($where['spec']);
                $this->dataArray = $this->select(array('*'), $where, array('order' => 'id DESC'), array('limit' => $this->limitspec), __FUNCTION__);

                // �������� �� ��������� �������
                if (!empty($array_pop) and is_array($this->dataArray)) {
                    array_pop($this->dataArray);
                }

                if (is_array($this->dataArray)) {
                    $this->product_grid($this->dataArray, $this->cell, $this->template, $line);
                    $this->set('specMainTitle', $this->lang('newprod'));

                    // ������� � ������
                    $this->memory_set('product_spec.' . $category, 3);
                }
            }
        }

        // �������� � ���������� ������� � ��������
        return $this->compile();
    }

}

?>