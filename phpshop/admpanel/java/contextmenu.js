d=document;	
var isOpera=self.opera;
var isNav = (navigator.appName == "Netscape");
var isIE= (navigator.appName == "Microsoft Internet Explorer");
var timerID;
var domenu=0; //�� ��������� �� ���������
var curpage="visiter";  //�� ��������� ��� ��� ��������� ��� ��� ����� �� �����
cMenus=['Nws'];		//������ ������, ������� ����.����

function starter(cpage) { //��� �������� ������
	domenu=1;
	if (cpage) {curpage=cpage;}
} //��� �������� ������


d.oncontextmenu=function(e){
if (domenu) {
	if(!isOpera&&!d.all)event=e;
	var o=d.all?event.srcElement:event.target;
	while(o){	//����� ����.���� ����� ������������ ������
		for(var i=0;i<cMenus.length;i++){
			if(o.id.substring(0,cMenus[i].length)==cMenus[i]) {break;}
		}
		if(i<cMenus.length)break;
		o=o.offsetParent;
	}
	if(o){
		cMenu(o,i);
		event.returnValue=!1;
	}else {
		cMenuOff();	//����./����.����.���� �� �����
	}
	//event.returnValue=!1;	//����� - ���� ���� ������ �������� ��������� ����.����
}
}

d.onclick=function(e){
if (domenu) {
	if(isOpera) {
		DoWith(999,IDS); //������������� �� ���
//		d.oncontextmenu(); //��������� ����������� ���� �� ��� (����������� ��� �����)
	}else if (isNav){
	}else {
		if (IDS!==0) {DoWith(999,IDS);} else {cMenuOff();}
	}
}
}	//����.����.���� �� ������

if (isNav) document.addEventListener("click",show, true);

function show(event){//������� ���������� ������ ���� ��� FF
if (domenu) {
	if(event.button == 0) {//��� ������ ������
		if (IDS!==0) {DoWith(999,IDS);} else {cMenuOff();}
	} else if(event.button == 1) {
		//  alert("Midle");
	} else {
		cMenuOff();
	}
}
}

cMenuOff=function(j){		//������� ��� (��� ���������) ����.����
	if(!j) {
		for(var i=0;i<cMenus.length;i++) {
			d.getElementById("cMenu"+cMenus[i]).style.visibility='hidden';
		}
	} else {
		j.style.visibility='hidden';
	}
	event.cancelBubble=!0;
}
cMenuOff2=function(j){		//������� ��� (��� ���������) ����.���� (����� cancelBubble, �������� timerid)
  if (timerID) {clearInterval(timerID);}
  timerID = null;
	if(!j) {
		for(var i=0;i<cMenus.length;i++) {
			d.getElementById("cMenu"+cMenus[i]).style.visibility='hidden';
		}
	} else {
		j.style.visibility='hidden';
	}
}
	
function cMenu(t,i){
	cMenuOff();

	var o2=d.getElementById('cMenu'+cMenus[i]);

	var cheIDS=ifcheckboxs(document.form_flag); //������ � �������
	var cheIDSAmount=cheIDS.length;
	
	if(cMenus[i]=='Nws'){	
		var coll = getLikeElements("A","name","tarurl");
		for(var ii=0;ii<coll.length;ii++) {
			var tip=coll[ii].id.replace("nameNews",""); //�������� id ��� ������
			if (cheIDSAmount>0) {
				coll[ii].href='javascript:DoWithSelect("'+tip+'",document.form_flag,1000)';			
			} else {
				coll[ii].href='javascript:DoWith("'+tip+'",'+IDS+')';
			}
			
		}
		
	}
/*	
	o2.style.left=d.all?d.body.scrollTop+event.clientX:d.body.scrollLeft+event.pageX; //��������� �� IE���������� � ���������� ����� �������

	if(isIE&&(d.getElementById("interfacesWin"))&&(curpage=="visiter")) {var topper=d.getElementById("interfacesWin").offsetTop;} else {var topper=0;} //���� ����  ��� �������, ��  �������� �������� ������� �� �������� �������.
	
	//alert(topper);


	o2.style.top=d.all?event.clientY-topper:event.pageY-topper; //��������� �� IE���������� � ���������� ����� �������
*/

	o2.style.left=d.all?d.body.scrollLeft+event.clientX:d.body.scrollLeft+event.pageX; //��������� �� IE���������� � ���������� ����� �������

	var topper=0;
	var inntopper=0;

	if (d.getElementById("interfacesWin")) {
		inntopper=d.getElementById("interfacesWin").scrollTop;
	}


	if(isIE&&(d.getElementById("interfacesWin"))&&(curpage=="visiter")) {var topper=d.getElementById("interfacesWin").offsetTop;} //���� ����  ��� �������, ��  �������� �������� ������� �� �������� �������.
	o2.style.top=d.all?event.clientY-topper+d.body.scrollTop+inntopper:event.pageY-topper+d.body.scrollTop; //��������� �� IE���������� � ���������� ����� �������


	o2.style.visibility ='visible';
	event.cancelBubble=!0;
	if (timerID) {clearInterval(timerID);} timerID = null;
	timerID =setTimeout("cMenuOff2()", 6000);	//����� �������� ���� ������ ��� ����� �������, ���� ���-��� �� ������� �� ���� ���
}

