<?php
/**
 * @var \App\Modules\Gutenberg\Blocks\EditorsChoice $this
 */
$editors_chose = $this->getData('editors_choice');
?>
<?php if (!empty($editors_chose)) : ?>
    <nav class="d-flex justify-content-center alight-items-center flex-wrap editors_choice">
        <h2 class="col-12">Editor's Choice:</h2>
        <?php foreach ($editors_chose as $post_item) : ?>
            <div class="col-6 text-center ">
                <figure class="d-flex justify-content-center flex-column">
                    <a href="<?php echo $post_item->guid ?>">
                        <?php echo get_the_post_thumbnail($post_item->ID, 'thumbnail') ?>
                    </a>
                    <figcaption class="">
                        <a href="<?php echo $post_item->guid ?>"><?php echo $post_item->post_title ?></a>
                    </figcaption>
                </figure>
            </div>
        <?php endforeach; ?>
    </nav>
<?php endif; ?>
