//***************************************************//
// PHPShop JavaScript 2.1                            //
// Copyright � www.phpshop.ru.                       //
// ��� ����� ��������.                               //
//***************************************************//

function ChangePage(val){
window.location.replace(val)
}

var ROOT_PATH="";


function LoadPath(my_path){
ROOT_PATH = my_path;
}

function dirPath(){
return ROOT_PATH;
}

// �������� ������
function ButOn(Id){
Id.className='imgOn';
}

function ButOff(Id){
Id.className='imgOff';
}


// ������� �������
function cartClean(){
if(confirm("�� ������������� ������ �������� �������?"))  window.location.replace('./?cart=clean');
}



function NoFoto(obj,pathTemplate){
obj.src=pathTemplate +'/images/shop/no_photo.gif';
}


function NoFoto2(obj){
obj.height=0;
obj.width=0;
}


function EditFoto(obj,max_width){
var w,h,pr,max_height;
w=Number(obj.width);
if(w > max_width) obj.width = max_width;
}




// ����� ������
function ChangeValuta(){
document.ValutaForm.submit();
}

function SearchChek()
{
var s1=window.document.forms.forma_search.words.value;
if (s1==""  || s1=="� ���..."){
 alert("������ ���������� ����� ������!");
 return false;
 }
   else document.forma_search.submit();
return true;
}

function OrderChek()
{
var s1=window.document.forms.forma_order.mail.value;
var s2=window.document.forms.forma_order.name_person.value;
var s3=window.document.forms.forma_order.tel_name.value;
var s4=window.document.forms.forma_order.adr_name.value;
if (s1=="" || s2=="" || s3=="" || s4=="")
 alert("������ ���������� ����� ������.\n������ ���������� �������� ��������� �����������! ");
  else
     document.forma_order.submit();
}

function Fchek()
{
var s1=window.document.forms.forma_gbook.name_new.value;
var s2=window.document.forms.forma_gbook.tema_new.value;
var s3=window.document.forms.forma_gbook.otsiv_new.value;
if (s1=="" || s2=="" || s3=="")
 alert("������ ���������� ����� ������!");
   else
     document.forma_gbook.submit();
}
