<?php

$_SESSION['theme'] = 'classic';

/**
 * ���������� ������� ���������������� �����������
 * @author PHPShop Software
 * @version 1.6
 * @package PHPShopGUI
 */
class PHPShopGUI {

    var $css;
    var $title;
    var $size;
    var $theme;
    var $dir = '../';
    var $alax_lib = false;

    /**
     * @var string ����������� �������������� JavaScript ������
     */
    var $includeJava;

    /**
     * @var string ����������� �������������� ������
     */
    var $includeCss;

    /**
     * @var int ����� ������ padding
     */
    var $padding = 5;

    /**
     * @var int ����� ������ margin
     */
    var $margin = 5;

    /**
     * @var bool ��������� ���� ��� ������.
     */
    var $window = false;

    /**
     * @var string �������� ������������ �������� ��� �������� ����
     */
    // var $reload="top";
    /**
     * @var bool ����� �������, ��������� ����
     */
    var $debug_close_window = true;

    /**
     * @var bool ����� �������, ������������ ������ � debug_close_window
     */
    var $debug = false;

    /**
     * @var string ���������
     */
    var $charset = "windows-1251";

    /**
     * @var bool ������������ ��������
     */
    var $cssTab = true;

    /**
     * @var string ���� �� ������ ���������
     */
    var $imgPath;

    /**
     * ������� ��������
     * @var string 
     */
    var $tab_pre = '_';
    var $windowID = false;

    /**
     * �����������
     */
    function PHPShopGUI($reload = 'top', $ajax = false) {

        // Ajax On
        $this->ajax = $ajax;

        $this->_BODY = '<body bottommargin="0"  topmargin="0" leftmargin="0" rightmargin="0">';

        if (empty($_SESSION['theme']))
            $this->theme = "classic";
        else
            $this->theme = $_SESSION['theme'];

        // �������� ����
        PHPShopObj::loadClass("lang");
    }

    /**
     * ID ���� ��� ������ ��������
     * @param string $file ��� �����
     * @param int $id ��
     */
    function setID($file, $id) {
        $path = pathinfo($file);
        $this->windowID = substr($path['basename'], 0, strlen($path['basename']) - strlen($path['extension']) - 1) . '_' . $id;
    }

    /**
     * �������� �������� ����� ����������
     * @param string $class_name ��� ������, �������� config.ini
     * @param array $data ������ ������
     * @param string $path ���� �� ����� gui
     * @param mixed $option �������������� ��������� 
     */
    function loadLib($file, $data, $path = './', $option = false) {
        $class_path = $path . 'gui/' . $file . '.gui.php';
        if (file_exists($class_path)) {
            require_once($class_path);
            return $file($data, $option);
        }

        else
            echo "��� ����� " . $class_path;
    }

    /**
     * ���������� �������� Form
     * @param string $value ����������
     * @param string $action action
     * @param string $name ���
     * @return string
     */
    function setForm($value, $action = false, $name = "product_edit") {
        $CODE.='<form method="post" enctype="multipart/form-data" action="' . $action . '" name="' . $name . '" id="' . $name . '">
            ' . $value . '</form>';
        return $CODE;
    }

    /**
     * ���������� ����������
     */
    function Compile() {
        global $_classPath;

        //  ���� �������� JS Ajax
        if ($this->alax_lib and !empty($this->ajax))
            $this->includeJava.='<script language="JavaScript" src="' . $_classPath . 'lib/Subsys/JsHttpRequest/Js.js"></script>';



        $this->_HEAD = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
     <html>
     <head>
     <title>' . $this->title . '</title>
     <meta http-equiv="Content-Type" content="text/html; charset=' . $this->charset . '">
     <link href="' . $this->dir . 'skins/' . $this->theme . '/tab.css" type=text/css rel=stylesheet>
	 <script type="text/javascript" src="' . $this->dir . 'java/tabpane.js"></script>
	 <link href="' . $this->dir . 'skins/' . $this->theme . '/texts.css" type=text/css rel=stylesheet>' . $this->includeCss . '
     <script src="' . $this->dir . 'java/phpshop.js" type="text/javascript"></script>' . $this->includeJava . '
	 ';

        $this->_HEAD.='</head>';

        echo $this->_HEAD . '
	 ' . $this->_BODY . '
	 <form method="post" enctype="multipart/form-data" action="' . $_SERVER['PHP_SELF'] . '" name="product_edit" id="product_edit" onsubmit="' . $this->onsubmit . '">
	 ' . $this->_CODE . '
	 </form>
	 </body>
	 </html>';
    }

    /**
     * ���������� ����������� ���������
     * @param string $editor
     */
    function setEditor($editor = false, $mod_enabled = false) {
        global $onsubmit;

        // ��������� ��������������� ������ ���������
        if (empty($editor))
            $editor = 'default';

        if ($mod_enabled)
            $editor_path = $this->dir . "editors/" . $editor . "/editor.php";
        else
            $editor_path = "../editors/" . $editor . "/editor.php";
        if (is_file($editor_path))
            include($editor_path);
        else {
            $this->setEditor();
        }

        $this->onsubmit = $onsubmit;
    }

    /**
     * ������� ������
     * @param string $value �����
     * @return string
     */
    function setLine($value = false) {
        $CODE = '
	 <div style="clear:both;">' . $value . '</div>';
        return $CODE;
    }

    /**
     * ���������� �������� Fieldset � ��������
     * @param string $title ��������� �������
     * @param string $content ����������
     * @param string $float �������� float �����
     * @param int $margin_left ������ �����
     * @param int $padding_top ������ ������
     * @return string
     */
    function setField($title, $content, $float = "none", $margin_left = 0, $padding_top = false) {
        $CODE = '
	 <FIELDSET style="float:' . $float . ';padding:' . $this->padding . 'px;margin-left:' . $margin_left . 'px;padding-top:' . $padding_top . '">
	 <LEGEND>' . $title . '</LEGEND>
	 ' . $content . '
	 </FIELDSET>';
        return $CODE;
    }

