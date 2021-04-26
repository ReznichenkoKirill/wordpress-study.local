<?php
/**
 * @var \App\Modules\Gutenberg\Blocks\Genres $this
 */

$author = $this->getData('author');
$date = $this->getData('date_of_book_write');
$genres = ($this->getData('genres'));
?>

<div class="d-flex flex-column">
    <?php if (!empty($author)) : ?>
        <h5 class="m-0 mb-3">Author: <?php echo $author ?></h5>
    <?php endif; ?>
    <?php if (!empty($date)) : ?>
        <h5 class="m-0 mb-3">Date of the book write: <?php echo $date ?></h5>
    <?php endif; ?>
    <?php if (!empty($genres)) : ?>
        <div>
            <h5 class="m-0 mb-3">Genres:</h5>
            <?php foreach ($genres as $genre): ?>
                <button class="button p-0">
                    <a href="<?php echo(get_term_link($genre->term_id)); ?>"
                       class="p-2 text-decoration-none"><?php echo $genre->name; ?></a>
                </button>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
