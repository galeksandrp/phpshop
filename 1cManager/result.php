<?php

/**
 * ���������� ������������� ������������ �� 1�
 * @package PHPShopExchange
 * @author PHPShop Software
 * @version 2.7
 */
// �����������
include_once("login.php");
PHPShopObj::loadClass(array("readcsv", "product", "orm", "string"));

$F_done = null;
$GetItemCreate = 0;
$GetItemUpdate = 0;
$GetCatalogCreate = 0;

// ����� ������ ������������� ��� ����� ������ �������
$GLOBALS['option']['sort'] = 17;


// ��������������
if (function_exists('mod_option')) {
    call_user_func_array('mod_option', array(&$GLOBALS['option']));
}

// ��������� ������������� v 2.0
function charsGenerator($category, $CsvToArray) {
    global $PHPShopBase;

    $return = null;

    // �������
    $debug = $_REQUEST['debug'];

    // ������������ ���������� ��������
    for ($i = $GLOBALS['option']['sort']; $i < count($CsvToArray); $i = $i + 2) {

        $sort_name = trim($CsvToArray[$i]);
        $sort_value = trim($CsvToArray[$i + 1]);

        // ��������� ��������
        if (strstr($sort_value, "&&")) {
            $sort_value_array = explode("&&", $sort_value);

            foreach ($sort_value_array as $value) {

                $CsvToArray[$i] = $sort_name;
                $CsvToArray[$i + 1] = $value;

                $CsvToArray[] = $sort_name;
                $CsvToArray[] = $value;
            }
        }
    }


    // ��������� 
    for ($i = $GLOBALS['option']['sort']; $i < count($CsvToArray); $i = $i + 2) {

        $sort_name = trim($CsvToArray[$i]);
        $sort_value = trim($CsvToArray[$i + 1]);

        if (empty($sort_name) or empty($sort_value))
            continue;

        // �������� �� ������ ������������� � ��������
        $PHPShopOrm = new PHPShopOrm();
        $PHPShopOrm->debug = $debug;
        $result_1 = $PHPShopOrm->query('select sort,name from ' . $GLOBALS['SysValue']['base']['categories'] . ' where id="' . $category . '"  limit 1', __FUNCTION__, __LINE__);
        $row_1 = mysqli_fetch_array($result_1);

        $cat_sort = unserialize($row_1['sort']);

        $cat_name = $row_1['name'];

        // ����������� � ����
        if (is_array($cat_sort))
            $where_in = ' and a.id IN (' . @implode(",", $cat_sort) . ') ';
        else
            $where_in = null;

        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['sort_categories']);
        $PHPShopOrm->debug = $debug;

        $result_2 = $PHPShopOrm->query('select a.id as parent, b.id from ' . $GLOBALS['SysValue']['base']['sort_categories'] . ' AS a 
        JOIN ' . $GLOBALS['SysValue']['base']['sort'] . ' AS b ON a.id = b.category where a.name="' . $sort_name . '" and b.name="' . $sort_value . '" ' . $where_in . ' limit 1', __FUNCTION__, __LINE__);
        $row_2 = mysqli_fetch_array($result_2);

        // ������������ �  ����
        if (!empty($where_in) and isset($row_2['id'])) {
            $return[$row_2['parent']][] = $row_2['id'];
        }
        // ����������� � ����
        elseif (!empty($cat_name)) {

            // �������� ��������������
            if (!empty($where_in))
                $sort_name_present = $PHPShopBase->getNumRows('sort_categories', 'as a where a.name="' . $sort_name . '" ' . $where_in . ' limit 1');

            // ������� ����� ��������������
            if (empty($sort_name_present) and !empty($category)) {

                // ����
                if (!empty($cat_sort[0])) {
                    $PHPShopOrm = new PHPShopOrm();
                    $PHPShopOrm->debug = $debug;

                    $result_3 = $PHPShopOrm->query('select category from ' . $GLOBALS['SysValue']['base']['sort_categories'] . ' where id="' . intval($cat_sort[0]) . '"  limit 1', __FUNCTION__, __LINE__);
                    $row_3 = mysqli_fetch_array($result_3);
                    $cat_set = $row_3['category'];
                }
                // ���, ������� ����� �����
                else {

                    // �������� ������ �������������
                    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['sort_categories']);
                    $PHPShopOrm->debug = $debug;
                    $cat_set = $PHPShopOrm->insert(array('name_new' => '��� �������� ' . $cat_name, 'category_new' => 0), '_new', __FUNCTION__, __LINE__);
                }


                $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['sort_categories']);
                $PHPShopOrm->debug = $debug;
                if ($parent = $PHPShopOrm->insert(array('name_new' => $sort_name, 'category_new' => intval($cat_set)), '_new', __FUNCTION__, __LINE__)) {

                    // ������� ����� �������� ��������������
                    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['sort']);
                    $PHPShopOrm->debug = $debug;
                    $slave = $PHPShopOrm->insert(array('name_new' => $sort_value, 'category_new' => $parent), '_new', __FUNCTION__, __LINE__);

                    $return[$parent][] = intval($slave);
                    $cat_sort[] = $parent;

                    // ��������� ����� �������� �������
                    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['categories']);
                    $PHPShopOrm->debug = $debug;
                    $PHPShopOrm->update(array('sort_new' => serialize($cat_sort)), array('id' => '=' . intval($category)), '_new', __FUNCTION__, __LINE__);
                }
            }
            // ���������� �������� 
            else {

                // �������� �� ������������ ��������������
                $PHPShopOrm = new PHPShopOrm();
                $PHPShopOrm->debug = $debug;
                $result = $PHPShopOrm->query('select a.id  from ' . $GLOBALS['SysValue']['base']['sort_categories'] . ' AS a where a.name="' . $sort_name . '" ' . $where_in . ' limit 1', __FUNCTION__, __LINE__);
                if ($row = mysqli_fetch_array($result)) {
                    $parent = $row['id'];
                    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['sort']);
                    $PHPShopOrm->debug = $debug;
                    $slave = $PHPShopOrm->insert(array('name_new' => $sort_value, 'category_new' => $parent), '_new', __FUNCTION__, __LINE__);

                    $return[$parent][] = intval($slave);
                }
            }
        }
    }

    return $return;
}

