<?php

namespace App\Modules\Theme;

use App\Helpers\ConfigHelper;
use App\Helpers\TemplateHelper;
use App\Modules\Gutenberg\Gutenberg;

/**
 * Class AbstractBlock
 * @package App\Modules\Theme
 */
abstract class AbstractBlock extends TemplateHelper
{
    /**
     * @var string
     */
    protected $slug = '';

    /**
     * @var string
     */
    protected $title = '';

    /**
     * @var string
     */
    protected $description = '';

    /**
     * @var string
     */
    protected $category = Gutenberg::BLOCK_CATEGORY;

    /**
     * @var string
     */
    protected $icon = '';

    /**
     * @var string
     */
    protected $align = 'full';

    /**
     * @var string
     */
    protected $template = '';

    /**
     * @var string
     */
    protected $configPath = '';

    /**
     * @var array
     */
    protected $block = [];

    /**
     * AbstractBlock constructor.
     */
    public function __construct()
    {
        add_action('acf/init', [$this, 'registerBlock']);
        $this->setConfig();
    }

    /**
     * Register ACF Gutenberg Block.
     */
    public function registerBlock()
    {
        if (function_exists('acf_register_block')) {
            acf_register_block(array(
                'name' => $this->slug . '-block',
                'title' => $this->title,
                'description' => $this->description || $this->title,
                'render_callback' => [$this, 'render'],
                'category' => $this->category,
                'icon' => $this->icon,
                'align' => $this->align,
                'keywords' => [$this->slug],
            ));
        }
    }

    /**
     * Render ACF Gutenberg Block.
     *
     * @param $block
     */
    public function render($block)
    {
        $blockFields = get_fields();

        $this->setData($blockFields);

        require get_template_directory() . '/templates/' . (!empty($this->template) ? $this->template : 'blocks/' . $this->slug) . '.php';
    }

    /**
     * Add ACF field group config.
     */
    public function setConfig()
    {
        if (function_exists('acf_add_local_field_group')) {
            $acfConfig = ConfigHelper::getConfig(!empty($this->configPath) ? $this->configPath : 'blocks/' . $this->slug);

            if ($acfConfig) {
                acf_add_local_field_group($acfConfig);
            }
        }
    }

    /**
     * @param $data
     *
     * @return $this
     */
    public function setData($data)
    {
        $this->block['data'] = $data;

        return $this;
    }

    /**
     * @param string $var
     *
     * @return array|null
     */
    protected function getData($var = '')
    {
        if (empty($var)) {
            return isset($this->block['data']) ? $this->block['data'] : [];
        } else {
            return isset($this->block['data'][$var]) ? $this->block['data'][$var] : null;
        }
    }
}
