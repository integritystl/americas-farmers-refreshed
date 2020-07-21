<?php
/**
*
* Component for the FAQ Section. Includes repeater for Question/Answer.
*
**/

$FAQsectionHeadline = get_sub_field('faq_section_title');
$FAQsectionSubHeadline = get_sub_field('faq_section_subtitle');
$faqContent = get_sub_field('faq_section_content')

?>

<?php if (have_rows('faq')) : ?>
	<div class="faqs_callout flex-content-section">



		<div class="container">

			<?php if ($FAQsectionHeadline || $FAQsectionSubHeadline) : ?>
				<div class="faqs-intro">
					<?php if ($FAQsectionHeadline) : ?>
						<h2><?php echo $FAQsectionHeadline; ?></h2>
					<?php endif; ?>

					<?php if ($FAQsectionSubHeadline) : ?>
						<?php echo $FAQsectionSubHeadline; ?>
					<?php endif; ?>
				</div>
			<?php endif; ?>

			<?php while (have_rows('faq')) : the_row();
			$faqQuestion = 	get_sub_field('faq_question');
			$faqAnswer = 	get_sub_field('faq_answer');
			?>
				<div class="faq-single">
					<div class="faq-question">
						<h4><?php echo $faqQuestion;?></h4><i class="fal fa-angle-down" aria-hidden="true"></i>
					</div>
					<div class="faq-answer">
						<?php echo $faqAnswer;?>
					</div>
				</div>
			<?php endwhile; ?>
		</div>
	</div>
<?php endif; ?>