// ��������� ���������
class ReadCsvCatalog extends PHPShopReadCsvNative {

    var $CsvContent;
    var $ReadCsvRow;
    var $TableName;
    var $CsvToArray;
    var $ItemCreate = 0;

    function __construct($file) {
        $this->CsvContent = $this->read($file);
        $this->TableName = $GLOBALS['SysValue']['base']['categories'];
    }

    function read($file) {

        if (file_exists($file)) {
            $fp = @fopen($file, "r");
            $i = 0;
            if ($this->title_clean)
                $i = 0;
            else
                $i = 1;
            while (($data = @fgetcsv($fp, $this->size, $this->delim)) !== FALSE) {
                if ($i > 0)
                    $this->CsvToArray[$data[0]] = $data;
                $i++;
            }
            fclose($fp);
        }
        else
            echo ("�� ���� ��������� ���� " . $file);
    }

    // ������� ����� ������
    function CreateCatalog($id) {
        global $link_db;
        $CsvToArray = $this->CsvToArray[$id];
        if (is_array($CsvToArray)) {
            $sql = "INSERT INTO " . $this->TableName . " SET
     id = '" . trim($CsvToArray[0]) . "',
     name = '" . addslashes($CsvToArray[1]) . "', 
     parent_to = '" . trim($CsvToArray[2]) . "' ";

            // �������
            if (isset($_REQUEST['debug'])) {
                echo $sql . PHP_EOL;
                $result = mysqli_query($link_db, $sql) or die(mysqli_error($link_db)) . PHP_EOL;
            }
            else
                $result = mysqli_query($link_db, $sql);

            if ($result)
                $this->ItemCreate++;
        }
    }

    function GetItemCreate() {
        return $this->ItemCreate;
    }

    // ��������� �������� ������ ���������
    function ChekTree($id) {
        $row = $this->CsvToArray;
        $parent = $row[$id][2];
        $CheckId = parent::CheckId($id);
        if (empty($CheckId))
            $this->CreateCatalog($id);
        if ($parent != 0) {
            $CheckIdParent = parent::CheckId($parent);
            if (empty($CheckIdParent))
                $this->ChekTree($parent);
        }
    }

}

