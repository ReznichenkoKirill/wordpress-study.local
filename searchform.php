<?php
$genres = get_terms([
    'taxonomy' => 'genres',
]);
global $table_prefix;
global $wpdb;
$min = $wpdb->get_results("SELECT MIN(meta_value) FROM {$wpdb->prefix}postmeta WHERE meta_key = 'date_of_book_write'", ARRAY_N);
$max = $wpdb->get_results("SELECT MAX(meta_value) FROM {$wpdb->prefix}postmeta WHERE meta_key = 'date_of_book_write'", ARRAY_N);
$min = mb_substr($min[0][0], 0, 4);
$max = mb_substr($max[0][0], 0, 4);
?>
    <form role="search" action="<?php echo get_post_type_archive_link('book') ?>?" method="GET">
<!--        <label for="s">Search</label>-->
<!--        <input type="text" value="" name="s" id="s"/>-->
        <!-- type="text" value="" name="s" id="s" объязательные поля для формы поиска -->

        <div class="mx-2 p-2">
            <h3>Author:</h3>
            <input type="text" name="author" value="<?php echo !empty($_GET['author']) ? $_GET['author'] : ''; ?>">
        </div>
        <div class="mx-2 p-2">
            <h3>Date:</h3>
            <div>
                <input type="number" min="<?php echo $min ?>" max="<?php echo $max ?>" name="date_of_book_write[min]">
                <label for="">Min</label>
            </div>
            <div>
                <input type="number" min="<?php echo $min ?>" max="<?php echo $max ?>" name="date_of_book_write[max]">
                <label for="">Max</label>
            </div>
        </div>
        <div class="mx-2 p-2">
            <h3>Genres:</h3>
            <?php foreach ($genres as $genre) : ?>
                <div>
                    <input type="checkbox" name="<?php echo $genre->taxonomy ?>[]" value="<?php echo $genre->slug ?>"
                           id="custom-widget-genre_<?php echo $genre->slug ?>-active"
                        <?php if (!empty($_GET['genres']) && in_array($genre->slug, $_GET['genres'])) echo 'checked' ?>>
                    <label for="custom-widget-genre_<?php echo $genre->slug ?>-active"><?php echo $genre->name ?></label>
                </div>
            <?php endforeach; ?>
        </div>
        <input type="submit" value="Search" class="d-block mx-auto mt-2">
    </form>
<?php