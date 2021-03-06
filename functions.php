<?php

add_theme_support('post-thumbnails');

add_action('init', 'study_template_init');
function study_template_init()
{
    register_post_type('book', [
            'label' => null,
            'labels' => [
                'name' => 'books',
                'singular_name' => 'book',
                'add_new' => 'Add book',
                'add_new_item' => 'Add book',
                'edit_item' => 'Edit book',
                'new_item' => 'New text book',
                'view_item' => 'Open book',
                'search_items' => 'Search book',
                'not_found' => 'Not found',
                'not_found_in_trash' => 'Not found in trash',
                'parent_item_colon' => '',
                'menu_name' => 'books',
            ],
            'description' => '',
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'book'),
            'supports' => ['title', 'editor', 'author', 'thumbnail',],
            'taxonomies' => array('category'),
        ]
    );
}

// выводить в последние записи постов / пости_тип[]
//add_action('pre_get_posts', 'study_template_add_books_to_query');
//function study_template_add_books_to_query($query)
//{
//    if (is_home() && $query->is_main_query())
//        $query->set('post_type', array('post', 'book'));
//    return $query;
//}

add_action('wp_enqueue_scripts', 'study_template_scripts');
function study_template_scripts()
{
    wp_enqueue_style('study-template-bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css');
    wp_enqueue_style('study-template-bootstrap-grid', get_template_directory_uri() . '/assets/css/bootstrap-grid.min.css', ['study-template-bootstrap']);
    wp_enqueue_style('study-template-main', get_template_directory_uri() . '/assets/css/main.css', ['study-template-bootstrap', 'study-template-bootstrap-grid'], '1.0');

    wp_enqueue_script('study-template-jquery', get_template_directory_uri() . '/assets/js/bootstrap.min.js');
    wp_enqueue_script('study-template-main', get_template_directory_uri() . '/assets/js/main.js');
}

//add_filter('the_content', 'study_template_content_filter');
//function study_template_content_filter($content)
//{
//    $content = ucfirst($content);
//    return $content;
//}

add_action('init', 'study_template_menu');
function study_template_menu()
{
    register_nav_menus([
        'top' => 'Top Menu',
        'bottom' => 'Bottom Menu',
    ]);
}
add_filter('excerpt_more', function($more) {
    return '...';
});

//METABOX START
//add_action('add_meta_boxes', 'study_template_meta_box');
//function study_template_meta_box() {
//    add_meta_box('date_of_write', 'Date of write the book', 'study_template_meta_box_date_callback', 'book');
//    add_meta_box('author_of_the_book', 'Author of the book', 'study_template_meta_box_author_callback', 'book');
//    // регистрируем новое кастомное метаполе для своего типа записи
//}
//function study_template_meta_box_date_callback( $post ) {
//    wp_nonce_field('study_template_save_date', 'study_template_book_meta_box_nonce');
//    // делает скрытое поле, для проверки подлиности запроса
//
//    $value = get_post_meta($post->ID, '_study_template_date_of_write_the_book', true);
//    // вытягиваем с БД значение по ключу, оно авто ресиализует значение
//
////    echo '<label for="study_template_book_date_field">Date of write the book</label>';
//    echo "<input type='date' id='study_template_book_date_field' name='study_template_book_date_field' value='".esc_attr($value)."'/>";
//    // esc_attr() делает экранирование в html сущность
//}
//function study_template_meta_box_author_callback( $post ) {
//    $value = get_post_meta($post->ID, '_study_template_author_of_the_book', true);
//
//    echo "<input type='text' id='study_template_book_date_field' name='study_template_author_of_the_book' value='".esc_attr($value)."'/>";
//}

//add_action('save_post', 'study_template_save_values_meta_data');
//function study_template_save_values_meta_data( $post_id ) {
//    if(array_key_exists('study_template_book_meta_box_nonce', $_POST)) {
//        update_post_meta($post_id, '_study_template_date_of_write_the_book', sanitize_text_field($_POST['study_template_book_date_field']));
//        update_post_meta($post_id, '_study_template_author_of_the_book', sanitize_text_field($_POST['study_template_author_of_the_book']));
//    }
//}
//METABOX END