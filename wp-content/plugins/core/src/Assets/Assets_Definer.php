<?php declare(strict_types=1);

namespace Tribe\Project\Assets;

use Tribe\Libs\Container\Definer_Interface;
use Tribe\Project\Assets\Admin\Styles as Admin_Styles;
use Tribe\Project\Assets\Theme\Styles as Theme_Styles;

class Assets_Definer implements Definer_Interface {

	public const THEME_STYLES = 'theme.styles';
	public const ADMIN_STYLES = 'admin.styles';

	public function define(): array {
		return [
			Theme_Styles::class => \DI\create()->constructor(
				[
					'theme' => [
						'filename'     => 'master',
						'uri'          => get_stylesheet_directory_uri() . '/assets/css/dist/theme/',
						'dependencies' => [],
						'media'        => 'all',
					],
				],
			),
			Admin_Styles::class => \DI\create()->constructor(
				[
					'admin' => [
						'filename'     => 'master',
						'uri'          => get_stylesheet_directory_uri() . '/assets/css/dist/admin/',
						'dependencies' => [],
						'media'        => 'all',
					],
				],
			),
		];
	}

}
