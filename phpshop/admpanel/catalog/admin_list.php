<?php

$TitlePage = __("��������");
PHPShopObj::loadClass('valuta');
PHPShopObj::loadClass('category');
PHPShopObj::loadClass('sort');
unset($_SESSION['jsort']);

/**
 * ����� �������
 */
function actionStart() {
    global $PHPShopGUI, $TitlePage;


    $PHPShopGUI->action_button['�������� �������'] = array(
        'name' => '',
        'action' => 'addNewCat',
        'class' => 'btn btn-default btn-sm navbar-btn',
        'type' => 'button',
        'icon' => 'glyphicon glyphicon-plus',
        'tooltip' => 'data-toggle="tooltip" data-placement="left" title="' . __('�������� �������') . '"'
    );

    $PHPShopGUI->setActionPanel($TitlePage, false, array('�������� �������'));


    $PHPShopGUI->addJSFiles('./js/jquery.treegrid.js', './catalog/gui/catalog.gui.js', './js/bootstrap-treeview.min.js');
    $PHPShopGUI->addCSSFiles('./css/bootstrap-treeview.min.css');

    // �����������
    $treebar = '<div class="progress">
  <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
    <span class="sr-only">' . __('��������') . '..</span>
  </div>
</div>';

    // ����� ���������
    $search = '<div class="none" id="category-search" style="padding-bottom:5px;"><div class="input-group input-sm">
                <input type="input" class="form-control input-sm" type="search" id="input-category-search" placeholder="' . __('������ � ����������...') . '" value="">
                 <span class="input-group-btn">
                  <a class="btn btn-default btn-sm" id="btn-search" type="submit"><span class="glyphicon glyphicon-search"></span></a>
                 </span>
            </div></div>';

    $sidebarleft[] = array('title' => '���������', 'content' => $search . '<div id="tree">' . $treebar . '</div>', 'title-icon' => '<div class="hidden-xs"><span class="glyphicon glyphicon-chevron-down" data-toggle="tooltip" data-placement="top" title="' . __('���������� ���') . '"></span>&nbsp;<span class="glyphicon glyphicon-chevron-up" data-toggle="tooltip" data-placement="top" title="' . __('��������') . '"></span>&nbsp;<span class="glyphicon glyphicon-search" id="show-category-search" data-toggle="tooltip" data-placement="top" title="' . __('�����') . '"></span></div>');

    $PHPShopGUI->setSidebarLeft($sidebarleft, 3);

    $PHPShopGUI->Compile(3);
}

// ��������� �������
$PHPShopGUI->getAction();
?>