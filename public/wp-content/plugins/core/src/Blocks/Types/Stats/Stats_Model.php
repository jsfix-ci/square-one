<?php declare(strict_types=1);

namespace Tribe\Project\Blocks\Types\Stats;

use Tribe\Project\Blocks\Fields\Cta_Field;
use Tribe\Project\Blocks\Types\Base_Model;
use Tribe\Project\Templates\Components\blocks\stats\Stats_Block_Controller;
use Tribe\Project\Templates\Components\link\Link_Controller;
use Tribe\Project\Templates\Models\Statistic as Statistic_Model;

class Stats_Model extends Base_Model {

	/**
	 * @return array
	 */
	public function get_data(): array {
		return [
			Stats_Block_Controller::ATTRS         => $this->get_attrs(),
			Stats_Block_Controller::CLASSES       => $this->get_classes(),
			Stats_Block_Controller::LAYOUT        => $this->get( Stats::LAYOUT, Stats::LAYOUT_STACKED ),
			Stats_Block_Controller::CONTENT_ALIGN => $this->get( Stats::CONTENT_ALIGN, Stats::CONTENT_ALIGN_CENTER ),
			Stats_Block_Controller::DIVIDERS      => $this->get( Stats::DIVIDERS, Stats::DIVIDERS_SHOW ),
			Stats_Block_Controller::TITLE         => $this->get( Stats::TITLE, '' ),
			Stats_Block_Controller::LEADIN        => $this->get( Stats::LEAD_IN, '' ),
			Stats_Block_Controller::DESCRIPTION   => $this->get( Stats::DESCRIPTION, '' ),
			Stats_Block_Controller::CTA           => $this->get_cta_args(),
			Stats_Block_Controller::STATS         => $this->get_stats(),
		];
	}

	/**
	 * @return array
	 */
	private function get_cta_args(): array {
		$cta  = $this->get( Cta_Field::GROUP_CTA, [] );
		$link = wp_parse_args( $cta['link'] ?? [], [
			'title'  => '',
			'url'    => '',
			'target' => '',
		] );

		return [
			Link_Controller::CONTENT        => $link['title'],
			Link_Controller::URL            => $link['url'],
			Link_Controller::TARGET         => $link['target'],
			Link_Controller::ADD_ARIA_LABEL => $cta['add_aria_label'] ?? false,
			Link_Controller::ARIA_LABEL     => $cta['aria_label'] ?? '',
		];
	}

	/**
	 * @return array
	 */
	private function get_stats(): array {
		$stat_objects = [];
		$stats_data   = get_field( Stats::STATS );

		if ( empty( $stats_data ) ) {
			return $stat_objects;
		}

		foreach ( $stats_data as $item ) {
			$stat_objects[] = new Statistic_Model( $item[ Stats::ROW_VALUE ], $item[ Stats::ROW_LABEL ] );
		}

		return $stat_objects;
	}

}
