<?php

namespace App\Modules\Taxonomies;

use App\Modules\Theme\AbstractTaxonomy;

class Genres extends AbstractTaxonomy
{
    protected $slug = 'genres';
    protected $object_type = ['book'];
    protected $labels = [
        'name' => 'Genres',
        'singular_name' => 'Genre',
        'search_items' => 'Search Genres',
        'all_items' => 'All Genres',
        'view_item ' => 'View Genre',
        'edit_item' => 'Edit Genre',
        'update_item' => 'Update Genre',
        'add_new_item' => 'Add New Genre',
        'new_item_name' => 'New Genre Name',
        'menu_name' => 'Genres',
    ];
    protected $hierarchical = true;
    protected $public = true;
}