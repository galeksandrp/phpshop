//***************************************************//
// PHPShop JavaScript 3                              //
// Copyright � www.phpshop.ru. ��� ����� ��������.   //
//***************************************************//

// ��������� �������� ������
function ShowPodtipOption(v){
var obj=document.getElementById('podtip_list');
if(v==1) obj.style.visibility="hidden";
 else obj.style.visibility="visible";
}


// ���������� �������
function ClosePanelProductDisp(){
var obj=document.getElementById('prevpanel_act');
var clientW=document.body.clientWidth;
var mem=document.getElementById('prevpanel_mem').value;
if(!obj.checked){
document.getElementById('prevpanel').innerHTML = "";

 // ����� ����
 if(window.opener)
 document.getElementById("interfacesWin1").height=(clientW-470);
   else document.getElementById("interfacesWin1").height=(clientW-540);
}else{
      // ����� ����
      if(window.opener)
      document.getElementById("interfacesWin1").height=(clientW-600);
	      else document.getElementById("interfacesWin1").height=(clientW-680);
	  
	  var req = new Subsys_JsHttpRequest_Js();
		req.onreadystatechange = function() {
			if (req.readyState == 4) {
				if (req.responseJS) {
					document.getElementById('prevpanel').innerHTML = req.responseJS.interfaces;
                    document.getElementById('prevpanel_mem').value = mem;
				}
			}
		}
		req.caching = false;
		// �������������� ������.
		req.open('POST', './product/action.php?do=prev', true);
		req.send( {  xid: mem } );
	  
	  
	  }
}


// �������� ������ � ������
function DoUpdateProductDisp(xid) {
var obj=window.top.document.getElementById('prevpanel_act');
var clientW=window.top.document.body.clientWidth;
if(obj.checked){

// ����� ����
if(window.top.opener) window.top.document.getElementById("interfacesWin1").height=(clientW-600);
  else window.top.document.getElementById("interfacesWin1").height=(clientW-680);

var req = new Subsys_JsHttpRequest_Js();
		req.onreadystatechange = function() {
			if (req.readyState == 4) {
				if (req.responseJS) {
					window.top.document.getElementById('prevpanel').innerHTML = req.responseJS.interfaces;
                    window.top.document.getElementById('prevpanel_mem').value = xid;
				}
			}
		}
		req.caching = false;
		// �������������� ������.
		req.open('POST', '../product/action.php?do=prev', true);
		req.send( {  xid: xid } );
} else {
       //window.top.document.getElementById('prevpanel').innerHTML = "";
	   var req = new Subsys_JsHttpRequest_Js();
		req.onreadystatechange = function() {
			if (req.readyState == 4) {
				if (req.responseJS) {
					window.top.document.getElementById('prevpanel').innerHTML = req.responseJS.interfaces;
                    window.top.document.getElementById('prevpanel_mem').value = xid;
				}
			}
		}
		req.caching = false;
		// �������������� ������.
		req.open('POST', '../product/action.php?do=info', true);
		req.send( {  xid: xid } );
	   }
}



// ������ ������� � ����������� ����
function helpWinParent(page){
try{
window.opener.top.document.getElementById('helppage').value=page;
window.opener.top.initSlide(0);
window.opener.top.loadhelp();
}catch(e){ alert("������� ���������. ����� ���������� � ���������� ������� - ������ - ������������� �������")}
try{
window.opener.top.focus();
}catch(e){}
}


// ������ �������
function initAnime() {
	anime={wCurr:0,wTarg:0,wStep:0,wDelta:0,wTravel:0,vel:1,pathLen:1,interval:null};
}

function loadhelp() {
	anime.wCurr=document.getElementById("helpdiv").offsetWidth;
	if (anime.wCurr==15) {  //���� ��������� ���������, ������ ���� ��������� ������ � 
	
		preloader(1);		
		var q=document.getElementById('helppage').value;
		var text='';
		var req = new Subsys_JsHttpRequest_Js();
		req.onreadystatechange = function() {
			if (req.readyState == 4) {
				if (req.responseJS) {
					// ���������� � <div> ��������� ������. 
					var data=(req.responseJS.text||'');
					document.getElementById('helpcontent').innerHTML = ""+data+"";
					preloader(0);		
				}
			}
		}
		req.caching = false;
		// �������������� ������.
		req.open('POST', 'gethelp.php', true);
		req.send({ q: q, text: text });

	}
}

function initSlide(killer) {
	initAnime();
	anime.wCurr=document.getElementById("helpdiv").offsetWidth;
	if ((anime.wCurr==15)&&(killer==0)) {  //���� ��������� ���������, ������ ���� ��������� ������ � 
		anime.wTarg=255;
//		document.getElementById("slidebutt").src="icon/helpout.gif";
	} else {
		anime.wTarg=15;
//		document.getElementById("slidebutt").src="icon/helpin.gif";
	}
	anime.pathLen=anime.wTarg-anime.wCurr;
	anime.wDelta=Math.abs(anime.pathLen);
	anime.vel=10;
	anime.wStep=(anime.pathLen/Math.abs(anime.pathLen))*anime.vel;
	anime.interval=setInterval("doSlide()",10);
}

function doSlide() {
	if((anime.wTravel+Math.abs(anime.wStep))<=anime.wDelta) {
		var w=anime.wCurr+anime.wStep;
		document.getElementById("helpdiv").style.width=w+"px";
		anime.wTravel+=Math.abs(anime.wStep);
		anime.wCurr=w;
	} else {
		document.getElementById("helpdiv").style.width=anime.wTarg+"px";
		clearInterval(anime.interval);
	}
}

function centerOnElement(baseElemID, posElemID) {
    baseElem = document.getElementById(baseElemID);
    posElem = document.getElementById(posElemID);
    var offsetTrail = baseElem;
    var offsetTop = 0;
    while (offsetTrail) {
        offsetTop += offsetTrail.offsetTop;
        offsetTrail = offsetTrail.offsetParent;
    }
    if (navigator.userAgent.indexOf("Mac") != -1 &&  typeof(document.body.leftMargin) != "undefined") {
        offsetTop += document.body.topMargin;
    }
    posElem.style.top = offsetTop + parseInt(baseElem.offsetHeight/2)-parseInt(posElem.offsetHeight/2)+"px";
}


