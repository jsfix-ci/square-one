<?php declare(strict_types=1);

namespace Tribe\Project\Assets\Theme;

use Tribe\Project\Assets\Styles_Abstract;

class Styles extends Styles_Abstract {

	private string $version = '1.0.0';

	/**
	 * Dequeue WP Core's default block styles from the public FE.
	 *
	 * @action wp_enqueue_scripts
	 */
	public function dequeue_block_styles(): void {
		wp_dequeue_style( 'wp-block-library' );
	}

}
