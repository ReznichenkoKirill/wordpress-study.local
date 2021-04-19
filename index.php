<?php get_header();
if (have_posts()) {
    while (have_posts()) : the_post() ?>
        <div class="col-12 d-flex flex-column justify-content-center mt-4 mb-5 pb-3 book-blur">
            <a href="<?php the_permalink(); ?>"><h2 class="text-center mb-3"><?php the_title(); ?></h2></a>

            <?php
            the_post_thumbnail();
            the_excerpt();
            echo get_post_meta($post->ID, '_study_template_author_of_the_book', true);
            ?>

            <ul class="m-0 p-0 mb-4">
                <li>Author: <?= get_the_author_link(); ?></li>
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

        </div>
    <?php endwhile;
    $args = array(
        'show_all' => false,
        'end_size' => 1,
        'mid_size' => 1,
        'prev_next' => true,
        'prev_text' => __('« Previous'),
        'next_text' => __('Next »'),
        'add_args' => false,
        'add_fragment' => null,
        'screen_reader_text' => ' ',
    );
    the_posts_pagination($args);

}
get_footer();