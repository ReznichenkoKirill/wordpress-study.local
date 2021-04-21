<?php

namespace App\Modules\Gutenberg;

use App\Bootstrap\Bootstrap;
use App\Modules\Gutenberg\Blocks\Hero;

/**
 * Class Gutenberg
 * @package App\Modules\Gutenberg
 */
class Gutenberg
{
    const BLOCK_CATEGORY = 'additional-blocks';

    /**
     * Gutenberg constructor.
     */
    public function __construct()
    {
        add_filter('block_categories', [$this, 'addBlockCategory'], 10, 2);
        $this->registerBlocks();
    }

    /**
     * Register Gutenberg blocks.
     */
    public function registerBlocks()
    {
        Bootstrap::load([
            Hero::class
        ]);
    }

    /**
     * Add the new Gutenberg category
     *
     * @param $categories
     * @param $post
     *
     * @return array
     */
    public function addBlockCategory($categories, $post)
    {
        $categories = array_merge($categories, [
            [
                'slug' => self::BLOCK_CATEGORY,
                'title' => __('Additional Blocks', THEME_DOMAIN),
            ],
        ]);

        return $categories;
    }
}
