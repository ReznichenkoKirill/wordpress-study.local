<?php
get_header('book');

$args = array('post_type' => 'book', 'post_per_page' => 3); // post_per_page - is pagination
$query = new WP_Query($args);

while ($query->have_posts()) : $query->the_post(); ?>
    <div class="col-12 d-flex flex-column justify-content-center mt-4 book-blur">
        <a href="<?php the_permalink(); ?>"><h2 class="text-center mb-3"><?php the_title(); ?></h2></a>
        <?php
        the_post_thumbnail();
        the_excerpt();
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
            <?php
            if (!is_page()) {
                the_shortlink('Read more!', 'link', '<p class="text-center m-0 p-0">', '</p>');
            }
            ?>
        </ul>
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

get_footer();