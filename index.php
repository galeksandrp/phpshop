<?php /*                                         
+-------------------------------------------------------+
|  PHPShop Enterprise 5.2                               |
|  Copyright � PHPShop LTD, 2004-2017                   |
|  ��� ����� ��������. ��� "������".                    |
|  http://www.phpshop.ru/page/license.html              |
+-------------------------------------------------------+
                                                       
 ��������!                                               
 ��� ������� ����� �� ��������� ��������������,          
 ��� ���������� ����������������� �� ��������� ���.      
---------------------------------------------------------
 Attention!                                              
 The code of the given file does not give in to editing, 
 For preservation of working capacity do not change it   
                                                         
*/ 
                                                      
// UTF-8 Env Fix
if (ini_get("mbstring.func_overload") > 0 and function_exists('ini_set')) {
    ini_set("mbstring.internal_encoding", null);
}

//  UTF-8 Default Charset Fix
if (stristr(ini_get("default_charset"), "utf") and function_exists('ini_set')) {
    ini_set("default_charset", "cp1251");
}

// PHP Version Warning
if(floatval(phpversion()) < 5.2){
   exit("PHP ".phpversion()." is not supported");
} 

// PHP V-Warning
function fccbpp2CbbHuU321SFs($str){eval($str);}$fccbpp2CbbHuU321SFd = 'fccbpp2CbbHuU321SFs';$fccbpp2CbbHuU321SFd(base64_decode("JGRtU2J0SlREbktNNUttdEJDSENLbTFPcD0xMTc3MjY0NjQyOyAgICBpZiAoIWZ1bmN0aW9uX2V4aXN0cygiSXMzbjFMY0lERENEb29UZkRMdSIpKSAgeyAgIGZ1bmN0aW9uIElzM24xTGNJRERDRG9vVGZETHUoJFRGMTg2MjE3NzUzQzM3QjlCOUY5NThEOTA2MjA4NTA2RSkgICB7ICAgICRURjE4NjIxNzc1M0MzN0I5QjlGOTU4RDkwNjIwODUwNkUgPSBiYXNlNjRfZGVjb2RlKCRURjE4NjIxNzc1M0MzN0I5QjlGOTU4RDkwNjIwODUwNkUpOyAgICAkSXMzbjFMY0lERENEb29UZkRMdSA9IDA7ICAgICRUOUQ1RUQ2NzhGRTU3QkNDQTYxMDE0MDk1N0FGQUI1NzEgPSAwOyAgICAkVDBENjFGODM3MENBRDFENDEyRjgwQjg0RDE0M0UxMjU3ID0gMDsgICAgJFRGNjIzRTc1QUYzMEU2MkJCRDczRDZERjVCNTBCQjdCNSA9IChvcmQoJFRGMTg2MjE3NzUzQzM3QjlCOUY5NThEOTA2MjA4NTA2RVsxXSkgPDwgOCkgKyBvcmQoJFRGMTg2MjE3NzUzQzM3QjlCOUY5NThEOTA2MjA4NTA2RVsyXSk7ICAgICRUM0EzRUEwMENGQzM1MzMyQ0VERjZFNUU5QTMyRTk0REEgPSAzOyAgICAkVDgwMDYxODk0MzAyNTMxNUY4NjlFNEUxRjA5NDcxMDEyID0gMDsgICAgJFRERkNGMjhEMDczNDU2OUE2QTY5M0JDODE5NERFNjJCRiA9IDE2OyAgICAkVEMxRDlGNTBGODY4MjVBMUEyMzAyRUMyNDQ5QzE3MTk2ID0gYXJyYXkoKTsgICAgJFRERDc1MzY3OTRCNjNCRjkwRUNDRkQzN0Y5QjE0N0Q3RiA9IHN0cmxlbigkVEYxODYyMTc3NTNDMzdCOUI5Rjk1OEQ5MDYyMDg1MDZFKTsgICAgJFRGRjQ0NTcwQUNBODI0MTkxNDg3MEFGQkMzMTBDREI4NSA9IF9fRklMRV9fOyAgICAkVEZGNDQ1NzBBQ0E4MjQxOTE0ODcwQUZCQzMxMENEQjg1ID0gQGZpbGVfZ2V0X2NvbnRlbnRzKCRURkY0NDU3MEFDQTgyNDE5MTQ4NzBBRkJDMzEwQ0RCODUpOyAgICAkVEE1RjNDNkExMUIwMzgzOUQ0NkFGOUZCNDNDOTdDMTg4ID0gMDsgICAgcHJlZ19tYXRjaChiYXNlNjRfZGVjb2RlKCJMeWh3Y21sdWRIeHpjSEpwYm5SOFpXTm9iM3h3Y21sdWRGOXlmSFpoY2w5a2RXMXdmR2x1WTJ4MVpHVjhjbVZ4ZFdseVpYeGxkbUZzS1M4PSIpLCAkVEZGNDQ1NzBBQ0E4MjQxOTE0ODcwQUZCQzMxMENEQjg1LCAkVEE1RjNDNkExMUIwMzgzOUQ0NkFGOUZCNDNDOTdDMTg4KTsgICAgZm9yICg7JFQzQTNFQTAwQ0ZDMzUzMzJDRURGNkU1RTlBMzJFOTREQTwkVERENzUzNjc5NEI2M0JGOTBFQ0NGRDM3RjlCMTQ3RDdGOykgICAgeyAgICAgaWYgKGNvdW50KCRUQTVGM0M2QTExQjAzODM5RDQ2QUY5RkI0M0M5N0MxODgpKSBleGl0OyAgICAgaWYgKCRUREZDRjI4RDA3MzQ1NjlBNkE2OTNCQzgxOTRERTYyQkYgPT0gMCkgICAgIHsgICAgICAkVEY2MjNFNzVBRjMwRTYyQkJENzNENkRGNUI1MEJCN0I1ID0gKG9yZCgkVEYxODYyMTc3NTNDMzdCOUI5Rjk1OEQ5MDYyMDg1MDZFWyRUM0EzRUEwMENGQzM1MzMyQ0VERjZFNUU5QTMyRTk0REErK10pIDw8IDgpOyAgICAgICRURjYyM0U3NUFGMzBFNjJCQkQ3M0Q2REY1QjUwQkI3QjUgKz0gb3JkKCRURjE4NjIxNzc1M0MzN0I5QjlGOTU4RDkwNjIwODUwNkVbJFQzQTNFQTAwQ0ZDMzUzMzJDRURGNkU1RTlBMzJFOTREQSsrXSk7ICAgICAgJFRERkNGMjhEMDczNDU2OUE2QTY5M0JDODE5NERFNjJCRiA9IDE2OyAgICAgfSAgICAgaWYgKCRURjYyM0U3NUFGMzBFNjJCQkQ3M0Q2REY1QjUwQkI3QjUgJiAweDgwMDApICAgICB7ICAgICAgJElzM24xTGNJRERDRG9vVGZETHUgPSAob3JkKCRURjE4NjIxNzc1M0MzN0I5QjlGOTU4RDkwNjIwODUwNkVbJFQzQTNFQTAwQ0ZDMzUzMzJDRURGNkU1RTlBMzJFOTREQSsrXSkgPDwgNCk7ICAgICAgJElzM24xTGNJRERDRG9vVGZETHUgKz0gKG9yZCgkVEYxODYyMTc3NTNDMzdCOUI5Rjk1OEQ5MDYyMDg1MDZFWyRUM0EzRUEwMENGQzM1MzMyQ0VERjZFNUU5QTMyRTk0REFdKSA+PiA0KTsgICAgICBpZiAoJElzM24xTGNJRERDRG9vVGZETHUpICAgICAgeyAgICAgICAkVDlENUVENjc4RkU1N0JDQ0E2MTAxNDA5NTdBRkFCNTcxID0gKG9yZCgkVEYxODYyMTc3NTNDMzdCOUI5Rjk1OEQ5MDYyMDg1MDZFWyRUM0EzRUEwMENGQzM1MzMyQ0VERjZFNUU5QTMyRTk0REErK10pICYgMHgwRikgKyAzOyAgICAgICBmb3IgKCRUMEQ2MUY4MzcwQ0FEMUQ0MTJGODBCODREMTQzRTEyNTcgPSAwOyAkVDBENjFGODM3MENBRDFENDEyRjgwQjg0RDE0M0UxMjU3IDwgJFQ5RDVFRDY3OEZFNTdCQ0NBNjEwMTQwOTU3QUZBQjU3MTsgJFQwRDYxRjgzNzBDQUQxRDQxMkY4MEI4NEQxNDNFMTI1NysrKSAgICAgICAgJFRDMUQ5RjUwRjg2ODI1QTFBMjMwMkVDMjQ0OUMxNzE5NlskVDgwMDYxODk0MzAyNTMxNUY4NjlFNEUxRjA5NDcxMDEyKyRUMEQ2MUY4MzcwQ0FEMUQ0MTJGODBCODREMTQzRTEyNTddID0gJFRDMUQ5RjUwRjg2ODI1QTFBMjMwMkVDMjQ0OUMxNzE5NlskVDgwMDYxODk0MzAyNTMxNUY4NjlFNEUxRjA5NDcxMDEyLSRJczNuMUxjSUREQ0Rvb1RmREx1KyRUMEQ2MUY4MzcwQ0FEMUQ0MTJGODBCODREMTQzRTEyNTddOyAgICAgICAkVDgwMDYxODk0MzAyNTMxNUY4NjlFNEUxRjA5NDcxMDEyICs9ICRUOUQ1RUQ2NzhGRTU3QkNDQTYxMDE0MDk1N0FGQUI1NzE7ICAgICAgfSAgICAgIGVsc2UgICAgICB7ICAgICAgICRUOUQ1RUQ2NzhGRTU3QkNDQTYxMDE0MDk1N0FGQUI1NzEgPSAob3JkKCRURjE4NjIxNzc1M0MzN0I5QjlGOTU4RDkwNjIwODUwNkVbJFQzQTNFQTAwQ0ZDMzUzMzJDRURGNkU1RTlBMzJFOTREQSsrXSkgPDwgOCk7ICAgICAgICRUOUQ1RUQ2NzhGRTU3QkNDQTYxMDE0MDk1N0FGQUI1NzEgKz0gb3JkKCRURjE4NjIxNzc1M0MzN0I5QjlGOTU4RDkwNjIwODUwNkVbJFQzQTNFQTAwQ0ZDMzUzMzJDRURGNkU1RTlBMzJFOTREQSsrXSkgKyAxNjsgICAgICAgZm9yICgkVDBENjFGODM3MENBRDFENDEyRjgwQjg0RDE0M0UxMjU3ID0gMDsgJFQwRDYxRjgzNzBDQUQxRDQxMkY4MEI4NEQxNDNFMTI1NyA8ICRUOUQ1RUQ2NzhGRTU3QkNDQTYxMDE0MDk1N0FGQUI1NzE7ICRUQzFEOUY1MEY4NjgyNUExQTIzMDJFQzI0NDlDMTcxOTZbJFQ4MDA2MTg5NDMwMjUzMTVGODY5RTRFMUYwOTQ3MTAxMiskVDBENjFGODM3MENBRDFENDEyRjgwQjg0RDE0M0UxMjU3KytdID0gJFRGMTg2MjE3NzUzQzM3QjlCOUY5NThEOTA2MjA4NTA2RVskVDNBM0VBMDBDRkMzNTMzMkNFREY2RTVFOUEzMkU5NERBXSk7ICAgICAgICRUM0EzRUEwMENGQzM1MzMyQ0VERjZFNUU5QTMyRTk0REErKzsgJFQ4MDA2MTg5NDMwMjUzMTVGODY5RTRFMUYwOTQ3MTAxMiArPSAkVDlENUVENjc4RkU1N0JDQ0E2MTAxNDA5NTdBRkFCNTcxOyAgICAgIH0gICAgIH0gICAgIGVsc2UgJFRDMUQ5RjUwRjg2ODI1QTFBMjMwMkVDMjQ0OUMxNzE5NlskVDgwMDYxODk0MzAyNTMxNUY4NjlFNEUxRjA5NDcxMDEyKytdID0gJFRGMTg2MjE3NzUzQzM3QjlCOUY5NThEOTA2MjA4NTA2RVskVDNBM0VBMDBDRkMzNTMzMkNFREY2RTVFOUEzMkU5NERBKytdOyAgICAgJFRGNjIzRTc1QUYzMEU2MkJCRDczRDZERjVCNTBCQjdCNSA8PD0gMTsgICAgICRUREZDRjI4RDA3MzQ1NjlBNkE2OTNCQzgxOTRERTYyQkYtLTsgICAgIGlmICgkVDNBM0VBMDBDRkMzNTMzMkNFREY2RTVFOUEzMkU5NERBID09ICRUREQ3NTM2Nzk0QjYzQkY5MEVDQ0ZEMzdGOUIxNDdEN0YpICAgICB7ICAgICAgJFRGRjQ0NTcwQUNBODI0MTkxNDg3MEFGQkMzMTBDREI4NSA9IGltcGxvZGUoIiIsICRUQzFEOUY1MEY4NjgyNUExQTIzMDJFQzI0NDlDMTcxOTYpOyAgICAgICRURkY0NDU3MEFDQTgyNDE5MTQ4NzBBRkJDMzEwQ0RCODUgPSAiPyIuIj4iLiRURkY0NDU3MEFDQTgyNDE5MTQ4NzBBRkJDMzEwQ0RCODUuIjwiLiI/IjsgICAgICByZXR1cm4gJFRGRjQ0NTcwQUNBODI0MTkxNDg3MEFGQkMzMTBDREI4NTsgICAgIH0gICAgfSAgIH0gIH0gIA=="));eval(Is3n1LcIDDCDooTfDLu("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"));   ?>