<?php

namespace Clr\PostType;

class ClrIngredient extends ClrPostType {
	public static function setup(): void {
		self::register_ingredients();
		self::register_ingredient_meta();
	}

	public static function register_ingredients(): void {
		$labels = array(
			'name'                  => __( 'Ingredients', 'clr-brands' ),
			'singular_name'         => __( 'Ingredient', 'clr-brands' ),
			'menu_name'             => __( 'Ingredients', 'clr-brands' ),
			'name_admin_bar'        => __( 'Ingredient', 'clr-brands' ),
			'add_new'               => __( 'Add New', 'clr-brands' ),
			'add_new_item'          => __( 'Add New Ingredient', 'clr-brands' ),
			'new_item'              => __( 'New Ingredient', 'clr-brands' ),
			'edit_item'             => __( 'Edit Ingredient', 'clr-brands' ),
			'view_item'             => __( 'View Ingredient', 'clr-brands' ),
			'all_items'             => __( 'All Ingredients', 'clr-brands' ),
			'search_items'          => __( 'Search Ingredients', 'clr-brands' ),
			'parent_item_colon'     => __( 'Parent Ingredients:', 'clr-brands' ),
			'not_found'             => __( 'No ingredients found.', 'clr-brands' ),
			'not_found_in_trash'    => __( 'No ingredients found in Trash.', 'clr-brands' ),
			'featured_image'        => _x( 'Ingredient Image', 'clr-brands' ),
			'set_featured_image'    => _x( 'Set ingredient image', 'clr-brands' ),
			'remove_featured_image' => _x( 'Remove ingredient image', 'clr-brands' ),
			'use_featured_image'    => _x( 'Use as ingredient image', 'clr-brands' ),
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => 20,
			'menu_icon'          => 'dashicons-cart', // Dashicon
			'supports'           => array(
				'title',
				'editor',
				'author',
				'thumbnail',
				'excerpt',
				'comments'
			),
			'show_in_rest'       => true, // Enable Gutenberg editor
			'taxonomies'         => array( 'category', 'post_tag' ) // Assign categories and tags
		);

		register_post_type( 'ingredient', $args );
	}

	public static function register_ingredient_meta(): void {
		add_action( 'acf/init', [ __CLASS__, 'acf_add_ingredient_meta' ], - 1 );
	}

