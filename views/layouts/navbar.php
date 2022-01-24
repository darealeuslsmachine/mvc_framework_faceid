<nav class="col-md-2 d-none d-md-block bg-light sidebar">
    <div class="sidebar-sticky">
        <ul class="nav flex-column">
            <?php
                if ($_SESSION['user']->admin === true) {
                    echo '<li class="nav-item">
                        <a class="nav-link" href="/faceid/admin" id="header_left_nav_users">
                            <i class="fa fa-users" aria-hidden="true"></i>
                            <span data-feather="home"></span>
                            Пользователи
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/faceid/admin/adduser" id="header_left_nav_addusers">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                            <span data-feather="adduser"></span>
                            Добавить пользователя
                        </a>
                    </li>
                     <li class="nav-item">
                            <a class="nav-link" href="/faceid/admin/settings" id="header_left_nav_addusers">
                                <i class="fa fa-users-cog" aria-hidden="true"></i>
                                <span data-feather="adduser"></span>
                                Администрирование
                            </a>
                     </li>';
                } else {
                    echo '<li class="nav-item">
                        <a class="nav-link" href="/faceid/manage" id="header_left_nav_users">
                            <i class="fa fa-users" aria-hidden="true"></i>
                            <span data-feather="home"></span>
                            Пользователи
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/faceid/manage/adduser" id="header_left_nav_addusers">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                            <span data-feather="adduser"></span>
                            Добавить пользователя
                        </a>
                    </li>';
                };
            ?>
        </ul>
    </div>
</nav>