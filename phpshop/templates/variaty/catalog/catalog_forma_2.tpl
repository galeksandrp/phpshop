<div id="divCatId@catalogId@" class="divCat_off">
  <table class="tableCat">
    <tbody>
      <tr>
        <td class="tdCatHeader"><div class="divCatTitle" id="titCat@catalogId@" onClick="catTiTFonClick('/shop/CID_@catalogId@.html');" onMouseOut="catTiTOut('contCat@catalogId@','contCat@catalogId@','titCat@catalogId@');" onMouseOver="catTiTOver('contCat@catalogId@','contCat@catalogId@');catTiTFonOver('titCat@catalogId@','titCat@catalogId@');">
            <table >
              <tr>
                <td width="4" class="m_act11"></td>
                <td class="m_act33" >@catalogName@</td>
                <td width="4" class="m_act22"></td>
              </tr>
            </table>
          </div></td>
      </tr>
      <tr>
        <td class="tdCatContent"><div class="divCatCont_off" id="contCat@catalogId@" onMouseOut="podCatTiTOut('contCat@catalogId@','contCat@catalogId@','titCat@catalogId@');" onMouseOver="podCatTiTOver('contCat@catalogId@','contCat@catalogId@','titCat@catalogId@');">
          <div class="drop" >
            <div class="drop1">&nbsp;</div>
            <div class="drop2">
              <ul>
                @catalogPodcatalog@
              </ul>
            </div>
            <div class="drop3"></div>
          </div></td>
      </tr>
    </tbody>
  </table>
</div>
