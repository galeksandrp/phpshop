<?php

/**
 * ������ �������������� ��������
 * @param array $row ������ ������
 * @return string 
 */
function tab_base($data) {
    global $PHPShopGUI, $skin_base_path, $PHPShopBase;


    // ������������� �������
    if (is_array($data))
        foreach ($data as $val) {
            $path_parts = pathinfo($val);
            $ready_theme[] = $path_parts['basename'];
        }


    /*    
    $i = 1;
    $count = 0;
    $data_pic = xml2array($skin_base_path . '/commerce.php', "template", true);
    
    $title = '<p class="text-muted hidden-xs data-row">'.__('�� ������ ���������� ����� ������� ������ �� �������������� �����. ��� ������� ������� ��������� � ����������� ��������� HTML5 � ��������� ��������� ��� ��������� ���������. �� ������ ���������� ��������������� ������ �������� ������� � ������������ �� 30 ����. �� ��������� ���������������� ������, ������ �������� � ����� ������������� �����������. ����� ������� ������� �������� ������������ ���� ��� ������������� ������� �� ����� �����. ��� ������� ������ ������ ��������� ����������� ��������� ���� �������').'.</p>';

    // ������� �������
    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['templates_key']);
    $data_template = $PHPShopOrm->select(array('*'), false, false, array('limit' => 100));
    if (is_array($data_template))
        foreach ($data_template as $row)
            $template_com[$row['path']] = $row;

    $img_list = $buy = null;
    $PHPShopTemplates = new PHPShopTemplates();
    if (is_array($data_pic))
        foreach ($data_pic as $row) {

            if ($i == 1)
                $img_list.='<div class="row">';

            if (@in_array($row['name'], $ready_theme)) {
                $main = "hide";
                $serial = "btn-default";
                $panel = 'panel-warning';

                if ($PHPShopTemplates->checkKey($row['name'], $template_com[$row['name']]['key'])) {
                    $panel = 'panel-success';
                    $serial = $buy = $trial = 'hide';
                    $active = null;
                } else {
                    $panel = 'panel-warning';
                    $buy = $trial = null;
                    $active = 'hide';
                }

                if (is_array($template_com[$row['name']]))
                    $mes = ' - ����������';
                else {
                    $date_end = time() + 2592000;
                    $key = null;
                    $sql = "INSERT INTO " . $GLOBALS['SysValue']['base']['templates_key'] . "  VALUES ('" . $row['name'] . "'," . $date_end . ",'" . $key . "','" . md5($row['name'] . $date_end . $_SERVER['SERVER_NAME'] . $key) . "')";
                    mysqli_query($PHPShopBase->link_db, $sql);
                    $mes = ' - ��������';
                }
            } else {
                $main = "btn-default";
                $panel = 'panel-default';
                $serial = $active = $trial = "hide";
                $mes = $buy = null;
            }

            $day = intval(round(($template_com[$row['name']]['date'] - time()) / (86400)));
            if ($day > 30 or $day < 0)
                $day = 30;



            $img_list.='<div class="col-md-4"><div class="panel ' . $panel . '"><div class="panel-heading">' . $row['name'] . $mes . '
                <span class="glyphicon glyphicon-plus pull-right btn ' . $main . ' btn-xs skin-load" data-path="' . $row['name'] . '" data-type="commerce" data-toggle="tooltip" data-placement="top" title="' . __('���������') . '"></span>
                <span class="glyphicon glyphicon-credit-card pull-right btn ' . $serial . ' btn-xs skin-serial" data-path="' . $row['name'] . '" data-type="commerce" data-toggle="tooltip" data-placement="top" title="' . __('������ ����') . '" data-key="' . $template_com[$row['name']]['key'] . '"></span>
                    </div><div class="panel-body text-center"><img class="image-shadow" style="max-height:150px" src="' . $skin_base_path . $row['icon'] . '">
                        
</div>
                     <div class="text-center panel-footer">
                     <a class="btn btn-sm btn-default active ' . $active . '" data-toggle="tooltip" data-placement="top" title="' . __('����: ') . $template_com[$row['name']]['key'] . '"><span class="glyphicon glyphicon-ok"></span> ' . __('�����������').'</a>
                        <div class="btn-group" role="group" aria-label="...">
                        <a class="btn btn-sm btn-primary ' . $buy . '" data-toggle="tooltip" data-placement="top" title="' . __('������ ��������') . '" href="http://www.phpshop.ru/market/?F=' . getPayLink($row['price'], $row['name']) . '" target="_blank">' . __('������').' ' . $row['price'] . ' <span class="rubznak hidden-xs">p</span></a>
                              <a class="btn btn-sm btn-default ' . $trial . '" data-toggle="tooltip" data-placement="top" title="' . __('�������� �� ����� ����') . '"><span class="glyphicon glyphicon-time"></span> ' . $day . ' ��.</a>
                        
                        <a class="btn btn-sm btn-default ' . $buy . '" data-toggle="tooltip" data-placement="top" title="' . __('���������� ����') . '" href="http://market.phpshop.ru/?skin=' . $row['name'] . '" target="_blank"><span class="glyphicon glyphicon-eye-open"></span> ' . __('����').'</a>
                        </div>
                     </div>
                        
                        </div>
                   </div>';

            if ($i == 3) {
                $img_list.='</div>';
                $i = 1;
            }
            else
                $i++;

            $count++;
        }


    if (count($data_pic) % 3 != 0)
        $img_list.='</div>';


    // �������� �������
    $i = 1;
    $count = 0;
    $data_pic = xml2array($skin_base_path . '/template-archive.php', "template", true);
    arsort($data_pic);
    
    $title_free = '<p class="text-muted hidden-xs data-row">' . __('���� ������������ ������������ ���������� ������� �� ���������� ������ PHPShop. ���������������� ������������ �������� ����� ���������� �� ����������� ��������. ��� 100% ����������������� �������� ������������� ������������ ����������������� �������').'.</p>';
    $img_list_free = null;
    if (is_array($data_pic))
        foreach ($data_pic as $row) {

            if ($i == 1)
                $img_list_free.='<div class="row">';

            if (@in_array($row['name'], $ready_theme)) {
                $main = "hide";
                $panel = 'panel-success';
                $mes = ' - ����������';
            } else {
                $main = "btn-default";
                $panel = 'panel-default';
                $mes = null;
            }
            

 
            $img_list_free.='<div class="col-md-4"><div class="panel ' . $panel . '"><div class="panel-heading">' . $row['name'] . $mes . ' <span class="glyphicon glyphicon-plus pull-right btn ' . $main . ' btn-xs skin-load" data-path="' . $row['name'] . '" data-toggle="tooltip" data-type="archive" data-placement="top" title="' . __('���������') . '"></span></div><div class="panel-body text-center"><img class="image-shadow image-skin"  src="' . $skin_base_path . $row['icon'] . '"></div></div></div>';

            if ($i == 3) {
                $img_list_free.='</div>';
                $i = 1;
            }
            else
                $i++;

            $count++;
        }


    if (count($data_pic) % 3 != 0)
        $img_list_free.='</div>';
    
    */
    // ��������� ������� 
    $i = 1;
    $count = 0;
    $data_pic = xml2array($skin_base_path . '/template5.php', "template", true);
    arsort($data_pic);

    $title_default = '<p class="text-muted hidden-xs data-row">' . __('���� ������������ ������� ���������� �������, �������������� ��� ��������� ���������. ��� �������������� �������, �������� �� ������ "���������". ��������� ����� ������ ����� ��������� � <a href="?path=system#1"><span class="glyphicon glyphicon-share-alt"></span>������� ����������</a> ��� ����������� ����������� ��������').'.</p>';
    $img_list_default = null;
    if (is_array($data_pic))
        foreach ($data_pic as $row) {

            if ($i == 1)
                $img_list_default.='<div class="row">';

            if (@in_array($row['name'], $ready_theme)) {
                $main = "hide";
                $panel = 'panel-default';
                $mes = '  <span class="pull-right text-muted">' . __('��������').'</span>';
                $demo=null;
                $reload = 'skin-reload';
                $load = __('�����������');
                $icon = 'glyphicon-save';
            } else {
                $main = "btn-default";
                $panel = 'panel-default';
                $mes =  null;
                $reload = null;
                $demo="hide";
                $load = __('���������');
                $icon = 'glyphicon-plus';
            }
            
            if($row['type'] == 'new')
                $new = ' <span class="label label-primary">new</span>';
            else $new=null;
            

            $img_list_default.='<div class="col-md-4"><div class="panel ' . $panel . '"><div class="panel-heading">' . $row['name'] . $new. $mes . '</div><div class="panel-body text-center"><img class="image-shadow image-skin"  src="' . $skin_base_path . $row['icon'] . '"></div>
                
           <div class="text-center panel-footer">
                    
                        <div class="btn-group" role="group" aria-label="...">
                        <a class="btn btn-sm btn-primary ' . $demo.'" data-toggle="tooltip" data-placement="top" title="' . __('���������') . '" href="?path=' . $_GET['path'] . '&name=' . $row['name'] .'"><span class="glyphicon glyphicon-cog"></span> ' . __('���������').' ' . $row['price'] . ' </a>
                            
                        <a class="btn btn-sm btn-default skin-load '.$reload.' " data-path="' . $row['name'] . '" data-type="default" data-toggle="tooltip" data-placement="top" title="' .$load . '"><span class="glyphicon '.$icon.'"></span> </a>
                              
                        <a class="btn btn-sm btn-default ' . $demo.'" data-toggle="tooltip" data-placement="top" title="' . __('���������� ����') . '" href="../../?skin=' . $row['name'] . '" target="_blank"><span class="glyphicon glyphicon-eye-open"></span> ' . __('����').'</a>
                            
                        

                        </div>
                     </div>

</div></div>';

            if ($i == 3) {
                $img_list_default.='</div>';
                $i = 1;
            }
            else
                $i++;

            $count++;
        }


    if (count($data_pic) % 3 != 0)
        $img_list_default.='</div>';

    // ������������ ������
    $promo = '������-���� <a href="http://www.phpshop.ru/page/portfolio.html" target="_blank">PHPShop.Design</a> ������ ������� ������ ���  PHPShop, � ������, �������������� ��� �������� ������� �� ����������, �  �� �������� ���������� ���������������� ������ � ����, ���������� ����  ����������� ������������ ���. 
   <p>     
<ol>
        <li>�� �� 100% ����� ���� ���������, � ��� ������, ���  ��� �� �������� ������������� �� ���� ������ ���������, �� ��������� �  PHPShop. </li>
        <li>�� ��������� ��������� ��� ���������������� PHPShop  ��� �� ������ ����� ��� ��������, � �� �������� ����������  ��������-������� �����, ����� �� ��� ������ �� ������������ ���� ������. </li>
        <li>����������� ���������, ����� �����������  ������������� � ��� ���������, �� ����� ������ PHPShop,  ������������ � ������� "������-�����", - ��� ������, ��� � ������� �� ������� ����������� ��� ������ ���������. </li>
        <li>�� ��������� �����, � ������������� �������� - ����  ����� ���������� ������� �� �������� ������� � ����� �������  ��  �������� ���. </li>
    </ol>
    </p>
    <p>��� ������ ������������� ������� ����� ��������� ����, � ������� ��  ������������ ������� ������, ��� ����������� ������� �������� � �����  �������������. C��� �������� ������ ������� - 15 ������� ����.</p>'.'
    <p>
    <a href="http://www.phpshop.ru/calculation/brifdesign/?from='.$_SERVER['SERVER_NAME'].'" target="_blank" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-share-alt"></span> '.__('���� �� ������������ ������ ��������-��������').'</a></p>';


    if (!empty($img_list_default)) {
        $PHPShopGUI->setTab(array(__('���������� �������'), $title_default . $img_list_default, true),  array(__('������������ ������'), $promo, true));
    }
    else
        $disp = $PHPShopGUI->setAlert('������ ����� � �������� ' . $skin_base_path, $type = 'warning');


    return $disp;
}

function getPayLink($amount, $template) {
    global $PHPShopSystem;

    $str = array(
        "url" => getenv('SERVER_NAME'),
        "template" => $template,
        "amount" => number_format($amount, 2, '.', ''),
        "time" => time("U") + (3 * 86400),
        'name' => $PHPShopSystem->getParam('company')
    );

    $str = serialize($str);
    $code = base64_encode($str);
    $code2 = str_replace("O", "!", $code);
    $code2 = str_replace("M", "$", $code2);

    return $code2;
}

?>
