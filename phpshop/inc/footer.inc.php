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


// ������.�������
if ($GLOBALS['PHPShopSystem']->getSerilizeParam('admoption.metrica_enabled')) {
    $metrica_id = intval($GLOBALS['PHPShopSystem']->getSerilizeParam('admoption.metrica_id'));
    echo '<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter'.$metrica_id.' = new Ya.Metrika({
                    id:'.$metrica_id.',
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/'.$metrica_id.'" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->';
}

echo '
  </body>
</html>';
?>
