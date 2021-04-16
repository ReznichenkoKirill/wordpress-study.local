<?php

add_theme_support('post-thumbnails', array('post'));
add_image_size('short_img', 150, 150, true);

add_action('init', 'study_template_init');
function study_template_init()
{
    register_post_type('book', [
            'label' => null,
            'labels' => [
                'name' => 'books', // основное название для типа записи
                'singular_name' => 'book', // название для одной записи этого типа
                'add_new' => 'Add book', // для добавления новой записи
                'add_new_item' => 'Add book', // заголовка у вновь создаваемой записи в админ-панели.
                'edit_item' => 'Edit book', // для редактирования типа записи
                'new_item' => 'New text book', // текст новой записи
                'view_item' => 'Open book', // для просмотра записи этого типа.
                'search_items' => 'Search book', // для поиска по этим типам записи
                'not_found' => 'Not found', // если в результате поиска ничего не было найдено
                'not_found_in_trash' => 'Not found in trash', // если не было найдено в корзине
                'parent_item_colon' => '', // для родителей (у древовидных типов)
                'menu_name' => 'books', // название меню
            ],
            'description' => '',
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'book'),
            'supports' => ['title', 'editor', 'author', 'thumbnail',], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
        ]
    );
}

function webpro_add_books_to_query( $query ) {
    if ( is_home() && $query->is_main_query() )
        $query->set( 'post_type', array( 'post', 'book' ) );
    return $query;
}
add_action( 'pre_get_posts', 'webpro_add_books_to_query' );

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