    /**
     * ���������� �������� Input
     * @param string $type ��� [text,password,button � �.�]
     * @param string $name ���
     * @param mixed $value ��������
     * @param int $float float
     * @param int $size ������
     * @param string $onclick ����� �� �����, ��� javascript �������
     * @param string $class ��� ������ �����
     * @param string $action �������� � ������, ��� php �������
     * @param string $caption ����� ����� ���������
     * @param string $description ����� ����� ��������
     * @return string
     */
    function setInput($type, $name, $value, $float = "none", $size = 200, $onclick = "return true", $class = false, $action = false, $caption = false, $description = false, $title = false) {

        $CODE = '
	 <div style="float:' . $float . ';padding:' . $this->padding . 'px;">
             ' . $caption . ' <input type="' . $type . '" value="' . $value . '" name="' . $name . '" id="' . $name . '" style="width:' . $this->chekSize($size) . ';"
                 class="' . $class . '" onclick="' . $onclick . '" title="' . $title . '"> ' . $description . '</div>';

        // ��������� ��������
        if ($action == true) {
            $this->action[$name] = $action;

            /*
              if(strpos($action,'.')){
              $action_array=explode(".", $action);
              $action_function_name=$action_array[0];

              // ����� �� ��������������
              $this->rule_path[$name]=$action_array[1];
              $this->rule_do[$name]=$action_array[2];
              }
              else
              $action_function_name = $action;
              $this->action[$name] = $action_function_name;
              $this->rule_path[$name]=false;
              $this->rule_do[$name]=false;
             * 
             */
        }

        return $CODE;
    }

    /**
     * ���������� �������� InputText
     * @param string $caption ����� ����� ���������
     * @param string $name ���
     * @param mixed $value ��������
     * @param int $size ������
     * @param string $description ����� ����� ��������
     * @param string $float  float
     * @param string $class ��� ������ �����
     * @return string
     */
    function setInputText($caption, $name, $value, $size = 300, $description = false, $float = "none", $class = false, $title = false) {
        return $this->setInput('text', $name, htmlentities($value, ENT_COMPAT, 'cp1251'), $float, $size, false, $class, false, $caption, $description, $title);
    }

    /**
     * ���������� ��������������� ��������
     * @param mixed $val ��� ��������
     */
    function setMyTag($val) {
        $this->_CODE.='
	 ' . $val;
    }

    /**
     * ���������� ��������� ����� ����
     * @param string $name ���������
     * @param string $title ��������
     * @param string $icon ������
     */
    function setHeader($name, $title, $icon) {
        $this->_CODE.='
	 <table cellpadding="0" cellspacing="0" width="100%" height="50" id="title">
     <tr bgcolor="#ffffff">
     <td style="padding:10">
     <b>' . $name . '</b><br>
     &nbsp;&nbsp;&nbsp;' . $title . '
     </td>
     <td align="right">
     <img src="' . $icon . '" border="0" hspace="10">
     </td>
     </tr>
     </table>';
    }

    /**
     * ���������� �������� Tab
     * <code>
     * // example:
     * $PHPShopGUI->setTab(array("���������1","����������1","������"),array("���������2","����������2","������"));
     * </code>
     */
    function setTab() {

        $this->_CODE.='
	 <!-- begin tab pane -->
     <div class="tab-pane" id="article' . $this->tab_pre . 'tab" style="margin-top:' . $this->margin . 'px;">
     <script type="text/javascript">
     ' . $this->tab_pre . 'tabPane = new WebFXTabPane( document.getElementById( "article' . $this->tab_pre . 'tab" ), true, "' . $this->windowID . '" );
     </script>
	 ';

        $Arg = func_get_args();


        if (!empty($this->TrialOff)) {
            $count = count($Arg) - 1;
            foreach ($Arg as $key => $val)
                if ($key < $count)
                    unset($Arg[$key]);
        }

        foreach ($Arg as $key => $val) {

            $this->_CODE.='
     <div class="tab-page" id="tab' . $this->tab_pre . $this->tab_key . '" style="height:' . $val[2] . '">
     <h2 class="tab">' . $val[0] . '</h2>
     <script type="text/javascript">
     ' . $this->tab_pre . 'tabPane.addTabPage( document.getElementById( "tab' . $this->tab_pre . $this->tab_key . '" ) );
     </script>
	 ' . $val[1] . '
	 </div>';
            $this->tab_key++;
        }
        //$this->_CODE.='</div>';
    }

    /**
     * ���������� �������� ��� �������
     * <code>
     * // example:
     * $PHPShopGUI->setTab(array("���������1","����������1","������"),array("���������2","����������2","������"));
     * $PHPShopGUI->addTab(array("���������3","����������3","������"));
     * </code>
     */
    function addTab() {
        $Arg = func_get_args();
        foreach ($Arg as $key => $val) {
            $this->_CODE.='
     <div class="tab-page" id="tab' . $this->tab_pre . $this->tab_key . '" style="height:' . $val[2] . '">
     <h2 class="tab">' . $val[0] . '</h2>
     <script type="text/javascript">
     ' . $this->tab_pre . 'tabPane.addTabPage( document.getElementById( "tab' . $this->tab_pre . $this->tab_key . '" ) );
     </script>
	 ' . $val[1] . '
	 </div>';
            $this->tab_key++;
        }
        //$this->_CODE.='</div>';
    }

