<?php
/**
 * ���������� ����������� ������
 * @version 1.2
 * @package PHPShopClass
 * @subpackage Helper
 */
class PHPShopText {

    /**
     * ������ &nbsp
     * @param int $n ���������� ��������
     * @return string
     */
    function nbsp($n=1) {
        $i=0;
        $nbsp=null;
        while($i < $n) {
            $nbsp.='&nbsp';
            $i++;
        }
        return $nbsp;
    }

    /**
     * ������ �����
     * @param string $string �����
     * @param string $style �����
     * @return string
     */
    function b($string,$style=false) {
        return '<b style="'.$style.'">'.$string.'</b>';
    }

    /**
     * ����������
     * @param string $string �����
     * @param string> $icon ������
     * @param string $size ������ ������
     * @return string
     */
    function notice($string,$icon=false,$size=false) {
        if(!empty($icon)) $img=PHPShopText::img($icon);
        return $img.'<font color="red" style="font-size:'.$size.'">'.$string.'</font>';
    }

    /**
     * ���������
     * @param string $string �����
     * @param string $icon ������
     * @param string $size ������ ������
     * @param string $color ���� ������
     * @return string
     */
    function message($string,$icon=false,$size=false,$color='green') {
        if(!empty($icon)) $img=PHPShopText::img($icon);
        return $img.'<font color="'.$color.'" style="font-size:'.$size.'">'.$string.'</font>';
    }

    /**
     * �����������
     * @param string $src ����������
     * @param int $hspace �������������� ������
     * @param string $align ������������
     * @return string
     */
    function img($src,$hspace=5,$align='left') {
        return '<img src="'.$src.'" hspace="'.$hspace.'" align="'.$align.'" border="0">';
    }

    /**
     * ������� ������
     * @return string
     */
    function br() {
        return '<br>';
    }

    /**
     * ������
     * @param string $href ������
     * @param string $text �����
     * @param string $title ��������
     * @param string $color ����
     * @param string $size ������
     * @param string $target ������
     * @param string $class �����
     * @return string
     */
    function a($href,$text,$title=false,$color=false,$size=false,$target=false,$class=false) {
        $style='text-decoration:underline;';
        if($size) $style.='font-size:'.$size.'px;';
        if($color) $style.='color:'.$color;
        if(empty($title)) $title=$text;
        return '<a href="'.$href.'" title="'.$title.'" target="'.$target.'" class="'.$class.'" style="'.$style.'">'.$text.'</a>';
    }

    /**
     * �����
     * @param string $name ���
     * @return string
     */
    function slide($name) {
        return '<a name="'.$name.'"></a>';
    }

    /**
     * ��������� H1
     * @param string $string �����
     * @return string
     */
    function h1($string) {
        return '<h1>'.$string.'</h1>';
    }

    /**
     * ��������� H2
     * @param string $string �����
     * @return string
     */
    function h2($string) {
        return '<h2>'.$string.'</h2>';
    }

    /**
     * ��������� H3
     * @param string $string �����
     * @return string
     */
    function h3($string) {
        return '<h3>'.$string.'</h3>';
    }

    /**
     * ������
     * @param string $string �����
     * @return string
     */
    function ul($string) {
        return '<ul>'.$string.'</ul>';
    }

    /**
     * ������������ ������
     * @param string $string �����
     * @param string $type ���
     * @return string
     */
    function ol($string,$type=null) {
        return '<ol type="'.$type.'">'.$string.'</ol>';
    }

    /**
     * ������� ������
     * @param string $string �����
     * @param string $href ������
     * @return string
     */
    function li($string,$href=null) {
        if(!empty($href)) {
            $text=PHPShopText::a($href,$string);
            $li='<li>'.$text.'</li>';
        }
        else $li='<li>'.$string.'</li>';
        return $li;
    }

    /**
     * ��������� ���� TR
     * @return string
     */
    function tr() {
        $Arg=func_get_args();
        $tr='<tr class=tablerow>';
        foreach($Arg as $val) {
            $tr.=PHPShopText::td($val,'tablerow');
        }
        $tr.='</tr>';
        return $tr;
    }

    /**
     * ���������� ������
     * <code>
     * // example:
     * $value[]=array('��� ����� 1',123,'selected');
     * $value[]=array('��� ����� 2',456,false);
     * PHPShopText::select('my',$value,100);
     * </code>
     * @param string $name ���
     * @param array $value ���������� � ���� �������
     * @param int $width ������
     * @param string $float float
     * @param string $caption ����� ����� ���������
     * @param string $onchange ��� javascript ������� �� ������ onchange
     * @param int $height ������
     * @param int $size ������
     * @return string
     */
    function select($name,$value,$width,$float="none",$caption=false,$onchange="return true",$height=false,$size=1,$id=false) {

        if(empty($id)) $id=$name;

        $select=$caption.' <select name="'.$name.'" id="'.$id.'" size="'.$size.'" style="float:'.$float.';width:'.$width.'px;height:'.$height.'px" onchange="'.$onchange.'">';
        if(is_array($value))
            foreach($value as $val)
                $select.='<option value="'.$val[1].'" '.@$val[2].'>'.$val[0].'</option>';
        $select.='</select>';
        return $select;
    }

