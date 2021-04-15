<?php
get_header();

if (have_posts()) :
    while (have_posts()) : the_post();
        ?>
        <div class="content-container"><?php
            the_title('<h2 class="text-center">', '</h2>');
            the_post_thumbnail();   //img
            the_content();  //or the_excerpt();
            ?>
            <ul class="content-list">
                <li>Author: <?php the_author(); ?></li>
                <li>Time: <?php the_time(); ?></li>
                <li>
                    <?php
                    $user = wp_get_current_user();
                    if (get_the_author() == $user->nickname || current_user_can('edit_published_posts')) {
                        edit_post_link();
                    }
                    ?>
                </li>
            </ul>
            <ul class="content-list">
                <li>Categories: <?php the_category(); ?></li>
            </ul>
            <p class='text-center'><a href='<?= home_url() ?>' title='To homepage'>Back to homepage</a></p>
        </div>
    <?php
    endwhile;
else:
    _e('Sorry, no posts matched your criteria.');
endif;
get_footer();