    /**
     * �������� �������
     * @param mixed $size
     * @return string
     */
    function chekSize($size) {
        if (!strpos($size, '%') and !strpos($size, 'px'))
            $size.='px';
        return $size;
    }

    /**
     * ���������� JS ������
     */
    function addJSFiles() {
        $Arg = func_get_args();
        foreach ($Arg as $val) {
            $this->includeJava.='<script type="text/javascript" src="' . $val . '"></script>';
        }
    }

    /**
     * ���������� CSS ������
     */
    function addCSSFiles() {
        $Arg = func_get_args();
        foreach ($Arg as $val) {
            $this->includeCss.='<link href="' . $val . '" type=text/css rel=stylesheet>';
        }
    }

    /**
     * ���������� �������� Div
     * @param string $align align
     * @param string $code ����������
     * @param string $style ��� ����� css
     * @nane string $name ��� �����
     * @return string
     */
    function setDiv($align, $code, $style = false, $name = 'div1') {
        $CODE = '
	 <div align="' . $align . '" style="' . $style . '" name="' . $name . '" id="' . $name . '">
	 ' . $code . '
	 </div>
	 ';
        return $CODE;
    }

    /**
     * ���������� �������
     * @param string $code ����������
     */
    function setFooter($code) {
        $this->_CODE.=$this->setDiv("right", $code);

        // ���������
        if (is_array($this->action))
            foreach ($this->action as $name => $function)
                $this->_CODE.=$this->setInput("hidden", "actionList[$name]", $function);
    }

    /**
     * ���������� ������� Textarea
     * @param string $name ���
     * @param mixed $value ��������
     * @param string $float float
     * @param mixed $width ����� ��������
     * @param mixed $height ������ ��������
     * @return string
     */
    function setTextarea($name, $value, $float = "none", $width = '99%', $height = '50px') {
        $CODE = '
	 <textarea style="float:' . $float . ';margin:' . $this->margin . 'px;height:' . $this->chekSize($height) . ';width:' . $this->chekSize($width) . '" name="' . $name . '" id="' . $name . '">' . $value . '</textarea>
	 ';
        return $CODE;
    }

    /**
     * ���������� ���������
     * @param string $name ��� ���� ��� ������� ����
     * @param string $align ������������
     * @param string $icon ������
     * @return string
     */
    function setCalendar($name, $align = 'right', $icon = '../icon/date.gif', $float = 'left', $style = "width:50px") {
        $CODE = '<div style="float:' . $float . ';padding:' . $this->padding . 'px;' . $style . '">' . $this->setImage($icon, 16, 16, $align = 'right', 0, '', 'popUpCalendar(this, product_edit.' . $name . ', \'dd-mm-yyyy\');') . '</div>';
        return $CODE;
    }

    /**
     * ���������� ����� ���������� � ����������
     * @param string $value ���������� text
     * @param string $height ������
     * @param string $width ������
     * @param string $align ������������
     * @return string
     */
    function setInfo($value, $height = false, $width = '100%', $align = "left") {
        return $this->setDiv($align, $value, 'width:' . $this->chekSize($width) . ';height:' . $this->chekSize($height) . ';background-color:white;padding:10px;border:1px;border-style: inset;overflow:auto;');
    }

    /**
     * ���������� �������� Select
     * <code>
     * // example:
     * $value[]=array('��� ����� 1',123,'selected');
     * $value[]=array('��� ����� 2 ',567, false);
     * $PHPShopGUI->setSelect('my',$value,100);
     * 
     * // example optgroup:
     * $opt_value[]=array('��� ����� 1',123,'selected');
     * $opt_value[]=array('��� ����� 2 ',567, false);
     * $value[]=array('��� ������ 1',$opt_value);
     * $PHPShopGUI->setSelect('my',$value,100);
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
    function setSelect($name, $value, $width, $float = "none", $caption = false, $onchange = "return true", $height = false, $size = 1, $multiple = false, $id = false) {

        if ($multiple)
            $multiple = 'multiple';

        if (empty($id))
            $id = $name;

        $CODE = $caption . ' <select name="' . $name . '" id="' . $id . '" size="' . $size . '" style="float:' . $float . ';margin:' . $this->margin . 'px;width:' . $this->chekSize($width) . ';height:' . $this->chekSize($height) . '" onchange="' . $onchange . '" ' . $multiple . '>';
        if (is_array($value))
            foreach ($value as $val) {

                // ������������� 
                if ($val[2] == $val[1])
                    $val[2] = "selected";
                elseif ($val[2] != "selected")
                    $val[2] = null;

                if (is_array($val[1])) {
                    $CODE.='<optgroup label="' . $val[0] . '">';
                    foreach ($val[1] as $group_val) {

                        // ������������� � ������
                        if ($group_val[2] == $group_val[1])
                            $group_val[2] = "selected";

                        $CODE.='<option value="' . $group_val[1] . '" ' . $group_val[2] . '>' . $group_val[0] . '</option>';
                    }
                    $CODE.='</optgroup>';
                }
                else
                    $CODE.='<option value="' . $val[1] . '" ' . $val[2] . '>' . $val[0] . '</option>';
            }
        $CODE.='</select>
	 ';
        return $CODE;
    }

    /**
     * ���������� �������� Select
     * @param int $n
     * @return array
     */
    function setSelectValue($n) {
        $i = 1;
        while ($i <= 10) {
            if ($n == $i)
                $s = "selected"; else
                $s = "";
            $select[] = array($i, $i, $s);
            $i++;
        }
        return $select;
    }

