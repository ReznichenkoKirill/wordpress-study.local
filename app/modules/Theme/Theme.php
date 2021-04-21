<?php

namespace App\Modules\Theme;

/**
 * Class Theme
 * @package App\Modules\Theme
 */
class Theme
{
    /**
     * Theme constructor.
     */
    public function __construct()
    {
        $this->themeSupport();
        add_action('after_setup_theme', [$this, 'addThemeLanguages']);
        add_filter('style_loader_src', [$this, 'removeScriptsVersion'], 9999);
        add_filter('script_loader_src', [$this, 'removeScriptsVersion'], 9999);
        remove_action('wp_head', 'wp_generator');
        add_action('wp_enqueue_scripts', [$this, 'addFrontendScripts']);
        add_action('wp_enqueue_scripts', [$this, 'addFrontendStyles']);
        add_action('admin_enqueue_scripts', [$this, 'addAdminStyles']);
        add_action('wp_enqueue_scripts', [$this, 'ajaxUrl'], 99);
        add_filter('render_block', [$this, 'renderBlocks'], 99, 2); //Disable if there is no need to use it
        add_filter('wp_get_attachment_image_attributes', [$this, 'lazyLoadImages'], 10, 3);
    }

    /**
     * Add theme support features.
     */
    public function themeSupport()
    {
        add_theme_support('menus');
        add_theme_support('post-thumbnails');
        add_theme_support('title-tag');
    }

    /**
     * Add theme languages.
     */
    public function addThemeLanguages()
    {
        load_theme_textdomain(THEME_DOMAIN, get_template_directory() . '/app/languages');
    }

    /**
     * Add frontend JS scripts.
     */
    public function addFrontendScripts()
    {
        //
    }

    /**
     * Add frontend styles.
     */
    public function addFrontendStyles()
    {
        //

        if (is_admin_bar_showing()) {
            //
        }
    }

    /**
     * Add admin (backend) styles.
     */
    public function addAdminStyles()
    {
        //
    }

    /**
     * Change the WP version number for scripts and styles
     *
     * @param string $src
     *
     * @return string
     */
    public function removeScriptsVersion($src)
    {
        if (strpos($src, 'ver=' . get_bloginfo('version'))) {
            $src = remove_query_arg('ver', $src);
            $src = add_query_arg(['ver' => STATIC_VERSION], $src);
        }

        return $src;
    }

    /**
     * Add AJAX URL for the frontend side.
     */
    public function ajaxUrl()
    {
        wp_localize_script('jquery', 'ajax_global',
            array(
                'url' => admin_url('admin-ajax.php')
            )
        );
    }

    /**
     * Add wrap <div class="container"></div> for all Gutenberg blocks.
     *
     * @param $block_content
     * @param $block
     * @return string|string[]
     */
    public function renderBlocks($block_content, $block)
    {
        global $post;

        if (strpos($block['blockName'], 'core/') === 0 && !in_array($post->post_type, ['post', 'page'])) {
            $block_content = '<div class="container">' . $block_content . '</div>';
        } else {
            $block_content = str_replace('class="container"', 'class="container container--inner"', $block_content);
        }

        return $block_content;
    }

    /**
     * @param $attr
     * @param $attachment
     * @param $size
     *
     * @return array
     */
    public function lazyLoadImages($attr, $attachment, $size)
    {
        if (stripos($attr['class'], 'not-lazy-load') !== false or is_admin()) {
            return $attr;
        }

        $attr['data-src'] = $attr['src'];
        $attr['data-srcset'] = $attr['srcset'];
        $attr['data-sizes'] = $attr['sizes'];
        $attr['class'] .= ' lazy-load-image';

        unset($attr['src']);
        unset($attr['srcset']);
        unset($attr['sizes']);

        return $attr;
    }
}
