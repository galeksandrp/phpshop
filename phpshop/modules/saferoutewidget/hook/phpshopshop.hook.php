<?php
function UID_saferoutewidget_hook($obj, $dataArray, $rout) {
    if ($rout == 'MIDDLE') {
        
        // API
        include_once 'phpshop/modules/saferoutewidget/class/saferoutewidget.class.php';
        $saferoutewidget = new saferoutewidget();
        $option = $saferoutewidget->option();
        
        if($option['prod_enabled']=='1'&&!empty($option['key'])) {
    
            $html = ParseTemplateReturn($GLOBALS['SysValue']['templates']['saferoutewidget']['saferoute_prod_template'], true);    
            $obj->set('saferouteCart', $html);
        }
    }
}

$addHandler = array
(
    'UID' => 'UID_saferoutewidget_hook',
);


?>