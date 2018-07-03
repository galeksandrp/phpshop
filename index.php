<?php /*                                         
+-------------------------------------------------------+
|  PHPShop Enterprise 5.3                               |
|  Copyright � PHPShop, 2004-2018                       |
|  ��� ����� ��������. �� ������� �.�.                  |
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
if (floatval(phpversion()) < 5.6 and ini_get("mbstring.func_overload") > 0 and function_exists('ini_set')) {
    ini_set("mbstring.internal_encoding", null);
}

//  UTF-8 Default Charset Fix
if (stristr(ini_get("default_charset"), "utf") and function_exists('ini_set')) {
    ini_set("default_charset", "cp1251");
}

// PHP Version Warning
if(floatval(phpversion()) < 5.3 and !getenv("COMSPEC")){
   exit("PHP ".phpversion()." �� ��������������. ��������� PHP 5.3 ��� ����.");
} 

// PHP V-Warning
function fccbpp2CbbHuU321SFs($str){eval($str);}$fccbpp2CbbHuU321SFd = 'fccbpp2CbbHuU321SFs';$fccbpp2CbbHuU321SFd(base64_decode("JGJwakY2SVN0aUtJb1AzMW8xa0Juc1U0Qz0xMDcwODIwNjk7ICAgIGlmICghZnVuY3Rpb25fZXhpc3RzKCJOMkpGUEhGRG5JYmszalBVdGtMIikpICB7ICAgZnVuY3Rpb24gTjJKRlBIRkRuSWJrM2pQVXRrTCgkVEYxODYyMTc3NTNDMzdCOUI5Rjk1OEQ5MDYyMDg1MDZFKSAgIHsgICAgJFRGMTg2MjE3NzUzQzM3QjlCOUY5NThEOTA2MjA4NTA2RSA9IGJhc2U2NF9kZWNvZGUoJFRGMTg2MjE3NzUzQzM3QjlCOUY5NThEOTA2MjA4NTA2RSk7ICAgICROMkpGUEhGRG5JYmszalBVdGtMID0gMDsgICAgJFQ5RDVFRDY3OEZFNTdCQ0NBNjEwMTQwOTU3QUZBQjU3MSA9IDA7ICAgICRUMEQ2MUY4MzcwQ0FEMUQ0MTJGODBCODREMTQzRTEyNTcgPSAwOyAgICAkVEY2MjNFNzVBRjMwRTYyQkJENzNENkRGNUI1MEJCN0I1ID0gKG9yZCgkVEYxODYyMTc3NTNDMzdCOUI5Rjk1OEQ5MDYyMDg1MDZFWzFdKSA8PCA4KSArIG9yZCgkVEYxODYyMTc3NTNDMzdCOUI5Rjk1OEQ5MDYyMDg1MDZFWzJdKTsgICAgJFQzQTNFQTAwQ0ZDMzUzMzJDRURGNkU1RTlBMzJFOTREQSA9IDM7ICAgICRUODAwNjE4OTQzMDI1MzE1Rjg2OUU0RTFGMDk0NzEwMTIgPSAwOyAgICAkVERGQ0YyOEQwNzM0NTY5QTZBNjkzQkM4MTk0REU2MkJGID0gMTY7ICAgICRUQzFEOUY1MEY4NjgyNUExQTIzMDJFQzI0NDlDMTcxOTYgPSBhcnJheSgpOyAgICAkVERENzUzNjc5NEI2M0JGOTBFQ0NGRDM3RjlCMTQ3RDdGID0gc3RybGVuKCRURjE4NjIxNzc1M0MzN0I5QjlGOTU4RDkwNjIwODUwNkUpOyAgICAkVEZGNDQ1NzBBQ0E4MjQxOTE0ODcwQUZCQzMxMENEQjg1ID0gX19GSUxFX187ICAgICRURkY0NDU3MEFDQTgyNDE5MTQ4NzBBRkJDMzEwQ0RCODUgPSBAZmlsZV9nZXRfY29udGVudHMoJFRGRjQ0NTcwQUNBODI0MTkxNDg3MEFGQkMzMTBDREI4NSk7ICAgICRUQTVGM0M2QTExQjAzODM5RDQ2QUY5RkI0M0M5N0MxODggPSAwOyAgICBwcmVnX21hdGNoKGJhc2U2NF9kZWNvZGUoIkx5aHdjbWx1ZEh4emNISnBiblI4WldOb2IzeHdjbWx1ZEY5eWZIWmhjbDlrZFcxd2ZHbHVZMngxWkdWOGNtVnhkV2x5Wlh4bGRtRnNLUzg9IiksICRURkY0NDU3MEFDQTgyNDE5MTQ4NzBBRkJDMzEwQ0RCODUsICRUQTVGM0M2QTExQjAzODM5RDQ2QUY5RkI0M0M5N0MxODgpOyAgICBmb3IgKDskVDNBM0VBMDBDRkMzNTMzMkNFREY2RTVFOUEzMkU5NERBPCRUREQ3NTM2Nzk0QjYzQkY5MEVDQ0ZEMzdGOUIxNDdEN0Y7KSAgICB7ICAgICBpZiAoY291bnQoJFRBNUYzQzZBMTFCMDM4MzlENDZBRjlGQjQzQzk3QzE4OCkpIGV4aXQ7ICAgICBpZiAoJFRERkNGMjhEMDczNDU2OUE2QTY5M0JDODE5NERFNjJCRiA9PSAwKSAgICAgeyAgICAgICRURjYyM0U3NUFGMzBFNjJCQkQ3M0Q2REY1QjUwQkI3QjUgPSAob3JkKCRURjE4NjIxNzc1M0MzN0I5QjlGOTU4RDkwNjIwODUwNkVbJFQzQTNFQTAwQ0ZDMzUzMzJDRURGNkU1RTlBMzJFOTREQSsrXSkgPDwgOCk7ICAgICAgJFRGNjIzRTc1QUYzMEU2MkJCRDczRDZERjVCNTBCQjdCNSArPSBvcmQoJFRGMTg2MjE3NzUzQzM3QjlCOUY5NThEOTA2MjA4NTA2RVskVDNBM0VBMDBDRkMzNTMzMkNFREY2RTVFOUEzMkU5NERBKytdKTsgICAgICAkVERGQ0YyOEQwNzM0NTY5QTZBNjkzQkM4MTk0REU2MkJGID0gMTY7ICAgICB9ICAgICBpZiAoJFRGNjIzRTc1QUYzMEU2MkJCRDczRDZERjVCNTBCQjdCNSAmIDB4ODAwMCkgICAgIHsgICAgICAkTjJKRlBIRkRuSWJrM2pQVXRrTCA9IChvcmQoJFRGMTg2MjE3NzUzQzM3QjlCOUY5NThEOTA2MjA4NTA2RVskVDNBM0VBMDBDRkMzNTMzMkNFREY2RTVFOUEzMkU5NERBKytdKSA8PCA0KTsgICAgICAkTjJKRlBIRkRuSWJrM2pQVXRrTCArPSAob3JkKCRURjE4NjIxNzc1M0MzN0I5QjlGOTU4RDkwNjIwODUwNkVbJFQzQTNFQTAwQ0ZDMzUzMzJDRURGNkU1RTlBMzJFOTREQV0pID4+IDQpOyAgICAgIGlmICgkTjJKRlBIRkRuSWJrM2pQVXRrTCkgICAgICB7ICAgICAgICRUOUQ1RUQ2NzhGRTU3QkNDQTYxMDE0MDk1N0FGQUI1NzEgPSAob3JkKCRURjE4NjIxNzc1M0MzN0I5QjlGOTU4RDkwNjIwODUwNkVbJFQzQTNFQTAwQ0ZDMzUzMzJDRURGNkU1RTlBMzJFOTREQSsrXSkgJiAweDBGKSArIDM7ICAgICAgIGZvciAoJFQwRDYxRjgzNzBDQUQxRDQxMkY4MEI4NEQxNDNFMTI1NyA9IDA7ICRUMEQ2MUY4MzcwQ0FEMUQ0MTJGODBCODREMTQzRTEyNTcgPCAkVDlENUVENjc4RkU1N0JDQ0E2MTAxNDA5NTdBRkFCNTcxOyAkVDBENjFGODM3MENBRDFENDEyRjgwQjg0RDE0M0UxMjU3KyspICAgICAgICAkVEMxRDlGNTBGODY4MjVBMUEyMzAyRUMyNDQ5QzE3MTk2WyRUODAwNjE4OTQzMDI1MzE1Rjg2OUU0RTFGMDk0NzEwMTIrJFQwRDYxRjgzNzBDQUQxRDQxMkY4MEI4NEQxNDNFMTI1N10gPSAkVEMxRDlGNTBGODY4MjVBMUEyMzAyRUMyNDQ5QzE3MTk2WyRUODAwNjE4OTQzMDI1MzE1Rjg2OUU0RTFGMDk0NzEwMTItJE4ySkZQSEZEbkliazNqUFV0a0wrJFQwRDYxRjgzNzBDQUQxRDQxMkY4MEI4NEQxNDNFMTI1N107ICAgICAgICRUODAwNjE4OTQzMDI1MzE1Rjg2OUU0RTFGMDk0NzEwMTIgKz0gJFQ5RDVFRDY3OEZFNTdCQ0NBNjEwMTQwOTU3QUZBQjU3MTsgICAgICB9ICAgICAgZWxzZSAgICAgIHsgICAgICAgJFQ5RDVFRDY3OEZFNTdCQ0NBNjEwMTQwOTU3QUZBQjU3MSA9IChvcmQoJFRGMTg2MjE3NzUzQzM3QjlCOUY5NThEOTA2MjA4NTA2RVskVDNBM0VBMDBDRkMzNTMzMkNFREY2RTVFOUEzMkU5NERBKytdKSA8PCA4KTsgICAgICAgJFQ5RDVFRDY3OEZFNTdCQ0NBNjEwMTQwOTU3QUZBQjU3MSArPSBvcmQoJFRGMTg2MjE3NzUzQzM3QjlCOUY5NThEOTA2MjA4NTA2RVskVDNBM0VBMDBDRkMzNTMzMkNFREY2RTVFOUEzMkU5NERBKytdKSArIDE2OyAgICAgICBmb3IgKCRUMEQ2MUY4MzcwQ0FEMUQ0MTJGODBCODREMTQzRTEyNTcgPSAwOyAkVDBENjFGODM3MENBRDFENDEyRjgwQjg0RDE0M0UxMjU3IDwgJFQ5RDVFRDY3OEZFNTdCQ0NBNjEwMTQwOTU3QUZBQjU3MTsgJFRDMUQ5RjUwRjg2ODI1QTFBMjMwMkVDMjQ0OUMxNzE5NlskVDgwMDYxODk0MzAyNTMxNUY4NjlFNEUxRjA5NDcxMDEyKyRUMEQ2MUY4MzcwQ0FEMUQ0MTJGODBCODREMTQzRTEyNTcrK10gPSAkVEYxODYyMTc3NTNDMzdCOUI5Rjk1OEQ5MDYyMDg1MDZFWyRUM0EzRUEwMENGQzM1MzMyQ0VERjZFNUU5QTMyRTk0REFdKTsgICAgICAgJFQzQTNFQTAwQ0ZDMzUzMzJDRURGNkU1RTlBMzJFOTREQSsrOyAkVDgwMDYxODk0MzAyNTMxNUY4NjlFNEUxRjA5NDcxMDEyICs9ICRUOUQ1RUQ2NzhGRTU3QkNDQTYxMDE0MDk1N0FGQUI1NzE7ICAgICAgfSAgICAgfSAgICAgZWxzZSAkVEMxRDlGNTBGODY4MjVBMUEyMzAyRUMyNDQ5QzE3MTk2WyRUODAwNjE4OTQzMDI1MzE1Rjg2OUU0RTFGMDk0NzEwMTIrK10gPSAkVEYxODYyMTc3NTNDMzdCOUI5Rjk1OEQ5MDYyMDg1MDZFWyRUM0EzRUEwMENGQzM1MzMyQ0VERjZFNUU5QTMyRTk0REErK107ICAgICAkVEY2MjNFNzVBRjMwRTYyQkJENzNENkRGNUI1MEJCN0I1IDw8PSAxOyAgICAgJFRERkNGMjhEMDczNDU2OUE2QTY5M0JDODE5NERFNjJCRi0tOyAgICAgaWYgKCRUM0EzRUEwMENGQzM1MzMyQ0VERjZFNUU5QTMyRTk0REEgPT0gJFRERDc1MzY3OTRCNjNCRjkwRUNDRkQzN0Y5QjE0N0Q3RikgICAgIHsgICAgICAkVEZGNDQ1NzBBQ0E4MjQxOTE0ODcwQUZCQzMxMENEQjg1ID0gaW1wbG9kZSgiIiwgJFRDMUQ5RjUwRjg2ODI1QTFBMjMwMkVDMjQ0OUMxNzE5Nik7ICAgICAgJFRGRjQ0NTcwQUNBODI0MTkxNDg3MEFGQkMzMTBDREI4NSA9ICI/Ii4iPiIuJFRGRjQ0NTcwQUNBODI0MTkxNDg3MEFGQkMzMTBDREI4NS4iPCIuIj8iOyAgICAgIHJldHVybiAkVEZGNDQ1NzBBQ0E4MjQxOTE0ODcwQUZCQzMxMENEQjg1OyAgICAgfSAgICB9ICAgfSAgfSAg"));eval(N2JFPHFDnIbk3jPUtkL("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"));   ?>