    /**
     * ���������� ��������
     * @param string $name ���
     * @param string $value ��������
     * @param string $caption ��������
     * @param string $checked checked
     * @param string $onchange ��� javascript ������� �� ������ onchange
     * @return string
     */
    function setCheckbox($name, $value, $caption, $checked = "checked", $onchange = "return true") {

        if ($checked == 1)
            $checked = "checked";

        $CODE = '
	 <input type="checkbox" value="' . $value . '" name="' . $name . '" id="' . $name . '" ' . $checked . ' onchange="' . $onchange . '"> ' . $caption . '
	 ';
        return $CODE;
    }

    /**
     * ���������� �������� Radio
     * @param string $name ���
     * @param string $value ��������
     * @param string $caption ��������
     * @param mixed $checked checked
     * @param string $onchange ��� javascript ������� �� ������ onchange
     * @return string
     */
    function setRadio($name, $value, $caption, $checked = "checked", $onchange = "return true") {

        // ������������� 
        if ($value == $checked)
            $checked = "checked";

        $CODE = '
	 <input type="radio" value="' . $value . '" name="' . $name . '" id="' . $name . '" ' . $checked . ' onchange="' . $onchange . '"> ' . $caption . '
	 ';
        return $CODE;
    }

    /**
     * ���������� ������
     * @param string $value �����
     * @param string $float float
     * @param string $style ��� ����� css
     * @return string
     */
    function setText($value, $float = "left", $style = false) {
        $CODE = '<div style="float:' . $float . ';padding:' . $this->padding . 'px;' . $style . '">' . $value . '</div>';
        return $CODE;
    }

    /**
     * ���������� �������� image
     * @param string $src ����� �����������
     * @param int $width ������
     * @param int $height ������
     * @param string $align align
     * @param Int $hspace hspace
     * @param string $style ��� ����� css
     * @return string
     */
    function setImage($src, $width, $height, $align = 'absmiddle', $hspace = "5", $style = false, $onclick = false, $alt = false) {
        if (!empty($width))
            $width = 'width="' . $width . '"';
        if (!empty($height))
            $height = 'height="' . $height . '"';
        $CODE = '<img src="' . $src . '" ' . $width . ' ' . $height . ' alt="' . $alt . '" title="' . $alt . '" border="0" align="' . $align . '" hspace="' . $hspace . '" style="' . $style . '" onclick="' . $onclick . '">';
        return $CODE;
    }

    /**
     * ���������� ������
     * @param string $href ����� ������
     * @param string $caption ����� ������
     * @param string $target target
     * @param string $style ��� ����� css
     * @return string
     */
    function setLink($href, $caption, $target = '_blank', $style = false, $title = false) {
        if (empty($title))
            $title = $caption;
        $CODE = '<a href="' . $href . '" target="' . $target . '" title="' . $title . '" style="' . $style . '">' . $caption . '</a>';
        return $CODE;
    }

    /**
     * �������� ����
     */
    function setClose() {
        $this->_CODE.='<script type="text/javascript">window.close();</script>';
    }

    /**
     * ��������� �� ������
     * @param string $name ��� ������
     * @param string $action �������� ������
     */
    function setError($name, $action) {
        $this->_CODE.='<p><span style="color:red">������ ����������� �������: </span> <strong>' . $name . '()</strong>
	 <br><em>' . $action . '</em></p>';
    }

    /**
     * ���������� �������� Iframe
     * @param string $name ���
     * @param string $src �����
     * @param int $width width
     * @param int $height height
     * @param string $float float
     * @return string
     */
    function setFrame($name, $src, $width, $height, $float = 'none', $border = 1, $scrolling = 'yes') {
        $CODE = '<iframe src="' . $src . '" height="' . $this->chekSize($height) . '" width="' . $this->chekSize($width) . '" scrolling="' . $scrolling . '" frameborder="' . $border . '" name="' . $name . '" id="' . $name . '" style="margin:' . $this->margin . 'px;background-color:#ffffff;float:' . $float . '"></iframe>';
        return $CODE;
    }

    /**
     * ������������ ����
     */
    function setReload() {
        if (!$this->debug) {
            $this->_CODE.='
	 <script type="text/javascript">
	 try{
	 ';
            if ($this->reload == "left")
                $this->_CODE.=' window.opener.top.frame1.location.reload();';
            if ($this->reload == "right")
                $this->_CODE.=' window.opener.top.frame2.location.reload();';
            if ($this->reload == "top") {

                // ��������� Ajax
                if ($this->ajax)
                    $this->_CODE.=" DoReloadMainWindowModule(" . $this->ajax . ");
                        ";
                else
                    $this->_CODE.=' window.opener.location.reload();';
            }
            elseif ($this->ajax) {
                $this->_CODE.=" DoReloadMainWindowModule(" . $this->ajax . ");
                        ";
            }


            $this->_CODE.='
	 }catch(e){
         ';
            // �������, �� �������� ����
            if (empty($this->debug))
                $this->_CODE.='self.close();';

            $this->_CODE.='
                }';

            if (!empty($this->debug_close_window) and empty($this->ajax)) {
                $this->_CODE.='window.close();
                    ';
            }
            $this->_CODE.='</script>';
        }
    }

    /**
     * ���������� ������
     * @param string $name ���������� ��� �������
     * @param string $function ��� ������� php �����������
     * @param bool $reload �������� ������������ ����� ����������
     */
    function setAction($name, $function, $reload = false) {
        if (!empty($name)) {
            if (function_exists($function)) {
                $action = call_user_func($function);
                if ($action !== true)
                    $this->setError($function, $action);
                else {
                    if ($reload != "none")
                        $this->setReload();
                    $this->Compile();
                }
            } else
                $this->setError($function, "function do not exists");
        }
    }

