<?php
// ���� �����
function TipPayment($payment) {
    $TIP = array(
        "message" => "���������",
        "bank" => "���� � ����",
        "sberbank" => "��������",
        "robox" => "�������� ����� Robox",
        "webmoney" => "Webmoney",
        "interkassa" => "�������� ����� Interkassa",
        "rbs" => "Visa, Mastercard (RBS)",
        "z-payment" => "�������� ����� Z-payment",
        "payonlinesystem" => "Visa, Mastercard (PayOnlineSystem)",
        "modules" => "������ ��������� �������"
    );

    foreach ($TIP as $k => $v)
        if ($k == $payment)
            return $v;
    return "������ " . $payment;
}

// ����� �����
function GetTipPayment($dir) {

    $path = "../../payment/";
    $arr=null;

    if ($dh = @opendir($path)) {

        while (($file = readdir($dh)) !== false) {
            if ($file != "." && $file != "..") {
                if (is_dir($path . $file)) {
                    if ($dir == $file)
                        $s = "selected";
                    else
                        $s = "";
                    $arr[] = array(TipPayment($file), $file, $s);
                }
            }
        }
        closedir($dh);
    }

    $arr[] = array(TipPayment('modules'), 'modules', $dir === 'modules' ? 'selected' : '');

    if (is_array($arr))
        return $arr;
    else
        return null;
}

?>