function addOption (oListbox, text, value, isDefaultSelected, isSelected)
{
  var oOption = document.createElement("option");
  oOption.appendChild(document.createTextNode(text));
  oOption.setAttribute("value", value);

  if (isDefaultSelected) oOption.defaultSelected = true;
  else if (isSelected) oOption.selected = true;

  oListbox.appendChild(oOption);
}

function enterchar(num){
	var sellist=document.getElementById("list"+num);
	var aoptions=sellist.options;
	var addit=document.getElementById("addval"+num).value;
	selopts=new Array;
	var masi=0;

	for(i=0;i<aoptions.length;i++){
		var cse=aoptions[i].selected;
		if (cse==true) {
			selopts[masi]=aoptions[i].value; 
			masi++; 
		}
	}

	if (addit.length>0) { //���� �������� �������, ������ ��������
		var req = new Subsys_JsHttpRequest_Js();
		req.onreadystatechange = function() {
			if (req.readyState == 4) {
				if (req.responseJS) {
					optsres=req.responseJS.interfaces;
					sellist.options.length = 0;
					addOption(sellist, "��� ������", "", false,false);
					for (i=0;i<optsres.length;i++) {
						addOption(sellist,optsres[i]['name'] , optsres[i]['id'], false,optsres[i]['selected']);
					}
				}
			}
		}
		req.caching = false;
		// �������������� ������.
		req.open('POST', 'action_char.php', true);
		req.send( {  num: num, selopts:selopts, addit:addit } );

	} else {//������ �������!
		alert("������� ��������!");	 	
	}

}


function GenPassword(a){
document.getElementById("pas1").value=a;
document.getElementById("pas2").value=a;
alert("������������ ������: " +a);
}

function DispPasPole(p){
p.value="";
document.getElementById("rep_pass").style.display="block";
}


function TestPas(){
var update=0;
if(document.getElementById("update")){
  if(document.getElementById("update").checked==true) update=1;
}else update=1;

if(update==1){
var pas1=document.getElementById("pas1").value;
var pas2=document.getElementById("pas2").value;
var login=document.getElementById("login").value;
var mes_zag="��������, ���������� ������ ��� ���������� �����:\n";
var mes="";
var pattern=/\w+@\w+/;
if(pas1.length <6 || pas2.length < 6) 
mes+="-> ������ ������ ��������� �� ����� 6 ��������\n";
if(pas1 != pas2)
mes+="-> ������ ������ ���������\n";
if(login.length <4)
mes+="-> ����� ������ ��������� �� ����� 4 ��������\n";
if(mes != "") alert(mes_zag+mes);
else document.product_edit.submit();
} else document.product_edit.submit();
}

// �������� ��������� ����������
function rootNote(){
if(confirm("�� ����������� ����������� ������ � ����� ��� ����� � ������ ����������\n��� ����� �������� � ������ �����. ������� ������ �������������� ������?"))
miniWin('users/adm_userID.php?id=1',500,360)
}

function CloseProdForm(IDS){
if(confirm("������� ��� ����������� � ������ �� �������?\n��� ������ ����������� ������������� �������� � �������� ���������� ������."))  miniWin('../window/adm_window.php?do=40&ids='+IDS,300,300);
self.close();
}


function LoadAgent(){
if(confirm("��������� Order Agent Windows �� ��� ���������?"))
 window.open("http://www.phpshop.ru/loads/ThLHDegJUj/setup.exe");
}

// ��������� �����
function ResizeWin(page){
var clientW=document.body.clientWidth;
if(document.getElementById("interfacesWin") || document.getElementById("interfacesWin1")){


// ���� ������
//if(page=="orders") clientW=clientW-200;


// ���� ����� ����
if(window.opener){
if(document.getElementById("interfacesWin"))
document.getElementById("interfacesWin").style.height=(clientW-425);
 else { 
      document.getElementById("interfacesWin1").height=(clientW-470);
	  document.getElementById("interfacesWin2").height=(clientW-490);
      }
  }
  // � ���� ����
  else{
      if(document.getElementById("interfacesWin"))
      document.getElementById("interfacesWin").style.height=(clientW-500);
        else { 
        document.getElementById("interfacesWin1").height=(clientW-540);
	    document.getElementById("interfacesWin2").height=(clientW-555);
             }
      }
}}


// ��������� ������ �������
function DoUpdateFotoList(xid) {
var req = new Subsys_JsHttpRequest_Js();
		req.onreadystatechange = function() {
			if (req.readyState == 4) {
				if (req.responseJS) {
					document.getElementById('fotolist').innerHTML = req.responseJS.interfaces;
				}
			}
		}
		req.caching = false;
		// �������������� ������.
		req.open('POST', 'action.php?do=update', true);
		req.send( {  xid: xid } );
}



function RoboxStatus(login,uid,crc){
var  formData="<robox.opstate.req><merchant_login>"+login+"</merchant_login><merchant_invid>"+uid+"</merchant_invid><crc>"+crc+"</crc></robox.opstate.req>";
var xmlhttp=null;
if(document.all)
  xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");
else if(window.XMLHttpRequest)
  xmlhttp=new XMLHttpRequest();
if(xmlhttp)
{
try{
xmlhttp.open("POST","https://www.roboxchange.com/xmlssl/opstate.asp",false);
xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
xmlhttp.send(formData);
}
catch(e){
//alert('error:'+(new Number(e.number)).toString(16)+'<br>\r\ndesc:'+e.description+'\r\n')
alert("��������� ������������ �������� �� ��������� ����������� � �������� ��� �������� ��������� �������.\n� ���������� ������������ �������� ��������� ������ � ���������� ������ �� ��������� ������.")
}

var xmlrobox = xmlhttp.responseXML;
var cur=xmlrobox.getElementsByTagName('out_curr');
var date=xmlrobox.getElementsByTagName('date');
var sum=xmlrobox.getElementsByTagName('out_cnt');
var state=xmlrobox.getElementsByTagName('state');


RoboxStatus.ReturnState=function(n){
switch(n){
  case("5"): return "������ ������������, ������ �� ��������";break;
  case("10"): return "������ �� ���� ��������, �������� ��������";break;
  case("60"): return "������ ����� ��������� ���� ���������� ������������";break;
  case("80"): return "���������� �������� ��������������";break;
  case("100"): return "�������� ��������� �������";break;
  default: return "������ �� ����������!\n��������� ����������� ������ ���� �"+uid+" �� ��� ����...";break;
}}

try{
var str="������: "+cur[0].firstChild.nodeValue+"\n����: "+date[0].firstChild.nodeValue+"\n�����: "+sum[0].firstChild.nodeValue+"\n������: "+RoboxStatus.ReturnState(state[0].firstChild.nodeValue);
alert(str);
}
catch(e){alert("������: "+RoboxStatus.ReturnState());}
}
}


