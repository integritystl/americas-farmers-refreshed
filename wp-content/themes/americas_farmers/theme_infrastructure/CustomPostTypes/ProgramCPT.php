<?php
namespace AmericasFarmers;

class ProgramCPT
{
	public static function setupPrograms()
	{
		self::createProgramPostType();
		self::addProgramACF();
	}

	public static function createProgramPostType()
	{
		register_post_type( 'program',
	      array(
	        'labels' => array(
	          'name' => __( 'Programs' ),
	          'singular_name' => __( 'Program' )
	        ),
	        'exclude_from_search' => true,
	        'publicly_queryable' => false,
	        'show_ui' => true,
	        'show_in_nav_menus' => false,
	        'show_in_menu' => true,
	        'show_in_rest' => true,
	        'has_archive' => false,
			'menu_icon' => 'dashicons-text-page',
	      )
	    );
	}

	public static function addProgramACF()
	{
		if( function_exists('acf_add_local_field_group') ):

			acf_add_local_field_group(array(
				'key' => 'group_5b0eb038cf2a7',
				'title' => 'Programs',
				'fields' => array(
					array(
						'key' => 'field_5b0ebaa315aca',
						'label' => 'Program Key',
						'name' => 'program_key',
						'type' => 'radio',
						'instructions' => '',
						'required' => 1,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'choices' => array(
							'communities' => 'Grow Communities',
							'rural' => 'Grow Rural Education',
							'leaders' => 'Grow Ag Leaders',
						),
						'allow_null' => 0,
						'other_choice' => 0,
						'save_other_choice' => 0,
						'default_value' => '',
						'layout' => 'vertical',
						'return_format' => 'value',
					),
					array(
						'key' => 'field_5b0eb03c4a694',
						'label' => 'Enroll Start',
						'name' => 'enroll_start',
						'type' => 'date_time_picker',
						'instructions' => '',
						'required' => 1,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'display_format' => 'm/d/Y g:i a',
						'return_format' => 'Y-m-d H:i:s',
						'first_day' => 1,
					),
					array(
						'key' => 'field_5b0eb03c4a61234',
						'label' => 'Enroll End',
						'name' => 'enroll_end',
						'type' => 'date_time_picker',
						'instructions' => '',
						'required' => 1,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'display_format' => 'm/d/Y g:i a',
						'return_format' => 'Y-m-d H:i:s',
						'first_day' => 1,
					),
					array(
						'key' => 'field_5b0eb0694a695',
						'label' => 'Announce Start',
						'name' => 'announce_start',
						'type' => 'date_time_picker',
						'instructions' => '',
						'required' => 1,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'display_format' => 'm/d/Y g:i a',
						'return_format' => 'Y-m-d H:i:s',
						'first_day' => 1,
					),
					array(
						'key' => 'field_5b0eb03234c4a694',
						'label' => 'Announce End',
						'name' => 'announce_end',
						'type' => 'date_time_picker',
						'instructions' => '',
						'required' => 1,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'display_format' => 'm/d/Y g:i a',
						'return_format' => 'Y-m-d H:i:s',
						'first_day' => 1,
					),
					array(
						'key' => 'field_5b0eb0894a696',
						'label' => 'Story Start',
						'name' => 'story_start',
						'type' => 'date_time_picker',
						'instructions' => '',
						'required' => 1,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'display_format' => 'm/d/Y g:i a',
						'return_format' => 'Y-m-d H:i:s',
						'first_day' => 1,
					),
					array(
						'key' => 'field_5b0eb03c41234a694',
						'label' => 'Story End',
						'name' => 'story_end',
						'type' => 'date_time_picker',
						'instructions' => '',
						'required' => 1,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'display_format' => 'm/d/Y g:i a',
						'return_format' => 'Y-m-d H:i:s',
						'first_day' => 1,
					),
					array(
						'key' => 'field_program_year',
						'label' => 'Program Winners Display Year',
						'name' => 'program_display_year',
						'type' => 'text',
						'instructions' => "Enter the year for the program announcements you'd like to display",
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
					),
					array(
						'key' => 'field_5cf658cefb0d2',
						'label' => 'Program Finalists',
						'name' => 'program_finalists',
						'type' => 'group',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'layout' => 'block',
						'sub_fields' => array(
							array(
								'key' => 'field_5cf655c64770a',
								'label' => 'Toggle Finalists',
								'name' => 'toggle_finalists',
								'type' => 'true_false',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'message' => 'Display finalists section for this program',
								'default_value' => 0,
								'ui' => 0,
								'ui_on_text' => '',
								'ui_off_text' => '',
							),
							array(
								'key' => 'field_5cf655fb4770b',
								'label' => 'Finalists Start',
								'name' => 'finalists_start',
								'type' => 'date_time_picker',
								'instructions' => '',
								'required' => 1,
								'conditional_logic' => array(
									array(
										array(
											'field' => 'field_5cf655c64770a',
											'operator' => '==',
											'value' => '1',
										),
									),
								),
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'display_format' => 'm/d/Y g:i a',
								'return_format' => 'Y-m-d H:i:s',
								'first_day' => 1,
							),
							array(
								'key' => 'field_5cf656674770c',
								'label' => 'Finalists End',
								'name' => 'finalists_end',
								'type' => 'date_time_picker',
								'instructions' => '',
								'required' => 1,
								'conditional_logic' => array(
									array(
										array(
											'field' => 'field_5cf655c64770a',
											'operator' => '==',
											'value' => '1',
										),
									),
								),
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'display_format' => 'm/d/Y g:i a',
								'return_format' => 'Y-m-d H:i:s',
								'first_day' => 1,
							),
							array(
								'key' => 'field_5cf656884770d',
								'label' => 'Finalists Upload',
								'name' => 'finalists_upload',
								'type' => 'file',
								'instructions' => '',
								'required' => 1,
								'conditional_logic' => array(
									array(
										array(
											'field' => 'field_5cf655c64770a',
											'operator' => '==',
											'value' => '1',
										),
									),
								),
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'return_format' => 'id',
								'library' => 'uploadedTo',
								'min_size' => '',
								'max_size' => 2,
								'mime_types' => 'csv',
							)
						),
					),
				),
				'location' => array(
					array(
						array(
							'param' => 'post_type',
							'operator' => '==',
							'value' => 'program',
						),
					),
				),
				'menu_order' => 0,
				'position' => 'normal',
				'style' => 'default',
				'label_placement' => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen' => array(
					0 => 'the_content',
					1 => 'excerpt',
					2 => 'discussion',
					3 => 'comments',
				),
				'active' => 1,
				'description' => '',
			));

