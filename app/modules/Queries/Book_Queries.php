<?php

namespace App\Modules\Queries;

class Book_Queries {

	public function __construct() {
		add_action( 'pre_get_posts', [ $this, 'study_template_ad_filter' ] );
	}

	/**
	 * add some filters for meta_query | filter by books
	 *
	 * @param $query
	 */
	public function study_template_ad_filter( $query ) {
		if ( $query->is_post_type_archive( 'book' ) && ! is_admin() ) {
			if ( ! empty( $_GET ) ) {
				$author = sanitize_text_field( $_GET['author'] );
				$args   = [
					'relation' => 'AND',
					[
						'relation' => 'OR',
						[
							'key'   => 'genres',
							'value' => ! empty( $_GET['genres'] ) ? $_GET['genres'] : '',
						],
						[
							'key'     => 'date_of_book_write',
							'value'   => ! empty( $_GET['date_of_book_write'] ) ? [
								$_GET['date_of_book_write']['min'],
								1 + $_GET['date_of_book_write']['max']
							] : '', //TODO else Condition
							'compare' => 'BETWEEN',
//                        'type' => 'DATE', //Doesn't work :(... doesn't print request with inclusive value
						],
					],
					[
						'key'     => 'author',
						'value'   => ! empty( $author ) ? $author : '',
						'compare' => 'LIKE',
					],

				];
				$query->set( 'meta_query', $args );
			}
		}
	}
}