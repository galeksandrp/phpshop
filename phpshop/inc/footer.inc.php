<?php
/* 
 * ������
*/

// �������� ������
if($PHPShopNav->notPath('print')){
$PHPShopModules->setHookHandler('footer','footer');
}else echo '</div>';


echo '
  </body>
</html>';
?>
