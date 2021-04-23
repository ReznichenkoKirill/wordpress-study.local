<?php

require_once 'vendor/autoload.php';

define('STATIC_VERSION', '1.0.0');
define('THEME_DOMAIN', 'theme');
define('NO_DATA_MESS', 'No Data');
\App\Bootstrap\Bootstrap::load([
    'ConfigHelper' => \App\Helpers\ConfigHelper::class,
    'TemplateHelper' => \App\Helpers\TemplateHelper::class,
    \App\Modules\Theme\ThemeOptions::class,
    App\Modules\Theme\Theme::class,
    \App\Modules\Theme\ThemeMenu::class,
    \App\Modules\Gutenberg\Gutenberg::class,
    \App\Modules\Taxonomies\Genres::class,
    \App\Modules\PostTypes\Book::class,
]);


add_theme_support('post-thumbnails');

add_action('init', 'study_template_menu');
function study_template_menu()
{
    register_nav_menus([
        'top' => 'Top Menu',
        'bottom' => 'Bottom Menu',
    ]);
}

add_filter('excerpt_more', function ($more) {
    return '...';
});
add_action('body_class', function ($classes) {
    $classes[] = 'd-grid';
    if (is_front_page()) {
        $classes[] = 'body-main';
    } else {
        $classes[] = 'book-bg';
    }
    return $classes;
});

add_action('widgets_init', 'register_my_widgets');
function register_my_widgets()
{

    register_sidebar(array(
        'name' => 'Right sidebar',
        'id' => "right-sidebar",
        'description' => '',
        'class' => '',
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => "</li>\n",
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => "</h2>\n",
        'before_sidebar' => '',
        'after_sidebar' => '',
    ));
}

#############################
#
# CLASSES WIDGET
#
#############################
class Custom_Widget extends WP_Widget
{
    public function __construct()
    {
        parent::__construct('custom_widget', 'Custom Widget', ['description' => 'Widget for sort book by custom fields']);
    }

    // Вывод виджета
    function widget($args, $instance)
    {
        $title = !empty($instance['title']) ? $instance['title'] : '';

        /** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
        $title = apply_filters('widget_title', $title, $instance, $this->id_base);
        echo $args['before_widget'];
        if ($title) {
            echo $args['before_title'] . $title . $args['after_title'];
        }

        echo "<h2 class='text-center'>$this->name</h2>";
        get_search_form();

        echo $args['after_widget'];
    }


    // Сохранение настроек виджета (очистка)
    function update($new_instance, $old_instance)
    {
    }

    // html форма настроек виджета в Админ-панели
    function form($instance)
    {
    }
}

add_action('widgets_init', 'my_register_widgets');
function my_register_widgets()
{
    register_widget('custom_widget');
}

add_action('pre_get_posts', 'study_template_ad_filter');
function study_template_ad_filter($query)
{
    if (is_post_type_archive('book')) {
        if (!empty($_GET)) {
            $author = filter_input(INPUT_GET, $_GET['author']);
            $args = [
                    'relation' => 'OR',
                    [
                        'key' => 'genres',
                        'value' => !empty($_GET['genres']) ? $_GET['genres'] : '', //!empty($_GET['genres']) ? filter_input(INPUT_GET, $_GET['genres']) : ''
                    ],
                    [
                        'key' => 'author',
                        'value' => !empty($author) ? $author : '',
                        'compare' => 'LIKE',
                    ],
                    [
                        'key' => 'date_of_book_write',
                        'value' => !empty($_GET['date_of_book_write']) ? [$_GET['date_of_book_write']['min'], $_GET['date_of_book_write']['max']] : '' ,
                        'compare' => 'BETWEEN',
                    ]
            ];
            $query->set('meta_query', $args);
        }
    }
}