    /**
     * ���������� ����������
     * @param string $name ���������� ��� ������� (�����������, ���� ���������� �� ����������)
     * @param string $function ��� ������� php �����������
     */
    function setLoader($name, $function) {
        if (empty($name))
            if (function_exists($function)) {
                $action = call_user_func($function);
                if (!$action)
                    $this->setError($function, $action);
                else {
                    $this->Compile();
                }
            } else
                $this->setError($function, "function do not exists");
    }

    /**
     * �������� �� �����
     */
    function getAction() {
        global $PHPShopBase;
        if (!empty($_REQUEST['actionList']) and is_array($_REQUEST['actionList']))
            foreach ($_REQUEST['actionList'] as $action => $function)
                if (!empty($_REQUEST[$action])) {

                    // �������� ���� ������������
                    if (strpos($function, '.')) {
                        $function_array = explode(".", $function);
                        $function_name = $function_array[0];

                        // ����� �� ��������������
                        $rule_path = $function_array[1];
                        $rule_do = $function_array[2];

                        if ($PHPShopBase->Rule->CheckedRules($rule_path, $rule_do))
                            $this->setAction($action, $function_name);
                        else
                            $PHPShopBase->Rule->BadUserFormaWindow();
                    } else
                        $this->setAction($action, $function);
                }
    }

    /**
     * ���������� �������� Button
     * @param string $value ��������
     * @param string $img ������
     * @param string $width ������
     * @param string $height ������
     * @param string $float float
     * @param string $onclick ��� javascript ������� �� ������ onclick
     * @return string
     */
    function setButton($value, $img, $width, $height, $float = "none", $onclick = "return false") {
        $CODE = '
	 <div style="float:' . $float . ';padding:' . $this->padding . 'px;">
	 <BUTTON style="width:' . $width . '; height:' . $height . '; margin-left:5"  onclick="' . $onclick . '">
     <img src="' . $this->imgPath . $img . '" width="16" height="16" border="0" align="absmiddle" hspace="3" hspace="3">
     ' . $value . '
     </BUTTON></div>
	 ';
        return $CODE;
    }

    /**
     * ���������� ����� ������� ���������
     * @return string 
     */
    function setHistory() {
        $PHPShopInterface = new PHPShopInterface();
        $PHPShopInterface->window = true;
        $PHPShopInterface->imgPath = "../../../admpanel/img/";
        $PHPShopInterface->setCaption(array('����', "20%"), array('��������� � ������', "80%"));

        // ������� ���������
        $db = readDatabase("../install/module.xml", "update");
        if (is_array($db)) {
            foreach ($db as $update) {
                $PHPShopInterface->setRow(1, $update['date'], $update['content']);
            }
            return $PHPShopInterface->Compile();
        }
    }

    /**
     * ���������� ����� � ������
     * @return string
     */
    function setPay($serial, $pay = false, $version = false, $update = false) {
        global $PHPShopModules;

        $mes = null;
        $path = $PHPShopModules->path;
        PHPShopObj::loadClass("date");

        if (!empty($path)) {
            $data = $PHPShopModules->checkKeyBase();
            if ($data) {
                $this->TrialOff = true;

                if (!$PHPShopModules->checkKey($serial, $path))
                    $mes = '<br>���� ���������������� ������� �� <b>' . PHPShopDate::dataV($data, false) . '</b>';
            }
        }


        $PHPShopInterface = new PHPShopInterface();
        $PHPShopInterface->size = "500,400";
        $PHPShopInterface->window = true;
        $PHPShopInterface->idRows = 'p';
        $PHPShopInterface->imgPath = "../../../admpanel/img/";
        $PHPShopInterface->setCaption(array("��������", "20%"), array("������", "20%"), array("��������", "80%"));

        // �������� ������
        $db = $PHPShopModules->getXml("../install/module.xml");
        if ($db['version'] > $version and !empty($update)) {
            PHPShopObj::loadClass('text');
            $version_info = PHPShopText::notice('������ ���� ' . $db['version'] . ' �� ������������� ������ �� ' . $version);
            $version_info.=$this->setInput("submit", "modupdate", "��������", "center", 100, "", "but", "actionBaseUpdate");
        }
        else
            $version_info = $db['version'];
        $PHPShopInterface->setRow(1, $db['name'], $version_info, $db['description'] . $mes);

        $CODE = $PHPShopInterface->Compile();


        if (!$pay)
            return $CODE;

        $CODE.=$this->setLine('<br>');

        if ($PHPShopModules->checkKey($serial, $path)) {
            $CODE.=$this->setField('�������� �����', $this->setInputText('EEM-', 'serial_new', $serial, $size = 110, $this->setImage($PHPShopInterface->imgPath . 'icon-activate.gif', 16, 16, $align = 'absmiddle', 0) . ' * ��������� ���������', false, 'serial_done'));
            $this->TrialOff = false;
            $PHPShopModules->setKeyBase($path);
            return $CODE;
        }

        $status_serial_img = null;
        $status_serial = null;

        if (!empty($serial)) {
            $status_serial = 'serial_fail';
            $status_serial_img = $this->setImage($PHPShopInterface->imgPath . 'error.gif', 16, 16, $align = 'absmiddle', 0);
        }

        $CODE.=$this->setField('�������� �����', $this->setInputText('EEM-', 'serial_new', $serial, 110, $status_serial_img . ' * ������ ���������  ������: 11111-22222-33333', false, $status_serial));

        if (!$PHPShopModules->checkKey($serial, $path) and !empty($db['base']))
            $CODE.=$this->setButton("������ �������� " . $db['price'], '../../../admpanel/icon/key.png', 200, false, $float = "none", $onclick = "window.open('http://www.phpshop.ru/order/?bay_mod=" . $db['base'] . "')");

        return $CODE;
    }

}

