<?php include ROOT . '/views/layouts/header.php';?>
<?php include ROOT . '/views/layouts/navbar.php';?>


<div class="col-md-9 ml-sm-5 col-lg-9 mt-2 justify-content-center">
    <div class="my-5">
        <div class="my-4">
            <div class="list-group">
                <div class="table-responsive">
                    <table class="table" id="allposttable">
                        <thead>
                        <tr>
                            <th><h5>Дочерние роли</h5></th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
       </div>
    </div>
    <hr class="my-4" />
    <h5>Добавление роли</h5>
    <hr class="my-4" />
    <form method="POST" action="#">
        <label for="input_addpost">Введите название роли:</label>
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Маляр" aria-describedby="btn_addpost" id="input_addpost" name="input_addpost" required>
            <div class="input-group-append">
                <button type="submit" class="btn btn-outline-success" id="btn_addpost" name="btn_addpost">Сохранить</button>
            </div>
        </div>
    </form>
    <br>
    <br>
    <br>
</div>

<?php include ROOT . '/views/layouts/footer.php';?>