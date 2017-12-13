<!DOCTYPE html>
<html>
    <head>
        <meta charset="windows-1251">
        <title>@pageTitl@</title>
        <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <link href="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@/ratchetcss/ratchet.css" rel="stylesheet">
        <link href="@pageCss@" rel="stylesheet">
        @fix_css@
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@/ratchet/js/ratchet.js"></script>
        <script src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin']; php@/pc.js"></script>
    </head>
    <body>
        <header class="bar bar-nav">
            <h1 class="title">@tel@</h1>
        </header>
        <nav class="bar bar-tab">
            <a class="tab-item active" href="/">
                <span class="icon icon-home"></span>
                <span class="tab-label">�����</span>
            </a>
            <a class="tab-item @user_active@" href="#setUser@user_active@" onclick="modal_on(this.hash)">
                <span class="icon icon-person"></span>
                <span class="tab-label">�������</span>
            </a>
            <a class="tab-item @cart_active@" href="/order/" onclick="go(this.href)">
                <span class="icon icon-download"></span> @cart_active_num@
                <span class="tab-label">�������</span>
            </a>
            <a class="tab-item @search_active@" href="#setSearch" onclick="modal_on(this.hash)">
                <span class="icon icon-search"></span>
                <span class="tab-label">�����</span>
            </a>
            <a class="tab-item" href="#setOption" onclick="modal_on(this.hash)">
                <span class="icon icon-gear"></span>
                <span class="tab-label">���������</span>
            </a>
        </nav>
        <div class="content">
            <p class="content-padded">@descrip@</p>
            <div class="card">
                <ul class="table-view">
                    <li class="table-view-divider">�������</li>
                    @leftCatal@
                    <li class="table-view-divider">���������</li>
                    @topMenu@
                    @pageCatal@
                    <li class="table-view-cell">
                        <a class="push-right" href="/news/" onclick="go(this.href)">
                            <strong>�������</strong>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        @usersDisp@

        <div id="setRetunCall" class="modal">
            <header class="bar bar-nav">
                <a class="icon icon-close pull-right" href="#setRetunCall" onclick="modal_off(this.hash)"></a>
                <h1 class="title">�������� ������</h1>
            </header>

            <div class="content">
                <div class="content-padded">
                    <form method="post" name="forma_search" action="/returncall/">
                        <p>
                            <input placeholder="���" name="returncall_mod_name" type="text" required>
                            <input placeholder="�������" type="text" name="returncall_mod_tel" required>
                            <textarea placeholder="���������" name="returncall_mod_message"></textarea>
                            <input type="hidden" name="returncall_mod_send" value="send">
                            <input type="hidden" name="key" value="off">
                        </p>
                        <button class="btn btn-positive btn-block"><span class="icon icon-sound"></span> ����������� ���</button>
                    </form>
                </div>
            </div>
        </div>

        <div id="setSearch" class="modal">
            <header class="bar bar-nav">
                <a class="icon icon-close pull-right" href="#setSearch" onclick="modal_off(this.hash)"></a>
                <h1 class="title">�����</h1>
            </header>

            <div class="content">
                <div class="content-padded">
                    <form method="post" name="forma_search" action="/search/">
                        <p>
                            <input placeholder="����� �������" name="words" type="search" required value="@searchString@">
                            <input type="hidden" value="2" name="pole">
                        </p>
                        <button class="btn btn-positive btn-block"><span class="icon icon-search"></span> ������</button>
                    </form>
                </div>
            </div>
        </div>

        <div id="setOption" class="modal">
            <header class="bar bar-nav">
                <a class="icon icon-close pull-right" href="#setOption" onclick="modal_off(this.hash)"></a>
                <h1 class="title">���������</h1>
            </header>

            <div class="content">
                <ul class="table-view">
                    <li class="table-view-divider"><span class="icon icon-person"></span> ������������</li>
                    <li class="table-view-cell">
                        <a class="navigate-right" href="#" onclick="window.location.reload(true)" ontouchstart="window.location.reload(true)">
                            �������� ��������
                        </a>
                    </li>
                    <li class="table-view-cell">
                        <a class="navigate-right" href="?logout=true" onclick="go(this.href)">
                            �����
                        </a>
                    </li>
                    <li class="table-view-cell">
                        <a class="navigate-right" href="?fullversion=true" onclick="go(this.href)">
                            ������ ������
                        </a>
                    </li>
                    <li class="table-view-divider"><span class="icon icon-info"></span> � ���������</li>
                    <li class="table-view-cell">
                        <p>PHPShop @version@ </p>
                    </li>
                </ul>

            </div>
        </div>
        <div class="copyright">