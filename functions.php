<?php

require_once 'vendor/autoload.php';

define( 'STATIC_VERSION', '1.0.0' );
define( 'THEME_DOMAIN', 'theme' );
define( 'NO_DATA_MESS', 'No Data' );
\App\Bootstrap\Bootstrap::load( [
	'ConfigHelper'   => \App\Helpers\ConfigHelper::class,
	'TemplateHelper' => \App\Helpers\TemplateHelper::class,
	\App\Modules\Theme\ThemeOptions::class,
	App\Modules\Theme\Theme::class,
	\App\Modules\Theme\ThemeMenu::class,
	\App\Modules\Gutenberg\Gutenberg::class,
	\App\Modules\Taxonomies\Genres::class,  // Taxonomy
	\App\Modules\PostTypes\Book::class,     // Post type
	\App\Modules\Widgets\Widget_Book_Filters::class,
	\App\Modules\Queries\Book_Queries::class,
] );
