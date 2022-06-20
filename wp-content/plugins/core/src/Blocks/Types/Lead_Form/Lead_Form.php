<?php declare(strict_types=1);

namespace Tribe\Project\Blocks\Types\Lead_Form;

use Tribe\Libs\ACF\Block;
use Tribe\Libs\ACF\Block_Config;
use Tribe\Libs\ACF\Field;
use Tribe\Libs\ACF\Field_Section;
use Tribe\Project\Admin\Editor\Classic_Editor_Formats;
use Tribe\Project\Blocks\Fields\Cta_Field;
use Tribe\Project\Blocks\Fields\Traits\With_Cta_Field;

class Lead_Form extends Block_Config implements Cta_Field {

	use With_Cta_Field;

	public const NAME = 'leadform';

	public const WIDTH       = 'width';
	public const WIDTH_GRID  = 'grid';
	public const WIDTH_FULL  = 'full';
	public const LEAD_IN     = 'leadin';
	public const TITLE       = 'title';
	public const DESCRIPTION = 'description';

	public const SECTION_APPEARANCE = 's-appearance';
	public const LAYOUT             = 'layout';
	public const LAYOUT_LEFT        = 'left';
	public const LAYOUT_RIGHT       = 'right';
	public const LAYOUT_BOTTOM      = 'bottom';
	public const FORM_FIELDS        = 'form_fields';
	public const FORM_STACKED       = 'form_stacked';
	public const FORM_INLINE        = 'form_inline';
	public const BACKGROUND         = 'background';
	public const BACKGROUND_LIGHT   = 'background_light';
	public const BACKGROUND_DARK    = 'background_dark';

	/**
	 * Register the block
	 */
	public function add_block(): void {
		$this->set_block( new Block( self::NAME, [
			'title'       => __( 'Lead Form', 'tribe' ),
			'description' => __( 'A block with a form selector for a newsletter/lead form.', 'tribe' ),
			'icon'        => '<svg width="20" height="20" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill="#fff" stroke="#000" stroke-linecap="round" stroke-linejoin="round" d="M.5.5h19v19H.5z"/><path fill="#000" d="M3 4h14v2H3zM5 7h10v2H5zM14 12h4v4h-4z"/><path fill="#fff" stroke="#000" d="M2.5 12.5h11v3h-11z"/></svg>',
			'keywords'    => [ __( 'form', 'tribe' ), __( 'display', 'tribe' ) ],
			'category'    => 'layout',
			'supports'    => [
				'align'  => false,
				'anchor' => true,
				'jsx'    => true,
			],
			'example'     => [
				'attributes' => [
					'mode' => 'preview',
					'data' => [
						self::LEAD_IN     => esc_html__( 'Lorem ipsum dolor sit amet.', 'tribe' ),
						self::TITLE       => esc_html__( 'The Lead Form Title', 'tribe' ),
						self::DESCRIPTION => esc_html__(
							'Cras ut ornare dui, sed venenatis est. Donec euismod in leo quis consequat.',
							'tribe'
						),
						self::GROUP_CTA   => [
							self::LINK => [
								'title'  => esc_html__( 'Lorem ipsum', 'tribe' ),
								'url'    => '#',
								'target' => '',
							],
						],
					],
				],
			],
		] ) );
	}

	/**
	 * Register Fields for block
	 */
	public function add_fields(): void {
		$this->add_field(
			new Field( self::NAME . '_' . self::WIDTH, [
				'type'          => 'button_group',
				'name'          => self::WIDTH,
				'label'         => __( 'Container Width', 'tribe' ),
				'choices'       => [
					self::WIDTH_GRID => __( 'Grid', 'tribe' ),
					self::WIDTH_FULL => __( 'Full', 'tribe' ),
				],
				'default_value' => self::WIDTH_GRID,
			] )
		)->add_field( new Field( self::NAME . '_' . self::LEAD_IN, [
				'label'       => __( 'Lead in', 'tribe' ),
				'name'        => self::LEAD_IN,
				'type'        => 'text',
				'placeholder' => __( 'Lead in (optional)', 'tribe' ),
				'wrapper'     => [
					'class' => 'tribe-acf-hide-label',
				],
			] )
		)->add_field( new Field( self::NAME . '_' . self::TITLE, [
				'label' => __( 'Title', 'tribe' ),
				'name'  => self::TITLE,
				'type'  => 'text',
			] )
		)->add_field( new Field( self::NAME . '_' . self::DESCRIPTION, [
				'label'        => __( 'Description', 'tribe' ),
				'name'         => self::DESCRIPTION,
				'type'         => 'wysiwyg',
				'toolbar'      => Classic_Editor_Formats::MINIMAL,
				'tabs'         => 'visual',
				'media_upload' => 0,
			] )
		)->add_field(
			$this->get_cta_field( self::NAME )
		);

		$this->add_section( new Field_Section( self::SECTION_APPEARANCE, __( 'Appearance', 'tribe' ), 'accordion' ) )
			 ->add_field(
				 new Field( self::NAME . '_' . self::LAYOUT, [
					 'type'          => 'button_group',
					 'name'          => self::LAYOUT,
					 'label'         => __( 'Form Layout', 'tribe' ),
					 'choices'       => [
						 self::LAYOUT_LEFT   => __( 'Left', 'tribe' ),
						 self::LAYOUT_RIGHT  => __( 'Right', 'tribe' ),
						 self::LAYOUT_BOTTOM => __( 'Bottom', 'tribe' ),
					 ],
					 'default_value' => self::LAYOUT_LEFT,
				 ] )
			 )->add_field(
				 new Field( self::NAME . '_' . self::FORM_FIELDS, [
					'type'          => 'button_group',
					'name'          => self::FORM_FIELDS,
					'label'         => __( 'Form Field Position', 'tribe' ),
					'choices'       => [
						self::FORM_STACKED => __( 'Stacked', 'tribe' ),
						self::FORM_INLINE  => __( 'Inline', 'tribe' ),
					],
					'default_value' => self::FORM_STACKED,
				 ] )
			 )->add_field(
				 new Field( self::NAME . '_' . self::BACKGROUND, [
					'type'          => 'button_group',
					'name'          => self::BACKGROUND,
					'label'         => __( 'Background Color', 'tribe' ),
					'choices'       => [
						self::BACKGROUND_LIGHT => __( 'Light', 'tribe' ),
						self::BACKGROUND_DARK  => __( 'Dark', 'tribe' ),
					],
					'default_value' => self::BACKGROUND_LIGHT,
				 ] )
			 );
	}

}