// ��������� �������
class ReadCsv1C extends PHPShopReadCsvNative {

    var $CsvContent;
    var $ReadCsvRow;
    var $TableName;
    var $Sklad_status;
    var $seourlpro_enabled = false;
    // ��������� SEO ������ ��� ����������
    var $seo_update = true;
    var $ObjCatalog, $ObjSystem;
    var $ItemCreate = 0;
    var $ItemUpdate = 0;
    var $ImageSrc = "jpg";

    function __construct($CsvContentFile, $ObjCatalog, $ObjSystem) {
        $this->ImagePath = $GLOBALS['SysValue']['dir']['dir'] . "/UserFiles/Image/";
        $this->TableName = $GLOBALS['SysValue']['base']['products'];
        $this->TableNameFoto = $GLOBALS['SysValue']['base']['foto'];
        $this->Sklad_status = $ObjSystem->getSerilizeParam("admoption.sklad_status");
        $this->ObjCatalog = $ObjCatalog;
        $this->ObjSystem = $ObjSystem;
        $this->GetIdValuta = PHPShopValuta::getAll(true);

        // ���� ������ SEOURLPRO
        if (!empty($GLOBALS['SysValue']['base']['seourlpro']['seourlpro_system'])) {
            $this->seourlpro_enabled = true;
        }

        parent::__construct($CsvContentFile);
        $this->DoUpdatebase();
    }

    // ���-�� ��������� �������
    function GetItemCreate() {
        return $this->ItemCreate;
    }

    // ���-�� ���������� �������
    function GetItemUpdate() {
        return $this->ItemUpdate;
    }

    // ���-�� ��������� ���������
    function GetCatalogCreate() {
        if ($this->ObjCatalog)
            $num = $this->ObjCatalog->GetItemCreate();
        else
            $num = 0;
        return $num;
    }

    // ���� � ��������
    function ImagePlus($img) {
        if (!empty($img))
            return $this->ImagePath . $img;
    }

    // ������� ��������
    function DoUpdatebase() {
        $CsvToArray = $this->CsvToArray;
        if (is_array($CsvToArray)) {
            foreach ($CsvToArray as $v) {
                $this->UpdateBaseCatalog($v[15]);
                $this->UpdateBase($v);
            }
        }
    }

    // ������� ��������
    function UpdateBaseCatalog($category) {
        if ($this->ObjCatalog)
            $this->ObjCatalog->ChekTree($category);
    }

    // �������� ���-�� ����
    function GetNumFoto($id) {
        global $link_db;
        $sql = "select id from " . $this->TableNameFoto . " where parent=$id";
        $result = mysqli_query($link_db, $sql);
        return @mysqli_num_rows($result);
    }

    // ��������� �� ������ �� ��������
    function getIdForImages($uid) {
        global $link_db;
        $sql = "select id from " . $this->TableName . " where uid='$uid' limit 1";
        $result = mysqli_query($link_db, $sql);
        $row = mysqli_fetch_array($result);
        return $row['id'];
    }

    // �������������� ������ 10/A#20/B
    function getWarehouse($store) {
        $sql = null;
        $items = $this->items = 0;

        if (strstr($store, '#')) {
            $store_array = explode('#', $store);

            if (is_array($store_array))
                foreach ($store_array as $stores) {
                    if (strstr($stores, '/')) {
                        $store_array2 = explode('/', $stores);
                        $store_array_true[$store_array2[1]] = $store_array2[0];
                        $items+=$store_array2[0];
                    }
                }
        }

        // ���� �������
        if (!is_array($this->warehous)) {
            $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['warehouses']);
            $data = $PHPShopOrm->select(array('*'), false, array('order' => 'num DESC'), array('limit' => 100));
            if (is_array($data))
                foreach ($data as $row) {
                    $this->warehouse[$row['uid']] = $row['id'];
                }
        }

        // ����� �����
        $sql.="items='" . $items . "', ";
        $this->items = $items;

        if (is_array($this->warehouse))
            foreach ($this->warehouse as $code => $id) {
                $sql.="items" . $id . "='" . $store_array_true[$code] . "', ";
            }