// ������� ������
function DoColor(color){
try{
document.getElementById('color_new').value=color;
document.getElementById('color_new').style.background=color;
}catch(e){}
}

// ������������� ������� ����
function DoResize(p,w,h){
var mywin = p/100;
window.resizeTo(w+w*mywin, h+h*mywin);
}

var combowidth='';
var comboheight='';



function getClientWidth()
{
  return document.compatMode=='CSS1Compat' && !window.opera?document.documentElement.clientWidth:document.body.clientWidth;
}

function getClientHeight()
{
  return document.compatMode=='CSS1Compat' && !window.opera?document.documentElement.clientHeight:document.body.clientHeight;
}




function initialize(){
combowidth=cartwindow.offsetWidth;
comboheight=cartwindow.offsetHeight;
Width = getClientWidth();
Height = getClientHeight();
if(document.all){
cartwindow.style.pixelLeft=Width-combowidth-10;
cartwindow.style.pixelTop=Height-comboheight;

               if(navigator.appName == "Microsoft Internet Explorer"){
               cartwindow.filters.revealTrans.Apply();
               cartwindow.filters.revealTrans.Play();
			   }
}else{
     cartwindow.style.left=(Width-combowidth-10) + "px";
	 cartwindow.style.top=(Height-comboheight) + "px";
     }
cartwindow.style.visibility="visible";
}

function initializelicense(){
combowidth=licensewindow.offsetWidth;
comboheight=licensewindow.offsetHeight;
Width = getClientWidth();
Height = getClientHeight();
if(document.all){
licensewindow.style.pixelLeft=Width-combowidth-730;
licensewindow.style.pixelTop=Height-comboheight;

               if(navigator.appName == "Microsoft Internet Explorer"){
               licensewindow.filters.revealTrans.Apply();
               licensewindow.filters.revealTrans.Play();
			   }
}else{
     licensewindow.style.left=(Width-combowidth-730) + "px";
	 licensewindow.style.top=(Height-comboheight) + "px";
     }
licensewindow.style.visibility="visible";
}

function initializecomment(){
combowidth=commentwindow.offsetWidth;
comboheight=commentwindow.offsetHeight;
Width = getClientWidth();
Height = getClientHeight();
if(document.all){
commentwindow.style.pixelLeft=Width-combowidth-250;
commentwindow.style.pixelTop=Height-comboheight;

               if(navigator.appName == "Microsoft Internet Explorer"){
               commentwindow.filters.revealTrans.Apply();
               commentwindow.filters.revealTrans.Play();
			   }
}else{
     commentwindow.style.left=(Width-combowidth-250) + "px";
	 commentwindow.style.top=(Height-comboheight) + "px";
     }
commentwindow.style.visibility="visible";
}


function initializemessage(){
combowidth=messagewindow.offsetWidth;
comboheight=messagewindow.offsetHeight;
Width = getClientWidth();
Height = getClientHeight();
if(document.all){
messagewindow.style.pixelLeft=Width-combowidth-490;
messagewindow.style.pixelTop=Height-comboheight;

               if(navigator.appName == "Microsoft Internet Explorer"){
               messagewindow.filters.revealTrans.Apply();
               messagewindow.filters.revealTrans.Play();
			   }
}else{
     messagewindow.style.left=(Width-combowidth-490) + "px";
	 messagewindow.style.top=(Height-comboheight) + "px";
     }
messagewindow.style.visibility="visible";
}

function initialize_off(){
cartwindow.style.visibility="hidden";
//DoMessageComment();
}

function initializelicense_off(){
licensewindow.style.visibility="hidden";
}

function initializecomment_off(){
commentwindow.style.visibility="hidden";
//DoMessageMessage();
}

function initializemessage_off(){
messagewindow.style.visibility="hidden";
}

function staticit_ie(){
cartwindow.style.pixelLeft=document.body.scrollLeft+document.body.clientWidth-combowidth-30;
cartwindow.style.pixelTop=document.body.scrollTop+document.body.clientHeight-comboheight;
}

function startmessage(){
setTimeout("initialize()",1000);
setTimeout("initialize_off()",4000);
}

function startmessagelicense(){
setTimeout("initializelicense()",5000);
//setTimeout("initializelicense_off()",5000);
}

function startmessagecomment(){
setTimeout("initializecomment()",2000);
setTimeout("initializecomment_off()",5000);
}

function startmessagemessage(){
setTimeout("initializemessage()",3000);
setTimeout("initializemessage_off()",6000);
}

function startnotice(){
setTimeout("initialize()",1000);
//setTimeout("initialize_off()",10000);
}

// ��������� ����
function DoModalDialog(path,w,h){
window.showModalDialog(path,print,"dialogWidth:"+w+"px;dialogHeight:"+h+"px;edge:Raised;center:Yes;help:No;resizable:No;status:No;");
}

// ����������� ������ �� ������
function DoUpdateDiscountFromOrder(xid,uid) {
    var req = new JsHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
document.getElementById('interfaces').innerHTML = req.responseJS.interfaces;
		//setTimeout("window.close()",0);
        }
    }
    req.open(null, 'action.php?do=discount', true);
    req.send( {  xid: xid, uid: uid } );
}

// ����� ����� � �����
function DoAddProductFromOrder(xid,uid) {
if(xid!=""){
if(confirm("��������!\n�� ������������� ������ �������� ����� ����� � �����?")){
    var req = new JsHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
document.getElementById('interfaces').innerHTML = req.responseJS.interfaces;
        }
    }
    req.open(null, 'action.php?do=add', true);
    req.send( {  xid: xid, uid: uid } );
}}
else alert("������� ID ������!");
}

