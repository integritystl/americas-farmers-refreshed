<?php
namespace AmericasFarmers;

class ACFOptionsPage {
	public static function setupOptionsPage() {

		if( function_exists('acf_add_options_page')){
			acf_add_options_page(array(
				'page_title' 	=> 'Theme Config',
				'menu_title'	=> 'Theme Config',
				'menu_slug' 	=> 'theme-config',
				'capability'	=> 'edit_posts',
				'redirect'		=> false
			));

			acf_add_options_sub_page(array(
				'page_title' 	=> 'Theme Header Settings',
				'menu_title'	=> 'Header',
				'menu_slug'     => 'header_settings',
				'parent'	=> 'theme-config',
			));

			acf_add_options_sub_page(array(
				'page_title' 	=> 'Theme Footer Settings',
				'menu_title'	=> 'Footer',
				'menu_slug'     => 'footer_settings',
				'parent'	=> 'theme-config',
			));

			acf_add_options_sub_page(array(
				'page_title' 	=> 'SalesForce API Config',
				'menu_title'	=> 'SalesForce API Config',
				'menu_slug'     => 'salesforce_api_config',
				'parent'	=> 'theme-config',
			));
		}

		if( function_exists('acf_add_local_field_group') ):

			acf_add_local_field_group(array(
				'key' => 'group_5b0edd3e9a2fb',
				'title' => 'Program Cards Settings',
				'fields' => array(
					array(
						'key' => 'field_5b0edf26b7c36',
						'label' => 'Headline',
						'name' => 'top_content',
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
						'key' => 'field_5b0edd47b7c23',
						'label' => 'Programs',
						'name' => 'programs',
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
						'min' => 3,
						'max' => 3,
						'layout' => 'block',
						'button_label' => '',
						'sub_fields' => array(
							array(
								'key' => 'field_5b0ee0a4ae1e8',
								'label' => 'Program',
								'name' => 'program',
								'type' => 'post_object',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '33',
									'class' => '',
									'id' => '',
								),
								'layout' => 'block',
								'post_type' => array(
									0 => 'program',
								),
								'taxonomy' => array(
								),
								'allow_null' => 0,
								'multiple' => 0,
								'return_format' => 'object',
								'ui' => 1,
							),
							array(
								'key' => 'field_5b0edd96b7c26',
								'label' => 'Sub Heading',
								'name' => 'sub_heading',
								'type' => 'text',
								'instructions' => '',
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
								'key' => 'field_5b0edd78b7c24',
								'label' => 'Background Image',
								'name' => 'background_image',
								'type' => 'image',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '33',
									'class' => '',
									'id' => '',
								),
								'return_format' => 'array',
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
								'key' => 'field_5b0eddd7b7c27',
								'label' => 'Enroll Phase',
								'name' => 'enroll_phase',
								'type' => 'group',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '33',
									'class' => '',
									'id' => '',
								),
								'layout' => 'block',
								'sub_fields' => array(
									array(
										'key' => 'field_5b0ede6fb7c28',
										'label' => 'Heading',
										'name' => 'heading',
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
										'key' => 'field_5b0ede81b7c29',
										'label' => 'Content',
										'name' => 'enroll_content',
										'type' => 'textarea',
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
										'maxlength' => '',
										'rows' => '',
										'new_lines' => '',
									),
									array(
										'key' => 'field_5b0ede89b7c2a',
										'label' => 'Button Text',
										'name' => 'button_text',
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
										'key' => 'field_5b0ede8eb7c2b',
										'label' => 'Button Link',
										'name' => 'button_link',
										'type' => 'link',
										'instructions' => '',
										'required' => 0,
										'conditional_logic' => 0,
										'wrapper' => array(
											'width' => '',
											'class' => '',
											'id' => '',
										),
										'return_format' => 'url',
									),
								),
							),
							array(
								'key' => 'field_5b0edeb3b7c2c',
								'label' => 'Announce Phase',
								'name' => 'announce_phase',
								'type' => 'group',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '33',
									'class' => '',
									'id' => '',
								),
								'layout' => 'block',
								'sub_fields' => array(
									array(
										'key' => 'field_5b0edec4b7c2d',
										'label' => 'Heading',
										'name' => 'heading',
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
										'key' => 'field_5b0edecab7c2e',
										'label' => 'Content',
										'name' => 'content',
										'type' => 'textarea',
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
										'maxlength' => '',
										'rows' => '',
										'new_lines' => '',
									),
									array(
										'key' => 'field_5b0eded0b7c2f',
										'label' => 'Button Text',
										'name' => 'button_text',
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
										'key' => 'field_5b0eded5b7c30',
										'label' => 'Button Link',
										'name' => 'button_link',
										'type' => 'link',
										'instructions' => '',
										'required' => 0,
										'conditional_logic' => 0,
										'wrapper' => array(
											'width' => '',
											'class' => '',
											'id' => '',
										),
										'return_format' => 'url',
									),
								),
							),
							array(
								'key' => 'field_5b0edee2b7c31',
								'label' => 'Story Phase',
								'name' => 'story_phase',
								'type' => 'group',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '33',
									'class' => '',
									'id' => '',
								),
								'layout' => 'block',
								'sub_fields' => array(
									array(
										'key' => 'field_5b0edef0b7c32',
										'label' => 'Heading',
										'name' => 'heading',
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
										'key' => 'field_5b0edef5b7c33',
										'label' => 'Content',
										'name' => 'content',
										'type' => 'textarea',
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
										'maxlength' => '',
										'rows' => '',
										'new_lines' => '',
									),
									array(
										'key' => 'field_5b0edefdb7c34',
										'label' => 'Button Text',
										'name' => 'button_text',
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
										'key' => 'field_5b0edf04b7c35',
										'label' => 'Button Link',
										'name' => 'button_link',
										'type' => 'link',
										'instructions' => '',
										'required' => 0,
										'conditional_logic' => 0,
										'wrapper' => array(
											'width' => '',
											'class' => '',
											'id' => '',
										),
										'return_format' => 'url',
									),
								),
							),
						),
					),
				),

				'location' => array(
					array(
						array(
							'param' => 'options_page',
							'operator' => '==',
							'value' => 'theme-config',
						),
					),
				),


				'menu_order' => 0,
				'position' => 'normal',
				'style' => 'default',
				'label_placement' => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen' => '',
				'active' => 1,
				'description' => '',
			));
		endif;

		if( function_exists('acf_add_local_field_group') ):
			acf_add_local_field_group(array(
					'key' => 'group_5b0edd3e9a2f11',
					'title' => 'Footer Settings',
					'fields' => array(
						array(
							'key' => 'field_5b0edef0b7c36',
							'label' => 'Facebook Link',
							'name' => 'facebook_link',
							'type' => 'url',
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
							'key' => 'field_5b0edef0b7c37',
							'label' => 'Twitter Link',
							'name' => 'twitter_link',
							'type' => 'url',
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
							'key' => 'field_5b0edef0b7c38',
							'label' => 'Instagram Link',
							'name' => 'instagram_link',
							'type' => 'url',
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
							'key' => 'field_5b0edef0b7c39',
							'label' => 'Youtube Link',
							'name' => 'youtube_link',
							'type' => 'url',
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
							'key' => 'field_5b0edef0b7c40',
							'label' => 'Copyright Information',
							'name' => 'footer_copyright',
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
							'key' => 'field_footer-logo',
							'label' => 'Logo',
							'name' => 'logo_image',
							'type' => 'image',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '33',
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
							'key' => 'field_5b0edef0b7c41',
							'label' => 'Newsletter Signup Gravity Form Shortcode',
							'name' => 'footer_newsletter',
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
							'key' => 'field_5b0edef0b7c41_text_optin',
							'label' => 'Text Opt-in',
							'name' => 'text_opt_in',
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
					),

					'location' => array(
							array(
								array(
									'param' => 'options_page',
									'operator' => '==',
									'value' => 'footer_settings',
								),
							),
						),

						'menu_order' => 0,
						'position' => 'normal',
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
