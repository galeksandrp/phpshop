<?php

function tab_menu() {
    global $subpath;

    ${'menu_active_' . $subpath[1]} = 'active';

    $tree = '
       <ul class="nav nav-pills nav-stacked">
       <li class="' . $menu_active_metrica . '"><a href="?path=metrica">' . __('������') . '</a></li>
       <li class="' . $menu_active_traffic . '"><a href="?path=metrica.traffic">' . __('������������') . '</a></li>
       <li class="' . $menu_active_popular . '"><a href="?path=metrica.popular">' . __('��������') . '</a></li>
       <li class="' . $menu_active_sources_summary . '"><a href="?path=metrica.sources_summary">' . __('���������, ������') . '</a></li>
       <li class="' . $menu_active_sources_social . '"><a href="?path=metrica.sources_social">' . __('���������� ����') . '</a></li>
       <li class="' . $menu_active_sources_sites . '"><a href="?path=metrica.sources_sites">' . __('�����') . '</a></li>
       <li class="' . $menu_active_search_phrases . '"><a href="?path=metrica.search_phrases">' . __('��������� �����') . '</a></li>
       <li class="' . $menu_active_search_engines . '"><a href="?path=metrica.search_engines">' . __('��������� �������') . '</a></li>
       </ul>';

    return $tree;
}

?>
