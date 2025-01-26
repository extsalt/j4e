<!doctype html>
<html lang="en">

<head>
    <title> Just4Entrepreneurs</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="theme-color" content="#76cef1" />
    <meta property="og:image" content="<?= base_url('assets/') ?>images/home/6974083357bizbook-white.png" />
    <meta property="og:logo" content="<?= base_url('assets/') ?>images/home/6974083357bizbook-white.png" />
    <link rel="shortcut icon" href="<?= base_url('assets/') ?>images/fevicon 9898.png"
        type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Oswald:700|Source+Sans+Pro:300,400,600,700&display=swap"
        rel="stylesheet">
    <link rel="preload" as="font" href="<?= base_url('assets/') ?>css/icon.woff2" type="font/woff2" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/jquery-ui.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/') ?>css/theme-color.php">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/') ?>css/style.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/fonts.css">
    <? if ($tag == 'event-detiails') { ?>
        <meta property="og:title" content="<?= $event_info->event_title ?>" />
        <meta property="og:description" content="<?= strip_tags($event_info->event_description) ?>" />
        <meta property="og:image" content="<?= base_url('admin/upload/events/'.$event_info->event_thumbnil) ?>" />
        <meta property="og:url" content="<?= base_url('admin/upload/events/'.$event_info->id) ?>" />
        <meta property="og:type" content="product" />
        <meta property="twitter:title" content="<?= $event_info->event_title ?>" />
        <meta property="twitter:description" content="<?= strip_tags($event_info->event_description) ?>" />
        <meta property="twitter:image" content="<?= base_url('admin/upload/events/'.$event_info->event_thumbnil) ?>" />
        <meta property="twitter:url" content="<?= base_url('admin/upload/events/'.$event_info->id) ?>" />
        <meta property="twitter:type" content="product" />
    <? } ?>
</head>

<body>