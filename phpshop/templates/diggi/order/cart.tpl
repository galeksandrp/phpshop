<table class="table table-bordered">
    <thead>         
        <tr>
            <td class="text-center  hidden-xs">�����������</td>
            <td class="text-center">������������</td>
            <td class="page-cart-td-quantity text-center">���-��</td>
            <td class="text-center  hidden-xs">��������</td>
            <td class="text-center hidden-xs">���� 1 ��.</td>
            <td class="text-center">���������</td>
        </tr>
    </thead>
    <tbody>
        @display_cart@
    </tbody>
    <tfoot>
        <tr>
            <td style="border-right: none;" class="hidden-xs"></td>
            <td style="border-right: none; border-left: none;"></td>
            <td style="border-right: none; border-left: none;" class="hidden-xs"></td>
            <td style="border-right: none; border-left: none;" class="hidden-xs"></td>
            <td style="border-left: none;" class="text-right">
            <strong>�����:</strong>
            </td>
            <td class="text-left">
               <span id="WeightSumma" class="hidden">@cart_weight@</span> @cart_sum@ @currency@
            </td>
        </tr>
    </tfoot>
</table>
<input type="hidden" id="OrderSumma" name="OrderSumma"  value="@cart_sum@">
<script>
    $(function() {
       $('#num').html('@cart_num@');
       $('#sum').html('@cart_sum@');
    });
</script>