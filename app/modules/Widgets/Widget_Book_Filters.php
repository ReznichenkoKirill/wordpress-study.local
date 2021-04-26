<?php

namespace App\Modules\Widgets;

use WP_Widget;

class Widget_Book_Filters extends WP_Widget {

	public function __construct() {
		parent::__construct( 'custom_widget', 'Custom Widget',
			[ 'description' => 'Widget for sort book by custom fields' ] );

		add_action( 'widgets_init', array( $this, 'my_widgets_register' ) );
	}

	// Вывод виджета
	public function widget( $args, $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		echo $args['before_widget'];
		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		echo "<h2 class='text-center'>$this->name</h2>";
		get_search_form();

		echo $args['after_widget'];
	}


	// Сохранение настроек виджета (очистка)
	public function update( $new_instance, $old_instance ) {
	}

	// html форма настроек виджета в Админ-панели
	public function form( $instance ) {
	}

	public function my_widgets_register() {

		register_widget( Widget_Book_Filters::class );
	}


}