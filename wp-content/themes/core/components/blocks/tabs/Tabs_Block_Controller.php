<?php declare(strict_types=1);

namespace Tribe\Project\Templates\Components\blocks\tabs;

use Tribe\Libs\Utils\Markup_Utils;
use Tribe\Project\Blocks\Types\Tabs\Tabs as Tabs_Block;
use Tribe\Project\Templates\Components\Abstract_Controller;
use Tribe\Project\Templates\Components\container\Container_Controller;
use Tribe\Project\Templates\Components\content_block\Content_Block_Controller;
use Tribe\Project\Templates\Components\Deferred_Component;
use Tribe\Project\Templates\Components\link\Link_Controller;
use Tribe\Project\Templates\Components\tabs\Tabs_Controller;
use Tribe\Project\Templates\Components\text\Text_Controller;

class Tabs_Block_Controller extends Abstract_Controller {

	public const ATTRS             = 'attrs';
	public const CLASSES           = 'classes';
	public const CONTAINER_CLASSES = 'container_classes';
	public const CTA               = 'cta';
	public const DESCRIPTION       = 'description';
	public const LAYOUT            = 'layout';
	public const LEADIN            = 'leadin';
	public const TABS              = 'tabs';
	public const TITLE             = 'title';

	/**
	 * @var string[]
	 */
	private array $attrs;

	/**
	 * @var string[]
	 */
	private array $classes;

	/**
	 * @var string[]
	 */
	private array $container_classes;

	/**
	 * @var string[]
	 */
	private array $cta;

	/**
	 * @var string[]
	 */
	private array $tabs;
	private string $description;
	private string $layout;
	private string $leadin;
	private string $title;

	/**
	 * @param array $args
	 */
	public function __construct( array $args = [] ) {
		$args = $this->parse_args( $args );

		$this->attrs             = (array) $args[ self::ATTRS ];
		$this->classes           = (array) $args[ self::CLASSES ];
		$this->container_classes = (array) $args[ self::CONTAINER_CLASSES ];
		$this->cta               = (array) $args[ self::CTA ];
		$this->description       = (string) $args[ self::DESCRIPTION ];
		$this->layout            = (string) $args[ self::LAYOUT ];
		$this->leadin            = (string) $args[ self::LEADIN ];
		$this->tabs              = (array) $args[ self::TABS ];
		$this->title             = (string) $args[ self::TITLE ];
	}

	public function get_classes(): string {
		$this->classes[] = sprintf( 'c-block--layout-%s', $this->layout );

		return Markup_Utils::class_attribute( $this->classes );
	}

	public function get_attrs(): string {
		return Markup_Utils::concat_attrs( $this->attrs );
	}

	public function get_container_classes(): string {
		return Markup_Utils::class_attribute( $this->container_classes );
	}

	public function get_header_args(): array {
		if ( empty( $this->title ) && empty( $this->description ) ) {
			return [];
		}

		return [
			Content_Block_Controller::TAG     => 'header',
			Content_Block_Controller::LEADIN  => $this->get_leadin(),
			Content_Block_Controller::TITLE   => $this->get_title(),
			Content_Block_Controller::CONTENT => $this->get_content(),
			Content_Block_Controller::CTA     => $this->get_cta(),
			Content_Block_Controller::CLASSES => [
				'c-block__content-block',
				'c-block__header',
				'b-tabs__header',
			],
		];
	}

	public function get_tabs_args(): array {
		return [
			Tabs_Controller::TABS    => $this->tabs,
			Tabs_Controller::LAYOUT  => $this->layout,
			Tabs_Controller::CLASSES => [ 'b-tabs__content' ],
		];
	}

	protected function defaults(): array {
		return [
			self::ATTRS             => [],
			self::CLASSES           => [],
			self::CONTAINER_CLASSES => [ 'l-container' ],
			self::CTA               => [],
			self::DESCRIPTION       => '',
			self::LAYOUT            => Tabs_Block::LAYOUT_HORIZONTAL,
			self::LEADIN            => '',
			self::TABS              => [],
			self::TITLE             => '',
		];
	}

	protected function required(): array {
		return [
			self::CLASSES           => [ 'c-block', 'b-tabs' ],
			self::CONTAINER_CLASSES => [ 'b-tabs__container' ],
		];
	}

	private function get_leadin(): Deferred_Component {
		return defer_template_part( 'components/text/text', null, [
			Text_Controller::CLASSES => [
				'c-block__leadin',
				'b-tabs__leadin',
				'h6',
			],
			Text_Controller::CONTENT => $this->leadin ?? '',
		] );
	}

	private function get_title(): Deferred_Component {
		return defer_template_part( 'components/text/text', null, [
			Text_Controller::TAG     => 'h2',
			Text_Controller::CLASSES => [
				'c-block__title',
				'b-tabs__title',
				'h3',
			],
			Text_Controller::CONTENT => $this->title ?? '',
		] );
	}

	private function get_content(): Deferred_Component {
		return defer_template_part( 'components/container/container', null, [
			Container_Controller::CLASSES => [
				'c-block__description',
				'b-tabs__description',
				't-sink',
				's-sink',
			],
			Container_Controller::CONTENT => $this->description ?? '',
		] );
	}

	private function get_cta(): Deferred_Component {
		$cta = wp_parse_args( $this->cta, [
			'content'        => '',
			'url'            => '',
			'target'         => '',
			'add_aria_label' => false,
			'aria_label'     => '',
		] );

		return defer_template_part( 'components/link/link', null, [
			Link_Controller::URL            => $cta['url'],
			Link_Controller::CONTENT        => $cta['content'] ?: $cta['url'],
			Link_Controller::TARGET         => $cta['target'],
			Link_Controller::ADD_ARIA_LABEL => $cta['add_aria_label'],
			Link_Controller::ARIA_LABEL     => $cta['aria_label'],
			Link_Controller::CLASSES        => [
				'c-block__cta-link',
				'a-btn',
				'a-btn--has-icon-after',
				'icon-arrow-right',
			],
		] );
	}

}
