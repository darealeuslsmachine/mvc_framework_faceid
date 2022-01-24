<?php include ROOT . '/views/layouts/header.php';?>
<?php include ROOT . '/views/layouts/navbar.php';?>




<!---------------------------------------------- Edit User Profile --------------------------------------------->
<div class="container pt-5">
    <div class="main-body">
        <form action="#" enctype="multipart/form-data" method="POST">
            <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img <?php if($user['img_b64'] != null) echo 'src="data:image/jpeg;base64,' . $user['img_b64'] . '"'?> id="preview" class="img-thumbnail" width="300" height="200"/>
                                <div class="custom-file mt-3">
                                    <input type="file" class="file custom-file-input" name="input_userimg_edit" accept="image/*" id="input_userimg_edit">
                                    <label class="custom-file-label" for="input_userimg_edit">Выберите файл...</label>
                                    <div class="invalid-feedback">Загрузите корректное фото</div>
                                </div>
                                <div class="mt-3">
                                    <h4><?php echo $user['lastname'] . ' ' . $user['firstname']; ?></h4>
                                    <p class="text-secondary mb-1"><?php echo $user['role']; ?></p>
                                    <p class="text-muted font-size-sm"><?php echo $user['country']?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>Первый вход в систему:</h6>
                                <span class="text-secondary"><?php echo date("Y-m-d H:i:s", $user['firstaccess']);?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                <h6 class="mb-0"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>Последний вход в систему:</h6>
                                <span class="text-secondary"><?php echo date("Y-m-d H:i:s", $user['lastaccess']);?></span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Фамилия</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" value="<?php echo $user['lastname']; ?>" id="input_lastname_edit" name="input_lastname_edit">
                                    <input type="hidden" value="<?php echo $user['id'];?>" id="inputhidden_userid">
                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Имя</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" value="<?php echo $user['firstname']; ?>" id="input_firstname_edit" name="input_firstname_edit">
                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Отчество</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" value="<?php echo $user['patronymic']; ?>" id="input_patronymic_edit" name="input_patronymic_edit">
                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Должность</h6>
                                </div>
                                <div class="col-sm-9 text-secondary" id="div_postedit_manage">
                                    <select class="custom-select select-post-show" id="input_post_edit" name="input_post_edit" required>
                                        <?php
                                        if (!empty($user['subs'])) {
                                            $subscount = count($user['subs']) - 1;
                                            foreach ($user['subs'] AS $sub) {
                                                if ($session->userid === $sub['parentid']) {
                                                    echo '<option value="' . $sub['postid'] . '" selected hidden>' . $sub['postname'] . '</option>';
                                                }
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" value="<?php echo $user['email']; ?>" id="input_email_edit" name="input_email_edit">
                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Телефон</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="tel" value="<?php echo $user['phone']; ?>" id="input_phone_edit" name="input_phone_edit">
                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Логин</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" value="<?php echo $user['login']; ?>" id="input_login_edit" name="input_login_edit">
                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Пароль</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="password" value="<?php echo $user['password']; ?>" id="input_pass_edit" name="input_pass_edit">
                                    <div class="custom-control custom-checkbox custom-control-inline">&nbsp
                                        <input type="checkbox" class="custom-control-input" id="chk_showpass_edit" name="chk_showpass_edit">
                                        <label for="chk_showpass_edit" class="custom-control-label text-sm float-right">Показать пароль</label>
                                    </div>
                                </div>
                            </div>

                            <?php
                            if ($_SESSION['user']->admin === true) {
                            echo '<hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Роль</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <select name="select_role_edit" id="select_role_edit" class="custom-select">
                                            <option id="selected_option_role_edit" value="' . $user['roleid'] . '" selected hidden>' . $user['role'] . '</option>';

                                            foreach ($systemrole as $role) {
                                                echo '<option id="adminoption" value="' . $role['id'] . '">' . $role['name'] . '</option>';
                                            };

                                        echo '</select>
                                    </div>
                                </div>';
                            }; ?>

                            <hr>

                            <div class="row">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-info" name="edituser_save">Сохранить</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <?php
        if (($user['roleid'] == 3) && ($_SESSION['user']->admin === true)) {
            include ROOT . '/views/user/subordinations.php';
        }
        ?>

    </div>
</div>

<!---------------------------------------------- User Profile --------------------------------------------->

<?php include ROOT . '/views/layouts/footer.php';?>