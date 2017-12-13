//***************************************************//
// PHPShop JavaScript 3.7                            //
// Copyright � www.phpshop.ru. ��� ����� ��������.   //
//***************************************************//

function showGraph() {
    d = document;
    var tempp = d.getElementById('graph').style.display;
    if (tempp != "none") {
        d.getElementById('graph').style.display = "none";
        SetCookie('stat_graph', 0, 10);
    }
    else {
        d.getElementById('graph').style.display = "block";
        SetCookie('stat_graph', 1, 10);
    }
}

function PHPShopJS() {

    this.button_on = function(a) {
        this.classStyle(a.id, 'buton');
    }

    this.button_off = function(a) {
        this.classStyle(a.id, 'butoff');
    }

    this.rowshow_on = function(a) {
        this.classStyle(a.id, 'row_show_on');
    }

    this.rowshow_out = function(a, line) {
        if (line != ' line2')
            this.classStyle(a.id, 'row_show_off');
        else
            this.classStyle(a.id, 'row line2');

    }

    this.classStyle = function(a, name) {
        document.getElementById(a).className = name;
    }

    this.style = function(a, style) {
        document.getElementById(a).style = style;
    }

    this.value = function(a, value) {
        document.getElementById(a).value = value;
    }

    this.open = function(url, w, h) {
        var Width = getClientWidth();
        var Height = getClientHeight();
        Width = (Width / 2) - (w / 2);
        Height = (Height / 2) - (h / 2);
        window.open(url, "_blank", "dependent=1,left=" + Width + ",top=" + Height + ",width=" + w + ",height=" + h + ",location=0,menubar=0,resizable=1,scrollbars=0,status=0,titlebar=0,toolbar=0");
    }

    this.loadjs = function(page) {
        var data = document.createElement('script');
        data.type = 'text/javascript';
        data.async = true;
        data.id = page + '_jslib';
        data.src = page + '/gui/' + page + '.gui.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(data, s);
    }

    // �������� ��� [1|2]
    this.selectall = function(value) {

        if (window.frame2)
            obj = window.frame2.document.flag_form;
        else
            obj = window.document.flag_form;

        if (value == 1) {
            for (var i = 0; i <= obj.length; i++)
                if (obj.elements[i])
                    (obj.elements[i]).checked = true;
        }
        else {
            for (var i = 0; i <= obj.length; i++)
                if (obj.elements[i])
                    (obj.elements[i]).checked = false;
        }
    }

    // ��������� ��������
    this.action = function(a) {
        var num = 1000;

        if (window.frame2)
            obj = window.frame2.document.flag_form;
        else
            obj = window.document.flag_form;

        try {
            if (a != 0) {
                var IDS = new Array();
                var j = 0;
                for (var i = 0; i <= num; i++) {
                    if (obj.elements[i]) {
                        if ((obj.elements[i]).checked) {
                            IDS[j] = (obj.elements[i]).value;
                            j++;
                        }
                    }
                }

                if (IDS.length > 0)
                    PHPShopJS.open('window/adm_window.php?do=' + a + '&ids=' + IDS, 300, 220);
            }
        } catch (e) {
        }

        try {
            document.getElementById('action').value = 0;
            // document.getElementById('DoAll').checked=false;
        } catch (e) {
        }
    }
}

var PHPShopJS = new PHPShopJS();

function DoUpgrade(name) {
    document.getElementById(name).submit();
}

// ���������� ��������
function DoUpdateModules(action, xid, pid) {
    var req = new Subsys_JsHttpRequest_Js();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            if (req.responseJS) {
                window.top.location.replace('../admin.php?page=modules&var2=' + pid);
            }
        }
    }
    req.caching = false;
    // �������������� ������.
    req.open('POST', 'action.php?do=' + action, true);
    req.send({
        xid: xid
    });


}



// ���������� �������
function ClosePanelProductDisp() {
    var obj = document.getElementById('prevpanel_act');
    var clientW = document.body.clientWidth;
    var clientH = document.body.clientHeight;
    var mem = document.getElementById('prevpanel_mem').value;
    if (!obj.checked) {
        document.getElementById('prevpanel').innerHTML = "";


        // ����� ����
        if (window.opener)
            document.getElementById("frame2").height = (clientH - 170);
        else
            document.getElementById("frame2").height = (clientH - 185);

    } else {

        // ����� ����
        if (window.opener)
            document.getElementById("frame2").height = (clientH - 315);
        else
            document.getElementById("frame2").height = (clientH - 330);

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
        req.send({
            xid: mem
        });


    }
}