        return $sql;
    }

    // ���������� ������
    function UpdateBase($CsvToArray) {
        global $link_db;

        // ���� �� ������ � ����
        if ($_REQUEST['create'] == "true")
            $CheckBase = parent::CheckUid($CsvToArray[0]);
        else
            $CheckBase = true;

        // ���������
        if (!empty($CheckBase)) {

            $sql = "UPDATE " . $this->TableName . " SET ";

            // ��������������
            if (function_exists('mod_update')) {
                $sql.=call_user_func_array('mod_update', array(&$CsvToArray, __CLASS__, __FUNCTION__));
            }

            if ($this->ObjSystem->getSerilizeParam("1c_option.update_name") == 1 and !empty($CsvToArray[1]))
                $sql.="name='" . addslashes($CsvToArray[1]) . "', "; // ��������

            if ($this->ObjSystem->getSerilizeParam('1c_option.update_content') == 1 and !empty($CsvToArray[4]))
                $sql.="content='" . addslashes($CsvToArray[4]) . "', "; // ������� ��������

            if ($this->ObjSystem->getSerilizeParam("1c_option.update_description") == 1 and !empty($CsvToArray[2]))
                $sql.="description='" . addslashes($CsvToArray[2]) . "', "; // ��������� ��������

            if ($this->ObjSystem->getSerilizeParam("1c_option.update_category") == 1 and !empty($CsvToArray[15]))
                $sql.="category='" . trim($CsvToArray[15]) . "', "; // ���������

            if ($this->ObjSystem->getSerilizeParam("1c_option.update_price") == 1 and !empty($CsvToArray[7]))
                $sql.="price='" . @$CsvToArray[7] . "', "; // ���� 1

                
// ����������������
            if ($this->ObjSystem->getSerilizeParam("1c_option.update_item") == 1) {
                $sql.=$this->getWarehouse($CsvToArray[6]);
                $CsvToArray[6] = $this->items;
            }

            // �����
            if ($this->ObjSystem->getSerilizeParam("1c_option.update_item") == 1) {
                switch ($this->Sklad_status) {

                    // ����� �������� ��� �����
                    case(3):
                        if ($CsvToArray[6] < 1)
                            $sql.="sklad='1', enabled='1', p_enabled='0', ";
                        else
                            $sql.="sklad='0', enabled='1', p_enabled='1', ";
                        break;

                    // ����� ��������� � ������
                    case(2):
                        if ($CsvToArray[6] < 1)
                            $sql.="enabled='0', p_enabled='0', ";
                        else
                            $sql.="enabled='1', sklad='0', p_enabled='1', ";
                        break;

                    // �� �����������
                    default: $sql.="";
                }
            }
            else {
                $sklad = 0;
                $enabled = 1;
            }

            if (!empty($CsvToArray[3])) {
                $sql.="pic_small='" . $this->ImagePlus($CsvToArray[3]) . "_1s." . $this->ImageSrc . "',";
                $sql.="pic_big='" . $this->ImagePlus($CsvToArray[3]) . "_1." . $this->ImageSrc . "',";
            }

            if ($this->ObjSystem->getSerilizeParam("1c_option.update_price") == 1) {

                $sql.="price2='" . @$CsvToArray[8] . "', "; // ���� 2
                $sql.="price3='" . @$CsvToArray[9] . "', "; // ���� 3
                $sql.="price4='" . @$CsvToArray[10] . "', "; // ���� 4
                $sql.="price5='" . @$CsvToArray[11] . "', "; // ���� 5
            }

            if ($this->ObjSystem->getSerilizeParam("1c_option.update_item") == 1 and !is_array($this->warehouse))
                $sql.="items='" . @$CsvToArray[6] . "', "; // �����

            if (PHPShopProductFunction::true_parent($CsvToArray[0])) {
                $sql.="parent_enabled='1', ";
            } else {
                $sql.="parent_enabled='0', ";
            }

            // ����������� ������
            if (strstr($CsvToArray[16], "@")) {
                $parent_array = explode("@", $CsvToArray[16]);
                $sql.="parent='" . $parent_array[0] . "', parent2='" . $parent_array[1] . "',";
            }
            else
                $sql.="parent='" . $CsvToArray[16] . "', ";

            // SEO
            if ($this->seourlpro_enabled and $this->seo_update) {
                $sql.="prod_seo_name='" . str_replace("_", "-", PHPShopString::toLatin($CsvToArray[1])) . "', ";
            }

            // ���
            if (!empty($CsvToArray[12]))
                $sql.="weight='" . $CsvToArray[12] . "', ";

            // ������
            if (!empty($CsvToArray[14]))
                $sql.="baseinputvaluta='" . $this->GetIdValuta[$CsvToArray[14]] . "', ";

            $sql.="datas='" . date("U") . "' "; // ���� ���������

            $sql.=" where uid='" . $CsvToArray[0] . "'";

            // �������
            if (isset($_REQUEST['debug'])) {
                echo $sql . PHP_EOL;
                $result = mysqli_query($link_db, $sql) or die(mysqli_error($link_db)) . PHP_EOL;
            }
            else
                $result = mysqli_query($link_db, $sql);

            if ($result)
                $this->ItemUpdate++;

            // ��������� �������� � �������
            if (!empty($CsvToArray[3])) {
                $last_id = $this->getIdForImages($CsvToArray[0]);
                $ready_num_img = $this->GetNumFoto($last_id);
                $img_num = $CsvToArray[5] - $ready_num_img;
                $img_num = +$ready_num_img;
                while ($img_num < $CsvToArray[5]) {
                    $ImgName = $this->ImagePlus($CsvToArray[3]) . "_" . ($img_num + 1) . "." . $this->ImageSrc;
                    $sql = "INSERT INTO " . $this->TableNameFoto . " VALUES ('',$last_id,'$ImgName','$img_num','')";
                    $result = mysqli_query($link_db, $sql);
                    $img_num++;
                }
            }

            // ��������� ��������������
            if ($this->ObjSystem->getSerilizeParam("1c_option.update_category") == 1 and $this->ObjSystem->getSerilizeParam("1c_option.update_sort") == 1 and !empty($CsvToArray[$GLOBALS['option']['sort']])) {

                // ��������� �������������
                $resCharsArray = charsGenerator($CsvToArray[15], $CsvToArray);

                if (is_array($resCharsArray)) {
                    $vendor = null;
                    $resSerialized = serialize($resCharsArray);
                    foreach ($resCharsArray as $k => $v) {
                        if (is_array($v)) {
                            foreach ($v as $o => $p) {
                                $vendor.="i" . $k . "-" . $p . "i";
                            }
                        } else {
                            $vendor.="i" . $k . "-" . $v . "i";
                        }
                    }

                    $sql = "UPDATE " . $this->TableName . " SET ";
                    $sql.="vendor='" . $vendor . "', ";
                    $sql.="vendor_array='" . $resSerialized . "' ";
                    $sql.=" where uid='" . $CsvToArray[0] . "'";

                    // �������
                    if (isset($_REQUEST['debug'])) {
                        echo $sql . PHP_EOL;
                        $result = mysqli_query($link_db, $sql) or die(mysqli_error($link_db)) . PHP_EOL;
                    }
                    else
                        $result = mysqli_query($link_db, $sql);
                }
            }
        }
        // ������� ����� �����
        else {

            // �����
            if ($this->ObjSystem->getSerilizeParam("1c_option.update_item") == 1) {

                // ����������������
                if ($this->ObjSystem->getSerilizeParam("1c_option.update_item") == 1) {
                    $sql.=$this->getWarehouse($CsvToArray[6]);
                    $CsvToArray[6] = $this->items;
                }


                switch ($this->Sklad_status) {

                    // ����� �������� ��� �����
                    case(3):
                        if ($CsvToArray[6] < 1) {
                            $sklad = 1;
                            $enabled = 1;
                            $p_enabled = 0;
                        } else {
                            $sklad = 0;
                            $enabled = $p_enabled = 1;
                        }
                        break;

                    // ����� ��������� � ������
                    case(2):
                        if ($CsvToArray[6] < 1)
                            $enabled = $p_enabled = 0;
                        else
                            $enabled = $p_enabled = 1;
                        break;

                    // �� �����������
                    default:
                        $sklad = 0;
                        $enabled = $p_enabled = 1;
                        break;
                }
            }
            else {
                $sklad = 0;
                $enabled = $p_enabled = 1;
            }

            // ��������� ��������������
            $vendor = $vendor_array = null;

            if ($this->ObjSystem->getSerilizeParam("1c_option.update_category") == 1 and $this->ObjSystem->getSerilizeParam("1c_option.update_sort") == 1 and !empty($CsvToArray[$GLOBALS['option']['sort']])) {

                // ��������� �������������
                $resCharsArray = charsGenerator($CsvToArray[15], $CsvToArray);
                if (is_array($resCharsArray)) {
                    $resSerialized = serialize($resCharsArray);
                    foreach ($resCharsArray as $k => $v) {
                        if (is_array($v)) {
                            foreach ($v as $o => $p) {
                                $vendor.="i" . $k . "-" . $p . "i";
                            }
                        } else {
                            $vendor.="i" . $k . "-" . $v . "i";
                        }
                    }
                }
                $vendor_array = serialize($resCharsArray);
            }

            $sql = "INSERT INTO " . $this->TableName . " SET ";

            // ��������������
            if (function_exists('mod_insert')) {
                $sql.=call_user_func_array('mod_insert', array(&$CsvToArray, __CLASS__, __FUNCTION__));
            }

            // ������������ ���������
            if ($this->ObjSystem->getSerilizeParam("1c_option.update_category") == 1 and !empty($CsvToArray[15]))
                $sql.="category='" . trim($CsvToArray[15]) . "',";
            else
                $sql.="category='1000001',";

            $sql.="name='" . addslashes($CsvToArray[1]) . "', "; // ��������

            if ($this->ObjSystem->getSerilizeParam('1c_option.update_content') == 1 and !empty($CsvToArray[4]))
                $sql.="content='" . addslashes($CsvToArray[4]) . "', "; // ������� ��������

            if ($this->ObjSystem->getSerilizeParam("1c_option.update_description") == 1 and !empty($CsvToArray[2]))
                $sql.="description='" . addslashes($CsvToArray[2]) . "', "; // ��������� ��������

            if ($this->ObjSystem->getSerilizeParam("1c_option.update_price") == 1 and !empty($CsvToArray[7]))
                $sql.="price='" . @$CsvToArray[7] . "', "; // ���� 1

            $sql.="
            sklad='" . $sklad . "',
            p_enabled='" . $p_enabled . "',
            enabled='" . $enabled . "',
            uid='" . $CsvToArray[0] . "',
            yml='1',
            datas='" . time() . "',
            vendor='" . $vendor . "',
            vendor_array='" . $vendor_array . "',";

            if (!empty($CsvToArray[3]))
                $sql.="pic_small='" . $this->ImagePlus($CsvToArray[3]) . "_1s." . $this->ImageSrc . "',
            pic_big='" . $this->ImagePlus($CsvToArray[3]) . "_1." . $this->ImageSrc . "',";

            if (PHPShopProductFunction::true_parent($CsvToArray[0])) {
                $sql.="parent_enabled='1', ";
            } else {
                $sql.="parent_enabled='0', ";
            }

            // ����������� ������ v 2.1
            if (strstr($CsvToArray[16], "@")) {
                $parent_array = explode("@", $CsvToArray[16]);
                $sql.="parent='" . $parent_array[0] . "', parent2='" . $parent_array[1] . "',";
            }
            else
                $sql.="parent='" . $CsvToArray[16] . "', ";

            // SEO
            if ($this->seourlpro_enabled) {
                $sql.="prod_seo_name='" . str_replace("_", "-", PHPShopString::toLatin($CsvToArray[1])) . "', ";
            }

            if ($this->ObjSystem->getSerilizeParam("1c_option.update_item") == 1 and !is_array($this->warehouse))
                $sql.="items='" . $CsvToArray[6] . "',";

            if ($this->ObjSystem->getSerilizeParam("1c_option.update_price") == 1) {
                $sql.="weight='" . $CsvToArray[12] . "',
            price2='" . $CsvToArray[8] . "',
            price3='" . $CsvToArray[9] . "',
            price4='" . $CsvToArray[10] . "',
            price5='" . $CsvToArray[11] . "',";
            }

            $sql.="baseinputvaluta='" . $this->GetIdValuta[$CsvToArray[14]] . "',
            ed_izm='" . $CsvToArray[13] . "'";

            // �������
            if (isset($_REQUEST['debug'])) {
                echo $sql . PHP_EOL;
                $result = mysqli_query($link_db, $sql) or die(mysqli_error($link_db)) . PHP_EOL;
            }
            else
                $result = mysqli_query($link_db, $sql);

            $this->ItemCreate++;

            // ��������� �������� � �������
            $img_num = 1;
            if (!empty($CsvToArray[3])) {
                //$last_id=$this->getIdForImages($CsvToArray[0]);
                $last_id = mysqli_insert_id($link_db);
                while ($img_num <= $CsvToArray[5]) {
                    $ImgName = $this->ImagePlus($CsvToArray[3]) . "_" . $img_num . "." . $this->ImageSrc;
                    $sql = "INSERT INTO " . $this->TableNameFoto . " VALUES ('',$last_id,'$ImgName','$img_num','')";
                    $result = mysqli_query($link_db, $sql);
                    $img_num++;
                }
            }
        }
    }

}

