<?php declare(strict_types=1);

namespace Tribe\Project\Blocks\Middleware\Color_Theme;

use Tribe\Libs\Field_Models\Collections\Swatch_Collection;
use Tribe\Project\Blocks\Middleware\Color_Theme\Contracts\Appearance;

/**
 * Retrieve a theme CSS class based on an acf-swatch hex code.
 */
class Class_Manager implements Appearance {

	protected Swatch_Collection $swatch_collection;

	/**
	 * An sprintf() compatible string for the base CSS class that will
	 * have its color theme string added to it.
	 *
	 * @example 't-theme--%s' or 't-theme--%1$s'
	 */
	protected string $class_blueprint;

	public function __construct( Swatch_Collection $swatch_collection, string $class_blueprint ) {
		$this->swatch_collection = $swatch_collection;
		$this->class_blueprint   = $class_blueprint;
	}

	/**
	 * Retrieve the mapped CSS class from a color hex code.
	 *
	 * @param string $color_format e.g. #FFFFFF, rgb(255,0,0), rgba(255,0,0, 1) etc...
	 *
	 * @return string
	 */
	public function get_class( string $color_format ): string {
		$swatch = $this->swatch_collection->get_by_value( $color_format );

		return $swatch ? $this->sanitize_class( $swatch->slug ) : '';
	}

	protected function sanitize_class( string $class ): string {
		return sanitize_html_class( sprintf( $this->class_blueprint, sanitize_title( $class ) ) );
	}

}
