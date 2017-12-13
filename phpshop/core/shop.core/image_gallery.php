<?php
/**
 * ����� ����������� ��� ���������� ��������
 * @author PHPShop Software
 * @version 1.0
 * @package PHPShopCoreFunction
 * @param obj $obj ������ ������
 * @param row $row ����� ������
 * @return mixed
 */
function image_gallery($obj,$row) {
    global $SysValue;

    if(!empty($row['pic_big'])) {
        $n=$row['id'];
        $pic_big=$row['pic_big'];
        $name_foto=$row['name'];
        $disp=null;
        $PHPShopOrm = new PHPShopOrm($obj->getValue('base.foto'));
        $data=$PHPShopOrm->select(array('*'),array('parent'=>'='.$row['id']),array('order'=>'num'),array('limit'=>100));
        if(is_array($data)){
            $j=1;
            foreach($data as $row){
                $name=$row['name'];
                $name_s=str_replace(".","s.",$name);
                $name_bigstr=str_replace(".","_big.",$pic_big);
                $name_big="http://".$_SERVER['HTTP_HOST'].$name_bigstr;
                if (@fopen($name_big, "r")) {
                    $name_b = str_replace(".","_big.",$pic_big);
                } else {
                    $name_b = str_replace(".",".",$pic_big);
                    ;
                }
                $id=$row['id'];
                $info=$row['info'];
                $FotoArray[]=array(
                        "id"=>$id,
                        "name"=>$name,
                        "name_s"=>$name_s,
                        "name_b"=>$name_b,
                        "info"=>$info
                );

            }

            if(is_array($FotoArray))
                $dBig='<div align="center" id="IMGloader" style="padding-bottom: 10px">
<a class=highslide onclick="return hs.expand(this)" href="'.$name_b.'" target=_blank getParams="null"><img id="currentBigPic" src="'.$pic_big.'" border="1" class="imgOn" alt="'.$row['name'].'"
    onerror="NoFoto2(this)"></a><div class="highslide-caption">'.$name_foto.'</div><br>'.$FotoArray[0]["info"].'
</div>';

            if(is_array($FotoArray[0]) and count($FotoArray)>1)
                $disp.='<td align="center">
  <a href="javascript:fotoload('.$n.',0);"><img src="'.$FotoArray[0]["name_s"].'" alt="'.$FotoArray[0]["info"].'" border="1" class="imgOn" onerror="NoFoto2(this)"></a></td>';

            if(is_array($FotoArray[1]))
                $disp.='<td align="center">
    <a href="javascript:fotoload('.$n.',1);"><img src="'.$FotoArray[1]["name_s"].'" alt="'.$FotoArray[1]["info"].'" border="1" class="imgOff" onmouseover="ButOn(this)" onmouseout="ButOff(this)" onerror="NoFoto2(this)"></a></td>';

            if(is_array($FotoArray[2]))
                $disp.='<td align="center">
     <a href="javascript:fotoload('.$n.',2);"><img src="'.$FotoArray[2]["name_s"].'" alt="'.$FotoArray[2]["info"].'" border="1" class="imgOff" onmouseover="ButOn(this)" onmouseout="ButOff(this)" onerror="NoFoto2(this)"></td><td>
<a href="javascript:fotoload('.$n.',2);" title="'.__('�����').'"><img src="../phpshop/lib/templates/icon/next.png" alt="'.__('�����').'" border="0"></a></td>';

            $d=$dBig;
            if(count($data)>1) $d.='<table class="foto">
<tr>
'.$disp.'</tr>
</table>
<div>�������� �����������: <strong>'.count($data).'</strong> </div>
';
        }
        else {
            $d='<div align="center" id="IMGloader" style="padding-bottom: 10px">
 <img src="'.$pic_big.'" border="1" class="imgOn" alt="'.$f.'" onerror="NoFoto2(this)"></div>';
        }

        // ���������
        $obj->set('productFotoList',$d);
    }
}
?>