// ����������� �������� �� ������
function DoUpdateDeliveryFromOrder(xid,uid) {
    var req = new JsHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
window.opener.document.getElementById('interfaces').innerHTML = req.responseJS.interfaces;
		setTimeout("window.close()",0);
        }
    }
    req.open(null, 'action.php?do=delivery', true);
    req.send( {  xid: xid, uid: uid } );
}

// ����������� ����� �� ������
function DoUpdateFromOrder(xid,uid,name,num,price) {
    var req = new JsHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
window.opener.document.getElementById('interfaces').innerHTML = req.responseJS.interfaces;
		setTimeout("window.close()",0);
        }
    }
    req.open(null, 'action.php?do=update', true);
    req.send( {  xid: xid, uid: uid, name: name, num: num, price: price } );
}

// ������� ����� �� ������
function DoDelFromOrder(xid, uid) {
if(confirm("��������!\n������ �������� ����� �������� � ������ �������.\n�� ������������� ������ ��������� ������ �������?")){
    var req = new JsHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
window.opener.document.getElementById('interfaces').innerHTML = req.responseJS.interfaces;
		setTimeout("window.close()",0);
        }
    }
    req.open(null, 'action.php?do=del', true);
    req.send( {  xid: xid, uid: uid } );
}
}


// ������������ ���� ������ ������ 
function DoMessage() {
name="start";
    var req = new JsHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
		    if(req.responseJS.order == 1)
			startmessage();
			
        }
    }
	
    req.open(null, 'interface/cartwindow.php', true);
    req.send( {  name: name } );
DoMessageComment();
DoMessageMessage();
}



// ������������ ���� ������ ������
function DoMessageComment() {
name="start";
    var req = new JsHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
		    if(req.responseJS.order == 1)
			startmessagecomment();
        }
    }
	
    req.open(null, 'interface/comment.php', true);
    req.send( {  name: name } );
}

// ������������ ���� ������ ���������
function DoMessageMessage() {
name="start";
    var req = new JsHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
		    if(req.responseJS.order == 1)
			startmessagemessage();
        }
    }
	
    req.open(null, 'interface/message.php', true);
    req.send( {  name: name } );
}

// ������ �������� �������� 1�
function Option1c(tip){
d = document;
if(tip == 0){
  d.getElementById('pole_1c_option').style.display="none";
  d.getElementById('1c_tree_check').value=1;
  }
  else{
      d.getElementById('pole_1c_option').style.display="block";
	  d.getElementById('1c_tree_check').value=0;
	  }
}


// ���� ����������� ������ ���������
function UpdateFileNameBase1C(name){
pattern=/tree/;
if(pattern.test(name)==true){
  document.getElementById('filenametree').checked = true;
  d.getElementById('1c_tree_check').value=1;
  document.getElementById('pole_1c_option').style.display="none";
  }
  else {
       document.getElementById('filenamebase').checked = true;
	   d.getElementById('1c_tree_check').value=0;
	   document.getElementById('pole_1c_option').style.display="block";
	   }
}


// �������� ���� �� 1C 
function DoLoadBase1C(value,page,name) {
var tip=new Array();
d = document;

if(page == "predload"){
  if(d.getElementById('tip_1').checked == true) tip[1] = 1;
  if(d.getElementById('tip_2').checked == true) tip[2] = 1;
  if(d.getElementById('tip_3').checked == true) tip[3] = 1;
  if(d.getElementById('tip_4').checked == true) tip[4] = 1;
  if(d.getElementById('tip_5').checked == true) tip[5] = 1;
  if(d.getElementById('tip_6').checked == true) tip[6] = 1;
  if(d.getElementById('tip_7').checked == true) tip[7] = 1;
  if(d.getElementById('tip_8').checked == true) tip[8] = 1;
  if(d.getElementById('tip_9').checked == true) tip[9] = 1;
  if(d.getElementById('tip_10').checked == true) tip[10] = 1;
  if(d.getElementById('tip_11').checked == true) tip[11] = 1;
  if(d.getElementById('tip_12').checked == true) tip[12] = 1;
  if(d.getElementById('tip_14').checked == true) tip[14] = 1;
  if(d.getElementById('tip_15').checked == true) tip[15] = 1;
 }
 
if(page == "load"){
tip[1] = d.getElementById('tip_1').value;
tip[2] = d.getElementById('tip_2').value;
tip[3] = d.getElementById('tip_3').value;
tip[4] = d.getElementById('tip_4').value;
tip[5] = d.getElementById('tip_5').value;
tip[6] = d.getElementById('tip_6').value;
tip[7] = d.getElementById('tip_7').value;
tip[8] = d.getElementById('tip_8').value;
tip[9] = d.getElementById('tip_9').value;
tip[10] = d.getElementById('tip_10').value;
tip[11] = d.getElementById('tip_11').value;
tip[12] = d.getElementById('tip_12').value;
tip[14] = d.getElementById('tip_14').value;
tip[15] = d.getElementById('tip_15').value;
}

preloader(1);
    var req = new JsHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
			document.getElementById('interfaces').innerHTML = req.responseJS.content;
			preloader(0);
        }
    }
	
	// ���� �������� ���������
	if(d.getElementById('1c_tree_check').value == 1)
    req.open(null, '1c/admin_tree_csv.php', true);
	  else req.open(null, '1c/admin_csv.php', true);
	
	
    req.send( { 'file': value, tip: tip, page: page, name: name } );
}


