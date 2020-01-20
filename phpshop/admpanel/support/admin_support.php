<?php

$TitlePage = __("Техподдержка");

function actionStart() {
    global $PHPShopInterface, $TitlePage;

    $licFile = PHPShopFile::searchFile('../../license/', 'getLicense', true);
    @$License = parse_ini_file_true("../../license/" . $licFile, 1);

    if ($License['License']['RegisteredTo'] == 'Trial NoName' or $License['License']['SupportExpires'] < time() or $_SERVER["REMOTE_ADDR"] == '185.183.160.137')
        $action = 'noSupport';
    else
        $action = 'addNew';

    $PHPShopInterface->action_button['Новая заявка'] = array(
        'name' => '',
        'action' => $action,
        'class' => 'btn btn-default btn-sm navbar-btn',
        'type' => 'button',
        'icon' => 'glyphicon glyphicon-plus',
        'tooltip' => 'data-toggle="tooltip" data-placement="left" title="' . __('Новая заявка в техподдержку') . '"'
    );

    $PHPShopInterface->setActionPanel($TitlePage, false, array('Новая заявка'));
    $PHPShopInterface->checkbox_action = false;
    $PHPShopInterface->addJSFiles('./support/gui/support.gui.js');
    $PHPShopInterface->setCaption(array("Заголовок", "60%"), array("№", "10%", array('align' => 'left')), array("Дата", "15%", array('align' => 'center')), array("Статус", "15%", array('align' => 'right')));

    if ($action == 'addNew') {
        PHPShopObj::loadClass('xml');
        $path = 'https://help.phpshop.ru/base-xml-manager/search/xml.php?s=' . $License['License']['Serial'] . '&u=' . $License['License']['DomenLocked'];
        $dataArray = readDatabase($path, "row");
    }

    $status_array = array(
        0 => '<span>Новая заявка</span>',
        1 => '<span class="text-warning">Ожидание ответа</span>',
        2 => '<span class="text-success">Есть ответ</span>',
        3 => '<span class="text-muted">Выполнено</span>',
    );

    if (is_array($dataArray))
        foreach ($dataArray as $row) {

            $PHPShopInterface->setRow(array('name' => $row['subject'], 'link' => '?path=' . $_GET['path'] . '&id=' . $row['id'] . '#m', 'align' => 'left'), array('name' => $row['id'], 'align' => 'left'), array('name' => $row['lastchange'], 'align' => 'center'), $status_array[$row['status']]);
        }

    $PHPShopInterface->Compile();
}

?>