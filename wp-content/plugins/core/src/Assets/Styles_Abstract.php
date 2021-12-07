<?php declare(strict_types=1);

namespace Tribe\Project\Assets;

abstract class Styles_Abstract {

	private array $stylesheets = [];
	private bool $is_prod      = false;
	private float $timestamp   = 0;
	private string $version    = '';

	public function __construct( $stylesheets ) {
		$this->is_prod     = wp_get_environment_type() === 'production';
		$this->timestamp   = defined( 'ASSET_VERSION_TIMESTAMP' ) && ASSET_VERSION_TIMESTAMP === true ? time() : 0;
		$this->stylesheets = $stylesheets;
	}

	/**
	 * Register all styles for later enqueue
	 *
	 * @return void
	 *
	 * @action template_redirect
	 */
	public function register_styles(): void {
		// If constant is true, set version to current timestamp, forcing cache invalidation on every page load
		foreach ( $this->stylesheets as $handle => $asset ) {
			$version = ( $this->timestamp > 0 ) ? $this->timestamp : $this->version;
			wp_register_style( $handle, $asset['uri'] . $asset['filename'] . ( $this->is_prod ? '.min' : '' ) .'.css', $asset['dependencies'], $version, $asset['media'] );
		}
	}

	/**
	 * Enqueue the styles we need for the current page
	 *
	 * @action wp_enqueue_scripts
	 */
	public function enqueue_styles(): void {
		// enqueue all non-legacy handles
		foreach ( $this->stylesheets as $handle => $asset ) {
			wp_enqueue_style( $handle );
		}
	}

}