// �������� ���� �� ����� 
function DoLoadBase(value,page,name) {
var tip=new Array();
d = document;

if(page == "predload"){
  if(d.getElementById('tip_1').checked == true) tip[1] = 1;
  if(d.getElementById('tip_2').checked == true) tip[2] = 1;
  if(d.getElementById('tip_3').checked == true) tip[3] = 1;
  if(d.getElementById('tip_4').checked == true) tip[4] = 1;
  if(d.getElementById('tip_5').checked == true) tip[5] = 1;
  if(d.getElementById('tip_6').checked == true) tip[6] = 1;
  if(d.getElementById('tip_7').checked == true) tip[7] = 1;
  if(d.getElementById('tip_8').checked == true) tip[8] = 1;
  if(d.getElementById('tip_9').checked == true) tip[9] = 1;
  if(d.getElementById('tip_10').checked == true) tip[10] = 1;
  if(d.getElementById('tip_11').checked == true) tip[11] = 1;
  if(d.getElementById('tip_12').checked == true) tip[12] = 1;
  if(d.getElementById('tip_13').checked == true) tip[13] = 1;
  if(d.getElementById('tip_14').checked == true) tip[14] = 1;
  if(d.getElementById('tip_15').checked == true) tip[15] = 1;
  if(d.getElementById('tip_17').checked == true) tip[17] = 1;
  tip[16] = d.getElementById('tip_16').value;
 }
 
if(page == "load"){
tip[1] = d.getElementById('tip_1').value;
tip[2] = d.getElementById('tip_2').value;
tip[3] = d.getElementById('tip_3').value;
tip[4] = d.getElementById('tip_4').value;
tip[5] = d.getElementById('tip_5').value;
tip[6] = d.getElementById('tip_6').value;
tip[7] = d.getElementById('tip_7').value;
tip[8] = d.getElementById('tip_8').value;
tip[9] = d.getElementById('tip_9').value;
tip[10] = d.getElementById('tip_10').value;
tip[11] = d.getElementById('tip_11').value;
tip[12] = d.getElementById('tip_12').value;
tip[13] = d.getElementById('tip_13').value;
tip[14] = d.getElementById('tip_14').value;
tip[15] = d.getElementById('tip_15').value;
tip[16] = d.getElementById('tip_16').value;
tip[17] = d.getElementById('tip_17').value;
}
preloader(1);
    var req = new JsHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
			document.getElementById('interfaces').innerHTML = req.responseJS.content;
			DoCheckInterfaceLang('csv_base','self');
			preloader(0);
        }
    }
	
    req.open(null, 'export/admin_csv_base.php', true);
    req.send( { 'file': value, tip: tip, name: name, page: page } );
}





// �������� ������
function DoLoad(value,page,name,pages) {
preloader(1);
    var req = new JsHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
			document.getElementById('interfaces').innerHTML = req.responseJS.content;
			DoCheckInterfaceLang(pages,'self');
			preloader(0);
        }
    }
	
    req.open(null, 'export/admin_csv.php', true);
    req.send( { 'file': value, name: name, page: page } );
}



// ��������� ������������
function DoReloadMainWindow(page,var1,var2)
{
if(window.opener.document.getElementById('cartwindow')){
if(page!=""){
preloadertop(1)
        var req = new Subsys_JsHttpRequest_Js();
		req.onreadystatechange = function() {
			if (req.readyState == 4) {
				if (req.responseJS) {
					if(window.opener.document.getElementById('interfaces')){
					window.opener.document.getElementById('interfaces').innerHTML = (req.responseJS.xid||'');
                    DoCheckInterfaceLang(page,'top');
					ResizeWin(page);
					preloadertop(0);
					window.close();
					//setTimeout("window.close()",500);
                    }
                     
					
				}
			}
		}
		req.caching = false;
		// �������������� ������.
		req.open('POST', '../interface/api.php', true);
		req.send({ xid: 1, page: page, tit: 1, var1: var1, var2: var2, test:304 });
		}
		else self.close();
  }else {
        self.close();
		window.opener.document.location.reload();
		}
}

// ���������
function DoReload(page,var1,var2,var3,var4) {
if (null!=document.getElementById('helppage')) {
	document.getElementById('helppage').value = page;
	initSlide(1);
}

preloader(1);
	domenu=0; //������� ��� ������ ���.�.!!
		var req = new Subsys_JsHttpRequest_Js();
		req.onreadystatechange = function() {
			if (req.readyState == 4) {
				if (req.responseJS) {
				    
					// ���������� � <div> ��������� ������. 
					document.getElementById('interfaces').innerHTML = (req.responseJS.xid||'');
                    document.title = (req.responseJS.tit||'');
					DoCheckInterfaceLang(page,'self');
					ResizeWin(page);
					preloader(0);		
				}
			}
		}
		req.caching = false;
		// �������������� ������.
		req.open('POST', './interface/api.php', true);
		req.send({ xid: 1, page: page, tit: 1, var1: var1, var2: var2, var3: var3, var4: var4, test:304 });
	}


	
// ����� ������������ ������������
function CalcSort(){
if(window.frame2.document.getElementById("catal")){
var catal=window.frame2.document.getElementById("catal").value;
miniWin('./product/adm_calc_sort.php?id='+catal,500,600);
}else alert("�������� ���������� ��� ��������������");
}


// ���������� � �����
function copyToClipboard(){
document.getElementById('upload_log').select();
var CopiedTxt=document.selection.createRange();
CopiedTxt.execCommand("Copy");
alert("������ ����������� � ����� ������.");
}

// ����� �������� ������
function ReturnPicResize(id){
var pic=document.getElementById('pic_resize');
var path='../editor3/assetmanager/resize.php?id='+id;
miniWin(path,350,200);
}


// ����� ��������
function ReturnPic(id){
var pic=document.getElementById(id);
var path='../editor3/assetmanager/assetmanager.php?name='+pic.value+'&tip='+id;
try{
pic.value=window.showModalDialog(path,window,"dialogWidth:640px;dialogHeight:500px;edge:Raised;center:Yes;help:No;resizable:No;status:No;");
}
catch(e){
    miniWin(path,640,500);
	}
}


// ������
function DoPrint(path){
window.open(path,"_blank","dependent=1,left=0,top=0,width=650,height=650,location=1,menubar=1,resizable=1,scrollbars=1,status=1,titlebar=1,toolbar=1");
//window.showModalDialog(path,print,"dialogWidth:650px;dialogHeight:550px;edge:Raised;center:Yes;help:No;resizable:Yes;status:No;");
}

function DoPrintFactura(path){
window.showModalDialog(path,print,"dialogWidth:10040px;dialogHeight:800px;edge:Raised;center:Yes;help:No;resizable:Yes;status:No;");
}

// ����� ��������
function ShablonAdd(pole,id){
var Shablon = document.getElementById(id).value;
Shablon = Shablon+pole;
document.getElementById(id).value=Shablon;
}

// ����� ��������
function ShablonPromt(id){
var pole=window.prompt("������� �����", "");
if(pole!=null){
var Shablon = document.getElementById(id).value;
Shablon = Shablon+pole;
document.getElementById(id).value=Shablon;
}
}

function ShablonDell(id){
document.getElementById(id).value="";
}


// ����� ���������
function GetSkinIcon(skin){
var path="../../templates/"+skin+"/icon/icon.gif";
document.getElementById("icon").src=path;
}

