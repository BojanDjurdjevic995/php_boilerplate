<?php
$page = explode('/', $_SERVER['SCRIPT_NAME']);
$page = explode('.', end($page))[0];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?= csrf_meta() ?>
    <title><?= $title ?: 'Title' ?></title>

<!--    <link rel="apple-touch-icon" sizes="180x180" href="#">-->
<!--    <link rel="icon" type="image/png" sizes="32x32" href="#">-->
<!--    <link rel="icon" type="image/png" sizes="16x16" href="#">-->

    <link rel="stylesheet" href="<?= asset('css/bootstrap-dtables-$confirm-awesome.min.css') ?>">
    <link rel="stylesheet" href="<?= asset('css/main.css') ?>">


    <meta name="page" content="<?= $page ?>">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="<?= asset() ?>">Panel</a>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item <?= is_route('home') ? 'active' : '' ?>">
                <a class="nav-link statsSubMenuActive" href="<?= route('home') ?>">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item <?= is_route('about') ? 'active' : '' ?>">
                <a class="nav-link statsSubMenuActive" href="<?= route('about') ?>">About <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item <?= is_route('form') ? 'active' : '' ?>">
                <a class="nav-link statsSubMenuActive" href="<?= route('form') ?>">Form <span class="sr-only">(current)</span></a>
            </li>
        </ul>
    </div>
</nav>
