<?php get_header(); ?>

    <div class="book-blur">

        <?php
        $editors_chose = get_field('editors_choice');
        if (!empty($editors_chose)) : ?>
            <nav>
                <h2>Editor's Choice:</h2>
                <ul>
                    <?php foreach ($editors_chose as $post_item) : ?>
                        <li>
                            <a href="<?php echo $post_item->guid ?>"><?php echo $post_item->post_title ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
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
        <ul class="">
            <?php
            $terms=get_terms([
                'taxonomy' => 'genres',
                'orderby' => 'id',
                'order' => 'ASC',
            ]);
            foreach ($terms as $term):?>
                <li>
                    <a href="<?php echo(get_term_link($term->term_id));?>"><?php esc_html_e($term->name) ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

<?php get_footer(); ?>