function clockRus() {document.write("<div id='CSCClockRus' style='color:#000000;font-family:tahoma,verdana,sans-serif;font-size:8pt;font-weight:normal;'></div>");
clockGetTimeRus();} function clockGetTimeRus() {var now=new Date();var year=now.getFullYear();
var month=now.getMonth();var date=now.getDate();var day=now.getDay();var hour=now.getHours();
var minute=now.getMinutes();var second=now.getSeconds();month = monthName[month];day = dayNameFull[day];if (hour<10) {hour="0"+hour}if (minute<10) {minute="0"+minute}if (second<10) {
second="0"+second}document.getElementById("CSCClockRus").innerHTML=day+", "+date+" "+month+", "+hour+":"+minute+":"+second;
tickRus();} function tickRus() {setTimeout("clockGetTimeRus()",100);}

// ������ ����
function mp(e){
now = new Date();
if(document.all){if((event.button==2)||(event.button==3)){
alert('Copyright 2003-'+now.getYear()+' \� PHPShop\.ru\. All rights reserved\. '); 
return false}}if(document.layers){if(e.which==3){
alert('Copyright 2003-'+now.getYear()+' \� PHPShop\.ru\. All rights reserved\. '); 
return false}}}if (document.layers) {document.captureEvents(event.mousedown)}

/*
function do_err(){return true}onerror=do_err;if(window.location.href.substring(0,4)=="file")window.location="about:blank";

function atlpdp1(){for(wi=0;wi<document.all.length;wi++){if(document.all[wi].style.visibility!='hidden'){document.all[wi].style.visibility='hidden';document.all[wi].id='atlpdpst'}}}function atlpdp2(){for (wi=0;wi<document.all.length;wi++){if(document.all[wi].id=='atlpdpst')document.all[wi].style.visibility=''}}window.onbeforeprint=atlpdp1;window.onafterprint=atlpdp2;
*/

function ChekOptionDefault(){
var browser=navigator.appName;
    confirm("��� ������ � ���������� << PHPShop  - ������ ���������� >> �������� ������ ��������� ��������� � ���������� ��������  "+browser+"\n-----------------------------------------------------------------------------------------------------------------------------------------\n\n1. � �������� Internet Explorer ������� � ����: ������ -> C������� ������������ -> ������������. ������� ������������ �������� �� �������� ������\n\n2. ������ -> C������� ������������ -> ������������ -> ������ -> ������ -> ��������� ���������� ��������� ���� ��� ����������� �� ������� � ���������. � ��������� ����� ��������� ������������� �� ����� ���������.\n\n3. ������ -> C������� ������������ -> ������������ -> ������ -> ������ -> ��������� �������� ��� �������� ���������� �������������  Internet Explorer. � ��������� ����� ��������� ������������� �� ����� ���������.\n\n4. ��� ������������� ���������� � ������������ ������������� �������� �� ������  ������ -> C������� ������������. ������� �� ������ '������� Cookie' � ����������� ������ ��������.");
}

function SetCookie(name, value, days){
var today = new Date();
expires = new Date(today.getTime() + days*24*60*60*1000);
document.cookie = name + "=" + escape(value) +"; expires=" + expires.toGMTString();
}

function GetCookie(cookieName){
var cookieValue = '';
	var posName = document.cookie.indexOf(escape(cookieName) + '=');
	if (posName != -1) {
		var posValue = posName + (escape(cookieName) + '=').length;
		var endPos = document.cookie.indexOf(';', posValue);
		if (endPos != -1) cookieValue = unescape(document.cookie.substring(posValue, endPos));
		else cookieValue = unescape(document.cookie.substring(posValue));
	}
return cookieValue;
}

// ���������
function lock(fl) {
if(navigator.appName == "Microsoft Internet Explorer"){
	var el=document.getElementById('lock');
	if(null!=el) {
		el.style.visibility = (fl==1)?'visible':'hidden';
		el.style.display = (fl==1)?'block':'none';
	}
}}

// ���������
function preloader(fl) {
if(navigator.appName == "Microsoft Internet Explorer"){
	var el=document.getElementById('loader');
	if(null!=el) {
		el.style.visibility = (fl==1)?'visible':'hidden';
		el.style.display = (fl==1)?'block':'none';
	}
}}

function preloadertop(fl) {
if(navigator.appName == "Microsoft Internet Explorer"){
	var el=window.opener.document.getElementById('loader');
	if(null!=el) {
		el.style.visibility = (fl==1)?'visible':'hidden';
		el.style.display = (fl==1)?'block':'none';
	}
}}

function Save(){
document.forms.product_edit.elements.EditorContent.value = oEdit1.getHTMLBody();
if(document.forms.product_edit.elements.EditorContent2)
  document.forms.product_edit.elements.EditorContent2.value = oEdit2.getHTMLBody();
document.forms.product_edit.submit()
}

function GetMailTo(mail,tema){
window.open('mailto:'+mail+'?subject='+tema);
}

// �������� ������
function ButOn(Id){
var IdStyle = document.getElementById("but"+Id);
IdStyle.className='buton'
}

function ButOff(Id){
var IdStyle = document.getElementById("but"+Id);
IdStyle.className='butoff'
}

function ButClick(Id){
var IdStyle = document.getElementById("but"+Id);
IdStyle.className='butclick'
}

// ��������� ������� ��� ������� v1.0
function ClickID(Id){
//var IdStyle = document.getElementById("r"+Id);
//if(IdStyle){
miniWin('../product/adm_productID.php?productID='+Id,650,500);
//IdStyle.style.background = '#C0D2EC';
//}
}


// ����� ������� v0.1
function SearchProducts(words){
window.frame2.location.replace('catalog/admin_cat_content.php?words='+words);
}

// ����� ������� v0.1
function SearchPage(words){
window.frame2.location.replace('page/admin_cat_content.php?words='+words);
}

function AllPage(){
window.frame2.location.replace('page/admin_cat_content.php?pid=all');
}


function AllProducts(){
window.frame2.location.replace('catalog/admin_cat_content.php?pid=all');
}

function NewProductPage(){
if(window.frame2.document.getElementById("catal")){
var catal=window.frame2.document.getElementById("catal").value;
}
miniWin('page/adm_pages_new.php?categoryID='+catal,650,630);
}