/**
 * ���������� ��������� ���������������� �����������
 * @author PHPShop Software
 * @version 1.3
 * @package PHPShopGUI
 */
class PHPShopInterface extends PHPShopGUI {

    /**
     * @var string ������ ������ (�������� ���� ��� ��������������)
     */
    var $link;

    /**
     * @var string ������
     */
    var $razmer;

    /**
     * @var string ���� �� ������
     */
    var $imgPath = "img/";

    /**
     * @var int ������
     */
    var $padding = 5;

    /**
     * @var int ������
     */
    var $margin = 5;

    /**
     * @var bool ��� ����?
     */
    var $window = false;

    /**
     * @var string id ����� ��� �������. ���� �������� 2 �������, �� idRows ������ ���� ���������� ��� ������ �����.
     */
    var $idRows = 'r';

    /**
     * �����������
     */
    function PHPShopInterface($tab_pre = false) {
        $this->n = 1;
        $this->numRows = 0;
        $this->razmer = $this->winsize;

        // ���� ��������� ��������
        if ($tab_pre)
            $this->tab_pre = $tab_pre;

        if (empty($_SESSION['theme']))
            $this->theme = "classic";
        else
            $this->theme = $_SESSION['theme'];
    }

    function setTab() {
        $this->_CODE.='
	 <!-- begin tab pane -->
     <div class="tab-pane" id="article' . $this->tab_pre . 'tab" style="margin-top:' . $this->margin . 'px;">
     <script type="text/javascript">
     ' . $this->tab_pre . 'tabPane = new WebFXTabPane( document.getElementById( "article' . $this->tab_pre . 'tab" ), true );
     </script>
	 ';

        $Arg = func_get_args();


        if (!empty($this->TrialOff)) {
            $count = count($Arg) - 1;
            foreach ($Arg as $key => $val)
                if ($key < $count)
                    unset($Arg[$key]);
        }

        foreach ($Arg as $key => $val) {

            $this->_CODE.='
     <div class="tab-page" id="tab' . $this->tab_pre . $key . '" style="height:' . $val[2] . '">
     <h2 class="tab">' . $val[0] . '</h2>
     <script type="text/javascript">
     ' . $this->tab_pre . 'tabPane.addTabPage( document.getElementById( "tab' . $this->tab_pre . $key . '" ) );
     </script>
	 ' . $val[1] . '
	 </div>';
            $this->tab_key++;
        }
        $this->_CODE.='</div>';
    }

    /**
     * ���������� ���������
     * @return string
     */
    function setHeader() {
        return '<html>
            <head>
<meta http-equiv="Content-Type" content="text/html; charset=' . $this->charset . '">
<link href="' . $this->dir . 'skins/' . $this->theme . '/texts.css" type=text/css rel=stylesheet>' . $this->includeCss . '
<script src="' . $this->dir . 'java/phpshop.js" type="text/javascript"></script>
</head>
<body bottommargin="0" rightmargin="0" topmargin="0" leftmargin="0" bgcolor="ffffff">';
    }

    function addTop($content) {
        $this->_TOP = $content;
    }

    /**
     * ���������� ����������
     * @return string
     */
    function Compile($id = 'interfacesWin2', $form = 'interfacesForm', $style = null) {
        $compile = $this->_TOP;

        if ($this->numRows > 10 and !$this->razmer)
            $this->razmer = "height:580px;";

        if ($this->header)
            $compile.=$this->setHeader();

        $compile.='<div id="' . $id . '" name="' . $id . '" align="left" style="width:100%;' . $this->razmer . ';overflow:auto">
     <table width="100%"  cellpadding="0" cellspacing="0" style="' . $style . '">
     <tr>
	    <td valign="top">
            <form id="' . $form . '" name="' . $form . '">
	       <table cellpadding="0" cellspacing="1" width="100%" border="0" class="sortable" id="sort">
		   ' . $this->_CODE . '
		   </table>
            </form>
	    </td>
     </tr>
     </table></div>' . $this->_CODE_ADD_BUTTON;
        if (empty($this->window))
            echo $compile;
        else
            return $compile;
    }

    function getContent() {
        return $this->_CODE;
    }

    /**
     * ���������� ��������� �������� �������
     */
    function setCaption() {
        $Arg = func_get_args();
        $CODE = null;

        foreach ($Arg as $val)
            $CODE.='
     <td width="' . $val[1] . '" id="pane"><span>' . $val[0] . '</span></td>
     ';
        $this->_CODE.='<tr>' . $CODE . '</tr>';
    }

    /**
     * ���������� ����� �������
     */
    function setRow() {
        $CODE = null;
        $this->numRows++;
        $Arg = func_get_args();


        if (!empty($this->link))
            $javaAction = 'onclick="miniWin(\'' . $this->link . '?id=' . $Arg[0] . '\',' . $this->size . ')"';
        else
            $javaAction = "";

        foreach ($Arg as $key => $val) {

            if (empty($this->window)) {
                if ($key == 1)
                    $align = "center"; else
                    $align = "left";
            } else
                $align = "left";

            if ($key > 0) {
                if (is_array($val))
                    $CODE.='
 <td align="' . $align . '">' . $val[0] . '</td>
     ';
                else
                    $CODE.='
 <td align="' . $align . '" ' . $javaAction . '>' . $val . '</td>
     ';
            }
        }

        // ��������� ������ �����
        if ($this->numRows % 2 == 0) {
            $style_r = ' line2';
        } else {
            $style_r = null;
        }



        //$this->_CODE.='<tr class="row'.$style_r.'" onmouseover="show_on(\'' . $this->idRows . $this->n . '\',this.className)" id="' . $this->idRows . $this->n . '" onmouseout="show_out(\'' . $this->idRows . $this->n . '\',this.className)" >' . $CODE . '</tr>';
        $this->_CODE.='<tr class="row' . $style_r . '" id="' . $this->idRows . $this->n . '" onmouseover="PHPShopJS.rowshow_on(this)" onmouseout="PHPShopJS.rowshow_out(this,\'' . $style_r . '\')">' . $CODE . '</tr>';
        $this->n++;
    }

