<?php include ROOT . '/views/layouts/header.php';?>
<?php include ROOT . '/views/layouts/navbar.php';?>


    <main role="main" class="col-md-9 col-lg-10 d-flex">
        <div class="col-sm-12 flex-wrap flex-md-nowrap pt-3 border-bottom main-body">
            <div class="card">
                <div class="card-body">
                    <div class="border-bottom pt-2 text-center">
                        <H5>Заполните необходимую информацию о пользователе</H5>
                    </div>


                    <form class="was-validated pt-3" action="#" enctype="multipart/form-data" method="POST">
                        <div class="row py-2">
                            <div class="col-md-5">
                                <div class="form-group input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-user"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="Имя" type="text" id="adduser_firstname" name="adduser_firstname"  required>
                                </div>
                                <div class="form-group input-group">
                                    <input class="form-control ml-5" placeholder="Фамилия" type="text" id="adduser_lastname" name="adduser_lastname" required>
                                </div>
                                <div class="form-group input-group">
                                    <input class="form-control ml-5" placeholder="Отчество" type="text" id="adduser_patronymic" name="adduser_patronymic">
                                </div>
                                <div class="form-group input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                                    </div>
                                    <input class="form-control" placeholder="Почта" type="email" id="adduser_email" name="adduser_email">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <img src="/faceid/style/img/emptyavatar.png" id="preview" class="p-2" width="170" height="146">
                                <div class="custom-file my-3">
                                    <input type="file" class="file custom-file-input" name="adduser_img" accept="image/*" id="validatedCustomFile">
                                    <label class="custom-file-label" for="validatedCustomFile">Выбрать</label>
                                    <div class="invalid-feedback">Загрузите корректное фото</div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group input-group" id="div_postedit">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fas fa-briefcase"></i> </span>
                                    </div>
                                    <select class="custom-select select-post-show-manage" id="adduser_post" name="adduser_post" required>
                                        <option value="" selected hidden>Выберите специальность</option>
                                    </select>
                                </div>
                                <div class="form-group input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-user"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="Логин" type="text" name="adduser_login" required>
                                </div>
                                <div class="form-group input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                                    </div>
                                    <input class="form-control" placeholder="Создайте пароль" type="password" name="adduser_password" required>
                                </div>
                                <div class="form-group input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
                                    </div>
                                    <input class="form-control" placeholder="Номер телефона" type="text" value="+7" name="adduser_phone">
                                </div>
                            </div>
                        </div>

                        <!-- Submit-->
                        <hr>
                        <div class="form-group col-md-3 float-right">
                            <button type="submit" class="btn btn-success btn-block" name="adduser_create">Создать пользователя</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>


<?php include ROOT . '/views/layouts/footer.php';?>