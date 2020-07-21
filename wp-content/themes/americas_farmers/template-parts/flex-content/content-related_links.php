<?php
/**
*
* Component for Related Links. Includes list of page links selected.
*
**/
?>
<?php
  $posts = get_sub_field('related_links_selection');
  if( $posts ): ?>
    <div class="related-links flex-content-section">
      <div class="container">
        <h3>Related Links</h3>
        <ul>
          <?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
              <?php setup_postdata($post); ?>
              <li>
                  <h4 class="related-link__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                  <span class="related-link__excerpt"><?php short_excerpt(get_the_excerpt(), get_the_ID()); ?></span>
                  <a href="<?php the_permalink(); ?>" class="special-link" aria-label="<?php the_title(); ?>">Read More</a>
              </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
<?php endif; ?>
