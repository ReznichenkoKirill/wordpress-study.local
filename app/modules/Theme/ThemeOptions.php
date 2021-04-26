<?php

namespace App\Modules\Theme;

use App\Helpers\ConfigHelper;

/**
 * Class ThemeOptions
 * @package Cactus\Modules\Theme
 */
class ThemeOptions {
	/**
	 * ThemeOptions constructor.
	 */
	public function __construct() {
		$this->addOptionsPage();
		$this->addUserProfilesSettings();
	}

	/**
	 * Add options page.
	 */
	public function addOptionsPage() {
		if ( function_exists( 'acf_add_options_page' ) ) {
			acf_add_options_page( array(
				'page_title' => __( 'Theme Settings', THEME_DOMAIN ),
				'menu_title' => __( 'Theme Settings', THEME_DOMAIN ),
				'menu_slug'  => 'theme-options',
				'capability' => 'edit_posts',
				'redirect'   => false
			) );

			if ( function_exists( 'acf_add_local_field_group' ) ) {
				$acfConfig = ConfigHelper::getConfig( 'theme-options' );

				if ( $acfConfig ) {
					acf_add_local_field_group( $acfConfig );
				}
			}
		}
	}

	/**
	 * Add user profiles settings.
	 */
	public function addUserProfilesSettings() {
		if ( function_exists( 'acf_add_local_field_group' ) ) {
			$acfConfig = ConfigHelper::getConfig( 'users' );

			if ( $acfConfig ) {
				acf_add_local_field_group( $acfConfig );
			}
		}
	}
}
