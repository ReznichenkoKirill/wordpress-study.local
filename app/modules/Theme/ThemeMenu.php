<?php

namespace App\Modules\Theme;

/**
 * Class ThemeMenu
 * @package App\Modules\Theme
 */
class ThemeMenu {
	/**
	 * ThemeMenu constructor.
	 */
	public function __construct() {
		add_action( 'after_setup_theme', [ $this, 'registerMenus' ] );
	}

	/**
	 * Register navigation menu areas.
	 */
	public function registerMenus() {
		register_nav_menus( [
//            'header_menu' => __('Header Menu', THEME_DOMAIN),
//            'footer_first_menu' => __('Footer First Menu', THEME_DOMAIN),
//            'footer_second_menu' => __('Footer Second Menu', THEME_DOMAIN),
			'top' => 'Top Menu',
		] );
	}
}