// �������� ������ � ������
function DoUpdateProductDisp(xid) {
    var obj = window.top.document.getElementById('prevpanel_act');
    var clientW = window.top.document.body.clientWidth;
    var clientH = window.top.document.body.clientHeight;
    if (obj.checked) {

        // ����� ����
        if (window.top.opener)
            window.top.document.getElementById("frame2").height = (clientH - 315);
        else if (window.top.document)
            window.top.document.getElementById("frame2").height = (clientH - 330);

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
        req.send({
            xid: xid
        });
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
        req.send({
            xid: xid
        });
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
    if (navigator.userAgent.indexOf("Mac") != -1 && typeof(document.body.leftMargin) != "undefined") {
        offsetTop += document.body.topMargin;
    }
    posElem.style.top = offsetTop + parseInt(baseElem.offsetHeight / 2) - parseInt(posElem.offsetHeight / 2) + "px";
}


function addOption(oListbox, text, value, isDefaultSelected, isSelected)
{
    var oOption = document.createElement("option");
    oOption.appendChild(document.createTextNode(text));
    oOption.setAttribute("value", value);

    if (isDefaultSelected)
        oOption.defaultSelected = true;
    else if (isSelected)
        oOption.selected = true;

    oListbox.appendChild(oOption);
}

function enterchar(num) {

    var sellist = document.getElementById("list" + num);
    var aoptions = sellist.options;
    var addit = document.getElementById("addval" + num).value;
    selopts = new Array;
    var masi = 0;

    for (i = 0; i < aoptions.length; i++) {
        var cse = aoptions[i].selected;
        if (cse == true) {
            selopts[masi] = aoptions[i].value;
            masi++;
        }
    }

    if (addit.length > 0) { //���� �������� �������, ������ ��������
        var req = new Subsys_JsHttpRequest_Js();
        req.onreadystatechange = function() {
            if (req.readyState == 4) {
                if (req.responseJS) {
                    optsres = req.responseJS.interfaces;
                    sellist.options.length = 0;
                    addOption(sellist, "��� ������", "", false, false);
                    for (i = 0; i < optsres.length; i++) {
                        addOption(sellist, optsres[i]['name'], optsres[i]['id'], false, optsres[i]['selected']);
                    }
                }
            }
        }
        req.caching = false;
        // �������������� ������.
        req.open('POST', 'action_char.php', true);
        req.send({
            num: num,
            selopts: selopts,
            addit: addit
        });

    } else {//������ �������!
        alert("������� ��������!");
    }

}


function GenPassword(a) {
    document.getElementById("pas1").value = a;
    document.getElementById("pas2").value = a;
    alert("������������ ������: " + a);
}

function DispPasPole(p) {
    p.value = "";
    document.getElementById("pas2").disabled = false;
    document.getElementById("gen_button").disabled = false;
}


function TestPas() {
    var update = 0;
    if (document.getElementById("update")) {
        if (document.getElementById("update").checked == true)
            update = 1;
    } else
        update = 1;

    if (update == 1) {
        var pas1 = document.getElementById("pas1").value;
        var pas2 = document.getElementById("pas2").value;
        var login = document.getElementById("login").value;
        var mes_zag = "��������, ���������� ������ ��� ���������� �����:\n";
        var mes = "";
        var pattern = /\w+@\w+/;
        if (pas1.length < 6 || pas2.length < 6)
            mes += "-> ������ ������ ��������� �� ����� 6 ��������\n";
        if (pas1 != pas2)
            mes += "-> ������ ������ ���������\n";
        if (login.length < 4)
            mes += "-> ����� ������ ��������� �� ����� 4 ��������\n";
        if (mes != "")
            alert(mes_zag + mes);
        else
            document.product_edit.submit();
    } else
        document.product_edit.submit();
}

// �������� ��������� ����������
function rootNote() {
    if (confirm("�� ����������� ����������� ������ � ����� ��� ����� � ������ ����������\n��� ����� �������� � ������ �����. ������� ������ �������������� ������?"))
        miniWin('users/adm_userID.php?id=1', 500, 360)
}

function CloseProdForm(IDS) {
    if (confirm("������� ��� ����������� � ������ �� �������?\n��� ������ ����������� ������������� �������� � �������� ���������� ������."))
        miniWin('../window/adm_window.php?do=40&ids=' + IDS, 300, 300);
    self.close();
}


function LoadAgent() {
    if (confirm("��������� Order Agent Windows �� ��� ���������?"))
        window.open("http://www.phpshop.ru/loads/files/setup.exe");
}


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
    req.send({
        xid: xid
    });
}