			endif;

			if( function_exists('acf_add_local_field_group') ):

			acf_add_local_field_group(array(
				'key' => 'group_5ebac9e0b10d1',
				'title' => 'Program Story',
				'name' => 'program_story',
				'fields' => array(
					array(
						'key' => 'field_5ebac9f123f',
						'label' => 'Story Headline',
						'name' => 'story_headline',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
					),
					array(
						'key' => 'field_5ebac2345fsd',
						'label' => 'Story Sub Headline',
						'name' => 'story_subheadline',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
					),
					array(
						'key' => 'field_5ebaca062615c',
						'label' => 'Story Content',
						'name' => 'story_content',
						'type' => 'wysiwyg',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'tabs' => 'all',
						'toolbar' => 'full',
						'media_upload' => 1,
						'delay' => 0,
					),
				),
				'location' => array(
					array(
						array(
							'param' => 'post_type',
							'operator' => '==',
							'value' => 'program',
						),
					),
				),
				'menu_order' => 1,
				'position' => 'normal',
				'style' => 'default',
				'label_placement' => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen' => '',
				'active' => true,
				'description' => '',
			));

			endif;

			if( function_exists('acf_add_local_field_group') ):

			acf_add_local_field_group(array(
				'key' => 'group_5ea217611ed99',
				'title' => 'Program Announce Winners',
				'fields' => array(
					array(
						'key' => 'field_5ea21b4d3ff9e',
						'label' => 'Year Header',
						'name' => 'year_display_header',
						'type' => 'text',
						'instructions' => 'Type the year that these winners represent.',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
					),
					array(
						'key' => 'field_5ea21basdff',
						'label' => 'Winners Content Blurb',
						'name' => 'winners_content_blurb',
						'type' => 'wysiwyg',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'tabs' => 'all',
						'toolbar' => 'full',
						'media_upload' => 1,
						'delay' => 0,
					),
					array(
						'key' => 'field_5ea21b9451231',
						'label' => 'No Winners Blurb',
						'name' => 'no_winners_blurb',
						'type' => 'wysiwyg',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'tabs' => 'all',
						'toolbar' => 'full',
						'media_upload' => 1,
						'delay' => 0,
					),
					array(
						'key' => 'field_5ea21baf3ffa0',
						'label' => 'Active Phases',
						'name' => 'active_phases',
						'type' => 'checkbox',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'choices' => array(
							'enroll' => 'Enroll',
							'announce' => 'Announce',
							'story' => 'Story',
						),
						'allow_custom' => 0,
						'default_value' => array(
						),
						'layout' => 'vertical',
						'toggle' => 0,
						'return_format' => 'value',
						'save_custom' => 0,
					),
				),
				'location' => array(
					array(
						array(
							'param' => 'post_type',
							'operator' => '==',
							'value' => 'program',
						),
					),
				),
				'menu_order' => 2,
				'position' => 'normal',
				'style' => 'default',
				'label_placement' => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen' => '',
				'active' => true,
				'description' => '',
			));

