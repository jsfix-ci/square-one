<?php declare(strict_types=1);

namespace Tribe\Project\Example;

use InvalidArgumentException;
use Tribe\Libs\Cache\Cache;
use Tribe\Project\Example\Contracts\String_Filter;
use Tribe\Project\Example\Contracts\String_Filter_Cache;

class Bad_Word_Filter_Cache implements String_Filter_Cache {

	protected String_Filter $filter;
	protected Cache $cache;
	protected string $key_format;

	public function __construct( String_Filter $filter, Cache $cache, string $key_format = 'filter_%d' ) {
		$this->filter     = $filter;
		$this->cache      = $cache;
		$this->key_format = $key_format;

		if ( ! str_contains( $this->key_format, '%d' ) ) {
			throw new InvalidArgumentException( 'The $key_format property must contain an integer replacement: %d.' );
		}
	}

	public function filter( string $text, int $post_id ): string {
		$content = $this->cache->get( $this->get_cache_key( $post_id ) );

		if ( $content ) {
			return $content;
		}

		$content = $this->filter->filter( $text );

		$this->cache->set( $this->get_cache_key( $post_id ), $content );

		return $content;
	}

	public function get_key_format(): string {
		return $this->key_format;
	}

	public function get_cache_key( int $post_id ): string {
		return sprintf( $this->get_key_format(), $post_id );
	}

}
