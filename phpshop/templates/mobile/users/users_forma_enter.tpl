<div id="setUser@user_active@" class="modal">
            <header class="bar bar-nav">
                <a class="icon icon-close pull-right" href="#setUser@user_active@" onclick="modal_off(this.hash)"></a>
                <h1 class="title">���� ��������</h1>
            </header>

            <div class="content">
                <div class="content-padded">
                    <div class="card">
                        <ul class="table-view">
                            <li class="table-view-divider">�����</li>
                            <li class="table-view-cell">@UsersLogin@</li>
                            <li class="table-view-divider">������</li>
                            <li class="table-view-cell">@UsersStatusName@</li>
                            <li class="table-view-divider">������</li>
                            <li class="table-view-cell">@UsersStatusDiscount@</li>
                        </ul>

                    </div>
                    <button class="btn btn-positive btn-block" onclick="window.location.replace('?logout=true')" ontouchstart="window.location.replace('?logout=true')">�����</button>
                </div>
            </div>
        </div>