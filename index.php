<?php get_header();


if (have_posts()) :
    while (have_posts()) : the_post();
        ?>
        <div class="contents-container"><?php
            the_title('<h2 class="text-center">', '</h2>');
            the_post_thumbnail();
            the_content();

            ?>
            <ul class="contents-list">
                <li>Author: <?php the_author(); ?></li> <!-- get_the_author_link() -->
                <li>Time: <?php the_time(); ?></li>
                <li>
                    <?php
                    $user = wp_get_current_user();
                    if (get_the_author() == $user->nickname && current_user_can('edit_published_posts')) {
                        edit_post_link();
                    }
                    ?>
                </li>
            </ul>
            <ul class="contents-list">
                <li>Categories: <?php the_category(); ?></li>
            </ul>

            <?php
            if (is_page()) {
                the_shortlink('Read more!', 'link', '<p class="text-center">', '</p>');
            } else {
                the_shortlink('Read more!', 'link', '<p class="text-center">', '</p>');
            }


            ?>

            <hr>
        </div>
    <?php
    endwhile;
else:
    _e('Sorry, no posts matched your criteria.', 'textdomain');
endif;
?>
<?php get_footer(); ?>