function RoboxStatus(login, uid, crc) {
    var formData = "<robox.opstate.req><merchant_login>" + login + "</merchant_login><merchant_invid>" + uid + "</merchant_invid><crc>" + crc + "</crc></robox.opstate.req>";
    var xmlhttp = null;
    if (document.all)
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    else if (window.XMLHttpRequest)
        xmlhttp = new XMLHttpRequest();
    if (xmlhttp)
    {
        try {
            xmlhttp.open("POST", "https://www.roboxchange.com/xmlssl/opstate.asp", false);
            xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xmlhttp.send(formData);
        }
        catch (e) {
            //alert('error:'+(new Number(e.number)).toString(16)+'<br>\r\ndesc:'+e.description+'\r\n')
            alert("��������� ������������ �������� �� ��������� ����������� � �������� ��� �������� ��������� �������.\n� ���������� ������������ �������� ��������� ������ � ���������� ������ �� ��������� ������.")
        }

        var xmlrobox = xmlhttp.responseXML;
        var cur = xmlrobox.getElementsByTagName('out_curr');
        var date = xmlrobox.getElementsByTagName('date');
        var sum = xmlrobox.getElementsByTagName('out_cnt');
        var state = xmlrobox.getElementsByTagName('state');


        RoboxStatus.ReturnState = function(n) {
            switch (n) {
                case("5"):
                    return "������ ������������, ������ �� ��������";
                    break;
                case("10"):
                    return "������ �� ���� ��������, �������� ��������";
                    break;
                case("60"):
                    return "������ ����� ��������� ���� ���������� ������������";
                    break;
                case("80"):
                    return "���������� �������� ��������������";
                    break;
                case("100"):
                    return "�������� ��������� �������";
                    break;
                default:
                    return "������ �� ����������!\n��������� ����������� ������ ���� �" + uid + " �� ��� ����...";
                    break;
            }
        }

        try {
            var str = "������: " + cur[0].firstChild.nodeValue + "\n����: " + date[0].firstChild.nodeValue + "\n�����: " + sum[0].firstChild.nodeValue + "\n������: " + RoboxStatus.ReturnState(state[0].firstChild.nodeValue);
            alert(str);
        }
        catch (e) {
            alert("������: " + RoboxStatus.ReturnState());
        }
    }
}


// ������� ������
function DoColor(color) {
    try {
        document.getElementById('color_new').value = color;
        document.getElementById('color_new').style.background = color;
    } catch (e) {
    }
}

// ������������� ������� ����
function DoResize(p, w, h) {
//var mywin = p/100;
//window.resizeTo(w+w*mywin, h+h*mywin);
}

var combowidth = '';
var comboheight = '';



function getClientWidth()
{
    return document.compatMode == 'CSS1Compat' && !window.opera ? document.documentElement.clientWidth : document.body.clientWidth;
}

function getClientHeight()
{
    return document.compatMode == 'CSS1Compat' && !window.opera ? document.documentElement.clientHeight : document.body.clientHeight;
}



function initializemessage(name) {
    try {
        licensewindow = document.getElementById(name);
        combowidth = licensewindow.offsetWidth;
        comboheight = licensewindow.offsetHeight;
        Width = getClientWidth();
        Height = getClientHeight();
        if (document.all) {
            licensewindow.style.pixelLeft = Width - combowidth - 10;
            licensewindow.style.pixelTop = Height - comboheight;

            if (navigator.appName == "Microsoft Internet Explorer") {
                licensewindow.filters.revealTrans.Apply();
                licensewindow.filters.revealTrans.Play();
            }
        } else {
            licensewindow.style.left = (Width - combowidth - 10) + "px";
            licensewindow.style.top = (Height - comboheight) + "px";
        }
        licensewindow.style.visibility = "visible";
    } catch (e) {
    }
}


// ��������� ����
function DoModalDialog(path, w, h) {
    window.showModalDialog(path, print, "dialogWidth:" + w + "px;dialogHeight:" + h + "px;edge:Raised;center:Yes;help:No;resizable:No;status:No;");
}

// ����������� ������ �� ������
function DoUpdateDiscountFromOrder(xid, uid) {
    var req = new JsHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            document.getElementById('interfaces').innerHTML = req.responseJS.interfaces;
            //setTimeout("window.close()",0);
        }
    }
    req.open(null, 'action.php?do=discount', true);
    req.send({
        xid: xid,
        uid: uid
    });
}

// ����� ����� � �����
function DoAddProductFromOrder(xid, uid) {
    if (xid != "") {
        if (confirm("��������!\n�� ������������� ������ �������� ����� ����� � �����?")) {
            var req = new JsHttpRequest();
            req.onreadystatechange = function() {
                if (req.readyState == 4) {
                    document.getElementById('interfaces').innerHTML = req.responseJS.interfaces;
                }
            }
            req.open(null, 'action.php?do=add', true);
            req.send({
                xid: xid,
                uid: uid
            });
        }
    }
    else
        alert("������� ID ������!");
}

