<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php wp_head(); ?>
</head>
<body class="d-grid book-bg">
<header class="">
    <nav class="d-flex justify-content-between align-items-center">
        <div class="col-4"><a href="<?= home_url(); ?>"><img
                        src="<?= get_template_directory_uri() ?>/assets/img/book-white.png" alt="book_logo"
                        class="logo-img"></a></div>
        <ul class="col-8 d-flex justify-content-center">
            <li><?php wp_nav_menu(['menu' => 'Top Menu', 'container_class' => 'link-light']); ?></li>
        </ul>
    </nav>
</header>
<main class="container d-flex flex-column justify-content-center">
<?php wp_body_open(); ?>