// �������������� ����
if (preg_match("/[^(0-9)|(\-)]/", $_REQUEST['date']))
    $date = "";
else
    $date = $_REQUEST['date'];

// �������� ������ Lite ��� ShopBuilder
if (empty($GLOBALS['option']['shopbuilder'])) {
    $path = "sklad";
    $dir = $path . "/" . $date;
} else {
    $path = "../phpshop/templates/1cManager/sklad";
    $dir = $path . "/" . $date;
}

// ������ ���������
if ($_REQUEST['create_category'] == "true")
    $ReadCsvCatalog = new ReadCsvCatalog($dir . "/tree.csv");
else
    $ReadCsvCatalog = false;

// ���������� ��������� ��������
$PS = new PHPShopSystem();

// ������� �����
if ($_REQUEST['files'] == "all" and is_dir($dir))
    if (@$dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {

            if ($file != "." and $file != ".." and $file != "tree.csv")
                $list_file[] = $file;
        }
        closedir($dh);
    }
if (is_file("./" . $dir . "/" . $_REQUEST['files'])) {
    $list_file[] = $_REQUEST['files'];
}

// ������������
if (isset($error)) {
    if (is_array($list_file))
        $list_file[$error] = "";
}


if (is_array($list_file))
    foreach ($list_file as $val) {

        // �������� ������
        $time = explode(' ', microtime());
        $start_time = $time[1] + $time[0];

        $fp = $dir . "/" . $val;
        if (file_exists($fp) and $val != 'tree.csv') {

            // ������ ����
            $ReadCsv = new ReadCsv1C($fp, $ReadCsvCatalog, $PS);
            $F_done.=$val . ";";

            $GetCatalogCreate+=$ReadCsv->GetCatalogCreate();
            $GetItemCreate+=$ReadCsv->GetItemCreate();
            $GetItemUpdate+=$ReadCsv->GetItemUpdate();

            // ��������������
            if (function_exists('mod_end_load')) {
                call_user_func_array('mod_end_load', array($ReadCsv, __CLASS__, __FUNCTION__));
            }

            // ���������
            if ($_REQUEST['files'] != "all")
                echo $date . ";" . $F_done . "
" . $GetItemCreate . ";" . $GetItemUpdate . ";" . $GetCatalogCreate . ";";

            // ��������� ������
            $time = explode(' ', microtime());
            $seconds = ($time[1] + $time[0] - $start_time);
            $seconds = substr($seconds, 0, 6);

            // ������
            $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['table_name12']);
            $PHPShopOrm->insert(array('datas_new' => time(), 'p_name_new' => $date, 'f_name_new' => $val, 'time_new' => $seconds));
        }
    }
else
    exit("�� ���� ��������� ���� " . $dir . "/" . $val);

if ($_REQUEST['files'] == "all")
    echo $date . ";" . $F_done . "
" . $GetItemCreate . ";" . $GetItemUpdate . ";" . $GetCatalogCreate . ";";
?>