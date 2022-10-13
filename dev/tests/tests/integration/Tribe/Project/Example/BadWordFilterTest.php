<?php declare(strict_types=1);

namespace Tribe\Project\Example;

use Tribe\Libs\Cache\Cache;
use Tribe\Project\Example\Contracts\String_Filter;
use Tribe\Project\Example\Contracts\String_Filter_Cache;
use Tribe\Tests\Test_Case;

/**
 * The tests here are fragile and may fail any time a developer
 * changes the project's bad word list or interface mapping.
 *
 * That may or may not be a good thing that we should discuss next time.
 *
 * @see \Tribe\Project\Example\Filter_Definer::define()
 */
final class BadWordFilterTest extends Test_Case {

	/**
	 * This is fragile, but it tests that our Definer is properly mapping
	 * the concrete classes to their instances when called out of the container.
	 */
	public function test_it_maps_concrete_classes_to_interfaces(): void {
		$filter = $this->container->get( String_Filter::class );
		$this->assertInstanceOf( Bad_Word_Filter::class, $filter );

		$filter_cache = $this->container->get( String_Filter_Cache::class );
		$this->assertInstanceOf( Bad_Word_Filter_Cache::class, $filter_cache );
	}

	public function test_it_replaces_words_in_a_post_title(): void {
		$post_id = $this->factory()->post->create( [
			'post_title' => 'I saw a clown at the circus.',
		] );

		$this->assertSame( 'I saw a ***** at the ******.', get_the_title( $post_id ) );
	}

	public function test_it_replaces_words_in_post_content(): void {
		$post_id = $this->factory()->post->create( [
			'post_title'   => 'Test Post',
			'post_content' => 'I saw a clown at the circus.',
		] );

		$this->assertSame( 'Test Post', get_the_title( $post_id ) );
		$this->assertStringContainsString( '<p>I saw a ***** at the ******.</p>', apply_filters( 'the_content', get_post( $post_id )->post_content ) );
	}

	public function test_it_retrieves_data_from_the_cache(): void {
		$post_id = $this->factory()->post->create( [
			'post_title' => 'I saw a clown at the circus.',
		] );

		$this->assertSame( 'I saw a ***** at the ******.', get_the_title( $post_id ) );

		$cache        = $this->container->get( Cache::class );
		$filter_cache = $this->container->get( String_Filter_Cache::class );

		$this->assertSame( 'I saw a ***** at the ******.', $cache->get( $filter_cache->get_cache_key( $post_id ) ) );
	}

}
