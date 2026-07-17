<?php
if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}
if (!class_exists('Elanding')) {
    require_once(__DIR__ . '/elanding.php');
    new Elanding();
}

//enqueue
function elanding_scripts() {
	wp_enqueue_style( 'elanding-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );

	wp_style_add_data( 'elanding-style', 'rtl', 'replace' );
	wp_enqueue_script( 'font.fontawesome', 'https://use.fontawesome.com/ee8428b9eb.js', array(), true, false );
	wp_enqueue_style( 'bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css', array(), true, false );
	wp_enqueue_style( 'slick', get_theme_file_uri( '/assets/js/slick/slick.css' ), array(), true, false );
	wp_enqueue_style( 'slick-theme', get_theme_file_uri( '/assets/js/slick/slick-theme.css' ), array(), true, false );
    wp_enqueue_style( 'font-roboto.min', 'https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,900;1,100;1,300;1,400&display=swap', array(), true, false );
    wp_enqueue_style( 'font-montserrat.min', 'https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,900;1,100&display=swap', array(), true, false );
    

    wp_enqueue_style( 'style-css', get_template_directory_uri() . '/assets/css/style.css', array(), true, false );
	wp_enqueue_script( 'popper', 'https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js', array('jquery'), false, true );
	wp_enqueue_script( 'bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js', array('jquery'), false, true );
	wp_enqueue_script( 'slick', get_theme_file_uri( '/assets/js/slick/slick.min.js' ), array('jquery'), false, true );
    wp_enqueue_script( 'main', get_theme_file_uri( '/assets/js/main.js' ), array('jquery'), false, true );
    wp_localize_script( 'jquery', 'eld_params', [
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'home_url' => home_url('/'),
        '_s'       => wp_create_nonce( '_wpnonce_security' ),
    ] );
}

add_action('elanding_scripts','elanding_scripts',9);

function elanding_scripts_action(){
	do_action( 'elanding_scripts' );
}

add_action( 'wp_enqueue_scripts', 'elanding_scripts_action' );


function elanding_load_template($slug, $name = false, $data = array())
{
    $template_dir = 'views';
    if (is_array($data))
        extract($data);

    if ($name) {
        $slug = $slug . '-' . $name;
    }
    $template = locate_template($template_dir . '/' . $slug . '.php');
    if (is_file($template)) {
        ob_start();
        include $template;
        $data = @ob_get_clean();
        return $data;
    }
}
function elanding_path_info($path = '', $return = '')
{
    if ($return == 'dir') {
        $pathinfo = pathinfo($path);
        $result = $pathinfo['dirname'];
    } else {
        $pathinfo = pathinfo($path);
        $result = $pathinfo['basename'];
    }

    return $result;
}
function elanding_get_elementor_content($page_id)
{
    if (class_exists('Elementor\Plugin')) {
        return \Elementor\Plugin::$instance->frontend->get_builder_content($page_id);
    }
    return '';
}

if ( ! function_exists( 'elanding_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function elanding_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Twenty Nineteen, use a find and replace
		 * to change 'elanding' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'elanding', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1568, 9999 );
		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
				'primary'      => __( 'Primary', 'elanding' ),
				'account-menu' => __( 'Account Menu', 'elanding' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'script',
				'style',
				'navigation-widgets',
			)
		);

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 56,
				'width'       => 56,
				'flex-width'  => false,
				'flex-height' => false,
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Enqueue editor styles.
		add_editor_style( 'style-editor.css' );

		// Add custom editor font sizes.
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => __( 'Small', 'elanding' ),
					'shortName' => __( 'S', 'elanding' ),
					'size'      => 19.5,
					'slug'      => 'small',
				),
				array(
					'name'      => __( 'Normal', 'elanding' ),
					'shortName' => __( 'M', 'elanding' ),
					'size'      => 22,
					'slug'      => 'normal',
				),
				array(
					'name'      => __( 'Large', 'elanding' ),
					'shortName' => __( 'L', 'elanding' ),
					'size'      => 36.5,
					'slug'      => 'large',
				),
				array(
					'name'      => __( 'Huge', 'elanding' ),
					'shortName' => __( 'XL', 'elanding' ),
					'size'      => 49.5,
					'slug'      => 'huge',
				),
			)
		);

		// Editor color palette.
		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'  => 'default' === get_theme_mod( 'primary_color' ) ? __( 'Blue', 'elanding' ) : null,
					'slug'  => 'primary',
					'color' => elanding_hsl_hex( 'default' === get_theme_mod( 'primary_color' ) ? 199 : get_theme_mod( 'primary_color_hue', 199 ), 100, 33 ),
				),
				array(
					'name'  => 'default' === get_theme_mod( 'primary_color' ) ? __( 'Dark Blue', 'elanding' ) : null,
					'slug'  => 'secondary',
					'color' => elanding_hsl_hex( 'default' === get_theme_mod( 'primary_color' ) ? 199 : get_theme_mod( 'primary_color_hue', 199 ), 100, 23 ),
				),
				array(
					'name'  => __( 'Dark Gray', 'elanding' ),
					'slug'  => 'dark-gray',
					'color' => '#111',
				),
				array(
					'name'  => __( 'Light Gray', 'elanding' ),
					'slug'  => 'light-gray',
					'color' => '#767676',
				),
				array(
					'name'  => __( 'White', 'elanding' ),
					'slug'  => 'white',
					'color' => '#FFF',
				),
			)
		);

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Add support for custom line height.
		add_theme_support( 'custom-line-height' );
	}
