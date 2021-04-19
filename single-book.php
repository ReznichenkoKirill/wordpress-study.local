<?php
get_header();

if (have_posts()) {
    while (have_posts()) : the_post(); ?>
        <div class="col-12 d-flex flex-column justify-content-center mt-5 mb-5 book-blur">

            <?php
            the_title('<h2 class="text-center mb-3">', '</h2>');
            the_post_thumbnail();
            the_content();
            ?>

            <ul class="m-0 p-0 mb-4">
                <li>Author: <?php the_field('author'); ?></li>
                <li>Date: <?php the_field('date_of_book_write'); ?></li>

                <li>
                    <?php echo the_taxonomies(get_the_ID()); ?>
                </li>

                <?php
                $user = wp_get_current_user();
                if (get_the_author() == $user->nickname || current_user_can('edit_published_posts')) :?>
                    <li> <?php edit_post_link(); ?> </li>
                <?php endif ?>

                <p class="text-center m-0 p-0"><a href='<?= home_url() ?>' title='To homepage'>Back to homepage</a></p>
            </ul>
        </div>
    <?php endwhile;
}
get_footer();