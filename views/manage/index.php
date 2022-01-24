<?php include ROOT . '/views/layouts/header.php';?>
<?php include ROOT . '/views/layouts/navbar.php';?>

<input type="hidden" value="<?php echo $_SESSION['user']->userid;?>" id="contractorid">
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 mt-2 px-4">
    <div class="table-responsive">
        <table class="table" id="contractortable">
            <caption>Таблица пользователей</caption>
            <thead>
            <tr>
                <th>ФИО</th>
                <th>Специальность</th>
                <th>Фото</th>
                <th style="width: 5%"></th>
            </tr>
            </thead>
        </table>
    </div>
</main>

<?php include ROOT . '/views/manage/modal_edit.php';?>
<?php include ROOT . '/views/layouts/modal_delete.php';?>
<?php include ROOT . '/views/layouts/footer.php';?>