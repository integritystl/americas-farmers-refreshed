<?php
/**
*
* Partial used to pull in Posts/Stories. Used for Recent Stories Component and Stories List template
*
**/
?>

  <?php
      //Need to count posts to add certain markup for styling

    $postCat = get_the_category();
    $postCatName = $postCat[0]->slug;

    $programText = '';
    $programClass = '';
    if ($postCatName === 'grow-communities') {
      $programText = 'GROW <span>Communities</span>';
      $programClass = 'communities';
    } else if ($postCatName === 'grow-rural-education') {
      $programText = 'GROW <span>Rural Education</span>';
      $programClass = 'rural';
    } else if ($postCatName === 'grow-ag-leaders') {
      $programText = 'GROW <span>Ag Leaders</span>';
      $programClass = 'leaders';
    }
    //vertical-card-group
    ?>
        <div class="post-card animated zoomIn">
          <div class="post-image">
            <?php
              if ( get_the_post_thumbnail() ) {
                $relatedBgImg = get_post_thumbnail_id();
                $relatedBgImgSize = 'related_stories';
                ?>
                <a href="<?php the_permalink(); ?>" aria-label="Read more: <?php the_title(); ?>"><?php echo wp_get_attachment_image( $relatedBgImg, $relatedBgImgSize ); ?></a>
          <?php } ?>
          </div>
          <div class="post-content">
            <div class="post-program <?php echo $programClass; ?>"><a href="/stories?category=<?php echo $postCatName; ?>"><?php echo $programText; ?></a></div>
            <h4>
              <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h4>
            <a href="<?php the_permalink(); ?>" class="special-link <?php echo $programClass; ?>" aria-label="Read more: <?php the_title(); ?>">Read More</a>
          </div>
        </div>

<?php
