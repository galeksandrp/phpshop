<?php

// ������� �������
function MapValueReturn($m) {
    global $MapValue;

    $result = 'data-toggle="popover" data-title="@' . $m[1] . '@" data-content="<p>' . $MapValue[$m[1]]['description'] . '</p>';

    if (empty($MapValue[$m[1]]['path'])) {
        $MapValue[$m[1]]['path'] = 'main/index.tpl';
        $search = '&search=' . $m[1];
    }
    else
        $search = null;

    $result.='<div><span class=\'glyphicon glyphicon-share-alt\'></span> <a href=\'?path=tpleditor&name='.$_GET['name'].'&file=/' . $MapValue[$m[1]]['path'] . $search . '\'><code>' . $MapValue[$m[1]]['path'] . '</code></a></div>" data-trigger="click"';


    return $result;
}

/**
 * ������ ����� ��������
 * @param array $row ������ ������
 * @return string 
 */
function tab_map() {
    global $PHPShopGUI, $MapValue;

    $map_name = array(
        'lego'=>5,
        'terra'=>4,
        'hub'=>4,
        'unishop'=>2,
        'bootstrap' => 2,
        'bootstrap_fluid' => 3,
        'astero' => 1,
        'spice' => 1,
        'diggi' => 2,
    );

    if (!empty($map_name[$_GET['name']]))
        $name = $map_name[$_GET['name']];

    if (!empty($name)) {
        $wysiwyg = xml2array('./tpleditor/gui/wysiwyg.xml', "template", true);

        if (is_array($wysiwyg))
            foreach ($wysiwyg[0]['var'] as $template) {
                $MapValue[$template['name']] = $template;
            }

        $map = file_get_contents('./tpleditor/gui/map' . $name . '.gui.tpl');


        $result = @preg_replace_callback("/@([a-zA-Z0-9_]+)@/", 'MapValueReturn', $map);

        $disp = $PHPShopGUI->setCollapse(__('����� ������� ' . ucfirst($_GET['name'])), $result);

        return $disp;
    }
}

?>
