// ���������� ���������� �������
function visualCart(xid) {
    if (document.getElementById('visualcart')) {

        // �������� ���� ���������� ������ � �������
        var cart_update = VisualCartGetCookie('cart_update_time');

        if (cart_update > 0 || xid > 0) {
            var req = new Subsys_JsHttpRequest_Js();

            req.onreadystatechange = function() {
                if (req.readyState == 4) {
                    if (req.responseJS) {

                        // �.�. ����� ���� ��������� ���������, ��������� ����� ����
                        var els = document.getElementsByClassName('visualcart');
                        // ����� ����� ����� ����������� �� ���� ��������� � �����
                        for (var i = 0; i < els.length; ++i) {
                            var el = els[i];
                            el.innerHTML = (req.responseJS.visualcart || '');
                        }
                        
                        if (req.responseJS.num == 0)
                            document.getElementById('visualcart_order').style.display = 'none';
                        else if (document.getElementById('visualcart_order') || req.responseJS.visualcart != '')
                            document.getElementById('visualcart_order').style.display = 'block';

                        // ������������� ��������
                        if (xid > 0 && document.getElementById('visualcart_order')) {
                            document.getElementById('num').innerHTML = (req.responseJS.num || '');
                            document.getElementById('sum').innerHTML = (req.responseJS.sum || '');
                        }

                    }
                }
            }
            req.caching = false;
            // �������������� ������.
            // �������� ����������
            var dir = dirPath();
            req.open('POST', dir + '/phpshop/modules/visualcart/ajax/visualcart.php', true);
            req.send({
                xid: xid
            });
        }
    }
}


function VisualCartGetCookie(cookieName) {
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

// �������� ����� ������� ����� ���������� �������
setInterval("visualCart(0)", 3000);