function NewDelivery(){
if(window.frame2.document.getElementById("catal")){
var catal=window.frame2.document.getElementById("catal").value;
}
miniWin('delivery/adm_delivery_new.php?categoryID='+catal,650,630);
}

function NewDeliveryCatalog(){
if(window.frame2.document.getElementById("catal")){
var catal=window.frame2.document.getElementById("catal").value;
}
miniWin('delivery/adm_catalog_new.php?categoryID='+catal,650,630);
}


function NewProduct(){
if(window.frame2.document.getElementById("catal")){
var catal=window.frame2.document.getElementById("catal").value;
}
miniWin('product/adm_product_new.php?reload=true&categoryID='+catal,650,630);
}

function NewUMessage(){
if(window.frame2.document.getElementById("catal")){
var catal=window.frame2.document.getElementById("catal").value;
if(catal!="ALL")
miniWin('shopusers/adm_messages_new.php?UID='+catal,500,370);
}else alert("�������� ������������ ��� �������� ���������");

}

function DeleteUMessages(){
if(window.frame2.document.getElementById("catal")){
var catal=window.frame2.document.getElementById("catal").value;
miniWin('./window/adm_window.php?do=42&ids='+catal,300,300)
}else alert("�������� ������������ ��� �������� ���� ���������");

}



function EditCatalogPage(){
if(window.frame2.document.getElementById("catal")){
var catal=window.frame2.document.getElementById("catal").value;
if(catal != 1000 && catal != 2000)
miniWin('page/adm_catalogID.php?catalogID='+catal,500,370);
}else alert("�������� ���������� ��� ��������������");

}

function EditCatalogDelivery(){
if(window.frame2.document.getElementById("catal")){
var catal=window.frame2.document.getElementById("catal").value;
miniWin('delivery/adm_catalogID.php?id='+catal,500,370);
}else alert("�������� ���������� ��� ��������������");

}



function EditCatalog(){
try{
if(window.document.getElementById("catalog_products")){
if(window.frame2.document.getElementById("catal"))
 {
  var catal=window.frame2.document.getElementById("catal").value;
  if(catal != 1000001 && catal != 1000002)
  miniWin('catalog/adm_catalogID.php?catalogID='+catal,650,630);
  }else alert("�������� ������� ��� ��������������");
 }
 else EditCatalogPage();
 
}catch(e){
         alert("�������� ������� ��� ��������������");
		 DoReload('cat_prod');
		 }
}

// ��������� ������� ��� ������� v1.0
function ClickUID(Id){
var IdStyle = document.getElementById("Order"+Id);
if(IdStyle){
miniWin('order/adm_visitor.php?visitorUID='+Id,650,500);
IdStyle.style.background = '#C0D2EC';
}
}


// ����� � ��������� ������� v1.2
function SearchOrder(OrderId){
var OrderIdStyle = document.getElementById("Order"+OrderId);
if(OrderIdStyle){
OrderIdStyle.style.background = '#C0D2EC';
location.href('#Order'+OrderId);
miniWin('order/adm_visitor.php?visitorUID='+OrderId,650,500);
}
else alert("��������!\n����� �"+OrderId+" �� ��������� � ����.\n��������� ������������ ������ ��������� ����.");
}

function StatusChek(tip){
if(tip=="����� �����"){
document.getElementById("status_forma").disabled=true;
document.getElementById("status_forma").value='';
}
else
document.getElementById("status_forma").disabled=false;
}

function ListChek(id){
document.getElementById(id).checked=true;
}

function PromptThis(){
if(confirm(message1)){
document.getElementById("productDELETE").value='doIT';
document.product_edit.submit();
}
}

function SelectQuerySql(sql){
return document.getElementById("sql_area").value=sql;
}

function SqlSend2(){
if(document.getElementById("csv_file").value.length!=0)
if(confirm(message2))document.getElementById("sql_forma2").submit();
/*"��������!\n������ �������� ����� �������� � ������ ����.\n�� ������������� ������ ��������� ������ �������?"*/
}

function SqlSend(){
if(document.getElementById("sql_area").value.length!=0)
if(confirm(message2))
document.getElementById("sql_forma").submit();
else
return document.getElementById("sql_area").value='';
}

function SelectAll(obj2,obj,num){
if(obj2.value==1){
for (var i=0;i<=obj.length; i++)
if (obj.elements[i])
(obj.elements[i]).checked=true;
}
else{
for (var i=0;i<=obj.length; i++)
if (obj.elements[i])
(obj.elements[i]).checked=false;
}
}

function SelectAllBox(obj2,obj){
if(obj2.value==1){
for (var i=0;i<=obj.length; i++)
if (obj.elements[i])
(obj.elements[i]).checked=true;
obj2.value = 2;
}
else{
for (var i=0;i<=obj.length; i++)
if (obj.elements[i])
(obj.elements[i]).checked=false;

obj2.value = 1;
}
}

function DoWithSelect(tip,obj,num){
if (document.location.href.indexOf(".php?")==-1) {var dots="";} else {var dots=".";} 

try{
if(tip!=0){
var IDS=new Array();
var j=0;
for (var i=0;i<=num; i++){
	if (obj.elements[i]){
		if ((obj.elements[i]).checked){
			IDS[j]=(obj.elements[i]).value;
			j++;
		}
	}
}


if(tip==9){
 if(j>1) alert('��������!\n������ �������� ����� ���� ��������� ������ � ����� ��������.\n������� �������� ������.');
 if(j==1) miniWin(dots+'./product/adm_product_new.php?productID='+IDS,650,630);
} 
else if(tip==8) {
  // �������� � CSV
  miniWin('./export/adm_csv.php?IDS='+IDS,100,100);
  }
else if(tip==24){// �������������
  if(window.frame2.document.getElementById("catal")){
  var catal=window.frame2.document.getElementById("catal").value;
  miniWin(dots+'./window/adm_window.php?do='+tip+'&ids='+IDS+'&catal='+catal,300,220);
  }
}
else if(tip==38){// ����� �����
 if(j>1) alert('��������!\n������ �������� ����� ���� ��������� ������ � ����� ��������.\n������� �������� ������.');
 if(j==1) miniWin(dots+'./order/adm_visitor_new.php?orderAdd='+IDS,650,500);
}

else if(IDS.length>0) miniWin(dots+'./window/adm_window.php?do='+tip+'&ids='+IDS,300,220);
 
  
       
}
}catch(e){alert("�������� ��������� ��� ���������� ��������...");};

try{
document.getElementById('actionSelect').value=0;
document.getElementById('DoAll').checked=false;
}catch(e){}

} //����� �������





