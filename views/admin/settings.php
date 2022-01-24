<?php include ROOT . '/views/layouts/header.php';?>
<?php include ROOT . '/views/layouts/navbar.php';?>

<div class="col-md-9 ml-sm-5 col-lg-9 mt-2 justify-content-center">
    <div class="my-5">
        <h2 class="h3 mb-4 page-title">Настроки</h2>
        <div class="my-4">
            <!--<ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Дочерние роли</a>
                </li>
            </ul>-->
            <!--<h5 class="mb-0 mt-5">Notifications Settings</h5>
            <p>Select notification you want to receive</p>
            <hr class="my-4" />
            <strong class="mb-0">Security</strong>
            <p>Control security alert you will be notified.</p>-->

            <div class="list-group">
                <div class="table-responsive">
                    <table class="table" id="posttable">
                        <thead>
                        <tr>
                            <th><h5>Дочерние роли</h5></th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>

            <p>
                <button type="button" class="btn btn-outline-success" data-toggle="collapse" data-target="#collapse_addsecondrole" aria-expanded="false" aria-controls="collapseExample">Добавить роль <i class="fas fa-plus"></i></button>
                <a class="btn btn-outline-info" href="/faceid/admin/settings/post/all" role="button"><span>Показать все </span><i class="fa fa-users"></i></a>
            </p>

            <form method="POST" action="#">
                <div class="collapse" id="collapse_addsecondrole">
                    <div class="card card-body">
                        <label for="input_addpost">Введите название роли:</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Маляр" aria-describedby="btn_addpost" id="input_addpost" name="input_addpost" required>
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-outline-success" id="btn_addpost" name="btn_addpost">Сохранить</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <!--
            <button type="button" class="btn btn-outline-success">Добавить <i class="fas fa-plus"></i></button>
            <button type="button" class="btn btn-outline-info">Показать все <i class="fas fa-users"></i></button>-->



                <!--<div class="list-group-item">
                    <div class="row align-items-center">
                        <div class="col">
                            <strong class="mb-0">Unusual activity notifications</strong>
                            <p class="text-muted mb-0">Donec in quam sed urna bibendum tincidunt quis mollis mauris.</p>
                        </div>
                        <div class="col-auto">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="alert1" checked="" />
                                <span class="custom-control-label"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="list-group-item">
                    <div class="row align-items-center">
                        <div class="col">
                            <strong class="mb-0">Unauthorized financial activity</strong>
                            <p class="text-muted mb-0">Fusce lacinia elementum eros, sed vulputate urna eleifend nec.</p>
                        </div>
                        <div class="col-auto">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="alert2" />
                                <span class="custom-control-label"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>-->
        </div>
    </div>
</div>

<?php include ROOT . '/views/layouts/footer.php';?>