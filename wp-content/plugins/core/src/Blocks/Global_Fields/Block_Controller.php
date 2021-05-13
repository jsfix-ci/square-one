<?php declare(strict_types=1);

namespace Tribe\Project\Blocks\Global_Fields;

/**
 * Controls which blocks are allowed to have global fields.
 *
 * @package Tribe\Project\Blocks\Global_Field_Meta
 */
class Block_Controller {

	/**
	 * An array of block names that are allowed to have global fields.
	 *
	 * @var string[]
	 */
	private array $block_names;

	/**
	 * Block_Controller constructor.
	 *
	 * @param array $block_names An array of Block_Config::NAME's
	 */
	public function __construct( array $block_names = [] ) {
		$this->block_names = $block_names;
	}

	/**
	 * Whether the block is in the allowed list.
	 *
	 * @param string $block_name The Block_Config::NAME of the block.
	 *
	 * @return bool
	 */
	public function allowed( string $block_name ): bool {
		$block_name = str_replace( 'acf/', '', $block_name );

		return in_array( $block_name, $this->block_names, true );
	}
}
