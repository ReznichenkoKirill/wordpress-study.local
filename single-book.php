<?php
get_header();

if (have_posts()) {
    while (have_posts()) : the_post(); ?>
        <div class="col-12 d-flex flex-column justify-content-center mt-5 mb-5 book-blur p-5">
            <?php
            the_title('<h2 class="text-center mb-3">', '</h2>');
            ?>
            <div class="d-flex justify-content-center">
                <?php the_post_thumbnail('medium', ['class' => 'mt-3 mb-5']);
                ?>
            </div>
            <?php
            the_content();
            ?>
            </ul>
            <div>
                <ul class="m-0 p-0 mb-4">
                    <?php if (!empty(get_field('author'))) : ?>
                        <li><h6>Author: <?php echo get_field('author') ?></h6></li>
                    <?php else: ?>
                        <li><h6>Author: <?php echo NO_DATA_MESS ?></h6></li>
                    <?php endif; ?>
                    <?php if (!empty(get_field('date_of_book_write'))) : ?>
                        <li><h6>Date: <?php echo get_field('date_of_book_write') ?></h6></li>
                    <?php else: ?>
                        <li><h6>Date: <?php echo NO_DATA_MESS ?></h6></li>
                    <?php endif; ?>
                </ul>
                <h5 class="mb-0 pb-0">Same books:</h5>
                <ul class="m-0 mb-3">
                    <?php
                    $get_book = get_post(get_the_ID());
                    $genres = get_the_terms($get_book->ID, 'genres');
                    $arr_genres_id = [];
                    foreach ($genres as $genre) {
                        $arr_genres_slug[] = $genre->slug;
                    }
                    $same_books = get_posts([
                        'genres' => $arr_genres_slug,
                        'post_type' => $get_book->post_type,
                        'exclude' => $get_book->ID,
                        'numberposts' => 5,
                    ]);
                    foreach ($same_books as $book) : ?>
                        <li>
                            <a href="<?php echo $book->guid; ?>"><?php esc_html_e($book->post_title) ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
                    <div>
                        <?php
                        $user = wp_get_current_user();
                        if (get_the_author() == $user->nickname || current_user_can('edit_published_posts')) : ?>
                            <h5> <?php edit_post_link(); ?> </h5>
                        <?php endif ?>
                    </div>
                    <div class="d-flex justify-content-center button-container">
                        <a href='<?= home_url() ?>' title='To homepage' class="button bg-dark">Back to homepage</a>
                    </div>
            </div>
        </div>
    <?php
    endwhile;
}
get_footer();