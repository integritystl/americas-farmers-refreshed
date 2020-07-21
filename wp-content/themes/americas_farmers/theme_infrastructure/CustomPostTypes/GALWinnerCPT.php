<?php
namespace AmericasFarmers;

class GALWinnerCPT
{
    public static function setupGALWinners()
    {
        self::createGALWinnerPostType();
        self::addGALWinnerACF();
    }

    public static function createGALWinnerPostType()
    {
        register_post_type( 'gal_winners',
            array(
                'labels' => array(
                    'name' => __( 'Grow Ag Leaders Winners' ),
                    'singular_name' => __( 'Grow Ag Leaders Winner' )
                ),
                'exclude_from_search' => true,
                'publicly_queryable' => false,
                'show_ui' => true,
                'show_in_nav_menus' => false,
                'show_in_menu' => true,
                'show_in_rest' => true,
                'has_archive' => false,
                'menu_icon' => 'dashicons-awards',
            )
        );
    }

    public static function addGALWinnerACF()
    {
        if( function_exists('acf_add_local_field_group') ):

            acf_add_local_field_group(array(
                'key' => 'group_gal_winner_information',
                'title' => 'Winner information',
                'fields' => array(
                    array(
                        'key' => 'field_gal_winner_year',
                        'label' => 'Year',
                        'name' => 'gal_winner_year',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '50',
                            'class' => '',
                            'id' => '',
                        ),
                    ),
                    array(
                        'key' => 'field_gal_winner_city',
                        'label' => 'City',
                        'name' => 'gal_winner_city',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '50',
                            'class' => '',
                            'id' => '',
                        ),
                    ),
                    array(
                        'key' => 'field_gal_winner_FFA_chapter_name',
                        'label' => 'FFA Chapter Name',
                        'name' => 'gal_winner_FFA_chapter_name',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '50',
                            'class' => '',
                            'id' => '',
                        ),
                    ),
                    array(
                        'key' => 'field_gal_winner_major',
                        'label' => 'Major Description',
                        'name' => 'gal_winner_major',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '50',
                            'class' => '',
                            'id' => '',
                        ),
                    ),
                ),
                'location' => array(
                    array(
                        array(
                            'param' => 'post_type',
                            'operator' => '==',
                            'value' => 'gal_winners',
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
    }
}