// ����������� �������� �� ������
function DoUpdateDeliveryFromOrder(xid, uid) {
    var req = new JsHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            window.opener.document.getElementById('interfaces').innerHTML = req.responseJS.interfaces;
            setTimeout("window.close()", 0);
        }
    }
    req.open(null, 'action.php?do=delivery', true);
    req.send({
        xid: xid,
        uid: uid
    });
}

// ����������� ����� �� ������
function DoUpdateFromOrder(xid, uid, name, num, price) {
    var req = new JsHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            window.opener.document.getElementById('interfaces').innerHTML = req.responseJS.interfaces;
            setTimeout("window.close()", 0);
        }
    }
    req.open(null, 'action.php?do=update', true);
    req.send({
        xid: xid,
        uid: uid,
        name: name,
        num: num,
        price: price
    });
}

// ������� ����� �� ������
function DoDelFromOrder(xid, uid) {
    if (confirm("��������!\n������ �������� ����� �������� � ������ �������.\n�� ������������� ������ ��������� ������ �������?")) {
        var req = new JsHttpRequest();
        req.onreadystatechange = function() {
            if (req.readyState == 4) {
                window.opener.document.getElementById('interfaces').innerHTML = req.responseJS.interfaces;
                setTimeout("window.close()", 0);
            }
        }
        req.open(null, 'action.php?do=del', true);
        req.send({
            xid: xid,
            uid: uid
        });
    }
}



// ���-�� ����� ������� � ������������
function CheckNewOrders() {
    name = "start";
    var req = new JsHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            if (req.responseJS.order > 0)
                document.getElementById('new_order').innerHTML = req.responseJS.order;

            if (req.responseJS.message > 0)
                document.getElementById('new_message').innerHTML = req.responseJS.message;

            if (req.responseJS.comment > 0)
                document.getElementById('new_comment').innerHTML = req.responseJS.comment;
        }
    }

    req.open(null, 'interface/check.php', true);
    req.send({
        name: name
    });
}


// ������ �������� �������� 1�
function Option1c(tip) {
    d = document;
    switch (tip) {
        case 0:
            d.getElementById('pole_1c_option').style.display = "none";
            d.getElementById('pole_user_option').style.display = "none";
            d.getElementById('1c_tree_check').value = 1;
            break;

        case 1:
            d.getElementById('pole_1c_option').style.display = "block";
            d.getElementById('pole_user_option').style.display = "none";
            d.getElementById('1c_tree_check').value = 0;
            break;

        case 2:
            d.getElementById('pole_1c_option').style.display = "none";
            d.getElementById('pole_user_option').style.display = "block";
            d.getElementById('1c_tree_check').value = 2;
            break;

    }
}


// ���� ����������� ������ ���������
function UpdateFileNameBase1C(name) {
    var d = document;
    var pattern = /tree/;
    var pattern2 = /user/;
    if (pattern.test(name) == true) {
        d.getElementById('filenametree').checked = true;
        d.getElementById('1c_target_check').value = 1;
        d.getElementById('pole_1c_option').style.display = "none";
        d.getElementById('pole_user_option').style.display = "none";
    }
    else if (pattern2.test(name) == true) {
        d.getElementById('filenameuser').checked = true;
        d.getElementById('1c_target_check').value = 2;
        d.getElementById('pole_user_option').style.display = "block";
        d.getElementById('pole_1c_option').style.display = "none";
    }
    else {
        d.getElementById('filenamebase').checked = true;
        d.getElementById('1c_target_check').value = 0;
        d.getElementById('pole_1c_option').style.display = "block";
        d.getElementById('pole_user_option').style.display = "none";
    }
}


// �������� ���� �� 1C 
function DoLoadBase1C(value, page, name) {
    var tip = new Array();
    var totalItems = 30;
    d = document;
    if (page == "predload") {
        i = 1;
        while (i < totalItems) {
            if (d.getElementById('tip_' + i))
                if (d.getElementById('tip_' + i).checked == true)
                    tip[i] = 1;
            i++;
        }
    }

    if (page == "load") {
        i = 1;
        while (i < totalItems) {
            if (d.getElementById('tip_' + i))
                tip[i] = d.getElementById('tip_' + i).value;
            i++;
        }
    }

    preloader(1);
    var req = new JsHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            document.getElementById('interfaces').innerHTML = req.responseJS.content;
            preloader(0);
        }
    }

    // ��������
    if (d.getElementById('1c_target_check').value == 1)
        target = "admin_tree_csv.php";
    if (d.getElementById('1c_target_check').value == 0)
        target = "admin_csv.php";
    if (d.getElementById('1c_target_check').value == 2)
        target = "admin_user_csv.php";

    req.open(null, '1c/' + target, true);
    req.send({
        'file': value,
        tip: tip,
        page: page,
        name: name
    });
}


