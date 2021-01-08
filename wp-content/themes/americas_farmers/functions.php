<?php
/**
 * americas_farmers functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package americas_farmers
 */
//Load our composer packages
require_once ( __DIR__ . '/theme_infrastructure/vendor_packages/autoload.php');
//SF Stuff
require_once ( __DIR__ . '/theme_infrastructure/SalesForceAPI/SalesforceAPICalls.php');
require_once ( __DIR__ . '/theme_infrastructure/ACF/ACFTemplateFields.php');
require_once ( __DIR__ . '/theme_infrastructure/ACF/ACFOptionsPage.php');
require_once ( __DIR__ . '/theme_infrastructure/CustomPostTypes/ProgramCPT.php');
require_once ( __DIR__ . '/theme_infrastructure/CustomPostTypes/GALWinnerCPT.php');
require_once ( __DIR__ . '/theme_infrastructure/ACF/ACFHeaderSettings.php');
require_once ( __DIR__ . '/theme_infrastructure/ACF/ACFHeroFields.php');
require_once ( __DIR__ . '/theme_infrastructure/ACF/ACFPostFields.php');
require_once ( __DIR__ . '/theme_infrastructure/Services/helpers.php');
require_once ( __DIR__ . '/theme_infrastructure/Services/FinalistsParser.php');

//Add our ACF template fields and custom post types and what not
if( ! function_exists('americas_farmers_theme_infrastructure_setup')){
	function americas_farmers_theme_infrastructure_setup(){
		\AmericasFarmers\ACFTemplateFields::setupTemplateFields();
		\AmericasFarmers\ACFOptionsPage::setupOptionsPage();
		\AmericasFarmers\ACFHeaderSettings::setupHeaderSettings();
		\AmericasFarmers\ProgramCPT::setupPrograms();
		\AmericasFarmers\GALWinnerCPT::setupGALWinners();
		\AmericasFarmers\ACFHeroFields::setupHeroFields();
		\AmericasFarmers\ACFPostFields::setupPostFields();
		\AmericasFarmers\SalesforceAPICalls::setSalesforceACFFields();
		//\AmericasFarmers\SalesforceAPICalls::getWinners('GrowCommunities', '2017', 'AL');
	}
}
add_action('init', 'americas_farmers_theme_infrastructure_setup');

if ( ! function_exists( 'americas_farmers_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function americas_farmers_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on americas_farmers, use a find and replace
		 * to change 'americas_farmers' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'americas_farmers', get_template_directory() . '/languages' );

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

		//Add image sizes for the Recent Posts/Related Posts
		add_image_size( 'related_stories', 850, 654, true );
		add_image_size( 'related_stories_tablet', 1450, 680, true );

		add_image_size( 'stories_feed_horizontal', 1040, 810, true );
		add_image_size( 'stories_feed_vertical', 800, 600, true );
		add_image_size( 'stories_feed_tablet', 1450, 870, true );
		add_image_size( 'stories_feed_mobile', 440, 330, true );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'americas_farmers_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'americas_farmers_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function americas_farmers_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'americas_farmers_content_width', 640 );
}
add_action( 'after_setup_theme', 'americas_farmers_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function americas_farmers_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'americas_farmers' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'americas_farmers' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'americas_farmers_widgets_init' );

//Add State Custom Taxonomy for GAL Winners Post Type
function add_state_taxonomy() {
    $args = array (
        'labels' => array(
            'name' => 'State',
            'singular_name' => 'State',
            'all_items' => 'All State Categories',
            'edit_item' => 'Edit State Categories',
            'view_item' => 'View State Category',
            'update_item' => 'Update State Category',
            'add_new_item' => 'Add New State Category',
        ),
        'show_ui' => true,
        'show_in_nav_menus' => false,
        'hierarchical' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
        'capabilities' => array(
            'manage_terms', 'edit_terms', 'delete_terms', 'assign_terms'
        ),

    );
    register_taxonomy('state_category', array('gal_winners'), $args);

}
add_action('init', 'add_state_taxonomy', 10);

/**
 * Enqueue scripts and styles.
 */
function americas_farmers_scripts() {
	wp_register_script('americas_farmers_scripts', get_template_directory_uri() . '/dist/app.js', array('jquery'), time(), true);
	wp_localize_script('americas_farmers_scripts', 'wpAjax', array(
		'ajaxurl' => admin_url('admin-ajax.php'),
		'api_nonce' => wp_create_nonce( 'wp_rest' ),
		'api_url' => home_url('/wp-json/rest/v1/'),
	));


	wp_enqueue_style( 'americas_farmers-style_animate', '//cdn.jsdelivr.net/npm/animate.css@3.5.2/animate.min.css');



	//For the Slick JS image slider used on My Town
	//wp_enqueue_style( 'americas_farmers-style_slick', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css');
	//wp_register_script('americas_farmers_slick', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array('jquery'), true);
	//wp_enqueue_script('americas_farmers_slick');

	//For the Animations
	wp_enqueue_style( 'americas_farmers-style_animate', '//cdn.jsdelivr.net/npm/animate.css@3.5.2/animate.min.css');

	wp_enqueue_style( 'americas_farmers-style', get_stylesheet_uri(), array(), time());


	wp_enqueue_script('americas_farmers_scripts');
	wp_enqueue_script('parsley', get_template_directory_uri() . '/js/libs/parsley.min.js', array('jquery'), time(), true);
	wp_enqueue_script('phone-mask', get_template_directory_uri() . '/js/libs/jquery-input-mask-phone-number.min.js', array('jquery'), time(), true);

	wp_enqueue_script('teacher-application', get_template_directory_uri() . '/js/src/components/teacher_application_form.js', array('jquery'), time(), true);

}
add_action( 'wp_enqueue_scripts', 'americas_farmers_scripts' );

//Custom styles for WP Login page
//Vanilla CSS since there's not much in it
function americas_farmers_login_styles() {



  wp_enqueue_style( 'americas_farmers-login', get_template_directory_uri() . '/style-login.css' );
}
add_action( 'login_enqueue_scripts', 'americas_farmers_login_styles');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}
//SVG Support in Media Uploader
function add_file_types_to_uploads($file_types){
	$new_filetypes = array();
	$new_filetypes['svg'] = 'image/svg+xml';
	$file_types = array_merge($file_types, $new_filetypes );
	return $file_types;
}
add_action('upload_mimes', 'add_file_types_to_uploads');

