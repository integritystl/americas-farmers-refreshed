<?php
/**
*
* Component for adding a Block Quote to Posts. Colors for citation and quote marks are based on what Program the Post is associated with
*
**/

?>
<div class="post-block-quote">
  <div class="container">
    <blockquote>
      <div class="quote">
        <?php the_sub_field('post_block_quote'); ?>
      </div>

      <?php if ( get_sub_field('post_block_quote_citation') ) { ?>
          <cite><?php the_sub_field('post_block_quote_citation'); ?></cite>
      <?php } ?>
    </blockquote>
  </div>
</div>