    /**
     * ������ ������� TD
     * @param string $string �����
     * @param string $class �����
     * @param string $colspan �������
     * @param string $id ��
     * @return string
     */
    function td($string,$class=false,$colspan=false,$id=false) {
        return '<td class="'.$class.'" id="'.$id.'" colspan="'.$colspan.'">'.$string.'</td>';
    }

    /**
     * ��������� ������� TH
     * @param string $string �����
     * @return string
     */
    function th($string) {
        return '<th>'.$string.'</th>';
    }

    /**
     * ���� DIV
     * @param string $string �����
     * @param string $align ������������
     * @param string $style �����
     * @param string $id ��
     * @return string
     */
    function div($string,$align="left",$style=false,$id=false) {
        return '<div align="'.$align.'" id="'.$id.'" style="'.$style.'">'.$string.'</div>';
    }

    /**
     * ����������� �����
     * @param string $string �����
     * @return string
     */
    function strike($string) {
        return '<strike>'.$string.'</strike>';
    }

    /**
     * �����������
     * @param string $type [<] ��� [>]
     * @return string
     */
    function comment($type='<') {
        if($type == '<') return '<!--';
        else return '-->';
    }

    /**
     * �����
     * @param string $string �����
     * @param string $style �����
     * @return string
     */
    function p($string='<br>',$style=false) {
        return '<p style="'.$style.'">'.$string.'</p>';
    }

    /**
     * ������
     * @param string $value �����
     * @param string $onclick JS ������� �� �����
     * @param string $class �����
     * @return string
     */
    function button($value,$onclick,$class='ok') {
        return '<input type="button" value="'.$value.'" onclick="'.$onclick.'" class="'.$class.'">';
    }

    /**
     * �������
     * @param string $content ����������
     * @param string $cellpadding cellpadding
     * @param string $cellspacing cellspacing
     * @param string $align ������������
     * @param string $width �����
     * @param string $bgcolor ���
     * @param string $border ������
     * @param string $id ��
     * @return string
     */
    function table($content,$cellpadding=3,$cellspacing=1,$align='center',$width='98%',$bgcolor=false,$border=0,$id=false) {
        return '<table id="'.$id.'" cellpadding="'.$cellpadding.'" cellspacing="'.$cellspacing.'" border="'.$border.'" bgcolor="'.$bgcolor.'" width="'.$width.'" align="'.$align.'">'.$content.'</table>';
    }

    /**
     * �����
     * @param string $content ����������
     * @param string $name ���, ��
     * @param string $method ����� ��������
     * @param string $action ���� ��������
     * @return string
     */
    function form($content,$name,$method='post',$action=false) {
        return '<form action="'.$action.'" name="'.$name.'" id="'.$name.'" method="'.$method.'">'.$content.'</form>';
    }

    /**
     * Input
     * @param string $type ��� [text,password,button � �.�]
     * @param string $name ���
     * @param mixed $value ��������
     * @param int $float float
     * @param int $size ������
     * @param string $onclick ����� �� �����, ��� javascript �������
     * @param string $class ��� ������ �����
     * @param string $caption ����� ����� ���������
     * @param string $description ����� ����� ��������
     * @return string
     */
    function setInput($type,$name,$value,$float="none",$size=200,$onclick="return true",$class=false,$caption=false,$description=false) {
        $input='
	 <div style="float:'.$float.';padding:5px;">
             '.$caption.' <input type="'.$type.'" value="'.$value.'" name="'.$name.'" id="'.$name.'" style="width:'.$size.'px;"
                 class="'.$class.'" onclick="'.$onclick.'"> '.$description.'</div>';
        return $input;
    }

    /**
     * ���� ��� ����� ������
     * @param string $caption ����� ����� ���������
     * @param string $name ���
     * @param mixed $value ��������
     * @param int $size ������
     * @param string $description ����� ����� ��������
     * @param string $float  float
     * @param string $class ��� ������ �����
     * @return string
     */
    function setInputText($caption,$name,$value,$size=300,$description=false,$float="none",$class=false) {
        return PHPShopText::setInput('text',$name,$value,$float,$size,false,$class,$caption,$description) ;
    }

}
?>