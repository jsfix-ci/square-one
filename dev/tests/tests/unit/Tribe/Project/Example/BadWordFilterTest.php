<?php declare(strict_types=1);

namespace Tribe\Project\Example;

use Tribe\Tests\Unit;

final class BadWordFilterTest extends Unit {

	public function test_it_replaces_words(): void {
		$text   = 'Hey look at this clown!';
		$filter = new Bad_Word_Filter( [
			'clown',
			'circus',
		] );

		$this->assertSame( 'Hey look at this *****!', $filter->filter( $text ) );
	}

	public function test_it_allows_the_replacement_character_to_be_changed(): void {
		$text   = 'Hey look at this clown!';
		$filter = new Bad_Word_Filter( [
			'clown',
			'circus',
		], '%' );

		$this->assertSame( 'Hey look at this %%%%%!', $filter->filter( $text ) );
	}

	/**
	 * This test is broken, because our feature doesn't actually work properly!
	 */
	public function test_it_replaces_word_inside_other_words(): void {
		$text   = 'Hey look at this clownclownclown!';
		$filter = new Bad_Word_Filter( [
			'clown',
			'circus',
		] );

		$this->assertSame( 'Hey look at this ***************!', $filter->filter( $text ) );
	}


}
