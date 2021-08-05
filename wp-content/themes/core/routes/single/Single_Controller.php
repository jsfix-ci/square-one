<?php declare(strict_types=1);

namespace Tribe\Project\Templates\Routes\single;

use Tribe\Project\Taxonomies\Category\Category;
use Tribe\Project\Templates\Components\Abstract_Controller;
use Tribe\Project\Templates\Components\footer\single_footer\Single_Footer_Controller;
use Tribe\Project\Templates\Components\header\subheader\Subheader_Single_Controller;
use Tribe\Project\Templates\Components\tags_list\Tags_List_Controller;
use Tribe\Project\Templates\Components\Traits\Page_Title;
use Tribe\Project\Templates\Components\Traits\Primary_Term;

class Single_Controller extends Abstract_Controller {

	use Page_Title;
	use Primary_Term;

	/**
	 * @var int|string
	 */
	public $sidebar_id = '';

	public function get_subheader_args(): array {
		global $post;

		$term = $this->get_primary_term( $post->ID );

		return [
			Subheader_Single_Controller::TITLE                => $this->get_page_title(),
			Subheader_Single_Controller::DATE                 => get_the_date(),
			Subheader_Single_Controller::AUTHOR               => get_the_author_meta( 'display_name', $post->post_author ),
			Subheader_Single_Controller::SHOULD_RENDER_BYLINE => true,
			Subheader_Single_Controller::TAG_NAME             => $term->name,
			Subheader_Single_Controller::TAG_LINK             => get_term_link( $term ),
		];
	}

	public function get_content_footer_args(): array {
		return [
			Single_Footer_Controller::CLASSES => [],
		];
	}

	public function get_first_taxonomy_term(): ?\WP_Term {
		$terms = $this->get_taxonomy_terms();

		if ( empty( $terms ) ) {
			return null;
		}

		if ( $terms[0] instanceof \WP_Term ) {
			return $terms[0];
		}

		return null;
	}

	public function get_taxonomy_terms(): array {
		global $post;

		$terms = get_the_terms( $post->ID, Category::NAME );
		if ( ! $terms ) {
			return [];
		}

		return $terms;
	}

	public function get_tags_list_args(): array {
		$tags_list = [];
		/** @var \WP_Term $term */
		foreach ( $this->get_taxonomy_terms() as $term ) {
			$tags_list[ $term->name ] = get_term_link( $term );
		}

		return [
			Tags_List_Controller::TAGS => $tags_list,
		];
	}

}
