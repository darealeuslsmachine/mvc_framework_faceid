<!DOCTYPE html>
<html lang="ru">

<head>
    <meta name="description" content="Webpage description goes here" />
    <meta charset="utf-8">
    <?php if ($_SESSION['user']->admin) {
        echo '<title>Администратор</title>';
    } else {
        echo '<title>Менеджер</title>';
    };
    ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="">

    <link rel="stylesheet" href="/faceid/style/css/main.css">

    <!-- Bootstrap 4.4.1 css -->
    <link rel="stylesheet" href="/faceid/style/lib/Bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="/faceid/style/lib/Bootstrap/css/bootstrap-grid.css">
    <link rel="stylesheet" href="/faceid/style/lib/Bootstrap/css/bootstrap-reboot.css">

    <!-- DataTables css-->
    <link rel="stylesheet" href="/faceid/style/lib/DataTables/datatables.min.css">
    <link rel="stylesheet" href="/faceid/style/lib/DataTables/Buttons/buttons.dataTables.min.css">
</head>

<body>
<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="/faceid/">ЖЕЛЕЗНО</a>
    <!--<input class="form-control form-control-dark w-100" type="text" placeholder="Поиск" aria-label="Search">-->
    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            <a class="nav-link" href="/faceid/user/logout">Выйти</a>
        </li>
    </ul>
</nav>
<div class="container-fluid">
    <div class="row">
