<?php
// Template partial for the Search Modal
?>

<div id="search-modal" role="dialog">
  <div class="search-container" id="search-container">
    <span class="close-search far fa-times" aria-label="Close Search"></span>
    <div class="search-bar-container">
      <label for="search-modal-input" class="screen-reader-text">Search Site</label>
      <input type="search" placeholder="Begin typing search" class="search-modal-input" id="search-modal-input" role="search" />
      <span class="fa fa-search"></span>
      <button id="search-clear" class="search-clear fa fa-times-circle no-arrow" aria-label="Clear Search"></button>
    </div>
    <div class="loading_spinner">
      <div class="lds-ring dark-ring"><div></div><div></div><div></div><div></div></div>
    </div>
    <div class="search-results-container">
      <div class="search-results">

        <?php
          $recentPostsArgs = array(
            'post_type' => 'post',
            'posts_per_page' => 6,
            'category_name' => 'Featured',
          );

          $recentPostsQuery = new WP_Query($recentPostsArgs);

          if ($recentPostsQuery->have_posts()) :
            $postCount = 1;
            while( $recentPostsQuery->have_posts() ) : $recentPostsQuery->the_post();
              //Using a partial cuz these Posts appear the same on Stories Template & need locate_template to share the variable
              include(locate_template('template-parts/content-posts-group.php'));
            $postCount++;
            endwhile;
            wp_reset_postdata();
          endif;
        ?>
      </div>
    </div>
  </div>
</div>
