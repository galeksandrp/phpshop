<?php

/*
 * ������
 */

// �������� ������
if ($PHPShopNav->notPath('print')) {
    $PHPShopModules->setHookHandler('footer', 'footer');
}


// ���������
$PHPShopAnalitica->counter();

echo '
    </div>
  </body>
</html>';
?>