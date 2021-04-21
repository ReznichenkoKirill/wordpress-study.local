<?php get_header(); ?>

    <div class="book-blur">
        <?php the_title('<h1 class="text-center mb-5 mt-3">', '</h1>')?>
        <?php
        $editors_chose = get_field('editors_choice');
        if (!empty($editors_chose)) : ?>

            <nav class="d-flex justify-content-center alight-items-center  flex-wrap">
                <h2 class="col-12">Editor's Choice:</h2>
<!--                <div class="col-12 d-flex justify-content-center alight-items-center flex-column flex-wrap">-->
                    <?php foreach ($editors_chose as $post_item) : ?>
                        <div class="col-6 text-center">
                            <figure class="d-flex justify-content-center flex-column">
                                <a href="<?php echo $post_item->guid ?>">
                                    <?php echo get_the_post_thumbnail($post_item->ID, 'thumbnail') ?>
                                </a>
                                <figcaption class="">
                                    <a href="<?php echo $post_item->guid ?>"><?php echo $post_item->post_title ?></a>
                                </figcaption>
                            </figure>
                        </div>
<!--                </div>-->
                    <?php endforeach; ?>
            </nav>
        <?php
        endif;

        $new_books = wp_get_recent_posts([
            'post_type' => 'book',
            'numberposts' => 5,
            'post_status' => 'publish',
        ]);

        if (!empty($new_books)) : ?>
            <h2>Last published books:</h2>
            <ul class="">
                <?php foreach ($new_books as $book) : ?>
                    <?php $book = (object)$book; ?>
                    <li>
                        <a href="<?php echo $book->guid ?>"><?php echo $book->post_title ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <h2>Category:</h2>
        <div class="d-flex flex-direction-column align-items-center flex-wrap justify-content-center">
            <?php
            $terms = get_terms([
                'taxonomy' => 'genres',
                'orderby' => 'id',
                'order' => 'ASC',
            ]);

            foreach ($terms as $term):?>
                    <?php
                    $image = get_field('image_genre', $term->taxonomy.'_'.$term->term_id);
                    ?>
                    <figure class="d-flex flex-column justify-content-center p-3 text-center">
                        <div class="text-center">
                        <a class="d-block" href="<?php echo(get_term_link($term->term_id)); ?>">
                            <?php echo wp_get_attachment_image($image['ID'], 'thumbnail'); ?>
                        </a>
                        </div>
                        <figcaption class="text-center bg-dark">
                            <a href="<?php echo(get_term_link($term->term_id)); ?>" class="text-light"><?php esc_html_e($term->name) ?></a>
                        </figcaption>
                    </figure>
            <?php endforeach; ?>
    </div>

<?php get_footer(); ?>