			acf_add_local_field_group(array(
				'key' => 'group_5ea215ce97fae',
				'title' => 'Program Enrollment Content',
				'fields' => array(
					array(
						'key' => 'field_5ea2166873acb',
						'label' => 'Thank You Page',
						'name' => 'thank_you_page',
						'type' => 'page_link',
						'instructions' => 'Select the thank you page for the enrollment form',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'post_type' => array(
							0 => 'page',
						),
						'taxonomy' => '',
						'allow_null' => 0,
						'allow_archives' => 1,
						'multiple' => 0,
					),
					array(
						'key' => 'field_5ebd61b568bfd',
						'label' => 'Grow Ag Enrollment Link',
						'name' => 'grow_ag_enrollment_link',
						'type' => 'link',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '50',
							'class' => '',
							'id' => '',
						),
						'return_format' => 'array',
					),
					array(
						'key' => '5b0d7b6b7ad3453',
						'label' => 'Grow Ag Image',
						'name' => 'gro_ag_img',
						'type' => 'image',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '50',
							'class' => '',
							'id' => '',
						),
						'return_format' => 'url',
						'preview_size' => 'thumbnail',
						'library' => 'all',
					),
					array(
						'key' => 'field_5ea21b9282344r',
						'label' => 'Enrollment Headline',
						'name' => 'enroll_headline',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'tabs' => 'all',
						'toolbar' => 'full',
						'media_upload' => 1,
						'delay' => 0,
					),
					array(
						'key' => 'field_5ea21b92837469h',
						'label' => 'Enrollment Content Blurb',
						'name' => 'enroll_content_blurb',
						'type' => 'wysiwyg',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'tabs' => 'all',
						'toolbar' => 'full',
						'media_upload' => 1,
						'delay' => 0,
					),
				),

				'location' => array(
					array(
						array(
							'param' => 'post_type',
							'operator' => '==',
							'value' => 'program',
						),
					),
				),
				'menu_order' => 3,
				'position' => 'normal',
				'style' => 'default',
				'label_placement' => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen' => '',
				'active' => true,
				'description' => '',
			));

			endif;
	}



	public static function getProgramPhase($id)
	{

		//Grab all the relevant variables
		$enroll = get_field('enroll_start', $id);
		$enroll_end = get_field('enroll_end', $id);
		$announce =  get_field('announce_start', $id);
		$announce_end = get_field('announce_end', $id);
		$story =  get_field('story_start', $id);
		$story_end = get_field('story_end', $id);
		$finalists_group = get_field('program_finalists', $id);
		//Grab "now" so we can see which phase are are in
    date_default_timezone_set('America/Chicago');
		$now = strtotime(date('Y-m-d H:i:s'));
		//Check to see which phase we are in.
		//Default to the 'story' phase because it's the one without functionality
		$active_phases = array();
		//See which phase if any our date falls into
		if($now >= strtotime($enroll) && $now <= strtotime($enroll_end)){
			array_push($active_phases, 'enroll');
		}
		if ($now >= strtotime($announce) && $now <= strtotime($announce_end)){
			array_push($active_phases, 'announce');
		}
		if($now >= strtotime($story) && $now <= strtotime($story_end)){
			array_push($active_phases, 'story');
		}
		if(!empty($finalists_group) && $finalists_group['toggle_finalists']){
			if($now >= strtotime($finalists_group['finalists_start']) && $now <= strtotime($finalists_group['finalists_end'])){
				array_push($active_phases, 'finalists');
			}
		}
		//Return dat phase
		return $active_phases;
	}
}
