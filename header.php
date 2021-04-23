<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php wp_head(); ?>
</head>
<body <?php body_class() ?>>
<header class="">
    <nav class="d-flex justify-content-between align-items-center">
        <div class="col-4"><a href="<?= home_url(); ?>"><img
                        src="<?= get_template_directory_uri() ?>/assets/img/book-white.png" alt="book_logo"
                        class="logo-img"></a></div>
        <?php
        wp_nav_menu([
            'menu' => 'Top Menu',
            'container' => 'div',
            'container_class' => 'col-8 d-flex justify-content-center',
            'menu_class' => 'd-flex justify-content-evenly',
            'before' => '<button type="button" class="button">',
            'after' => '</button>',
        ]);
        ?>
    </nav>
</header>
<main class="mx-3 d-flex flex-wrap justify-content-center pt-4">

    <?php wp_body_open(); ?>