/**
*
* Helper Functions
*
**/
function getProgramPhase($id)
{
	return \AmericasFarmers\ProgramCPT::getProgramPhase($id);
}

//Get Top-most Parent Page ID of Page; helps with Subnav conditional
function getTopParentID() {
	$post = get_post();
	if ( is_page() && $post->post_parent ) {
	 $subpageParent = get_post_ancestors( get_the_ID() );
	 $topParentID = $subpageParent[count($subpageParent) - 1];
	 return $topParentID;
	} else {
		return false;
	}
}

//Function to check if current page has children; helps with Subnav conditionals
function has_children() {
	global $post;
	return count( get_posts( array('post_parent' => $post->ID, 'post_type' => $post->post_type) ) );
}

//Ajax endpoints for Salesforce shenanigans
add_action( 'wp_ajax_get_winners', 'getWinners' );
add_action( 'wp_ajax_nopriv_get_winners', 'getWinners' );

add_action( 'wp_ajax_get_finalists', 'getFinalists' );
add_action( 'wp_ajax_nopriv_get_finalists', 'getFinalists' );

add_action( 'wp_ajax_get_nomination_by_state', 'getNominationByState' );
add_action( 'wp_ajax_nopriv_get_nomination_by_state', 'getNominationByState' );

add_action( 'wp_ajax_get_nomination_by_school', 'getNominationBySchoolId' );
add_action( 'wp_ajax_nopriv_get_nomination_by_school', 'getNominationBySchoolId' );

add_action( 'wp_ajax_get_community_enrollment_by_code', 'getCommunityEnrollmentByCode' );
add_action( 'wp_ajax_nopriv_get_community_enrollment_by_code', 'getCommunityEnrollmentByCode' );

add_action( 'wp_ajax_grow_community_enrollment_form', 'growCommunityEnrollmentForm' );
add_action( 'wp_ajax_nopriv_grow_community_enrollment_form', 'growCommunityEnrollmentForm' );

add_action( 'wp_ajax_get_rural_enrollment_by_code', 'getRuralEnrollmentByCode' );
add_action( 'wp_ajax_nopriv_get_rural_enrollment_by_code', 'getRuralEnrollmentByCode' );

add_action( 'wp_ajax_grow_rural_enrollment_form', 'growRuralEnrollmentForm' );
add_action( 'wp_ajax_nopriv_grow_rural_enrollment_form', 'growRuralEnrollmentForm' );

