<?php
/**
*
* Component for Step by Step callout. Includes number counter and step content.
*
**/
$stepSectionHeadline = get_sub_field('step_header');
$stepSectionContent = get_sub_field('step_content');
?>

<div class="step-by-step flex-content-section">
  <div class="container">
    <?php if($stepSectionHeadline):?>
      <h2><?php echo $stepSectionHeadline; ?></h2>
    <?php endif; ?>

    <?php if($stepSectionContent):
      echo $stepSectionContent;
    endif; ?>
    <div class="step-wrapper">
      <?php if( have_rows('steps') ): ?>

          <?php while ( have_rows('steps') ) : the_row();
            $stepNumber = get_sub_field('step_number');
            $stepContent = get_sub_field('step_content');
          ?>
        <div class="step">
          <div class="numbers">
            <div class="number"><?php echo $stepNumber ?></div>
            <p>step</p>
          </div>
          <div class="step-content">
            <?php echo $stepContent ?>
          </div>
        </div>
          <?php endwhile;?>
       <?php endif; ?>
    </div>
  </div>
</div>
