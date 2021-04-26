<?php
/**
 * @var \App\Modules\Gutenberg\Blocks\ShowCategories $this
 */

$categories = $this->getData('categories');
krsort($categories);
?>
<h2>Category:</h2>
        <div class="d-flex flex-direction-column align-items-center flex-wrap justify-content-center">
            <?php
            foreach ($categories as $item):?>
                <?php
                $image = get_field('image_genre', $item->taxonomy.'_'.$item->term_id);
                ?>
                <figure class="d-flex flex-column justify-content-center p-3 text-center">
                    <div class="text-center">
                        <a class="d-block" href="<?php echo(get_term_link($item->term_id)); ?>">
                            <?php echo wp_get_attachment_image($image['ID'], 'thumbnail'); ?>
                        </a>
                    </div>
                    <figcaption class="text-center bg-dark">
                        <a href="<?php echo(get_term_link($item->term_id)); ?>" class="text-light"><?php esc_html_e($item->name) ?></a>
                    </figcaption>
                </figure>
            <?php endforeach; ?>
    </div>