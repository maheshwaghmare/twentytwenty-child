<?php
/**
 * Twenty Twenty Child Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Twenty Twenty Child
 * @since 1.0.0
 */

/**
 * Enqueue styles
 */
function twentytwenty_child_enqueue_styles() {
    wp_enqueue_style( 'twentytwenty-style', get_template_directory_uri() . '/style.css' );
    wp_style_add_data( 'twentytwenty-style', 'rtl', 'replace' );

    wp_enqueue_style( 'twenty-twenty-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( 'twentytwenty-style' ),
        wp_get_theme()->get('Version')
    );
    wp_style_add_data( 'twenty-twenty-child-style', 'rtl', 'replace' );
}

add_action( 'wp_enqueue_scripts', 'twentytwenty_child_enqueue_styles' );

/**
 * Register widget areas.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function twentytwenty_child_sidebar_registration() {

	// Arguments used in all register_sidebar() calls.
	$shared_args = array(
		'before_title'  => '<h2 class="widget-title subheading heading-size-4">',
		'after_title'   => '</h2>',
		'before_widget' => '<div class="widget %2$s"><div class="widget-content">',
		'after_widget'  => '</div></div>',
	);

	// Footer #3.
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => __( 'Footer #3', 'twentytwenty' ),
				'id'          => 'sidebar-3',
				'description' => __( 'Widgets in this area will be displayed in the first column in the footer.', 'twentytwenty' ),
			)
		)
	);

	// Footer #4.
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => __( 'Footer #4', 'twentytwenty' ),
				'id'          => 'sidebar-4',
				'description' => __( 'Widgets in this area will be displayed in the second column in the footer.', 'twentytwenty' ),
			)
		)
	);

}

add_action( 'widgets_init', 'twentytwenty_child_sidebar_registration' );


add_filter( 'twentytwenty_post_meta_location_single_top', 'twentytwenty_child_post_meta_location_single_top' );

function twentytwenty_child_post_meta_location_single_top( $items = array() ) {
	if( ! empty( $items ) ) {
		foreach ($items as $key => $item) {
			if( 'author' === $item ) {
				unset( $items[ $key ] );
			}
		}
	}
	return $items;
}

add_filter( 'twentytwenty_start_of_post_meta_list', 'twentytwenty_child_start_of_post_meta_list' );

function twentytwenty_child_start_of_post_meta_list() {
	?>
	<li class="post-author meta-wrapper">
		<span class="meta-icon">
			<span class="screen-reader-text"><?php _e( 'Post author', 'twentytwenty' ); ?></span>
			<?php echo get_avatar( get_the_author_meta( 'ID' ), 20 ); ?>
		</span>
		<span class="meta-text">
			<?php
			printf(
				/* translators: %s: Author name */
				__( 'By %s', 'twentytwenty' ),
				'<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author_meta( 'display_name' ) ) . '</a>'
			);
			?>
		</span>
	</li>
	<?php
}