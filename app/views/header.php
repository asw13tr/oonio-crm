<!doctype html>
<html lang="en">
<head>
    <title><?php echo isset($Title)? $Title : 'Oonio CRM'; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@400;500;700&family=Roboto:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php url('/static/oonio.css'); ?>">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css">
    <?php
        if(isset($headerStyles) && is_array($headerStyles)){
            foreach($headerStyles as $href){
                echo '<link rel="stylesheet" href="'.$href.'">';
            }
        }
        if(isset($headerScripts) && is_array($headerScripts)){
            foreach($headerScripts as $src){
                echo '<script src="'.$src.'"></script>';
            }
        }
    ?>
</head>
<body>
<?php require_once('navbar.php'); ?>
<div id="wrap" class="mt-5 p-3">

