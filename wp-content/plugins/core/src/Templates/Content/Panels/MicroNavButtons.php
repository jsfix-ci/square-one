<?php

namespace Tribe\Project\Templates\Content\Panels;

use Tribe\Project\Panels\Types\MicroNavButtons as Micro;
use Tribe\Project\Templates\Components\Button;

class MicroNavButtons extends Panel {

	public function get_data(): array {
		$data       = parent::get_data();
		$panel_data = $this->get_mapped_panel_data();
		$data       = array_merge( $data, $panel_data );

		return $data;
	}

	public function get_title(): string {
		$title = '';

		if ( ! empty( $this->panel_vars[ Micro::FIELD_TITLE ] ) ) {
			$title = the_panel_title( esc_html( $this->panel_vars[ Micro::FIELD_TITLE ] ), 'site-section__title h2', 'title', true, 0, 0 );
		}

		return $title;
	}

	public function get_list_items(): array {
		$btns = [];

		if ( ! empty( $this->panel_vars[ Micro::FIELD_ITEMS ] ) ) {
			for ( $i = 0; $i < count( $this->panel_vars[ Micro::FIELD_ITEMS ] ); $i++ ) {

				$btn = $this->panel_vars[ Micro::FIELD_ITEMS ][ $i ];

				$options = [
					Button::URL    => esc_url( $btn[ Micro::FIELD_ITEM_CTA ]['url'] ),
					Button::TARGET => esc_attr( $btn[ Micro::FIELD_ITEM_CTA ]['target'] ),
					Button::LABEL  => esc_attr( $btn[ Micro::FIELD_ITEM_CTA ]['label'] ),
					Button::CLASSES => [ 'c-btn--full' ],
				];

				$btn_obj = Button::factory( $options );
				$btns[]  = $btn_obj->render();
			}
		}

		return $btns;
	}

	public function get_mapped_panel_data(): array {
		$data = [
			'title'       => $this->get_title(),
			'description' => ! empty( $this->panel_vars[ Micro::FIELD_DESCRIPTION ] ) ? $this->panel_vars[ Micro::FIELD_DESCRIPTION ] : false,
			'items'       => $this->get_list_items(),
		];

		return $data;
	}
}
