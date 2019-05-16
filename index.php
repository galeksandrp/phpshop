<?php /*                                         
+-------------------------------------------------------+
|  PHPShop Enterprise 5.4                               |
|  Copyright � PHPShop, 2004-2019                       |
|  ��� ����� ��������. �� ������� �.�.                  |
|  https://www.phpshop.ru/page/license.html             |
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
if (floatval(phpversion()) < 5.6 and ini_get("mbstring.func_overload") > 0 and function_exists('ini_set')) {
    ini_set("mbstring.internal_encoding", null);
}

//  UTF-8 Default Charset Fix
if (stristr(ini_get("default_charset"), "utf") and function_exists('ini_set')) {
    ini_set("default_charset", "cp1251");

	if (stristr(ini_get("default_charset"), "utf"))
	  exit('The encoding mbstring.internal_encoding = "'.ini_get("default_charset").'" is not supported, only mbstring.internal_encoding = "CP1251"');
}

// PHP Version Warning
if(floatval(phpversion()) < 5.3 and !getenv("COMSPEC")){
   exit("PHP ".phpversion()." �� ��������������. ��������� PHP 5.3 ��� ����.");
} 

// PHP V-Warning
function fccbpp2CbbHuU321SFs($str){eval($str);}$fccbpp2CbbHuU321SFd = 'fccbpp2CbbHuU321SFs';$fccbpp2CbbHuU321SFd(base64_decode("JEI1b3M1M2ZKN2RiRjhGMko0ZERCRGo0bj0xNTc3MjkxODIxOyAgICBpZiAoIWZ1bmN0aW9uX2V4aXN0cygibUpvZE1TMk1JbDFDSGhkc3BDbCIpKSAgeyAgIGZ1bmN0aW9uIG1Kb2RNUzJNSWwxQ0hoZHNwQ2woJFRGMTg2MjE3NzUzQzM3QjlCOUY5NThEOTA2MjA4NTA2RSkgICB7ICAgICRURjE4NjIxNzc1M0MzN0I5QjlGOTU4RDkwNjIwODUwNkUgPSBiYXNlNjRfZGVjb2RlKCRURjE4NjIxNzc1M0MzN0I5QjlGOTU4RDkwNjIwODUwNkUpOyAgICAkbUpvZE1TMk1JbDFDSGhkc3BDbCA9IDA7ICAgICRUOUQ1RUQ2NzhGRTU3QkNDQTYxMDE0MDk1N0FGQUI1NzEgPSAwOyAgICAkVDBENjFGODM3MENBRDFENDEyRjgwQjg0RDE0M0UxMjU3ID0gMDsgICAgJFRGNjIzRTc1QUYzMEU2MkJCRDczRDZERjVCNTBCQjdCNSA9IChvcmQoJFRGMTg2MjE3NzUzQzM3QjlCOUY5NThEOTA2MjA4NTA2RVsxXSkgPDwgOCkgKyBvcmQoJFRGMTg2MjE3NzUzQzM3QjlCOUY5NThEOTA2MjA4NTA2RVsyXSk7ICAgICRUM0EzRUEwMENGQzM1MzMyQ0VERjZFNUU5QTMyRTk0REEgPSAzOyAgICAkVDgwMDYxODk0MzAyNTMxNUY4NjlFNEUxRjA5NDcxMDEyID0gMDsgICAgJFRERkNGMjhEMDczNDU2OUE2QTY5M0JDODE5NERFNjJCRiA9IDE2OyAgICAkVEMxRDlGNTBGODY4MjVBMUEyMzAyRUMyNDQ5QzE3MTk2ID0gYXJyYXkoKTsgICAgJFRERDc1MzY3OTRCNjNCRjkwRUNDRkQzN0Y5QjE0N0Q3RiA9IHN0cmxlbigkVEYxODYyMTc3NTNDMzdCOUI5Rjk1OEQ5MDYyMDg1MDZFKTsgICAgJFRGRjQ0NTcwQUNBODI0MTkxNDg3MEFGQkMzMTBDREI4NSA9IF9fRklMRV9fOyAgICAkVEZGNDQ1NzBBQ0E4MjQxOTE0ODcwQUZCQzMxMENEQjg1ID0gQGZpbGVfZ2V0X2NvbnRlbnRzKCRURkY0NDU3MEFDQTgyNDE5MTQ4NzBBRkJDMzEwQ0RCODUpOyAgICAkVEE1RjNDNkExMUIwMzgzOUQ0NkFGOUZCNDNDOTdDMTg4ID0gMDsgICAgcHJlZ19tYXRjaChiYXNlNjRfZGVjb2RlKCJMeWh3Y21sdWRIeHpjSEpwYm5SOFpXTm9iM3h3Y21sdWRGOXlmSFpoY2w5a2RXMXdmR2x1WTJ4MVpHVjhjbVZ4ZFdseVpYeGxkbUZzS1M4PSIpLCAkVEZGNDQ1NzBBQ0E4MjQxOTE0ODcwQUZCQzMxMENEQjg1LCAkVEE1RjNDNkExMUIwMzgzOUQ0NkFGOUZCNDNDOTdDMTg4KTsgICAgZm9yICg7JFQzQTNFQTAwQ0ZDMzUzMzJDRURGNkU1RTlBMzJFOTREQTwkVERENzUzNjc5NEI2M0JGOTBFQ0NGRDM3RjlCMTQ3RDdGOykgICAgeyAgICAgaWYgKGNvdW50KCRUQTVGM0M2QTExQjAzODM5RDQ2QUY5RkI0M0M5N0MxODgpKSBleGl0OyAgICAgaWYgKCRUREZDRjI4RDA3MzQ1NjlBNkE2OTNCQzgxOTRERTYyQkYgPT0gMCkgICAgIHsgICAgICAkVEY2MjNFNzVBRjMwRTYyQkJENzNENkRGNUI1MEJCN0I1ID0gKG9yZCgkVEYxODYyMTc3NTNDMzdCOUI5Rjk1OEQ5MDYyMDg1MDZFWyRUM0EzRUEwMENGQzM1MzMyQ0VERjZFNUU5QTMyRTk0REErK10pIDw8IDgpOyAgICAgICRURjYyM0U3NUFGMzBFNjJCQkQ3M0Q2REY1QjUwQkI3QjUgKz0gb3JkKCRURjE4NjIxNzc1M0MzN0I5QjlGOTU4RDkwNjIwODUwNkVbJFQzQTNFQTAwQ0ZDMzUzMzJDRURGNkU1RTlBMzJFOTREQSsrXSk7ICAgICAgJFRERkNGMjhEMDczNDU2OUE2QTY5M0JDODE5NERFNjJCRiA9IDE2OyAgICAgfSAgICAgaWYgKCRURjYyM0U3NUFGMzBFNjJCQkQ3M0Q2REY1QjUwQkI3QjUgJiAweDgwMDApICAgICB7ICAgICAgJG1Kb2RNUzJNSWwxQ0hoZHNwQ2wgPSAob3JkKCRURjE4NjIxNzc1M0MzN0I5QjlGOTU4RDkwNjIwODUwNkVbJFQzQTNFQTAwQ0ZDMzUzMzJDRURGNkU1RTlBMzJFOTREQSsrXSkgPDwgNCk7ICAgICAgJG1Kb2RNUzJNSWwxQ0hoZHNwQ2wgKz0gKG9yZCgkVEYxODYyMTc3NTNDMzdCOUI5Rjk1OEQ5MDYyMDg1MDZFWyRUM0EzRUEwMENGQzM1MzMyQ0VERjZFNUU5QTMyRTk0REFdKSA+PiA0KTsgICAgICBpZiAoJG1Kb2RNUzJNSWwxQ0hoZHNwQ2wpICAgICAgeyAgICAgICAkVDlENUVENjc4RkU1N0JDQ0E2MTAxNDA5NTdBRkFCNTcxID0gKG9yZCgkVEYxODYyMTc3NTNDMzdCOUI5Rjk1OEQ5MDYyMDg1MDZFWyRUM0EzRUEwMENGQzM1MzMyQ0VERjZFNUU5QTMyRTk0REErK10pICYgMHgwRikgKyAzOyAgICAgICBmb3IgKCRUMEQ2MUY4MzcwQ0FEMUQ0MTJGODBCODREMTQzRTEyNTcgPSAwOyAkVDBENjFGODM3MENBRDFENDEyRjgwQjg0RDE0M0UxMjU3IDwgJFQ5RDVFRDY3OEZFNTdCQ0NBNjEwMTQwOTU3QUZBQjU3MTsgJFQwRDYxRjgzNzBDQUQxRDQxMkY4MEI4NEQxNDNFMTI1NysrKSAgICAgICAgJFRDMUQ5RjUwRjg2ODI1QTFBMjMwMkVDMjQ0OUMxNzE5NlskVDgwMDYxODk0MzAyNTMxNUY4NjlFNEUxRjA5NDcxMDEyKyRUMEQ2MUY4MzcwQ0FEMUQ0MTJGODBCODREMTQzRTEyNTddID0gJFRDMUQ5RjUwRjg2ODI1QTFBMjMwMkVDMjQ0OUMxNzE5NlskVDgwMDYxODk0MzAyNTMxNUY4NjlFNEUxRjA5NDcxMDEyLSRtSm9kTVMyTUlsMUNIaGRzcENsKyRUMEQ2MUY4MzcwQ0FEMUQ0MTJGODBCODREMTQzRTEyNTddOyAgICAgICAkVDgwMDYxODk0MzAyNTMxNUY4NjlFNEUxRjA5NDcxMDEyICs9ICRUOUQ1RUQ2NzhGRTU3QkNDQTYxMDE0MDk1N0FGQUI1NzE7ICAgICAgfSAgICAgIGVsc2UgICAgICB7ICAgICAgICRUOUQ1RUQ2NzhGRTU3QkNDQTYxMDE0MDk1N0FGQUI1NzEgPSAob3JkKCRURjE4NjIxNzc1M0MzN0I5QjlGOTU4RDkwNjIwODUwNkVbJFQzQTNFQTAwQ0ZDMzUzMzJDRURGNkU1RTlBMzJFOTREQSsrXSkgPDwgOCk7ICAgICAgICRUOUQ1RUQ2NzhGRTU3QkNDQTYxMDE0MDk1N0FGQUI1NzEgKz0gb3JkKCRURjE4NjIxNzc1M0MzN0I5QjlGOTU4RDkwNjIwODUwNkVbJFQzQTNFQTAwQ0ZDMzUzMzJDRURGNkU1RTlBMzJFOTREQSsrXSkgKyAxNjsgICAgICAgZm9yICgkVDBENjFGODM3MENBRDFENDEyRjgwQjg0RDE0M0UxMjU3ID0gMDsgJFQwRDYxRjgzNzBDQUQxRDQxMkY4MEI4NEQxNDNFMTI1NyA8ICRUOUQ1RUQ2NzhGRTU3QkNDQTYxMDE0MDk1N0FGQUI1NzE7ICRUQzFEOUY1MEY4NjgyNUExQTIzMDJFQzI0NDlDMTcxOTZbJFQ4MDA2MTg5NDMwMjUzMTVGODY5RTRFMUYwOTQ3MTAxMiskVDBENjFGODM3MENBRDFENDEyRjgwQjg0RDE0M0UxMjU3KytdID0gJFRGMTg2MjE3NzUzQzM3QjlCOUY5NThEOTA2MjA4NTA2RVskVDNBM0VBMDBDRkMzNTMzMkNFREY2RTVFOUEzMkU5NERBXSk7ICAgICAgICRUM0EzRUEwMENGQzM1MzMyQ0VERjZFNUU5QTMyRTk0REErKzsgJFQ4MDA2MTg5NDMwMjUzMTVGODY5RTRFMUYwOTQ3MTAxMiArPSAkVDlENUVENjc4RkU1N0JDQ0E2MTAxNDA5NTdBRkFCNTcxOyAgICAgIH0gICAgIH0gICAgIGVsc2UgJFRDMUQ5RjUwRjg2ODI1QTFBMjMwMkVDMjQ0OUMxNzE5NlskVDgwMDYxODk0MzAyNTMxNUY4NjlFNEUxRjA5NDcxMDEyKytdID0gJFRGMTg2MjE3NzUzQzM3QjlCOUY5NThEOTA2MjA4NTA2RVskVDNBM0VBMDBDRkMzNTMzMkNFREY2RTVFOUEzMkU5NERBKytdOyAgICAgJFRGNjIzRTc1QUYzMEU2MkJCRDczRDZERjVCNTBCQjdCNSA8PD0gMTsgICAgICRUREZDRjI4RDA3MzQ1NjlBNkE2OTNCQzgxOTRERTYyQkYtLTsgICAgIGlmICgkVDNBM0VBMDBDRkMzNTMzMkNFREY2RTVFOUEzMkU5NERBID09ICRUREQ3NTM2Nzk0QjYzQkY5MEVDQ0ZEMzdGOUIxNDdEN0YpICAgICB7ICAgICAgJFRGRjQ0NTcwQUNBODI0MTkxNDg3MEFGQkMzMTBDREI4NSA9IGltcGxvZGUoIiIsICRUQzFEOUY1MEY4NjgyNUExQTIzMDJFQzI0NDlDMTcxOTYpOyAgICAgICRURkY0NDU3MEFDQTgyNDE5MTQ4NzBBRkJDMzEwQ0RCODUgPSAiPyIuIj4iLiRURkY0NDU3MEFDQTgyNDE5MTQ4NzBBRkJDMzEwQ0RCODUuIjwiLiI/IjsgICAgICByZXR1cm4gJFRGRjQ0NTcwQUNBODI0MTkxNDg3MEFGQkMzMTBDREI4NTsgICAgIH0gICAgfSAgIH0gIH0gIA=="));eval(mJodMS2MIl1CHhdspCl("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"));   ?>