<?php

namespace App\Modules\PostTypes;

use App\Modules\Theme\AbstractPostType;

class Book extends AbstractPostType
{
    protected $slug = 'book';
    protected $label = '';
    protected $labels = [
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
    ];
    protected $public = true;
    protected $taxonomies = ['genres'];
    protected $supports = ['title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields'];
    protected $has_archive = true;
    protected $rewrite = ['slug' => 'book'];
}