// �������� ���� �� ����� 
function DoLoadBase(value, page, name) {
    var tip = new Array();
    var d = document;
    var totalItems = 25;
    if (page == "predload") {

        i = 1;
        while (i < totalItems) {
            if (d.getElementById('tip_' + i))
                if (d.getElementById('tip_' + i).checked == true)
                    tip[i] = 1;
            i++;
        }
        tip[16] = d.getElementById('tip_16').value;
    }

    if (page == "load") {
        i = 1;
        while (i < totalItems) {
            if (d.getElementById('tip_' + i))
                tip[i] = d.getElementById('tip_' + i).value;
            i++;
        }
    }
    preloader(1);
    var req = new JsHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            document.getElementById('interfaces').innerHTML = req.responseJS.content;
            DoCheckInterfaceLang('csv_base', 'self');
            preloader(0);
        }
    }

    req.open(null, 'export/admin_csv_base.php', true);
    req.send({
        'file': value,
        tip: tip,
        name: name,
        page: page
    });
}





// �������� ������
function DoLoad(value, page, name, pages) {
    preloader(1);
    var req = new JsHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            document.getElementById('interfaces').innerHTML = req.responseJS.content;
            DoCheckInterfaceLang(pages, 'self');
            preloader(0);
        }
    }

    req.open(null, 'export/admin_csv.php', true);
    req.send({
        'file': value,
        name: name,
        page: page
    });
}



// ��������� ������������
function DoReloadMainWindow(page, var1, var2)
{
    if (window.opener.document.getElementById('licensewindow')) {
        if (page != "") {
            //preloadertop(1)
            var req = new Subsys_JsHttpRequest_Js();
            req.onreadystatechange = function() {
                if (req.readyState == 4) {
                    if (req.responseJS) {
                        if (window.opener.document.getElementById('interfaces')) {
                            window.opener.document.getElementById('interfaces').innerHTML = (req.responseJS.xid || '');
                            //DoCheckInterfaceLang(page,'top');
                            //ResizeWin(page);
                            //preloadertop(0);
                            window.close();
                            //setTimeout("window.close()",500);
                        }


                    }
                }
            }
            req.caching = false;
            // �������������� ������.
            req.open('POST', '../interface/api.php', true);
            req.send({
                xid: 1,
                page: page,
                tit: 1,
                var1: var1,
                var2: var2,
                test: 304
            });
        }
        else
            self.close();
    } else {
        self.close();
        window.opener.document.location.reload();
    }
}

// ���������
function DoReload(page, var1, var2, var3, var4) {

    domenu = 0;
    var req = new Subsys_JsHttpRequest_Js();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            if (req.responseJS) {

                // ���������� � <div> ��������� ������.
                document.getElementById('interfaces').innerHTML = (req.responseJS.xid || '');
                document.title = (req.responseJS.tit || '');

                // �������� ��������������� JS �� ����������
                if (req.responseJS.js !== null)
                    PHPShopJS.loadjs(page);

                // ����������
                sortables_init();

                //preloader(0);
                // ResizeWin(page);

            }
        }
    }
    req.caching = false;
    // �������������� ������.
    req.open('POST', './interface/api.php', true);
    req.send({
        xid: 1,
        page: page,
        tit: 1,
        var1: var1,
        var2: var2,
        var3: var3,
        var4: var4,
        test: 304
    });
}


// ���������� � �����
function copyToClipboard() {
    document.getElementById('upload_log').select();
    var CopiedTxt = document.selection.createRange();
    CopiedTxt.execCommand("Copy");
    alert("������ ����������� � ����� ������.");
}

// ����� �������� ������
function ReturnPicResize(id) {
    var pic = document.getElementById('pic_resize');
    var path = '../editor3/assetmanager/resize.php?id=' + id;
    miniWin(path, 350, 200);
}


// ����� ��������
function ReturnPic(id) {
    var pic = document.getElementById(id);
    var path = '../editor3/assetmanager/assetmanager.php?name=' + pic.value + '&tip=' + id;

    miniWin(path, 640, 500);

}


// ������
function DoPrint(path) {
    window.open(path, "_blank", "dependent=1,left=0,top=0,width=650,height=650,location=1,menubar=1,resizable=1,scrollbars=1,status=1,titlebar=1,toolbar=1");
//window.showModalDialog(path,print,"dialogWidth:650px;dialogHeight:550px;edge:Raised;center:Yes;help:No;resizable:Yes;status:No;");
}

function DoPrintFactura(path) {
    window.showModalDialog(path, print, "dialogWidth:10040px;dialogHeight:800px;edge:Raised;center:Yes;help:No;resizable:Yes;status:No;");
}

// ����� ��������
function ShablonAdd(pole, id) {
    var Shablon = document.getElementById(id).value;
    Shablon = Shablon + pole;
    document.getElementById(id).value = Shablon;
}

