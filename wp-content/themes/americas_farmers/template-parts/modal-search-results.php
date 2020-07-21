<?php
/** Template part for Search Modal results
*
*/
?>

<a href="<?php the_permalink();?>" class="result-card">
  <div class="results-header">
    <div class="results-header-text">
      <?php if ( get_post_type() === 'post' ) { ?>
        <div class="results-section">Stories</div>
      <?php } else if ( get_post_ancestors( get_the_ID() ) > 0  &&  !empty(get_post_ancestors( get_the_ID() )) ) {
        //If it's not a Post, get the Parent page to output its section
        $postParent = get_post_ancestors( get_the_ID() );
        $postParentTitle = get_the_title( $postParent[0] );?>
        <div class="results-section"><?php echo $postParentTitle; ?> </div>
      <?php } else {
        //leave empty I guess
      } ?>
      <h2><?php the_title(); ?></h2>
    </div>
    <?php
    if ( get_the_post_thumbnail() ) {
      $relatedBgImg = get_post_thumbnail_id();
      $relatedBgImgSize = 'medium';
      ?>
      <div class="thumbnail"><?php echo wp_get_attachment_image( $relatedBgImg, $relatedBgImgSize ); ?></div>
  <?php } ?>
  </div>
  <?php if ( has_excerpt() ) { ?>
    <p><?php the_excerpt(); ?></p>
  <?php } ?>

  <p class="special-link">Read More</p>
</a>


