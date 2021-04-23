<?php
get_header();
//<div class="container col-12 border-0 book-content-wrap d-flex flex-wrap justify-content-center"> <!-- content block -->
if (have_posts()) : ?>
    <div class="d-flex col-8 mx-auto flex-column justify-content-between border-0 book-content-wrap">
    <?php while (have_posts()) : the_post(); ?>
        <div class="col-12 d-flex flex-column justify-content-center book-blur mb-3">
            <a href="<?php the_permalink(); ?>"><h2 class="text-center mb-3"><?php the_title(); ?></h2></a>
            <div class="d-flex justify-content-center mt-3 mb-5">
                <?php the_post_thumbnail('medium', ['class' => 'text-center']); ?>
            </div>

            <?php
            the_excerpt();
            ?>

            <ul class="m-0 p-0 mb-4">
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
                <li>
                    <?php the_taxonomies() ?>
                </li>

                <?php
                $user = wp_get_current_user();

                if (get_the_author() == $user->nickname || current_user_can('edit_published_posts')) :?>
                    <li> <?php edit_post_link(); ?> </li>
                <?php endif; ?>
            </ul>
            <?php if (!is_page()) : ?>
                <button class="col-2 button text-center m-0 p-0 mx-auto border border-dark">
                    <a class="d-block col-12 bg-dark text-light" href="<?php echo get_page_link(get_the_ID()) ?>">Read
                        more!</a>
                </button>
            <?php endif; ?>
        </div>

    <?php
    endwhile; ?>
    </div>
    <div class="col-3 sidebar border-0">
        <?php get_sidebar() ?>
    </div>
<?php else : ?>
    <div class="bg-dark h-75 d-flex justify-content-center align-items-center">
        <h2 class="text-white">Empty</h2>
    </div>
<?php endif;

get_footer();