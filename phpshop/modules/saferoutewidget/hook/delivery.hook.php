<?php

/**
 * Õóê
 */
function saferoutewidget_delivery_hook($obj, $data) {

    $_RESULT = $data[0];
    $xid = $data[1];

    // API
    include_once '../modules/saferoutewidget/class/saferoutewidget.class.php';
    $saferoutewidget = new saferoutewidget();
    $option = $saferoutewidget->option();

    if (in_array($xid, @explode(",", $option['delivery_id']))) {

        $hook['dellist'] = $_RESULT['dellist'];
        $hook['hook'] = 'saferoutewidgetStart();';
        $hook['delivery'] = $_RESULT['delivery'];
        $hook['total'] = $_RESULT['total'];
        $hook['adresList'] = $_RESULT['adresList'];
        $hook['success'] = 1;

        return $hook;
    }
}

$addHandler = array
    (
    'delivery' => 'saferoutewidget_delivery_hook'
);
?>