//alert(curpage);

//����������������  ���������������� ������� PHPSHOP
function DoWith (tip,IDS) {
if (document.location.href.indexOf(".php?")==-1) {var dots="";} else {var dots=".";} //������������ ������� �������� ������ �������� ������	
	if(tip==9){
		miniWin(dots+'./product/adm_product_new.php?productID='+IDS,650,630);
	} else if(tip==24){// �������������
		if(window.top.frame2.document.getElementById("catal")){
			var catal=window.top.frame2.document.getElementById("catal").value;
			miniWin(dots+'./window/adm_window.php?do='+tip+'&ids='+IDS+'&catal='+catal,300,220);
		}
	} else if(tip==38){// ����� �����
		miniWin(dots+'./order/adm_visitor_new.php?orderAdd='+IDS,650,500);
	} else if(tip==999){// �������������� ������
/*
		if (curpage=="product") miniWin(dots+'./product/adm_productID.php?productID='+IDS,650,630);
		if (curpage=="pages") miniWin(dots+'./page/adm_pagesID.php?id='+IDS,650,600);		
		if (curpage=="news") miniWin(dots+'./news/adm_newsID.php?id='+IDS,650,650);				
		if (curpage=="search_jurnal") {}						
		if (curpage=="search_pre") {miniWin(dots+'./report/adm_preID.php?id='+IDS,400,380);}
		if (curpage=="gbook") {miniWin(dots+'./gbook/adm_gbookID.php?id='+IDS,630,630);}										
		if (curpage=="visiter") {miniWin(dots+'./order/adm_visitorID.php?visitorID='+IDS,650,500);}
		if (curpage=="users") {miniWin(dots+'./shopusers/adm_userID.php?id='+IDS,500,500);}
		if (curpage=="notice") {miniWin(dots+'./product/adm_productID.php?productID='+IDS,700,630);}
		if (curpage=="comment") {miniWin(dots+'./comment/adm_commentID.php?id='+IDS,650,530);}
		if (curpage=="chanels") {miniWin(dots+'./rssgraber/adm_chanelsID.php?id='+IDS,400,450);}
*/
	} else {
		miniWin(dots+'./window/adm_window.php?do='+tip+'&ids='+IDS,300,220);
	}
}
//����������������  ���������������� ������� PHPSHOP



///////////////���� �� ����������
function remover() {
	if (timerID) {clearInterval(timerID);} timerID = null;	
	clearInterval(timerID);
	timerID =setTimeout("cMenuOff2()", 1000);
} //��������� ���� ����� ���� ��� ����� ���
function stoptime() {
	clearInterval(timerID);
	if (timerID) {clearInterval(timerID);} timerID = null;
} //��������� �������, ���� ��� ������ �� ���� � ����
///////////////���� �� ����������



//������� �������� ������� ���������� ���������.
function ifcheckboxs(obj) {
var IDS=new Array();
var j=0;
var num=1000;
for (var i=0;i<=num; i++){
	if (obj.elements[i]){
		if ((obj.elements[i]).checked){
			IDS[j]=(obj.elements[i]).value;
			j++;
		}
	}
}

return IDS;
}



//��� ������ ������ ������ ����� �� ����� ��������
function getLikeElements(tagName, attrName, attrValue) {
    var startSet;
    var endSet = new Array();
    if (tagName) {
        startSet = document.getElementsByTagName(tagName);    
    } else {
        startSet = (document.all) ? document.all : document.getElementsByTagName("*");
    }
    if (attrName) {
        for (var i = 0; i < startSet.length; i++) {
            if (startSet[i].getAttribute(attrName)) {
                if (attrValue) {
                    if (startSet[i].getAttribute(attrName) == attrValue) {
                        endSet[endSet.length] = startSet[i];
                    }
                } else {
                    endSet[endSet.length] = startSet[i];
                }
            }
        }
    } else {
        endSet = startSet;
    }
    return endSet;
}

