<?php

include_once dirname(__DIR__) . '/class/Request.php';

/**
 * Методы загрузки справочников с Новой почты.
 *
 * Class Loader
 */
class Loader {

    /**
     * @var Request
     */
    private $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function getWarehouses()
    {
        $result = $this->request->post(Request::ADDRESS_MODEL, Request::WAREHOUSES_METHOD);

        if($result['success']) {
            $query_values = array();
            $PHPShopOrm = new PHPShopOrm('phpshop_modules_novaposhta_warehouses');
            $PHPShopOrm->query('TRUNCATE `phpshop_modules_novaposhta_warehouses`');
            foreach ($result['data'] as $warehouse) {
                $query_values[] = "(" . "'" . str_replace("'", '`', $warehouse['Description']) . "','" .
                    $warehouse['Ref'] . "','" . str_replace("'", '`', $warehouse['ShortAddress']) . "','" . $warehouse['Phone'] . "','" .
                    $warehouse['TypeOfWarehouse'] . "','" . $warehouse['Number'] . "','" . $warehouse['SettlementRef'] . "','" .
                    $warehouse['Longitude'] . "','" . $warehouse['Latitude'] . "')";
            }
            $PHPShopOrm->query('INSERT INTO `phpshop_modules_novaposhta_warehouses` (`title`, `ref`, `address`, `phone`, `type`, `number`, `city`, `longitude`, `latitude`) VALUES ' . implode(',', $query_values));

            $PHPShopOrm->query('UPDATE `phpshop_modules_novaposhta_system` SET `last_warehouses_update`="' . time() . '" WHERE `id`=1');
        }
    }

    public function getWarehouseTypes()
    {
        $result = $this->request->post(Request::ADDRESS_MODEL, Request::WAREHOUSE_TYPES_METHOD);

        if($result['success']) {
            $query_values = array();
            $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['novaposhta']['novaposhta_whtypes']);
            $PHPShopOrm->query('TRUNCATE ' . $GLOBALS['SysValue']['base']['novaposhta']['novaposhta_whtypes']);
            foreach ($result['data'] as $type) {
                $query_values[] = '(' . '"' . $type['Description'] . '","' . $type['Ref'] . '")';
            }
            $PHPShopOrm->query('INSERT INTO ' . $GLOBALS['SysValue']['base']['novaposhta']['novaposhta_whtypes'] . ' (`title`, `ref`) VALUES ' . implode(',', $query_values));

            $PHPShopOrm->query('UPDATE ' . $GLOBALS['SysValue']['base']['novaposhta']['novaposhta_system'] . ' SET `last_whtypes_update`="' . time() . '" WHERE `id`=1');
        }
    }

    public function getCities()
    {
        $PHPShopOrm = new PHPShopOrm('phpshop_modules_novaposhta_cities');
        $PHPShopOrm->query('TRUNCATE `phpshop_modules_novaposhta_cities`');

        $result = $this->request->post(Request::ADDRESS_MODEL, Request::SETTLEMETS_METHOD, array('Warehouse' => 1, 'Page' => 1));

        $this->storeCities($result);

        if($result['success']) {
            $pages = ceil($result['info']['totalCount'] / Request::API_PER_PAGE);
            for($i = 2; $i <= $pages; $i++) {
                $this->storeCities($this->request->post(Request::ADDRESS_MODEL, Request::SETTLEMETS_METHOD, array('Warehouse' => 1, 'Page' => $i)));
            }

            $PHPShopOrm->query('UPDATE `phpshop_modules_novaposhta_system` SET `last_cities_update`="' . time() . '" WHERE `id`=1');
        }
    }

    /**
     * Сохранение населенных пунктов со страницы.
     * @param array $result
     */
    private function storeCities($result)
    {
        if($result['success']) {
            $query_values = array();
            $PHPShopOrm = new PHPShopOrm('phpshop_modules_novaposhta_cities');
            foreach ($result['data'] as $area) {
                // Почему-то с БД НП Киевская обл идет без области
                if(trim($area['AreaDescription']) === 'Київська') {
                    $area['AreaDescription'] = $area['AreaDescription'] . ' область';
                }

                $query_values[] = '(' . '"' .
                    $area['Description'] . '","' .
                    $area['Ref'] . '","' .
                    $area['Latitude'] . '","' .
                    $area['Longitude'] . '","' .
                    $area['Area'] . '","' .
                    $area['Description'] . ', ' . $area['AreaDescription'] . '")';
            }
            $PHPShopOrm->query('INSERT INTO `phpshop_modules_novaposhta_cities` (`city`, `ref`, `latitude`, `longitude`, `region`, `area_description`) VALUES ' . implode(',', $query_values));
        }
    }
}