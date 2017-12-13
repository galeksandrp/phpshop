<!DOCTYPE html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
    <HEAD>
        <TITLE>PHPShop.Chat Free</TITLE>
        <META http-equiv="Content-Type" content="text-html; charset=windows-1251">
        <LINK href="./templates/skin/@chat_mod_skin@.css" type="text/css" rel="stylesheet">
        <SCRIPT language="JavaScript" type="text/javascript" src="./lib/Subsys/JsHttpRequest/Js.js"></SCRIPT>
        <SCRIPT language="JavaScript" type="text/javascript" src="./ajax/phpshopchat.js"></SCRIPT>
        <SCRIPT src="./lib/soundmanager2/soundmanager2-nodebug-jsmin.js"></SCRIPT>
        <SCRIPT>
            soundManager.setup({
                url: './lib/soundmanager2/',
                debugMode: false,
                onready: function() {
      
                    mySound = soundManager.createSound({
                        id: 'aSound',
                        url: '@chat_mod_sound@'
                    });
                }
            });

        

        </SCRIPT>


    </HEAD>
    <BODY onLoad="PHPShopChat_ping();PHPShopChat_email();">
    <table width="100%" height="100%">
        <tr valign="top" >
            <td height="70%"><b>���������</b>:</td>
            <td height="70%"> <div name="chat_mod_content" id="chat_mod_content">@chat_mod_content@</div>
            </td>
        <tr>
        <tr valign="top" >
            <td height="10%"><b>������</b>:</td>
            <td height="10%">
                <textarea name="chat_mod_user_text" id="chat_mod_user_text" @chat_mod_disable@></textarea>
                <div> 
                    <IMG onmouseover="this.style.cursor='pointer';" title=������� onclick="emoticon(':-D');" alt=������� src="templates/smiley/grin.gif" border=0> 
                    <IMG onmouseover="this.style.cursor='pointer';" title=��������� onclick="emoticon(':)');" alt=��������� src="templates/smiley/smile3.gif" border=0> 
                    <IMG onmouseover="this.style.cursor='pointer';" title=�������� onclick="emoticon(':(');" alt=�������� src="templates/smiley/sad.gif" border=0> 
                    <IMG onmouseover="this.style.cursor='pointer';" title="� ����" onclick="emoticon(':shock:');" alt="� ����" src="templates/smiley/shok.gif" border=0> 
                    <IMG onmouseover="this.style.cursor='pointer';" title=������������� onclick="emoticon(':cool:');" alt=������������� src="templates/smiley/cool.gif" border=0> 
                    <IMG onmouseover="this.style.cursor='pointer';" title=���������� onclick="emoticon(':blush:');" alt=���������� src="templates/smiley/blush2.gif" border=0> 
                    <IMG onmouseover="this.style.cursor='pointer';" title=������� onclick="emoticon(':dance:');" alt=������� src="templates/smiley/dance.gif" border=0> 
                    <IMG onmouseover="this.style.cursor='pointer';" title=�������� onclick="emoticon(':rad:');" alt=�������� src="templates/smiley/happy.gif" border=0> 
                    <IMG onmouseover="this.style.cursor='pointer';" title="��� ������" onclick="emoticon(':lol:');" alt="��� ������" src="templates/smiley/lol.gif" border=0> 
                    <IMG onmouseover="this.style.cursor='pointer';" title="� ��������������" onclick="emoticon(':huh:');" alt="� ��������������" src="templates/smiley/huh.gif" border=0> 
                    <IMG onmouseover="this.style.cursor='pointer';" title=���������� onclick="emoticon(':rolly:');" alt=���������� src="templates/smiley/rolleyes.gif" border=0> 
                    <IMG onmouseover="this.style.cursor='pointer';" title=���� onclick="emoticon(':thuf:');" alt=���� src="templates/smiley/threaten.gif" border=0> 
                    <IMG onmouseover="this.style.cursor='pointer';" title="���������� ����" onclick="emoticon(':tongue:');" alt="���������� ����" src="templates/smiley/tongue.gif" border=0> 
                    <IMG onmouseover="this.style.cursor='pointer';" title=�������� onclick="emoticon(':smart:');" alt=�������� src="templates/smiley/umnik2.gif" border=0> 
                    <IMG onmouseover="this.style.cursor='pointer';" title=��������� onclick="emoticon(':wacko:');" alt=��������� src="templates/smiley/wacko.gif" border=0> 
                </div>
            </td>
        </tr>
        <tr valign="top">
            <td></td>
            <td height="100">
                <div id="help"><img src="./templates/help.png" align="absmiddle" hspace="3">����������� ��������� ������ <b>CTRL + Enter</b> ��� �������� ������</div>
                <div id="exit">
                    <button onclick="PHPShopChat_exit();">
                        <img src="./templates/exit.gif" align="absmiddle" hspace="5">�����
                    </button>
                </div>
                <div id="post">
                    <button onclick="PHPShopChat_write('@chat_mod_disable@');">
                        <img src="./templates/post.gif" align="absmiddle" hspace="5" id="chat_mod_send_button_icon"><span id="chat_mod_send_button_text">���������</span>
                    </button>
                    <input type="hidden"  value="@chat_mod_time@" id="chat_mod_time" name="chat_mod_time">
                </div>

            </td>
        </tr>
    </table>
</BODY>
</HTML>