// ����� ��������
function ShablonPromt(id) {
    var pole = window.prompt("������� �����", "");
    if (pole != null) {
        var Shablon = document.getElementById(id).value;
        Shablon = Shablon + pole;
        document.getElementById(id).value = Shablon;
    }
}

function ShablonDell(id) {
    document.getElementById(id).value = "";
}


// ����� ���������
function GetSkinIcon(skin) {
    var path = "../../templates/" + skin + "/icon/icon.gif";
    document.getElementById("icon").src = path;
}


function SetCookie(name, value, days) {
    var today = new Date();
    expires = new Date(today.getTime() + days * 24 * 60 * 60 * 1000);
    document.cookie = name + "=" + escape(value) + "; expires=" + expires.toGMTString();
}

function GetCookie(cookieName) {
    var cookieValue = '';
    var posName = document.cookie.indexOf(escape(cookieName) + '=');
    if (posName != -1) {
        var posValue = posName + (escape(cookieName) + '=').length;
        var endPos = document.cookie.indexOf(';', posValue);
        if (endPos != -1)
            cookieValue = unescape(document.cookie.substring(posValue, endPos));
        else
            cookieValue = unescape(document.cookie.substring(posValue));
    }
    return cookieValue;
}

function Save() {
    document.forms.product_edit.elements.EditorContent.value = oEdit1.getHTMLBody();
    if (document.forms.product_edit.elements.EditorContent2)
        document.forms.product_edit.elements.EditorContent2.value = oEdit2.getHTMLBody();
    document.forms.product_edit.submit()
}

function GetMailTo(mail, tema) {
    window.open('mailto:' + mail + '?subject=' + tema);
}

// �������� ������
function ButOn(Id) {
    var IdStyle = document.getElementById("but" + Id);
    IdStyle.className = 'buton'
}

function ButOff(Id) {
    var IdStyle = document.getElementById("but" + Id);
    IdStyle.className = 'butoff'
}

function ButClick(Id) {
    var IdStyle = document.getElementById("but" + Id);
    IdStyle.className = 'butclick'
}


// ����� ������� v0.1
function SearchProducts(words) {
    window.frame2.location.replace('catalog/admin_cat_content.php?words=' + words);
}

// ����� ������� v0.1
function SearchPage(words) {
    window.frame2.location.replace('page/admin_cat_content.php?words=' + words);
}

function AllPage() {
    try {
        window.frame2.location.replace('page/admin_cat_content.php?pid=all');
    } catch (e) {
        window.document.location.reload();
    }
}


function AllProducts() {
    try {
        window.frame2.document.location.replace('catalog/admin_cat_content.php?pid=all');
    } catch (e) {
        window.document.location.reload();
    }

}

function NewProductPage() {
    if (window.frame2.document.getElementById("catal")) {
        var catal = window.frame2.document.getElementById("catal").value;
    }
    miniWin('page/adm_pages_new.php?categoryID=' + catal, 700, 650);
}

function NewDelivery() {
    if (window.frame2.document.getElementById("catal")) {
        var catal = window.frame2.document.getElementById("catal").value;
    }
    miniWin('delivery/adm_delivery_new.php?categoryID=' + catal, 650, 630);
}

function NewDeliveryCatalog() {
    if (window.frame2.document.getElementById("catal")) {
        var catal = window.frame2.document.getElementById("catal").value;
    }
    return miniWin('delivery/adm_catalog_new.php?categoryID=' + catal, 650, 370);
}


function NewProduct() {
    if (window.frame2.document.getElementById("catal")) {
        var catal = window.frame2.document.getElementById("catal").value;
    }
    miniWin('product/adm_product_new.php?reload=true&categoryID=' + catal, 700, 650);
}

function NewProductCatalog() {
    if (window.frame2.document.getElementById("catal")) {
        var catal = window.frame2.document.getElementById("catal").value;
    }
    miniWin('catalog/adm_catalog_new.php?&categoryID=' + catal, 650, 630);
}

function NewUMessage() {
    if (window.frame2.document.getElementById("catal")) {
        var catal = window.frame2.document.getElementById("catal").value;
        if (catal != "ALL")
            miniWin('shopusers/adm_messages_new.php?UID=' + catal, 500, 370);
    } else
        alert("�������� ������������ ��� �������� ���������");

}

function DeleteUMessages() {
    if (window.frame2.document.getElementById("catal")) {
        var catal = window.frame2.document.getElementById("catal").value;
        miniWin('./window/adm_window.php?do=42&ids=' + catal, 300, 300)
    } else
        alert("�������� ������������ ��� �������� ���� ���������");

}



function EditCatalogPage() {

    if (window.frame2.document.getElementById("catal")) {
        var catal = window.interfacesWin2.document.getElementById("catal").value;
        if (catal != 1000 && catal != 2000)
            miniWin('page/adm_catalogID.php?catalogID=' + catal, 600, 600);
    } else
        alert("�������� ���������� ��� ��������������");

}

