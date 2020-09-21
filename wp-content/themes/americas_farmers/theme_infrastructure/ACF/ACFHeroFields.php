<?php
namespace AmericasFarmers;

class ACFHeroFields
{
  public static function setupHeroFields()
  {
    self::setupHeroFlexFields();
  }
  private static function setupHeroFlexFields()
  {
    if( function_exists('acf_add_local_field_group') ):

      acf_add_local_field_group(array(
      	'key' => 'group_5b17dc41a5de0',
      	'title' => 'Hero Unit',
      	'fields' => array(
      		array(
      			'key' => 'field_5b17dc521d8c2',
      			'label' => 'Hero Flexible Content',
      			'name' => 'hero_flexible_content',
      			'type' => 'flexible_content',
      			'instructions' => 'Select a hero layout.',
      			'required' => 0,
      			'conditional_logic' => 0,
      			'wrapper' => array(
      				'width' => '',
      				'class' => '',
      				'id' => '',
      			),
      			'layouts' => array(
      				'5b17dc6f30192' => array(
      					'key' => '5b17dc6f30192',
      					'name' => 'striped_background_image',
      					'label' => 'Striped with Background Image',
      					'display' => 'block',
      					'sub_fields' => array(
      						array(
      							'key' => 'field_5b17dce11d8c3',
      							'label' => 'Background Image',
      							'name' => 'background_image',
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
      							'min_width' => '',
      							'min_height' => '',
      							'min_size' => '',
      							'max_width' => '',
      							'max_height' => '',
      							'max_size' => 1,
      							'mime_types' => '',
      						),

                  array(
                    'key' => 'field_5b17e34dd71c4',
                    'label' => 'Small Logo',
                    'name' => 'small_logo',
                    'type' => 'image',
                    'instructions' => 'Optional.',
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
                    'min_width' => '',
                    'min_height' => '',
                    'min_size' => '',
                    'max_width' => '',
                    'max_height' => '',
                    'max_size' => '0.5',
                    'mime_types' => '',
                  ),

      						array(
      							'key' => 'field_5b17dff71d8c4',
      							'label' => 'Striped Header',
      							'name' => 'striped_header',
      							'type' => 'repeater',
      							'instructions' => 'Add text for the header in separate blocks. Select all caps or no caps and a background color for each text block that makes up the header.',
      							'required' => 0,
      							'conditional_logic' => 0,
      							'wrapper' => array(
      								'width' => '',
      								'class' => '',
      								'id' => '',
      							),
      							'collapsed' => '',
      							'min' => 0,
      							'max' => 0,
      							'layout' => 'table',
      							'button_label' => '',
      							'sub_fields' => array(
      								array(
      									'key' => 'field_5b17e0751d8c5',
      									'label' => 'Stripe Text',
      									'name' => 'stripe_text',
      									'type' => 'text',
      									'instructions' => '',
      									'required' => 0,
      									'conditional_logic' => 0,
      									'wrapper' => array(
      										'width' => '50',
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
      									'key' => 'field_5b17e08f1d8c6',
      									'label' => 'Make text all caps?',
      									'name' => 'all_caps',
      									'type' => 'true_false',
      									'instructions' => '',
      									'required' => 0,
      									'conditional_logic' => 0,
      									'wrapper' => array(
      										'width' => '15',
      										'class' => '',
      										'id' => '',
      									),
      									'message' => '',
      									'default_value' => 0,
      									'ui' => 0,
      									'ui_on_text' => '',
      									'ui_off_text' => '',
      								),
                      array(
                        'key' => 'field_line_break',
                        'label' => 'Insert Line Break',
                        'name' => 'insert_line_break',
                        'type' => 'true_false',
                        'instructions' => 'All words after this will break to next line.',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                          'width' => '15',
                          'class' => '',
                          'id' => '',
                        ),
                        'message' => '',
                        'default_value' => 0,
                        'ui' => 0,
                        'ui_on_text' => '',
                        'ui_off_text' => '',
                      ),
      							),
      						),

                  array(
                       'key' => 'field_5b17234234dce11d8c3',
                       'label' => 'Image Caption',
                       'name' => 'caption',
                       'type' => 'text',
                       'instructions' => '',
                       'required' => 0,
                       'conditional_logic' => 0,
                       'wrapper' => array(
                             'width' => '100',
                             'class' => '',
                             'id' => '',
                       ),
                       'min_width' => '',
                       'min_height' => '',
                       'min_size' => '',
                       'max_width' => '',
                       'max_height' => '',
                       'max_size' => 1,
                       'mime_types' => '',
                 ),

      						array(
      							'key' => 'field_5b17e3c2d71c5',
      							'label' => 'Program Button ID',
      							'name' => 'program_button_id',
      							'type' => 'text',
      							'instructions' => 'Optional. Enter The ID to smooth scroll to',
      							'required' => 0,
      							'conditional_logic' => 0,
      							'wrapper' => array(
      								'width' => '50',
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
                        'key' => 'field_5b12342347e3c2d71c5',
                        'label' => 'Program Button Text',
                        'name' => 'program_button_text',
                        'type' => 'text',
                        'instructions' => 'Enter the text to be displayed on the header button',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                              'width' => '50',
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
      							'key' => 'field_5b17e50e631c1',
      							'label' => 'Video',
      							'name' => 'video',
      							'type' => 'text',
      							'instructions' => 'Optional. Add video using the Share URL: https://youtu.be/video-id.',
      							'required' => 0,
      							'conditional_logic' => 0,
      							'wrapper' => array(
      								'width' => '50',
      								'class' => '',
      								'id' => '',
      							),
      							'default_value' => '',
      							'placeholder' => '',
      							'maxlength' => '',
      						),
                  array(
                    'key' => 'field_hero_video_related',
                    'label' => 'Related Videos',
                    'name' => 'related_videos',
                    'type' => 'repeater',
                    'instructions' => 'Optional. Add related videos using the same URL structure as main video.',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'max' => 3,
                    'layout' => 'block',
                    'button_label' => 'Add Video',
                    'sub_fields' => array(
                      array(
                        'key' => 'field_video_related_title',
                        'label' => 'Video Title',
                        'name' => 'related_videos_title',
                        'type' => 'text',
                        'rows' => '4',
                      ),
                      array(
                        'key' => 'field_video_related_item',
                        'label' => 'Video URL',
                        'name' => 'related_videos_item',
                        'type' => 'text',
                        'rows' => '4',
                      ),
                    ),
                    'wrapper' => array(
                      'width' => '50',
                      'class' => '',
                      'id' => '',
                    ),
                    'default_value' => '',
                    'placeholder' => '',
                    'maxlength' => '',
                  ),
      					),

      					'min' => '',
      					'max' => '',
      				),
      				'5b17e3ff631c0' => array(
      					'key' => '5b17e3ff631c0',
      					'name' => 'download_callouts',
      					'label' => 'Download Callouts',
      					'display' => 'block',
      					'sub_fields' => array(
      						array(
      							'key' => 'field_5b17e733811de',
      							'label' => 'Background Image',
      							'name' => 'background_image',
      							'type' => 'image',
      							'instructions' => '',
      							'required' => 0,
      							'conditional_logic' => 0,
      							'wrapper' => array(
      								'width' => '',
      								'class' => '',
      								'id' => '',
      							),
      							'return_format' => 'url',
      							'preview_size' => 'thumbnail',
      							'library' => 'all',
      							'min_width' => '',
      							'min_height' => '',
      							'min_size' => '',
      							'max_width' => '',
      							'max_height' => '',
      							'max_size' => '',
      							'mime_types' => '',
      						),
      						array(
                    'key' => 'field_5b17dff7456g',
                    'label' => 'Striped Header',
                    'name' => 'striped_header',
                    'type' => 'repeater',
                    'instructions' => 'Add text for the header in separate blocks. Select all caps or no caps and a background color for each text block that makes up the header.',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                      'width' => '',
                      'class' => '',
                      'id' => '',
                    ),
                    'collapsed' => '',
                    'min' => 0,
                    'max' => 0,
                    'layout' => 'table',
                    'button_label' => '',
                    'sub_fields' => array(
                      array(
                        'key' => 'field_5b17e07334gd',
                        'label' => 'Stripe Text',
                        'name' => 'stripe_text',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                          'width' => '50',
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
                        'key' => 'field_5b17e0345dfdg',
                        'label' => 'Make text all caps?',
                        'name' => 'all_caps',
                        'type' => 'true_false',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                          'width' => '15',
                          'class' => '',
                          'id' => '',
                        ),
                        'message' => '',
                        'default_value' => 0,
                        'ui' => 0,
                        'ui_on_text' => '',
                        'ui_off_text' => '',
                      ),
                      array(
                        'key' => 'field_line_break_callout',
                        'label' => 'Insert Line Break',
                        'name' => 'insert_line_break',
                        'type' => 'true_false',
                        'instructions' => 'All words after this will break to next line.',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                          'width' => '15',
                          'class' => '',
                          'id' => '',
                        ),
                        'message' => '',
                        'default_value' => 0,
                        'ui' => 0,
                        'ui_on_text' => '',
                        'ui_off_text' => '',
                      ),
                    ),
                  ),
      						array(
      							'key' => 'field_5b17e858c1171',
      							'label' => 'Download Items',
      							'name' => 'download_items',
      							'type' => 'repeater',
      							'instructions' => '',
      							'required' => 0,
      							'conditional_logic' => 0,
      							'wrapper' => array(
      								'width' => '',
      								'class' => '',
      								'id' => '',
      							),
      							'collapsed' => '',
      							'min' => 0,
      							'max' => 0,
      							'layout' => 'table',
      							'button_label' => 'Add Download',
      							'sub_fields' => array(
      								array(
      									'key' => 'field_5b17e81a811e1',
      									'label' => 'Program Logo',
      									'name' => 'program_logo',
      									'type' => 'image',
      									'instructions' => '',
      									'required' => 0,
      									'conditional_logic' => 0,
      									'wrapper' => array(
      										'width' => '',
      										'class' => '',
      										'id' => '',
      									),
      									'return_format' => 'url',
      									'preview_size' => 'thumbnail',
      									'library' => 'all',
      									'min_width' => '',
      									'min_height' => '',
      									'min_size' => '',
      									'max_width' => '',
      									'max_height' => '',
      									'max_size' => '',
      									'mime_types' => '',
      								),
      								array(
      									'key' => 'field_5b17e826811e2',
      									'label' => 'File Download',
      									'name' => 'file_download',
      									'type' => 'file',
      									'instructions' => '',
      									'required' => 0,
      									'conditional_logic' => 0,
      									'wrapper' => array(
      										'width' => '',
      										'class' => '',
      										'id' => '',
      									),
      									'return_format' => 'url',
      									'library' => 'all',
      									'min_size' => '',
      									'max_size' => '',
      									'mime_types' => '',
      								),
                      array(
                        'key' => 'field_5b17ea633cd3a',
                        'label' => 'Program Key',
                        'name' => 'program_key',
                        'type' => 'radio',
                        'instructions' => '',
                        'required' => 1,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                          'width' => '50',
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
      							),
      						),
      					),
      					'min' => '',
      					'max' => '',
      				),
      				'5b17e8d816c0a' => array(
      					'key' => '5b17e8d816c0a',
      					'name' => 'program_callouts',
      					'label' => 'Program Callouts',
      					'display' => 'block',
      					'sub_fields' => array(
      						array(
      							'key' => 'field_5b17e91716c0b',
      							'label' => 'Background Image',
      							'name' => 'background_image',
      							'type' => 'image',
      							'instructions' => '',
      							'required' => 0,
      							'conditional_logic' => 0,
      							'wrapper' => array(
      								'width' => '',
      								'class' => '',
      								'id' => '',
      							),
      							'return_format' => 'url',
      							'preview_size' => 'thumbnail',
      							'library' => 'all',
      							'min_width' => '',
      							'min_height' => '',
      							'min_size' => '',
      							'max_width' => '',
      							'max_height' => '',
      							'max_size' => '',
      							'mime_types' => '',
      						),
      						array(
      							'key' => 'field_5b17e97316c0c',
      							'label' => 'Header Text Line One',
      							'name' => 'header_text_line_one',
      							'type' => 'text',
      							'instructions' => 'Styled to appear smaller.',
      							'required' => 0,
      							'conditional_logic' => 0,
      							'wrapper' => array(
      								'width' => '33',
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
      							'key' => 'field_5b17e99316c0d',
      							'label' => 'Header Text Line Two',
      							'name' => 'header_text_line_two',
      							'type' => 'text',
      							'instructions' => 'Styled to appear larger & with different font.',
      							'required' => 0,
      							'conditional_logic' => 0,
      							'wrapper' => array(
      								'width' => '33',
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
      							'key' => 'field_5b17e99e16c0e',
      							'label' => 'Header Text Line Three',
      							'name' => 'header_text_line_three',
      							'type' => 'text',
      							'instructions' => 'Styled to appear smaller.',
      							'required' => 0,
      							'conditional_logic' => 0,
      							'wrapper' => array(
      								'width' => '33',
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
      							'key' => 'field_5b17ea4a3cd39',
      							'label' => 'Program Items',
      							'name' => 'program_items',
      							'type' => 'repeater',
      							'instructions' => '',
      							'required' => 0,
      							'conditional_logic' => 0,
      							'wrapper' => array(
      								'width' => '',
      								'class' => '',
      								'id' => '',
      							),
      							'collapsed' => '',
      							'min' => 0,
      							'max' => 0,
      							'layout' => 'block',
      							'button_label' => '',
      							'sub_fields' => array(
      								array(
      									'key' => 'field_5b17ea633cd3a',
      									'label' => 'Program Key',
      									'name' => 'program_key',
      									'type' => 'radio',
      									'instructions' => '',
      									'required' => 1,
      									'conditional_logic' => 0,
      									'wrapper' => array(
      										'width' => '50',
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
      									'key' => 'field_5b17eb519d0c6',
      									'label' => 'Logo',
      									'name' => 'logo',
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
      									'min_width' => '',
      									'min_height' => '',
      									'min_size' => '',
      									'max_width' => '',
      									'max_height' => '',
      									'max_size' => '',
      									'mime_types' => '',
      								),
      								array(
      									'key' => 'field_5b17ec6c30684',
      									'label' => 'Button Number',
      									'name' => 'button_number',
      									'type' => 'text',
      									'instructions' => 'The number that appears in the colored button.',
      									'required' => 0,
      									'conditional_logic' => 0,
      									'wrapper' => array(
      										'width' => '50',
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
      									'key' => 'field_5b17eb709d0c7',
      									'label' => 'Button Text',
      									'name' => 'button_text',
      									'type' => 'text',
      									'instructions' => 'The text that appears directly under the button.',
      									'required' => 0,
      									'conditional_logic' => 0,
      									'wrapper' => array(
      										'width' => '50',
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
      									'key' => 'field_5b17eb9e9d0c8',
      									'label' => 'Number Details',
      									'name' => 'number_details',
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
      									'key' => 'field_5b17ebb39d0c9',
      									'label' => 'Number Details Headline',
      									'name' => 'number_details_headline',
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
      									'key' => 'field_5b17ebcd9d0ca',
      									'label' => 'Details Content',
      									'name' => 'details_content',
      									'type' => 'textarea',
      									'instructions' => 'The paragraph text that displays when a callout is opened',
      									'required' => 0,
      									'conditional_logic' => 0,
      									'wrapper' => array(
      										'width' => '',
      										'class' => '',
      										'id' => '',
      									),
      									'default_value' => '',
      									'placeholder' => '',
      									'maxlength' => '',
      									'rows' => '',
      									'new_lines' => '',
      								),
      							),
      						),
      					),
      					'min' => '',
      					'max' => '',
      				),
      			),
      			'button_label' => 'Add Row',
      			'min' => '',
      			'max' => '',
      		),
      	),
      	'location' => array(
      		array(
      			array(
      				'param' => 'post_type',
      				'operator' => '==',
      				'value' => 'page',
      			),
      		),
      		array(
      			array(
      				'param' => 'post_type',
      				'operator' => '==',
      				'value' => 'post',
      			),
      		),
      	),
      	'menu_order' => 0,
      	'position' => 'acf_after_title',
      	'style' => 'default',
      	'label_placement' => 'top',
      	'instruction_placement' => 'label',
      	'hide_on_screen' => '',
      	'active' => 1,
      	'description' => '',
      ));



    endif;
  }


}
