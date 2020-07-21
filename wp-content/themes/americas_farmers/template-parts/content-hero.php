
<?php
// Template partial that grabs the Hero Flex fields. Set so that hero is always at the top.



if(have_rows('hero_flexible_content', get_the_ID())):
  while(have_rows('hero_flexible_content')): the_row();
    include(locate_template('template-parts/flex-content/hero-' . get_row_layout() . '.php'));
  endwhile;
endif;
?>
