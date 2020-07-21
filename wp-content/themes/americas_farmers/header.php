<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package americas_farmers
 */
/**
*
**/


 //Current Page ID/Parent to reference for active class before we start our loop for Post Object
 $currentPageID = get_the_ID();
 $currentPageParent = getTopParentID();


// Display a page parent's slug
$post_data = get_post($post->post_parent);
$post_slug = get_post($post->post_name);
$parent_slug = $post_data->post_name;

if ( $post_slug || $parent_slug == 'grow-communities') {
  $parentSlug = 'communities';
} elseif ( $post_slug || $parent_slug == 'grow-ag-leaders') {
  $parentSlug = 'ag-leaders';
} elseif ( $post_slug || $parent_slug == 'grow-rural-education') {
  $parentSlug = 'rural-education';
}

?>

<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<!-- Google Tag Manager -->

	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-WQJRCHM');</script>
	<!-- End Google Tag Manager -->
	<meta name="google-site-verification" content="nBmhpbo5lRxZYDBPgdW0HBNywY2HKIXEXRuZ2sXu4Gs" />

	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_stylesheet_directory_uri(); ?>/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon-16x16.png">
  <link rel="stylesheet" type="text/css" href="https://cloud.typography.com/6016856/6740192/css/fonts.css" />
  <link rel="manifest" href="/manifest.json">
	<?php wp_head(); ?>

    <!-- Facebook Pixel Code -->
    <script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window,document,'script',
        'https://connect.facebook.net/en_US/fbevents.js';);
    fbq('init', '1124166674325905');
    fbq('track', 'PageView');
    </script>
    <noscript>
    <img height="1" width="1" src="https://www.facebook.com/tr?id=1124166674325905&ev=PageView&noscript=1"/>
    </noscript>

    <!-- End Facebook Pixel Code -->

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.13.0/css/all.css" integrity="sha384-IIED/eyOkM6ihtOiQsX2zizxFBphgnv1zbe1bKA+njdFzkr6cDNy16jfIKWu4FNH" crossorigin="anonymous">

</head>

<body <?php body_class(); ?>>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WQJRCHM"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<!--    Check if it is the Thank You page (using page title) -->
<?php if (get_the_title() === 'Thank You For Submitting To Grow Communities'):?>
    <!-- Facebook Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window,document,'script',
            'https://connect.facebook.net/en_US/fbevents.js';);
        fbq('init', '1124166674325905');
        fbq('track', 'CompleteRegistration');
    </script>

    <noscript>
        <img height="1" width="1" src="https://www.facebook.com/tr?id=1124166674325905&ev=PageView&noscript=1"/>
    </noscript>
    <!-- End Facebook Pixel Code -->
<?php endif; ?>

<div id="page" class="site <?php echo $parentSlug; ?>">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'americas_farmers' ); ?></a>

	<header id="masthead" class="site-header">
        <div id="stickyHeader">
			<div class="container">
	            <div class="main-header">
	            	<div id="mobile-menu-toggle" class="menu-toggle">
	            		<div>
	            			<span></span>
	                        <span></span>
	                        <span></span>
	            		</div>
                    </div><!-- .mobile-navigation -->
	                <div class="site-branding">
						<div class="site-logo">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
								<span><?php the_field('logo_text_first', 'option'); ?></span>
								<span><?php the_field('logo_text_second', 'option'); ?></span>
							</a>
						</div>
					</div>
					<div class="main-nav">
						<nav id="site-navigation" class="main-navigation">
							<?php
								wp_nav_menu( array(
								'theme_location' => 'primary-menu',
								'menu_id'        => 'primrary-menu',
							) );
							?>
						</nav><!-- #site-navigation -->
					</div>
					<div class='search'>
						<button id="search-trigger" aria-label="Search Site" class="btn-header header-search no-arrow">
							<span class="fa fa-search"></span>
						</button>
					</div>
	            </div>
	            <!-- This is displaying the subnav on only pages with children -->
            	<?php
	            	if ($post->post_parent) {
					        $ancestors=get_post_ancestors($post->ID);
					        $root=count($ancestors)-1;
					        $parent = $ancestors[$root];
					} else {
					        $parent = $post->ID;
					}

					$children = get_pages('child_of='.$parent);
					$child_pages = array(1);

					foreach($children as $child) {
					    array_push($child_pages,$child->ID);
					}
					$all_pages = implode(",",$child_pages);

					if( count( $children ) != 0 ) {
					echo '<div class="subnav">'.'<ul class="sidebar-navigation">'.
					    wp_list_pages( 'title_li=&sort_column=menu_order&echo=0&include='.$all_pages )
					    .'</ul>'.'</div>';
					}
				?>
	        </div>
	    </div>
	    <div class="mobile-nav">
	    	<nav id="site-navigation" class="main-navigation">
				<?php
					wp_nav_menu( array(
					'theme_location' => 'mobile-menu',
					'menu_id'        => 'mobile-menu',
				) );
				?>
			</nav><!-- #mobile-navigation -->
	    </div>

	</header><!-- #masthead -->



<!-- MIGHT NEED TO STRIP THIS LATER WHEN RE-WORK Heros -->
<?php

  //Partial for Hero unit
  if (!is_404() ) {
      get_template_part('template-parts/content', 'hero');
  }
  //if there's no Hero component being used, add a class to space out header
  if( have_rows('hero_flexible_content', get_the_ID()) && !is_404() ) {
  ?>
	 <div id="content" class="site-content">
  <?php } else { ?>
    <div id="content" class="site-content no-hero">
  <?php }

?>
