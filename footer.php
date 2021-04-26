<?php wp_footer(); ?>
<!--</div>-->
<div class="col-10">
	<?php
	$args = array(
		'show_all'           => false,
		'end_size'           => 1,
		'mid_size'           => 1,
		'prev_next'          => true,
		'prev_text'          => __( '« Previous' ),
		'next_text'          => __( 'Next »' ),
		'add_args'           => false,
		'add_fragment'       => null,
		'screen_reader_text' => ' ',
	);
	the_posts_pagination( $args );
	?>
</div>
</main>
<footer class="footer d-flex flex-column justify-content-center pt-3 pb-3">
    <h2>footer</h2>
</footer>
</body>
</html>