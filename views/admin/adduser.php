<?php include ROOT . '/views/layouts/header.php';?>
<?php include ROOT . '/views/layouts/navbar.php';?>


    <main role="main" class="col-md-9 col-lg-10 px-5 d-flex">
                <div class="ml-2 col-sm-12 flex-wrap flex-md-nowrap pb-2 mb-3 pt-3 border-bottom">
                    <div class="border-bottom pt-2 text-center">
                        <H5>Заполните необходимую информацию о пользователе</H5>
                    </div>
                    <form class="was-validated pt-3" action="#" enctype="multipart/form-data" method="POST">
                        <div class="row">
                            <!------------------------------ Upload photo--------------------------------->
                            <!--<input type="file" name="img[]" class="file custom-file-input" accept="image/*" required>
                            <div class="input-group my-3">
                                <input type="text" class="form-control" disabled placeholder="Загрузите фотографию" id="file">
                                <div class="input-group-append">
                                    <button type="button" class="browse btn btn-primary">Выбрать...</button>
                                </div>
                            </div>-->
                            <div class="col my-5">
                                <div class="center col-sm-9 my-2">
                                    <img src="/faceid/style/img/emptyavatar.png" id="preview" class="img-thumbnail">
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="file custom-file-input" name="adduser_img" accept="image/*" id="validatedCustomFile">
                                    <label class="custom-file-label" for="validatedCustomFile">Выберите файл...</label>
                                    <div class="invalid-feedback">Загрузите корректное фото</div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-user"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="Имя" type="text" id="adduser_firstname" name="adduser_firstname"  required>
                                </div>
                                <div class="form-group input-group">
                                    <input class="form-control ml-5" placeholder="Фамилия" type="text" id="adduser_lastname" name="adduser_lastname" required>
                                </div>
                                <div class="form-group input-group ml-6">
                                    <input class="form-control" placeholder="Отчество" type="text" id="adduser_patronymic" name="adduser_patronymic">
                                </div>
                                <div class="form-group input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-building"></i> </span>
                                    </div>
                                        <select class="form-control custom-select" name="adduser_role" required>
                                            <option value="" selected disabled hidden>Выберите роль</option>
                                            <option value="1">Администратор</option>
                                            <option value="2">Подрядчик</option>
                                            <option value="">Сотрудник</option>
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
                                        <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                                    </div>
                                    <input class="form-control" placeholder="Почта" type="email" id="adduser_email" name="adduser_email">
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
                        <div class="row form-group mx-1">
                            <button type="submit" class="btn btn-outline-primary btn-block" name="adduser_create">Создать пользователя</button>
                        </div>
                    </form>
                </div>
        </main>


<?php include ROOT . '/views/layouts/footer.php';?>