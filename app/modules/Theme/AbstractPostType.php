<?php

namespace App\Modules\Theme;

use App\Helpers\ConfigHelper;

/**
 * Class AbstractPostType
 * @package App\Modules\Theme
 */
abstract class AbstractPostType
{
    /**
     * @var string
     */
    protected $slug = '';

    /**
     * @var array
     */
    protected $labels = [];

    /**
     * @var bool
     */
    protected $public = true;

    /**
     * @var string
     */
    protected $icon = 'dashicons-admin-post';

    /**
     * @var string|bool
     */
    protected $configPath = false;

    /**
     * @var array
     */
    protected $supports = ['title', 'thumbnail'];

    /**
     * @var bool
     */
    protected $showInRest = true;

    /**
     * AbstractPostType constructor.
     */
    public function __construct()
    {
        register_post_type($this->slug, array(
            'labels' => $this->labels,
            'public' => $this->public,
            'publicly_queryable' => $this->public,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'rewrite' => true,
            'capability_type' => 'post',
            'has_archive' => false,
            'hierarchical' => false,
            'menu_position' => null,
            'show_in_rest' => $this->showInRest,
            'menu_icon' => $this->icon,
            'supports' => $this->supports
        ));

        $this->addCustomFields();
    }

    /**
     * Add custom fields.
     */
    public function addCustomFields()
    {
        if (function_exists('acf_add_local_field_group')) {
            if ($this->configPath) {
                $acfConfig = ConfigHelper::getConfig($this->configPath);

                if ($acfConfig) {
                    acf_add_local_field_group($acfConfig);
                }
            }
        }
    }
}
