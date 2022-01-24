<?php include ROOT . '/views/layouts/header.php';?>
<?php include ROOT . '/views/layouts/navbar.php';?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 mt-2 px-4">
    <div class="table-responsive">
        <table class="table" id="admintable">
            <caption>Таблица пользователей</caption>
            <thead>
            <tr>
                <th>ФИО</th>
                <th>Логин</th>
                <th>Пароль</th>
                <th>Роль</th>
                <th style="width: 5%"></th>
            </tr>
            </thead>
        </table>
    </div>
</main>

<?php include ROOT . '/views/layouts/modal_edit.php';?>
<?php include ROOT . '/views/layouts/modal_delete.php';?>
<?php include ROOT . '/views/layouts/footer.php';?>