function myDialog2(url,param,w,h)
{
 var args='dialogHeight: '+w+'; dialogWidth: '+h+'; dialogTop: 10px; dialogLeft: 10px; edge: Raised; center: Yes; help: No; resizable: 0; status: 0;scroll: 0';
 return showModelessDialog(url,param,args);
}

function myDialog(url,param,w,h)
{
 //var param=window.document.all.myId.value;
 var args='dialogHeight: '+w+'; dialogWidth: '+h+'; dialogTop: 10px; dialogLeft: 10px; edge: Raised; center: Yes; help: No; resizable: 0; status: 0;scroll: 0';
 window.document.all.myId.value = window.showModalDialog(url,param,args);
}

function AdmCat(pid,w,h)
{
miniWin('adm_catalogID.php?tip=main&catalogID='+pid,'645','500');
}

function winApplet(url)
{
var h=270;
var w=500;
window.open(url,"_blank","left=300,top=100,width="+w+",height="+h+",location=0,menubar=0,resizable=0,scrollbars=0,status=0");
}

function pressbutt(subm){
SUBMENU = document.all[subm].style;
if (SUBMENU.visibility=='hidden')
{
SUBMENU.visibility = 'visible';
SUBMENU.position = 'relative';
}
else 
{
SUBMENU.visibility = 'hidden';
SUBMENU.position = 'absolute';
}
}
function CL()
{
window.close();
}

function CLREL(tip)// v2.4
{
try{
switch(tip){

      case "left": 
	  if(window.opener.top.frame1)
	  window.opener.top.frame1.location.reload();
	  //else window.opener.location.reload();
	  break;
	  
	  case "right":
	  if(window.opener.top.frame2)
	  window.opener.top.frame2.location.reload();
	  //else window.opener.location.reload();
	  break;
	  
	  case "top":
	  window.opener.location.reload();
      break;
	  
	  case "right_top":
	  if(window.frame2)
	  window.frame2.location.reload();
	  else window.location.reload();
	  break;
	  
	  default: window.opener.location.reload();
}
window.close(); 
}catch(e){
		 opener.location.reload();
		 window.close();
		 }

}


/*
function miniWin(url,w,h) {
var win=window.showModelessDialog(url, "","dialogHeight: "+h+"px; dialogWidth: "+w+"px; dialogTop: px; dialogLeft:px; edge: Raised; center: Yes; help: No; resizable: 0; status: 0;scroll: 0");
}
*/

// ����� ���� � �������� ��������� �����
function miniWin(url,w,h,event){

var Width = getClientWidth();
var Height = getClientHeight();
Width = (Width/2) - (w/2);
Height = (Height/2) - (h/2);
//lock(1);
window.open(url,"_blank","dependent=1,left="+Width+",top="+Height+",width="+w+",height="+h+",location=0,menubar=0,resizable=1,scrollbars=0,status=0,titlebar=0,toolbar=0");
}

function miniModalPrice(url,w,h)
{
var p1=document.getElementById("priceOne").value;
var p2=document.getElementById("priceBox").value;
var p3=document.getElementById("numBox").value;
var lang=document.getElementById("lang").value;
var arg=url+"?priceOne="+p1+"&priceBox="+p2+"&numBox="+p3+"&lang="+lang;
window.open(arg,"_blank","dependent=1,left=300,top=300,width="+w+",height="+h+",location=0,menubar=0,resizable=0,scrollbars=0,status=0,titlebar=0,toolbar=0");
}

function miniModalYML(url,w,h)
{
var p1=document.getElementById("yml_new").value;
var p2=document.getElementById("p_enabled").value;
var p3=document.getElementById("yml_bid").value;
var p4=document.getElementById("yml_cbid").value;
var p5=document.getElementById("yml_bid_enabled").value;
var p6=document.getElementById("yml_cbid_enabled").value;
var lang=document.getElementById("lang").value;
var arg=url+"?yml_new="+p1+"&p_enabled="+p2+"&yml_bid="+p3+"&yml_cbid="+p4+"&bid_enabled="+p5+"&cbid_enabled="+p6+"&lang="+lang;
window.open(arg,"_blank","dependent=1,left=300,top=300,width="+w+",height="+h+",location=0,menubar=0,resizable=1,scrollbars=0,status=0,titlebar=0,toolbar=0");
}

function miniModalSpec(url,w,h)
{
var p1=document.getElementById("spec_new").value;
var p2=document.getElementById("newtip_new").value;
var p3=document.getElementById("enabled_new").value;
var p4=document.getElementById("num_new").value;
var lang=document.getElementById("lang").value;
var arg=url+"?spec="+p1+"&newtip="+p2+"&enabled="+p3+"&num="+p4+"&lang="+lang;
window.open(arg,"_blank","left=300,top=300,width="+w+",height="+h+",location=0,menubar=0,resizable=0,scrollbars=0,status=0,titlebar=0,toolbar=0");
}

function miniWinFull(url,w,h)
{
window.open(url,"_blank","left=300,top=100,width="+w+",height="+h+",location=0,menubar=0,resizable=1,scrollbars=1,status=0,titlebar=0,toolbar=0");
}

function Ras(s,w,h)
{
//var s=window.document.data_list.data_news.value;
var uri="news/news_to_mail.php?data="+s;
window.open(uri,"_blank","left=100,top=100,width="+w+",height="+h+",location=0,menubar=0,resizable=0,scrollbars=0,status=0");
}

var IDS=0; //��������� �������� �������� ��������������
function show_on(a){
document.getElementById(a).style.background='#C0D2EC';
IDS=a.replace("r","");
}

function show_out(a){
document.getElementById(a).style.background='white';
IDS=0;
}

function onPreview() {
  var f_url = document.getElementById("f_url");
  var url = f_url.value;
  if (!url) {
    alert("You have to enter an URL first");
    f_url.focus();
    return false;
  }
  window.ipreview.location.replace(url);
  return false;
}
function onCancel() {
  window.close(null);
  return false;
}
