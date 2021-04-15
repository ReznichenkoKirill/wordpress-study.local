<?php include_once 'functions.php' ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php wp_head(); ?>
</head>
<header>
    <div class="logo-container"><a href="<?= home_url();?>"><img src="<?=get_template_directory_uri()?>/assets/img/book-white.png" alt="book_logo" class="logo-img"></a></div>
    <nav class="header-content">
        <ul class="header-nav-menu">
            <li><?php wp_nav_menu('menu=Top Menu'); ?></li>
        </ul>
    </nav>
</header>
<body class="">
    <main class="container">
<?php wp_body_open(); ?>


