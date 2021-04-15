<?php
get_header();

if (have_posts()) :
    while (have_posts()) : the_post();
        ?>
        <div class="content-container"><?php
            the_title('<h2 class="text-center">', '</h2>');
            the_post_thumbnail();
            the_content();
            ?>
            <ul class="content-list">
                <li>Author: <?php the_author(); ?></li>
                <li>Time: <?php the_time(); ?></li>
            </ul>
            <ul class="content-list">
                <li>Categories: <?php the_category(); ?></li>
            </ul>

            <?php
            if (is_page()) {
                the_shortlink('Read more!', 'link', '<p class="text-center">', '</p>');
            } else {
                echo "<p class='text-center'><a href='" . home_url() . "' title='To homepage'>Back to homepage</a></p>";
            }
            ?>
        </div>
    <?php
    endwhile;
else:
    _e('Sorry, no posts matched your criteria.', 'textdomain');
endif;
get_footer();
