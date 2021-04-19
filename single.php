<?php get_header();
if (have_posts()) {
    while (have_posts()) : the_post() ?>
        <div class="col-12 d-flex flex-column justify-content-center book-blur">
            <?php
            the_title('<h2 class="text-center mb-3">', '</h2>');
            the_post_thumbnail('short_img');
            the_content();
            ?>
            <ul class="m-0 p-0 mb-4">
                <li>Author: <?= get_the_author_link(); ?></li>
                <li>Time: <?php the_time(); ?></li>
                <?php
                $user = wp_get_current_user();
                if (get_the_author() == $user->nickname || current_user_can('edit_published_posts')): ?>
                    <li> <?php edit_post_link(); ?> </li>
                <?php endif ?>
                <li>Categories: <?php the_category('/'); ?></li>
            </ul>
            <p class="text-center m-0 p-0"><a href='<?= home_url() ?>' title='To homepage'>Back to homepage</a></p>
        </div>
    <?php endwhile;
}
get_footer();
