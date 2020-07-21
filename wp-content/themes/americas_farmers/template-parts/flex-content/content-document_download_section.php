<?php
/**
*
* Component to add image tiles that link to document downloads. Includes header and intro text as well.
*
*
**/


?>


<div class="document-downloads flex-content-section ">
	<h2><?php the_sub_field('download_section_header'); ?></h2>
	<div class="container">
		<div class="document-intro">
			<p><?php the_sub_field('download_section_content'); ?></p>
		</div>
		<?php if ( have_rows('document_download') ) : ?>
			<ul class="document-group">
				<?php while ( have_rows('document_download') ) : the_row() ; ?>
						<li class="download-tile" style="background-image: url(<?php the_sub_field('background_image'); ?>);">
							<a href="<?php the_sub_field('file'); ?>" target="_block" download>
								<div class="content">
									<h3><?php the_sub_field('title'); ?></h3>
									<div class="download-button"><?php the_sub_field('sub_title'); ?><i class="far fa-file-download"></i></div>
								</div>
							</a>

						</li>
				<?php endwhile ;?>
			</ul>
		<?php endif; ?>
	</div>
</div>
