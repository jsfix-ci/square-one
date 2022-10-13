<?php declare(strict_types=1);

namespace Tribe\Project\Example;

use Tribe\Libs\Container\Abstract_Subscriber;
use Tribe\Project\Example\Contracts\String_Filter_Cache;

class Filter_Subscriber extends Abstract_Subscriber {

	public function register(): void {
		add_filter( 'the_title', function ( $title, $post_id ) {
			return $this->container->get( String_Filter_Cache::class )->filter( $title, $post_id );
		}, 10, 2 );

		add_filter( 'the_content', function ( $title ) {
			return $this->container->get( String_Filter_Cache::class )->filter( $title, (int) get_the_ID() );
		}, 10, 1 );
	}

}
