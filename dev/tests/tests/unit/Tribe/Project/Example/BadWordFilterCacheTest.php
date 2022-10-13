<?php declare(strict_types=1);

namespace Tribe\Project\Example;

use InvalidArgumentException;
use Tribe\Libs\Cache\Cache;
use Tribe\Project\Example\Contracts\String_Filter;
use Tribe\Tests\Unit;

final class BadWordFilterCacheTest extends Unit {

	private String_Filter $filter;
	private Cache $cache;

	protected function setUp(): void {
		parent::setUp();

		$this->filter = new Bad_Word_Filter( [
			'dog',
			'cat',
			'chicken',
		] );

		$this->cache = new Cache();
	}

	public function test_it_throws_an_exception_when_using_an_invalid_key_format(): void {
		$this->expectException( InvalidArgumentException::class );
		new Bad_Word_Filter_Cache( $this->filter, $this->cache, 'invalid_cache_format' );
	}

	public function test_it_fetches_the_key_format(): void {
		$filter_cache = new Bad_Word_Filter_Cache( $this->filter, $this->cache, 'custom_%d_filter' );

		$this->assertSame( 'custom_%d_filter', $filter_cache->get_key_format() );
		$this->assertSame( 'custom_25_filter', $filter_cache->get_cache_key( 25 ) );
	}

}