    /**
     * ���������� ������ �������� ����� �������
     * @param string $link ������ �� ����� ����
     */
    function setAddItem($link) {
        $this->_CODE_ADD_BUTTON = '
	 <div align="right" style="padding:10"><BUTTON style="width: 15em; height: 2.2em; margin-left:5"  onclick="miniWin(\'' . $link . '\',' . $this->size . ')">
     <img src="' . $this->imgPath . 'icon-move-banner.gif" width="16" height="16" border="0" align="absmiddle">
     ����� �������
     </BUTTON>
	 </div>
	 ';
    }

    /**
     * ���������� ������ ���/./����
     * @param bool $flag ���
     * @return string
     */
    function icon($flag) {
        if (empty($flag))
            $imgchek = '<img src="' . $this->imgPath . 'icon-deactivate.gif" width="16" height="16" border="0">';
        else
            $imgchek = '<img src="' . $this->imgPath . 'icon-activate.gif" width="16" height="16" border="0">';
        return $imgchek;
    }

}

class PHPShopIframePanel extends PHPShopGUI {

    var $iframe_left = array();
    var $iframe_right = array();
    var $button_tree_control = true;

    function PHPShopIframePanel($iframe_left, $iframe_right) {
        $this->iconNum = 0;
        $this->imgPath = null;


        if (is_array($iframe_left)) {
            $this->iframe_left = $iframe_left;
        }

        if (is_array($iframe_right)) {
            $this->iframe_right = $iframe_right;
        }
    }

    function addTop($content) {
        $this->_CODE = $content;
    }

    /**
     * ���������� ����������
     */
    function Compile() {

        $compile = $this->_CODE . '
<table cellpadding="0" cellspacing="1" width="100%">
<tr>
  <td width="' . $this->iframe_left[1] . '" valign="top" height="' . $this->iframe_left[1] . '">
  <div id="pane"><img src="' . $this->imgPath . 'img/arrow_d.gif" width="7" height="7" border="0" hspace="5">' . $this->title . '</div>
<iframe frameborder="0" id="' . $this->iframe_left[3] . '" name="' . $this->iframe_left[3] . '" src="' . $this->iframe_left[0] . '" width="' . $this->iframe_left[1] . '" height="' . $this->iframe_left[2] . '" scrolling="Auto">
</iframe>';

        if (!empty($this->button_tree_control)) {
            $compile.= '   
<div align="center" style="padding:5px">
<table cellpadding="0" cellspacing="0">
  <tr>
  <td id="but381" class="butoff" onmouseover="PHPShopJS.button_on(this)" onmouseout="PHPShopJS.button_off(this)">
  <img src="' . $this->imgPath . 'icon/chart_organisation_add.gif" alt="' . __('������� ���') . '" title="' . __('������� ���') . '"  width="16" 
      height="16" border="0"  onclick="window.' . $this->iframe_left[3] . '.d.openAll()">
    </td>
    <td width="5"></td>
  <td width="1" bgcolor="#ffffff"></td>
  <td width="1" bgcolor="#808080"></td>
   <td width="5"></td>
  <td id="but382" class="butoff" onmouseover="PHPShopJS.button_on(this)" onmouseout="PHPShopJS.button_off(this)">
  <img src="' . $this->imgPath . 'icon/chart_organisation_delete.gif" alt="' . __('������� ���') . '" title="' . __('������� ���') . '" width="16" 
      height="16" border="0" onclick="window.' . $this->iframe_left[3] . '.d.closeAll()"></td>
  </tr>
</table>
</div>';
        }
        $compile.= ' </td>
   <td valign="top">
<iframe id="' . $this->iframe_right[3] . '" name="' . $this->iframe_right[3] . '" src="' . $this->iframe_right[0] . '" width="' . $this->iframe_right[1] . '" height="' . $this->iframe_right[2] . '"  frameborder="0" scrolling="Auto">
</iframe>

</td>
</tr>
</table>';

        echo $compile;
    }

}

/**
 * ���������� ������������� ���������������� �����������
 * @author PHPShop Software
 * @version 1.3
 * @package PHPShopGUI
 */
class PHPShopIcon extends PHPShopGUI {

    /**
     * �����������
     */
    function PHPShopIcon($iconNum = 1) {
        $this->iconNum = $iconNum;
        $this->imgPath = "icon/";
    }

    /**
     * ���������� ������ ���������
     * @param string $icon ����� ������
     * @param string $alt �������� alt
     * @param string $onclick ��� javascript ������� �� ������ onclick
     * @return string
     */
    function setIcon($icon, $alt, $onclick) {
        $this->iconNum++;
        $CODE = '<td id="but' . $this->iconNum . '" class="butoff"><img title="' . $alt . '" src="' . $icon . '" alt="' . $alt . '" width="16" height="16" border="0" onmouseover="ButOn(' . $this->iconNum . ')" onmouseout="ButOff(' . $this->iconNum . ')" onclick="' . $onclick . '"></td>
   <td width="3"></td>';
        $this->iconNum++;
        return $CODE;
    }

