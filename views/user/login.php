<!DOCTYPE html>
<html lang="ru">

<head>
    <meta name="description" content="Webpage description goes here" />
    <meta charset="utf-8">
    <title>Вход</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="">

    <link rel="stylesheet" href="/faceid/style/css/login.css">

    <!-- Bootstrap 4.4.1 css -->
    <link rel="stylesheet" href="/faceid/style/lib/Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/faceid/style/lib/Bootstrap/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="/faceid/style/lib/Bootstrap/css/bootstrap-reboot.min.css">
</head>

<body>

<div class="container-fluid px-1 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto">
    <div class="card card0 border-0">
        <div class="row d-flex">
            <div class="col-lg-6">
                <div class="card1 pb-5">
                    <div class="row">
                        <img src="/faceid/style/img/zheleznologo.jpg" class="logo ml-5">
                    </div>
                    <div class="row px-3 justify-content-center mt-4 mb-5 border-line"> <img src="/faceid/style/img/loginfactory.png" class="image"> </div>
                </div>
            </div>
                <div class="col-lg-6">
                    <div class="card2 card border-0 px-4 py-5">
                        <br>
                        <br>
                        <form action="#" method="POST">
                            <div class="row px-3">
                                <label class="mb-1">
                                    <h6 class="mb-0 text-sm">Логин</h6>
                                </label>
                                <input class="mb-4" type="text" name="login" placeholder="Введите корректный логин">
                            </div>
                            <div class="row px-3">
                                <label class="mb-1">
                                    <h6 class="mb-0 text-sm">Пароль</h6>
                                </label>
                                <input type="password" name="password" placeholder="Введите пароль">
                            </div>
                            <br>
                            <div class="row px-3 mb-4">
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    <input id="chkadmin" type="checkbox" name="checkboxadmin" class="custom-control-input">
                                    <label for="chkadmin" class="custom-control-label text-sm">Войти как администратор</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-blue btn-outline-success" name="btnlogin">Войти</button>
                        </form>
                        <br>
                        <?php if (isset($errors) && is_array($errors)): ?>
                            <ul class="list-group list-group-flush">
                                <?php foreach ($errors as $error): ?>
                                    <li class="list-group-item list-group-item-danger"><?php echo $error; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>
        </div>
        <div class="bg-blue py-4">
            <div class="row px-3"> <small class="ml-4 ml-sm-5 mb-2">Железно &copy; 2021.</small>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap 4.4.1 js -->
<script href="style/lib/Bootstrap/js/bootstrap.bundle.min.js"></script>
<script href="style/lib/Bootstrap/js/bootstrap.min.js"></script>

<!-- Font Awesome -->
<script defer src="/faceid/style/lib/FontAwesome/js/brands.js"></script>
<script defer src="/faceid/style/lib/FontAwesome/js/solid.js"></script>
<script defer src="/faceid/style/lib/FontAwesome/js/fontawesome.js"></script>

</body>
</html>