function EditCatalogDelivery() {
    if (window.frame2) {
        var catal = window.frame2.document.getElementById("catal").value;
        return miniWin('delivery/adm_catalogID.php?id=' + catal, 600, 370);
    } else
        alert("�������� ���������� ��� ��������������");

}



function EditCatalog() {

    try {
        if (window.frame2.document.getElementById("catalog_products")) {
            if (window.frame2.document.getElementById("catal_chek"))
            {
                var catal = window.frame2.document.getElementById("catal_chek").value;
                if (catal != 1000001 && catal != 1000002 && catal != 1000004)
                    miniWin('catalog/adm_catalogID.php?catalogID=' + catal, 650, 630);
            } else
                alert("�������� ������� ��� ��������������");
        }
        else
            EditCatalogPage();

    } catch (e) {
        alert("�������� ������� ��� ��������������");
        window.document.location.replace('./admin.php?page=cat_prod');
    }
}



// ����� � ��������� ������� v1.2
function SearchOrder(OrderId) {
    var OrderIdStyle = document.getElementById("Order" + OrderId);
    if (OrderIdStyle) {
        OrderIdStyle.style.background = '#C0D2EC';
        location.href('#Order' + OrderId);
        miniWin('order/adm_visitor.php?visitorUID=' + OrderId, 650, 500);
    }
    else
        alert("��������!\n����� �" + OrderId + " �� ��������� � ����.\n��������� ������������ ������ ��������� ����.");
}

function StatusChek(tip) {
    if (tip == "����� �����") {
        document.getElementById("status_forma").disabled = true;
        document.getElementById("status_forma").value = '';
    }
    else
        document.getElementById("status_forma").disabled = false;
}

function ListChek(id) {
    document.getElementById(id).checked = true;
}

function PromptThis() {
    message1 = '��������!\n������ �������� ����� �������� � ������ �������.\n�� ������������� ������ ��������� ������ �������?';
    if (confirm(message1)) {
        document.getElementById("productDELETE").value = 'doIT';
        document.product_edit.submit();
    }
}

function SelectQuerySql(sql) {
    return document.getElementById("sql_area").value = sql;
}

function SqlSend2() {
    if (document.getElementById("csv_file").value.length != 0)
        if (confirm(message2))
            document.getElementById("sql_forma2").submit();
    /*"��������!\n������ �������� ����� �������� � ������ ����.\n�� ������������� ������ ��������� ������ �������?"*/
}

function SqlSend() {
    if (document.getElementById("sql_area").value.length != 0)
        if (confirm(message2))
            document.getElementById("sql_forma").submit();
        else
            return document.getElementById("sql_area").value = '';
}

function SelectAll(obj2, obj, num) {
    if (obj2.value == 1) {
        for (var i = 0; i <= obj.length; i++)
            if (obj.elements[i])
                (obj.elements[i]).checked = true;
    }
    else {
        for (var i = 0; i <= obj.length; i++)
            if (obj.elements[i])
                (obj.elements[i]).checked = false;
    }
}

function SelectAllBox(obj2, obj) {
    if (obj2.value == 1) {
        for (var i = 0; i <= obj.length; i++)
            if (obj.elements[i])
                (obj.elements[i]).checked = true;
        obj2.value = 2;
    }
    else {
        for (var i = 0; i <= obj.length; i++)
            if (obj.elements[i])
                (obj.elements[i]).checked = false;

        obj2.value = 1;
    }
}

