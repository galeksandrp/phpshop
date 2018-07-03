<?php

/**
 * ������ ������������� ������
 * @param array $row ������ ������
 * @return string 
 */
function tab_option($data) {
    global $PHPShopInterface, $PHPShopSystem,$CategoryArray;

    $PHPShopInterface = new PHPShopInterface();
    $PHPShopInterface->action_title['value-edit'] = '�������������';
    $PHPShopInterface->action_title['value-delete'] = '�������';
    
    $PHPShopParentNameArray = new PHPShopParentNameArray(array('id'=>'='.$CategoryArray[$data['category']]['parent_title']));
    $parent_title = $PHPShopParentNameArray->getParam($CategoryArray[$data['category']]['parent_title'].".name");
    if(empty($parent_title))
        $parent_title="������������ ������� ��� ������";
    

    $PHPShopInterface->dropdown_action_form = false;
    $PHPShopInterface->checkbox_action = false;
    $PHPShopInterface->setCaption(array($parent_title. ' <a class="glyphicon glyphicon glyphicon-cog" href="?path=catalog&id='.$data['category'].'&tab=3" title="��������" style="cursor:pointer;"></a>', "35%"), array("����", "25%"), array("���-��", "10%"), array("����", "15%"), array(null, "10%"), array("�����", "5%", array('align' => 'right')));

    // ������� � �������
    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['products']);
    $PHPShopOrm->debug = false;
    $PHPShopOrm->mysql_error = false;

    $parent_array = @explode(",", $data['parent']);
    if (is_array($parent_array))
        foreach ($parent_array as $v)
            if (!empty($v))
                $parent_array_true[] = $v;

    if (!empty($data['parent'])) {

        // ������� �� 1�
        if ($PHPShopSystem->ifSerilizeParam('1c_option.update_option'))
            $data_option = $PHPShopOrm->select(array('*'), array('uid' => ' IN ("'. @implode('","', $parent_array_true) . '")', 'parent_enabled' => "='1'"), array('order' => 'num,name DESC'), array('limit' => 100));
        else
            $data_option = $PHPShopOrm->select(array('*'), array('id' => ' IN ("'. @implode('","', $parent_array_true) . '")', 'parent_enabled' => "='1'"), array('order' => 'num,name DESC'), array('limit' => 100));
        
    }

    if (is_array($data_option))
        foreach ($data_option as $row) {

            if (empty($row['parent'])  and empty($row['parent2']) and !empty($row['name']))
                $row['parent'] = $row['name'];

            // �����
            if (empty($row['enabled']) or !empty($row['sklad']))
                $icon = '<span class="pull-right text-muted glyphicon glyphicon-eye-close" data-toggle="tooltip" data-placement="top" title="'.__('������').'"></span>';
            else
                $icon = null;
            
            if($row['color'] == '#ffffff')
                $row['color']='';

            $PHPShopInterface->setRow(array('name' => $row['parent'], 'editable' => 'parent_new', 'id' => $row['id']), array('name' => $row['parent2'], 'editable' => 'parent2_new', 'id' => $row['id'],'color'=>$row['color']),array('name' => $row['items'], 'align' => 'center', 'editable' => 'items_new', 'id' => $row['id']), array('name' => $row['price'], 'editable' => 'price_new', 'id' => $row['id']), array('action' =>
                array('value-edit', '|', 'value-delete', 'id' => $row['id']), 'align' => 'center'), array('name' => $icon));
        }

    $PHPShopInterface->setRow(array('name' => '<input style="width:100%" data-id="" placeholder="'.__('��������').'" name="name_option_new" class="form-control input-sm" value="">'),array('name' => '<input style="width:100%" data-id="" placeholder="'.__('��������').'" name="name2_option_new" class="form-control input-sm " value="">'), array('name' => '<input style="width:100%" class="form-control input-sm" name="items_option_new" value="1">'), array('name' => '<input style="width:100%" class="form-control input-sm" name="price_option_new" value="' . $data['price'] . '">'), array('name'=>'<button data-toggle="tooltip" data-placement="top" type="button" name="addOption" class="btn btn-default btn-sm" value="" data-original-title="'.__('�������� ������').'"><span class="glyphicon glyphicon-plus"></span> '.__('��������').'</button>', 'align' => 'left'), '');
    $disp = '<table class="table table-hover value-list">' . $PHPShopInterface->getContent() . '</table>';

    return $disp;
}

?>