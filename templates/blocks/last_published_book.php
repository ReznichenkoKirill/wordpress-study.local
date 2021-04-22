<?php
/**
 * @var \App\Modules\Gutenberg\Blocks\LastPublishedBook $this
 */

$post_type = $this->getData('post_type');
$count = $this->getData('count_of_publish');
$new_books = wp_get_recent_posts([
    'post_type' => 'book',
    'numberposts' => $count,
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