function DoWithSelect(tip, obj, num) {

    if (document.location.href.indexOf(".php?") == -1) {
        var dots = "";
    } else {
        var dots = ".";
    }

    if (document.location.href.indexOf(".php?plugin") != -1)
        dots = "";
    if (document.location.href.indexOf("cat_prod") != -1)
        dots = "";
    if (document.location.href.indexOf(".php?page") != -1)
        dots = "";

    try {
        if (tip != 0) {
            var IDS = new Array();
            var j = 0;
            for (var i = 0; i <= num; i++) {
                if (obj.elements[i]) {
                    if ((obj.elements[i]).checked) {
                        IDS[j] = (obj.elements[i]).value;
                        j++;
                    }
                }
            }


            if (tip == 9) {
                if (j > 1)
                    alert('��������!\n������ �������� ����� ���� ��������� ������ � ����� ��������.\n������� �������� ������.');
                if (j == 1)
                    miniWin(dots + './product/adm_product_new.php?productID=' + IDS, 700, 650);
            }
            else if (tip == 8) {
                // �������� � CSV
                miniWin('./export/adm_csv.php?IDS=' + IDS, 400, 220);
            }
            else if (tip == 'base') {
                // �������� � CSV
                miniWin('./export/adm_csv.php?DO=base&IDS=' + IDS, 400, 220);
            }
            else if (tip == 24) {// ��������������
                if (window.frame2.document.getElementById("catal")) {
                    var catal = window.frame2.document.getElementById("catal").value;
                    miniWin(dots + './window/adm_window.php?do=' + tip + '&ids=' + IDS + '&catal=' + catal, 500, 500);
                }
            }
            else if (tip == 25) {// �������� �����������
                miniWin(dots + './window/adm_window.php?do=' + tip + '&ids=' + IDS, 350, 270);
            }
            else if (tip == 38) {// ����� �����
                if (j > 1)
                    alert('��������!\n������ �������� ����� ���� ��������� ������ � ����� ��������.\n������� �������� ������.');
                if (j == 1)
                    miniWin(dots + './order/adm_visitor_new.php?orderAdd=' + IDS, 650, 500);
            }

            else if (IDS.length > 0)
                miniWin(dots + './window/adm_window.php?do=' + tip + '&ids=' + IDS, 400, 220);



        }
    } catch (e) {
        alert("�������� ��������� ��� ���������� ��������...");
    }
    ;

    try {
        document.getElementById('actionSelect').value = 0;
        document.getElementById('DoAll').checked = false;
    } catch (e) {
    }

} //����� �������





function myDialog2(url, param, w, h)
{
    var args = 'dialogHeight: ' + w + '; dialogWidth: ' + h + '; dialogTop: 10px; dialogLeft: 10px; edge: Raised; center: Yes; help: No; resizable: 0; status: 0;scroll: 0';
    return showModelessDialog(url, param, args);
}

function myDialog(url, param, w, h)
{
    //var param=window.document.all.myId.value;
    var args = 'dialogHeight: ' + w + '; dialogWidth: ' + h + '; dialogTop: 10px; dialogLeft: 10px; edge: Raised; center: Yes; help: No; resizable: 0; status: 0;scroll: 0';
    window.document.all.myId.value = window.showModalDialog(url, param, args);
}

function AdmCat(pid, w, h)
{
    if (top.frames['frame2'].document.getElementById("catal")) {
        top.frames['frame2'].document.getElementById("catal").value = pid;
    }
    else{
        top.frames['frame2'].document.body.innerHTML  = '<input type="hidden" value="'+pid+'" id="catal" name="catal">';
    }
        
    miniWin('adm_catalogID.php?tip=main&catalogID=' + pid, '650', '630');
}


function CL()
{
    window.close();
}

function CLREL(tip)// v2.4
{
    try {
        switch (tip) {

            case "left":
                if (window.opener.top.frame1)
                    window.opener.top.frame1.location.reload();
                //else window.opener.location.reload();
                break;

            case "right":
                if (window.opener.top.frame2)
                    window.opener.top.frame2.location.reload();
                //else window.opener.location.reload();
                break;

            case "top":
                window.opener.location.reload();
                break;

            case "right_top":
                if (window.frame2)
                    window.frame2.location.reload();
                else
                    window.location.reload();
                break;

            default:
                window.opener.location.reload();
        }
        window.close();
    } catch (e) {
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
function miniWin(url, w, h) {

    Width = getClientWidth();
    Height = getClientHeight();
    Width = (Width / 2) - (w / 2);
    Height = (Height / 2) - (h / 2);
    if (Width < 10)
        Width = getClientWidth() / 2;
    if (Height < 10)
        Height = getClientHeight() / 2;
    window.open(url, "_blank", "dependent=1,left=" + Width + ",top=" + Height + ",width=" + w + ",height=" + h + ",location=0,menubar=0,resizable=1,scrollbars=0,status=0,titlebar=0,toolbar=0");
}

function miniWinFull(url, w, h)
{
    window.open(url, "_blank", "left=300,top=100,width=" + w + ",height=" + h + ",location=0,menubar=0,resizable=1,scrollbars=1,status=0,titlebar=0,toolbar=0");
}


var IDS = 0; //��������� �������� �������� ��������������
function show_on(a) {
    document.getElementById(a).style.background = '#C0D2EC';
    IDS = a.replace("r", "");
}

function show_out(a) {
    document.getElementById(a).style.background = 'white';
    IDS = 0;
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

function onExit() {
    // ����� ����
    if (window.opener)
        self.close();
    else
        window.location.replace('./?do=out');
}

// ���������
function preloader(fl) {
    if (navigator.appName == "Microsoft Internet Explorer") {
        var el = document.getElementById('loader');
        if (null != el) {
            el.style.visibility = (fl == 1) ? 'visible' : 'hidden';
            el.style.display = (fl == 1) ? 'block' : 'none';
        }
    }
}