    /**
     * ���������� ������������� ��������
     * @param string $content �������
     * @param int $width ����� ����
     * @param string $padding_left ������ �����
     * @param string $padding_right ������ ������
     * @return string 
     */
    function add($content, $width = 100, $padding_left = 0, $padding_right = 0) {

        if (!empty($width))
            $width = 'width=' . $width;
        else
            $width = null;

        $CODE = '<td ' . $width . ' style="padding-left:' . $this->chekSize($padding_left) . ';padding-right:' . $this->chekSize($padding_right) . '">' . $content . '</td>
   <td width="3"></td>';
        return $CODE;
    }

    /**
     * ���������� ������� �����������
     * @return string
     */
    function setBorder() {
        $CODE = '<td width="1" bgcolor="#ffffff"></td>
     <td width="1" class="menu_line"></td>
     <td width="3"></td>';
        return $CODE;
    }

    /**
     * ���������� ����� ��� ������
     * @param string $CODE ��� ������
     */
    function setTab($CODE) {
        $this->_CODE.='
	 <table cellpadding="0" cellspacing="0" border="0" width="100%">
	 <tr>
		   ' . $CODE . '<td align="right">&nbsp;</td>
     </tr>
	 </table>
	 ';
    }

    /**
     * ���������� ����������
     */
    function Compile($return = false) {
        $compile = '
     <table width="100%" cellpadding="0" cellpadding="0" class="iconpane">
     <tr>
       <td style="padding-left:5">
		   ' . $this->_CODE . '
	    </td>
     </tr>
     </table>';

        if ($return)
            return $compile;
        else
            echo $compile;
    }

}

/**
 * ���������� ������� �����������
 * @author PHPShop Software
 * @version 1.0
 * @package PHPShopGUI
 */
class PHPShopFrontInterface extends PHPShopInterface {

    var $css;
    var $js;

    /**
     * ���������� ����������
     * @return string
     */
    function Compile() {

        if ($this->numRows > 10 and !$this->razmer)
            $this->razmer = "height:450px;";

        if (!empty($this->css))
            $compile.='<LINK href="' . $this->css . '" type="text/css" rel="stylesheet">';
        if (!empty($this->js))
            $compile.='<SCRIPT language="JavaScript" src="' . $this->js . '"></SCRIPT>';

        $compile.='<div style="' . $this->razmer . ';overflow:auto;">
	       <table cellpadding="0" class="phpshop-gui" cellspacing="1" border="0">' . $this->_CODE . '</table></div>';
        return $compile;
    }

    /**
     * ������ �����������
     * @return string
     */
    function getContent() {
        return $this->_CODE;
    }

}

/**
 * ���������� ������ ���������
 * @author PHPShop Software
 * @version 1.0
 * @package PHPShopGUI
 */
class CatalogTree {

    /**
     * �����������
     */
    function CatalogTree($table) {
        $this->table = $table;
        PHPShopObj::loadClass("lang");
        $this->dis = "<script type=\"text/javascript\">
    <!--
    d = new dTree('d');
       ";
    }

    /**
     * ���������� �������� � ������
     * @param int $n �������������
     * @param int $id ��������
     * @param string $name ������������
     * @param string $icon ������
     */
    function addcat($n, $id, $name, $icon = false) {
        $name = __($name);
        $this->dis.="d.add($n,$id,'$name','$name','','','','$icon');";
    }

    /**
     * ������ � ��
     * @param string $sql SQL ������
     * @return mixed
     */
    function sql($sql) {
        $PHPShopOrm = new PHPShopOrm($this->table);
        return $PHPShopOrm->query($sql);
    }

    /**
     * �������� �� ������� ���������
     * @param int $n �� �������
     * @return int
     */
    function chek($n) {
        return mysql_num_rows($this->sql("select id from " . $this->table . " where parent_to='$n'"));
    }

    /**
     * ������������ ������ �� ���������
     * @param int $n �������������
     * @return string
     */
    function add($n) {
        $disp = '';
        $result = $this->sql("select * from " . $this->table . " where parent_to='$n' order by num");
        while ($row = mysql_fetch_array($result)) {
            $i = 0;
            $id = $row['id'];
            $name = $row['name'];
            $parent_to = $row['parent_to'];
            $num = $this->chek($id);

            if ($i < $num) {// ���� ���� ��� ��������
                $disp.="d.add($id,$n,'$name','');
                        " . $this->add($id);
            } else {// ���� ��� ���������
                $disp.="d.add($id,$n,'$name','" . $this->name($parent_to, $name) . "');";
            }
        }
        return $disp;
    }

    /**
     * ��� �������� �� ��������������
     * @param int $n ������������� ��������
     * @return string
     */
    function name($n) {
        $result = $this->sql("select name from " . $this->table . " where id='$n'");
        $row = mysql_fetch_array($result);
        $name = $row['name'];
        return $name . " => " . $catalog;
    }

    /**
     * ����� ������ ���������
     */
    function disp() {
        $this->dis.="
         document.write(d);
        //-->
       </script>";

        // �����������
        writeLangFile();

        echo $this->dis;
    }

    /**
     * ������� ������ ���������
     */
    function create() {
        $result = $this->sql("select * from " . $this->table . " where parent_to=0 order by num");
        $i = 0;
        $j = 0;
        $dis = '';
        while ($row = mysql_fetch_array($result)) {
            $id = $row['id'];
            $name = $row['name'];
            $num = $this->chek($id);
            if ($num > 0)
                $this->dis.="
  d.add($id,0,'$name','');
                        " . $this->add($id) . "
  ";
            else
                $this->dis.="
  d.add($id,0,'$name','$name');
                        " . $this->add($id) . "
  ";
            $i++;
        }

        // �������� ���������
        if (!empty($_GET['category'])) {
            $this->dis.="d.openTo(" . $_GET['category'] . ", true);";
        }
    }

}

?>