	public static function acf_add_ingredient_meta(): void {
		acf_add_local_field_group( array(
			'key'                   => 'group_clr_ingredient_meta',
			'title'                 => 'Ingredient Settings',
			'fields'                => [],//self::ingredient_meta_config(),
			'menu_order'            => 0,
			'position'              => 'normal',
			'style'                 => 'default',
			'label_placement'       => 'top',
			'instruction_placement' => 'label',
			'active'                => true,
			'location'              => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'ingredient',
					),
				),
			),
		) );
	}

	protected static function ingredient_meta_config(): array {
		$fields = [
			// Image (ACF Image Picker)
			[
				'key'   => 'ingredient_image',
				'label' => 'Image',
				'name'  => 'ingredient_image',
				'type'  => 'image',
			],
			// Safety Ingredients (Text Area)
			[
				'key'   => 'safety_ingredients',
				'label' => 'Safety Ingredients',
				'name'  => 'safety_ingredients',
				'type'  => 'textarea',
			],
			// SDS (File Picker)
			[
				'key'   => 'sds',
				'label' => 'SDS',
				'name'  => 'sds',
				'type'  => 'file',
			],
			// Tech Data Sheets (File Picker)
			[
				'key'   => 'tech_data_sheets',
				'label' => 'Tech Data Sheets',
				'name'  => 'tech_data_sheets',
				'type'  => 'file',
			],
			// Ingredient Sell Sheets (File Picker)
			[
				'key'   => 'ingredient_sell_sheets',
				'label' => 'Ingredient Sell Sheets',
				'name'  => 'ingredient_sell_sheets',
				'type'  => 'file',
			],
			// How To Use (File Picker)
			[
				'key'   => 'how_to_use',
				'label' => 'How To Use',
				'name'  => 'how_to_use',
				'type'  => 'wysiwyg',
			],
			[
				'key'   => 'WtbAlt',
				'label' => 'WtbAlt',
				'name'  => 'WtbAlt',
				'type'  => 'text',
			],
			// Ingredient Use (Checkbox)
			[
				'key'     => 'ingredient_use',
				'label'   => 'Ingredient Use',
				'name'    => 'ingredient_use',
				'type'    => 'checkbox',
				'choices' => [/* Add options here */ ],
			],
			// Rooms (Checkbox)
			[
				'key'     => 'rooms',
				'label'   => 'Rooms',
				'name'    => 'rooms',
				'type'    => 'checkbox',
				'choices' => [/* Add options here */ ],
			],
			// Surfaces (Checkbox)
			[
				'key'     => 'surfaces',
				'label'   => 'Surfaces',
				'name'    => 'surfaces',
				'type'    => 'checkbox',
				'choices' => [/* Add options here */ ],
			],
			// SDS Spanish (File Picker)
			[
				'key'   => 'sds_spanish',
				'label' => 'SDS Spanish',
				'name'  => 'sds_spanish',
				'type'  => 'file',
			],
			// Online Available (Checkbox)
			[
				'key'     => 'online_available',
				'label'   => 'Online Available',
				'name'    => 'online_available',
				'type'    => 'checkbox',
				'choices' => [/* Add options here */ ],
			],
			// Available Sizes (Checkbox)
			[
				'key'     => 'available_sizes',
				'label'   => 'Available Sizes',
				'name'    => 'available_sizes',
				'type'    => 'checkbox',
				'choices' => [/* Add options here */ ],
			],
			// Custom Surfaces Content (WYSIWYG)
			[
				'key'   => 'custom_surfaces_content',
				'label' => 'Custom Surfaces Content',
				'name'  => 'custom_surfaces_content',
				'type'  => 'wysiwyg',
			],
			// Subhead (Text)
			[
				'key'   => 'subhead',
				'label' => 'Subhead',
				'name'  => 'subhead',
				'type'  => 'text',
			],
			// Custom Size Text (Text Area)
			[
				'key'   => 'custom_size_text',
				'label' => 'Custom Size Text',
				'name'  => 'custom_size_text',
				'type'  => 'textarea',
			],
			// How To Use Header (Text)
			[
				'key'   => 'how_to_use_header',
				'label' => 'How To Use Header',
				'name'  => 'how_to_use_header',
				'type'  => 'text',
			],
			// UPC Code Fields (Text)
			[
				'key'   => 'upc_code',
				'label' => 'UPC Code',
				'name'  => 'upc_code',
				'type'  => 'file',
			],
			[
				'key'   => 'upc_code2',
				'label' => 'UPC Code 2',
				'name'  => 'upc_code2',
				'type'  => 'file',
			],
			[
				'key'   => 'upc_code3',
				'label' => 'UPC Code 3',
				'name'  => 'upc_code3',
				'type'  => 'file',
			],
			[
				'key'   => 'upc_code4',
				'label' => 'UPC Code 4',
				'name'  => 'upc_code4',
				'type'  => 'file',
			],
			[
				'key'   => 'upc_code5',
				'label' => 'UPC Code 5',
				'name'  => 'upc_code5',
				'type'  => 'file',
			],
			[
				'key'   => 'upc_code_alt',
				'label' => 'UPC Code Alt',
				'name'  => 'upc_code_alt',
				'type'  => 'text',
			],
			[
				'key'   => 'upc_code_alt2',
				'label' => 'UPC Code 2 Alt',
				'name'  => 'upc_code_alt2',
				'type'  => 'text',
			],
			[
				'key'   => 'upc_code_alt3',
				'label' => 'UPC Code 3 Alt',
				'name'  => 'upc_code_alt3',
				'type'  => 'text',
			],
			[
				'key'   => 'upc_code_alt4',
				'label' => 'UPC Code 4 Alt',
				'name'  => 'upc_code_alt4',
				'type'  => 'text',
			],
			[
				'key'   => 'upc_code_alt5',
				'label' => 'UPC Code 5 Alt',
				'name'  => 'upc_code_alt5',
				'type'  => 'text',
			],
			[
				'key'   => 'sort_top',
				'label' => 'Sort Top',
				'name'  => 'sort_top',
				'type'  => 'true_false',
			],
			// Not Subject to CA Act (True/False)
			[
				'key'   => 'not_subject_to_ca_act',
				'label' => 'Not Subject to CA Act',
				'name'  => 'not_subject_to_ca_act',
				'type'  => 'true_false',
			],
			[
				'key'   => 'is_new_ingredient',
				'label' => 'Is New Ingredient',
				'name'  => 'is_new_ingredient',
				'type'  => 'true_false',
			],
			[
				'key'   => 'show_ingredient_safer_choice_logo',
				'label' => 'Show Ingredient Safer Choice Logo',
				'name'  => 'show_ingredient_safer_choice_logo',
				'type'  => 'true_false',
			],
			[
				'key'     => 'field_ingredient_application',
				'label'   => 'Ingredient Application',
				'name'    => 'ingredient_application',
				'type'    => 'checkbox',
				'choices' => array(// Add application options here
				),
			],
			// Ingredient Use Proline (True/False)
			[
				'key'     => 'ingredient_use_proline',
				'label'   => 'Ingredient Use Proline',
				'name'    => 'ingredient_use_proline',
				'type'    => 'checkbox',
				'choices' => [],
			],
			// Ingredient Type (Checkbox)
			[
				'key'     => 'field_ingredient_type',
				'label'   => 'Ingredient Type',
				'name'    => 'ingredient_type',
				'type'    => 'checkbox',
				'choices' => array(// Add type options here
				),
			],
			// Show Proline Safer Choice (True/False)
			[
				'key'   => 'show_proline_safer_choice',
				'label' => 'Show Proline Safer Choice',
				'name'  => 'show_proline_safer_choice',
				'type'  => 'true_false',
			],
		];

		return $fields;
	}
}