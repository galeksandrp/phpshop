<?php
 
 
/**
 * ��������� meta title description keywords �������� �� ��������
 */
function ID_hook($obj, $data, $rout) {
 
        //���������� � �� ���������
        $title = trim($data['meta_title']);
        $keywords = trim($data['meta_keywords']);
        $description = trim($data['meta_description']);

        // ����
        if($title!='')
            $obj->title = $title;
        if($keywords!='')
            $obj->keywords = $keywords;
        if($description!='')
            $obj->description = $description;
}
 
$addHandler=array
        (
            'ID' => 'ID_hook'
 
);
?>