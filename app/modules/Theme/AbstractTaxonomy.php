<?php

namespace App\Modules\Theme;

use App\Helpers\ConfigHelper;

/**
 * Class AbstractTaxonomy
 * @package App\Modules\Theme
 */
abstract class AbstractTaxonomy
{
    /**
     * @var string|array
     */
    protected $object_type = '';

    /**
     * @var bool
     */
    protected $hierarchical = false;

    /**
     * @var string
     */
    protected $description = '';

    /**
     * @var string
     */
    protected $label = '';

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
     * @var string|bool
     */
    protected $configPath = false;

    /**
     * @var bool
     */
    protected $showInRest = true;

    /**
     * AbstractPostType constructor.
     */
    public function __construct()
    {
        register_taxonomy($this->slug, $this->object_type , array(
            'label' => $this->label,
            'labels' => $this->labels,
            'description' => $this->description,
            'public' => $this->public,
            'publicly_queryable' => $this->public,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'rewrite' => true,
            'hierarchical' => $this->hierarchical,
            'show_in_rest' => $this->showInRest,
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