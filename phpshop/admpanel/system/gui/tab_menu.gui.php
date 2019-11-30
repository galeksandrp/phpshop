<?php

function tab_menu() {
    global $subpath;

    ${'menu_active_' . $subpath[1]} = 'active';
    
    $tree = '
       <ul class="nav nav-pills nav-stacked">
       <li class="' . $menu_active_system . '"><a href="?path=system">'.__('�������� ���������').'</a></li>
       <li class="' . $menu_active_company . '"><a href="?path=system.company">'.__('���������').'</a></li>
       <li class="' . $menu_active_sync . '"><a href="?path=system.sync">'.__('�������������� (CRM)').'</a></li>
       <li class="' . $menu_active_seo . '"><a href="?path=system.seo">'.__('SEO ���������').'</a></li>
       <li class="' . $menu_active_currency . '"><a href="?path=system.currency">'.__('������').'</a></li>
       <li class="' . $menu_active_image . '"><a href="?path=system.image">'.__('�����������').'</a></li>
       <li class="' . $menu_active_servers . '"><a href="?path=system.servers">'.__('�������').'</a></li> 
       <li class="' . $menu_active_warehouse . '"><a href="?path=system.warehouse">'.__('������').'</a></li>
       <li class="' . $menu_active_integration . '"><a href="?path=system.integration">'.__('���������� � ���������').'</a></li>     
       <li><a href="?path=tpleditor">'.__('������� �������').'</a></li>
       </ul>';
    
    return $tree;
}

?>