function getWinners(){
	$state = $_GET['state'];
	$program = $_GET['program'];
	$year = $_GET['year'];

	if ($program !== 'GrowAgLeaders') {
        $data = json_encode(\AmericasFarmers\SalesforceAPICalls::getWinners($program, $year, $state));
        wp_send_json_success($data);
    }
}

function getFinalists() {
	$state = sanitize_text_field($_GET['state']);
	$program = sanitize_text_field($_GET['program']);

	$data = json_encode(getFinalistsFromCSV($program, $state));
	wp_send_json_success($data);
}

function getNominationByState(){
	$state = $_GET['state'];
	$data = json_encode(\AmericasFarmers\SalesforceAPICalls::getNominationSchoolsList($state));
	wp_send_json_success($data);
}

function getNominationBySchoolId(){
	$schoolId = $_GET['schoolId'];
	$data = json_encode(\AmericasFarmers\SalesforceAPICalls::getNominationCount($schoolId));
	wp_send_json_success($data);
}

function getCommunityEnrollmentByCode(){
	$code = $_GET['code'];
	$data = json_encode(\AmericasFarmers\SalesforceAPICalls::GetGCEnrollmentByCode($code));
	wp_send_json_success($data);
}

function growCommunityEnrollmentForm()
{
	//$stuff = $_POST;
	//$data = json_encode($stuff);
	$data = json_encode(\AmericasFarmers\SalesforceAPICalls::GCEnrollmentSubmission());
	wp_send_json_success($data);
}

function getRuralEnrollmentByCode(){
	$code = $_GET['code'];
	$data = json_encode(\AmericasFarmers\SalesforceAPICalls::GetRuralEnrollmentByCode($code));
	wp_send_json_success($data);
}

function growRuralEnrollmentForm()
{
	//$stuff = $_POST;
	//$data = json_encode($stuff);
	$data = json_encode(\AmericasFarmers\SalesforceAPICalls::RuralEnrollmentSubmission());
	wp_send_json_success($data);
}

// Ajax endpoint for GAL winners
add_action( 'wp_ajax_nopriv_get_gal_winners', 'getGalWinners' );
add_action( 'wp_ajax_get_gal_winners', 'getGalWinners' );
function getGalWinners () {
    $state = '';
    if (isset($_GET['state'])) {
        $state = $_GET['state'];
	}

	//Get the year for the Ag Leaders program announcements from program CPT
    $programId = get_page_by_path('grow-ag-leaders', '', 'program')->ID;
    $displayYear = get_field('program_display_year', $programId);

    $args = array(
		'post_type' => "gal_winners",
		'meta_key' => 'gal_winner_year',
        'posts_per_page' => -1,
        'meta_value' => $displayYear,
        'tax_query' => array(
            array(
                'taxonomy' => 'state_category',
                'field' => 'slug',
                'terms' => $state
            )
        )
    );
    $data = new WP_Query($args);
    if( $data->have_posts() ):
        while( $data->have_posts() ): $data->the_post();
        $city = get_field('gal_winner_city');
        $ffa = get_field('gal_winner_FFA_chapter_name');
        $highSchool = get_field('gal_winner_FFA_high_school');
        $major = get_field('gal_winner_major');
        ?>
        <div class='winner_item has-arrow'>
            <div class='winner_item_top'>
                <h5><?php the_title(); ?></h5>
                <span><?php
                    if ($city) echo $city . ', ';
                    if ($state) echo $state; ?>
                </span>
                <i class='winners_internal_chevron fal fa-arrow-down' aria-hidden='true'></i>
            </div>
            <div class='winner_item_bottom'>
                <?php if ($major) { ?>
                    <h5><?php echo $major; ?></h5>
                <?php } ?>
                <?php if ($ffa) { ?>
                    <p><?php echo $ffa; ?></p>
                <?php }else if ($highSchool) { ?>
                    <p><?php echo $highSchool; ?></p>
                <?php } ?>
            </div>
        </div>
        <?php endwhile;
    else : ?>
        <p class='no_winners_blurb'>
            Unfortunately there are no winners for your state. The grant program opens again January 1, 2021. Tell a farmer to nominate a school in your area at <a href='http://www.AmericasFarmers.com'>www.AmericasFarmers.com</a>.
        </p>
    <?php endif;
    wp_reset_postdata();
    // Don't forget to stop execution afterward.
    wp_die();
}

/**
 * Custom AmericasFarmers : Allow Page Excerpts
 */

function AF_custom_pages() {
	add_post_type_support( 'page', 'excerpt' );
}
add_action( 'init', 'AF_custom_pages');