endif;
add_action( 'after_setup_theme', 'elanding_setup' );
function elanding_hsl_hex( $h, $s, $l, $to_hex = true ) {

	$h /= 360;
	$s /= 100;
	$l /= 100;

	$r = $l;
	$g = $l;
	$b = $l;
	$v = ( $l <= 0.5 ) ? ( $l * ( 1.0 + $s ) ) : ( $l + $s - $l * $s );

	if ( $v > 0 ) {
		$m       = $l + $l - $v;
		$sv      = ( $v - $m ) / $v;
		$h      *= 6.0;
		$sextant = floor( $h );
		$fract   = $h - $sextant;
		$vsf     = $v * $sv * $fract;
		$mid1    = $m + $vsf;
		$mid2    = $v - $vsf;

		switch ( $sextant ) {
			case 0:
				$r = $v;
				$g = $mid1;
				$b = $m;
				break;
			case 1:
				$r = $mid2;
				$g = $v;
				$b = $m;
				break;
			case 2:
				$r = $m;
				$g = $v;
				$b = $mid1;
				break;
			case 3:
				$r = $m;
				$g = $mid2;
				$b = $v;
				break;
			case 4:
				$r = $mid1;
				$g = $m;
				$b = $v;
				break;
			case 5:
				$r = $v;
				$g = $m;
				$b = $mid2;
				break;
		}
	}

	$r = round( $r * 255, 0 );
	$g = round( $g * 255, 0 );
	$b = round( $b * 255, 0 );

	if ( $to_hex ) {

		$r = ( $r < 15 ) ? '0' . dechex( $r ) : dechex( $r );
		$g = ( $g < 15 ) ? '0' . dechex( $g ) : dechex( $g );
		$b = ( $b < 15 ) ? '0' . dechex( $b ) : dechex( $b );

		return "#$r$g$b";

	}

	return "rgb($r, $g, $b)";
}
//Widget
function eld_prefix(){
	return 'eld_';
}

function eld_get_setting($theme_mod_name = '', $default = false)
{
    $get_theme_mod = apply_filters('stt_setting_' . eld_prefix('prefix') . $theme_mod_name, get_theme_mod(eld_prefix('prefix') . $theme_mod_name, $default));
    return $get_theme_mod;
}
function eld_title_excerpt($limit){
    $excerpt = explode(' ', get_the_title(), $limit);
    if (count($excerpt)>=$limit) {
        array_pop($excerpt);
        $excerpt = implode(" ",$excerpt).'.';
    } else {
        $excerpt = implode(" ",$excerpt);
    } 
    $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
    return $excerpt;
}
function elanding_widgets_init() {

	register_sidebar(
		array(
			'name'          => __( 'Sidebar', 'elanding' ),
			'id'            => 'sidebar',
			'description'   => __( 'Add widgets here to appear in your sidebar.', 'elanding' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	// Footer Sidebar

    register_sidebar([
        'name' => esc_html__('Footer 1', 'elanding'),
        'id' => 'footer-1-sidebar',
        'description' => esc_html__('Widgets in this area will be shown on the left side of the Footer', 'elanding'),
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
        'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
        'after_widget' => '</div>',
    ]);

	register_sidebar([
        'name' => esc_html__('Footer 2', 'elanding'),
        'id' => 'footer-2-sidebar',
        'description' => esc_html__('Widgets in this area will be shown on the left side of the Footer', 'elanding'),
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
        'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
        'after_widget' => '</div>',
    ]);

}
add_action( 'widgets_init', 'elanding_widgets_init' );