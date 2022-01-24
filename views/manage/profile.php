<?php include ROOT . '/views/layouts/header.php';?>
<?php include ROOT . '/views/layouts/navbar.php';?>

<!---------------------------------------------- User Profile --------------------------------------------->
<div class="container pt-5">
    <div class="main-body">
        <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img <?php if($user['img_b64'] != null) echo 'src="data:image/jpeg;base64,' . $user['img_b64'] . '"'?> class="img-thumbnail" name="img_userimg_profile" width="300" height="200"/>
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
                            <h6 class="mb-0">Первый вход в систему:</h6>
                            <span class="text-secondary"><?php echo date("Y-m-d H:i:s", $user['firstaccess']);?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0">Последний вход в систему:</h6>
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
                                <?php echo $user['lastname']; ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Имя</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?php echo $user['firstname']; ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Отчетсво</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?php echo $user['patronymic']; ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Должность</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?php
                                if (!empty($user['subs'])) {
                                    $subscount = count($user['subs']) - 1;
                                    foreach ($user['subs'] AS $sub) {
                                        if ($session->userid === $sub['parentid']) {
                                            echo $sub['postname'];
                                        }
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Email</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?php echo $user['email']; ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Телефон</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?php echo $user['phone']; ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Логин</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <?php echo $user['login']; ?>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Пароль</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                <input type="password" class="border-0" value="<?php echo $user['password']; ?>" id="inputpass_profile" name="inputpass_profile" readonly>
                                <div class="custom-control custom-checkbox custom-control-inline">&nbsp
                                    <input type="checkbox" class="custom-control-input" id="chkshowpass_profile" name="chkshowpass_profile">
                                    <label for="chkshowpass_profile" class="custom-control-label text-sm float-right">Показать пароль</label>
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
                                        <div class="col-sm-9 text-secondary">' .
                                            $user['role']
                                        . '</div>
                                    </div>';
                        };

                        if ((!empty($user['subs'])) && ($_SESSION['user']->admin === true)) {
                            echo '<hr>';
                            foreach ($user['subs'] AS $sub) {
                                echo ' <div class="row">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Специальность</h6>
                                            </div>
                                            <div class="col-sm-3 text-secondary">' .
                                                $sub['postname'] .
                                          ' </div>  
                                             <div class="col-sm-3">
                                                <h6 class="mb-0">Руководитель</h6>
                                            </div>  
                                            <div class="col-sm-3">' .
                                                $sub['parentfullname'] .
                                          ' </div>                              
                                        </div>
                                        
                                        <br>
                                        
                                        
                                        ';
                            }
                        };
                        ?>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12">
                                <a class="btn btn-info " href="/faceid/manage/profile/edit/<?php echo $user['id']; ?>/">Править</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include ROOT . '/views/layouts/footer.php';?>