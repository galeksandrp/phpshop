<?php

/*
 * ������
 */

// �������� ������
if ($PHPShopNav->notPath('print')) {
    $PHPShopModules->setHookHandler('footer', 'footer');
}
else
    echo '</div>';

// ���������
$PHPShopAnalitica->counter();

echo '
  </body>
</html>';
?>