function short_excerpt($string, $id) {
	$excerpt = '<p>' . substr(strip_tags($string), 0, 150) . '</p>';
	echo $excerpt;
}
//Add the Post Category class to Body to help with Single styling of components
function add_category_to_single($classes) {
  if (is_single() ) {
    global $post;
    foreach((get_the_category($post->ID)) as $category) {
      // add category slug to the $classes array
      $classes[] = $category->category_nicename;
    }
  }
  // return the $classes array
  return $classes;
}
add_filter('body_class','add_category_to_single');

function getFinalistsFromCSV($program, $state = null){
	return \AmericasFarmers\FinalistsParser::getFinalists($program, $state);
}

//Add endpoint for Ajax search & use Relevanssi
add_action('rest_api_init', 'register_search_modal_endpoint');
function register_search_modal_endpoint() {
	register_rest_route('rest/v1', '/search_modal/', array(
		'methods' => 'GET',
		'callback' => 'search_modal_query',
		'args' => array (
			'search' => array (
				'required' => true,
				'default' => get_search_query()
			)
		)
	));
}

function search_modal_query($request) {
	$params = $request->get_params();
	$currentSearch = $params["search"];

	if ( is_plugin_active( 'relevanssi/relevanssi.php' ) || is_plugin_active('relevanssi-premium/relevanssi.php') ) {
		$searchQuery = new WP_Query();
		$searchQuery->query_vars['s'] = $currentSearch;
		$searchQuery->query_vars['posts_per_page'] = -1;
		relevanssi_do_query($searchQuery);
	} else {
		$args = array(
			'posts_per_page' => -1,
			's' => $currentSearch
		);
		$searchQuery = new WP_Query($args);
	}

	if ( $searchQuery->have_posts() ) :
		echo '<h2 class="results-number">' . $searchQuery->found_posts . ' Results</h2>';
		while ( $searchQuery->have_posts() ): $searchQuery->the_post();
			get_template_part('template-parts/modal', 'search-results');
		endwhile;
	else :
		echo '<div class="no-results">' . get_field('search_no_results_content', 'options') . '</div>';
	endif;
	die();
}
add_action('rest_api_init', 'register_blog_list_endpoint');
function register_blog_list_endpoint() {
    register_rest_route('rest/v1', '/post_list/', array(
      'methods' => 'GET',
      'callback' => 'ajax_filter_get_posts',
      'args' => array (
         'filter' => array (
            'required' => true,
            'default' => 'grow-communities'
            )
         )
      ));
}


function ajax_filter_get_posts($request) {
    $params = $request->get_params();
    $currentFilter = $params["filter"];

    $args = array(
	    'post_type' => 'post',
	    'posts_per_page' => 5,
	    'paged' => $params["page"],
    );

    if ($currentFilter !== 'all') {
        $args['category_name'] = $currentFilter;
    }

    $storiesQuery = new WP_Query( $args );

    if ( $storiesQuery->have_posts() ) :
        $postCount = 1;
    while ( $storiesQuery->have_posts() ) : $storiesQuery->the_post();
    //var_dump($storiesQuery);
    //Using a partial cuz these Posts appear the same on Stories Template
    include(locate_template('template-parts/content-posts-group.php'));
    $postCount++;
    endwhile;
    wp_reset_postdata();
    else:
        echo '<div class="no-results"><h2>No More Stories Found.</h2></div>';

    endif;
    die();
}

add_action( 'wp_ajax_filter_posts', 'ajax_filter_get_posts' );

function contact_us_form_scripts() {
	wp_register_script('contact_us', get_template_directory_uri() . '/js/src/components/contact_us_form.js' , array('jquery'), true);
	wp_enqueue_script('contact_us');
  }

  add_action( 'wp_enqueue_scripts', 'contact_us_form_scripts' );

//Add some extra classes to Gravity Forms to target labels better for animation
add_filter( 'gform_field_css_class', 'extra_classes', 10, 3 );
function extra_classes( $classes, $field, $form ) {
	//var_dump($field->inputs);
	if ($field->isRequired == 'true' && $field->type == 'name') {

	}
	if ( $field->type == 'email' || $field->type == 'text' ) {
        $classes .= ' animate-text';
	}
    if ( $field->type == 'textarea' ) {
        $classes .= ' animate-textarea';
	}
	if ( $field->type == 'select' ) {
        $classes .= ' select-container';
    }
    return $classes;
}
