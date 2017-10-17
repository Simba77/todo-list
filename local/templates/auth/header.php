<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
use \Bitrix\Main\Page\Asset;
/** @var $USER */
/** @var $APPLICATION */
?><!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8"/>
    <link rel="apple-touch-icon" sizes="76x76" href="/public/assets/img/apple-icon.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/public/assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title><?$APPLICATION->ShowTitle()?></title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
    <meta name="viewport" content="width=device-width, user-scalable=no"/>
    <?
    Asset::getInstance()->addCss('/public/assets/css/app.css');
    ?>
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <? $APPLICATION->ShowHead(); ?>
</head>
<? $APPLICATION->ShowPanel(); ?>
<body>

<div class="wrapper">

    <div class="content">
        <div class="container-fluid">
            <div class="row">
