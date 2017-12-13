/**
 * JS ���������� ������ ������� ������ tab_cart.gui.php
 */


// �������� �����
function DoPrint(path){
    window.open(path,"_blank","dependent=1,left=0,top=0,width=650,height=650,location=1,menubar=1,resizable=1,scrollbars=1,status=1,titlebar=1,toolbar=1");
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
    req.open(null, 'ajax/cart.ajax.php?do=discount', true);
    req.send( {
        xid: xid,
        uid: uid
    } );
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
            req.open(null, 'ajax/cart.ajax.php?do=add', true);
            req.send( {
                xid: xid,
                uid: uid
            } );
        }
    }
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
    req.open(null, 'ajax/cart.ajax.php?do=delivery', true);
    req.send( {
        xid: xid,
        uid: uid
    } );
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
    req.open(null, 'ajax/cart.ajax.php?do=update', true);
    req.send( {
        xid: xid,
        uid: uid,
        name: name,
        num: num,
        price: price
    } );
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
        req.open(null, 'ajax/cart.ajax.php?do=delete', true);
        req.send( {
            xid: xid,
            uid: uid
        } );
    }
}
