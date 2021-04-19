<?php
get_header('book');

if (have_posts()) {
    while (have_posts()) : the_post(); ?>
        <div class="col-12 d-flex flex-column justify-content-center mt-5 mb-5 book-blur">
            <?php
            the_title('<h2 class="text-center mb-3">', '</h2>');
            the_post_thumbnail();
            the_content(); //the_content();
            ?>
            <ul class="m-0 p-0 mb-4">
                <li>Author: <?php the_field('author'); ?></li>
                <li>Date: <?php the_field('date_of_book_write'); ?></li>

                <?php
                $terms = get_field('genres');
                if (!empty($terms)) {
                    $terms_count = count($terms);
                    $position = 0;
                }
                if ($terms): ?>
                    <li>Genres:
                        <?php foreach ($terms as $term): ?>
                            <?php
                            ++$position;
                            if ($position !== $terms_count):?>
                                <a href="#"><?php echo esc_html($term->name) . ','; ?></a>
                            <?php else: ?>
                                <a href="#"><?php echo esc_html($term->name) . '.'; ?></a>
                            <?php endif ?>
                        <?php endforeach; ?>
                    </li>
                <?php endif; ?>

                <?php
                $user = wp_get_current_user();
                if (get_the_author() == $user->nickname || current_user_can('edit_published_posts')) :?>
                    <li> <?php edit_post_link(); ?> </li>
                <?php endif ?>
                <li>Categories: <?php the_category('/'); ?></li>
                <p class="text-center m-0 p-0"><a href='<?= home_url() ?>' title='To homepage'>Back to homepage</a></p>
            </ul>
        </div>
    <?php endwhile;
}
get_footer();

