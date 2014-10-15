<?php
add_action( 'after_slider', 'prepare_slider' );
function prepare_slider(){
	$featured = (int) count( get_option( 'sticky_posts' ) );
	// jQuery code begin for the slider ?>
<script>
( function( $ ){
	var slider = jQuery( '.bxslider' );
	var slide = jQuery( 'div.slide' );
	// begin the slider
	slider.bxSlider({
		'infiniteLoop': false,
		'pagerType': 'short',
		'pagerShortSeparator': ' | ',
		'minSlides': <?php echo $featured; ?>,
		'slideMargin': 100,
		'maxSlides': <?php echo $featured; ?>,
	});
})( jQuery );
</script>
<?php } // end jQuery code

add_action( 'before_slider', 'slider_css' );
function slider_css(){ ?>
<style>
	.bx-wrapper{
		padding: 60px 0;
	}	
	.bxslider .slide {
		width: 80%;
	}
	.bxslider .bx-controls-direction {
		clear: both;
		overflow: hidden;
	}
	.bx-prev {
		float: left;
	}
	.bx-next {
		float: right;
	}
</style>
<?php } // slider_css


do_action( 'before_slider' );
/**
 * Slider template used for front-page
 */
$featured = get_posts( 
	array(
	'posts_per_page' => 3,
	'include' => get_option( 'sticky_posts' ),
	'orderby' => 'rand'
	)
 );
echo '<ul id="my-slider" class="bxslider">';
foreach( $featured as $feature ){
	setup_postdata( $feature );
	$link = esc_url( get_permalink( $feature->ID ) );
	$cont = sprintf( '<span class="featured-link"><a href="%s">' . __( 'Read: ', 'nopasera' ) . $feature->post_title . '</a></span>', $link );
	$postinfo = sprintf( '<h3 class="featured-post">%s</h3><div class="featured-content"><p>%s</p></div>%s', $feature->post_title, get_the_excerpt(), $cont );
	printf( '<li><div class="slide">%s</div></li>\n', $postinfo );
}
echo '</ul>';
wp_reset_postdata();
do_action( 'after_slider' );