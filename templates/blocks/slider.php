<?php

$images = $this->getData('slider_book');
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

        foreach ($images

        as $img) :
        if ($img['ID'] === $img_first_id) :
        ?>
        <div class="carousel-item active">
            <?php else : ?>
            <div class="carousel-item">
                <?php endif; ?>
                <?php echo wp_get_attachment_image($img['ID'], 'medium', '', ['class' => 'd-block mx-auto not-lazy-load']);

                ?>
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
<?php endif;