<?php
get_header();

if (have_posts()) {
    while (have_posts()) : the_post(); ?>
        <div class="col-12 d-flex flex-column justify-content-center mt-5 mb-5 book-blur p-5">

            <?php
            the_title('<h2 class="text-center mb-3">', '</h2>');
            ?>

            <div class="d-flex justify-content-center">
                <?php the_post_thumbnail('medium', [ 'class' => 'mt-3 mb-5']); ?>
            </div>

            <?php
            the_content();
            ?>


            <?php
            $images = get_field('slider_book');
            if (!empty($images)) :
                ?>

                <div id="carouselExampleIndicators" class="carousel slide w-50 mx-auto" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                                class="active"
                                aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                                aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                                aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <?php
                        $img_first_el = $images[0];
                        $img_first_id = $img_first_el['ID'];

                        foreach ($images as $img) :
                            if ($img['ID'] === $img_first_id) :
                        ?>
                                <div class="carousel-item active">
                            <?php else : ?>
                                <div class="carousel-item">
                            <?php endif; ?>
                            <?php echo wp_get_attachment_image($img['ID'], 'medium', '', ['class' => 'd-block mx-auto']); ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                            data-bs-slide="prev">
                        <span class="carousel-control-prev-icon bg-dark h-100" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                            data-bs-slide="next">
                        <span class="carousel-control-next-icon bg-dark h-100" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            <?php endif; ?>


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
            </ul>

            <div>
                <h2>Same books:</h2>
                <ul>
                    <?php
                    $genres = get_the_terms(get_the_ID(), 'genres');
                    $arr_genres = [];
                    foreach ($genres as $genre) {
                        $arr_genres[] = $genre->slug;
                    }
                    $same_books = get_posts([
                        'genres' => $arr_genres,
                        'post_type' => 'book',
                        'exclude' => get_the_ID(),
                        'numberposts' => 5,
                    ]);

                    foreach ($same_books as $book) : ?>

                        <li>
                            <a href="<?php echo $book->guid; ?>"><?php esc_html_e($book->post_title) ?></a>
                        </li>

                    <?php endforeach; ?>
                </ul>
                <div class="d-flex justify-content-center button-container">
                    <a href='<?= home_url() ?>' title='To homepage' class="button bg-dark">Back to homepage</a>
                </div>
            </div>
        </div>
    <?php
    endwhile;
}
get_footer();