<?php get_header();
if (have_posts()) {
    while (have_posts()) : the_post()?>
        <div class="col-12 d-flex flex-column justify-content-center mt-4">
            <?php
            the_title('<h2 class="text-center mb-3">', '</h2>');
            the_post_thumbnail('short_img');
            the_excerpt(); //the_content();
            ?>
            <ul class="m-0 p-0 mb-4">
                <li>Author: <?= get_the_author_link(); ?></li> <!-- get_the_author_link() -->
                <li>Time: <?php the_time(); ?></li>
                <li>
                    <?php
                    $user = wp_get_current_user();
                    if (get_the_author() == $user->nickname || current_user_can('edit_published_posts')) {
                        edit_post_link();
                    }
                    ?>
                </li>
                <li>Categories: <?php the_category('/'); ?></li>
            </ul>
            <?php
            if (!is_page()) {
                the_shortlink('Read more!', 'link', '<p class="text-center m-0 p-0">', '</p>');
            }
            ?>
            <hr class="mb-5">
        </div>
    <?php endwhile;
}
get_footer();