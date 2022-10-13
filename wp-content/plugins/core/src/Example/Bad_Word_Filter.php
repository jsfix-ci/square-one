<?php declare(strict_types=1);

namespace Tribe\Project\Example;

use Tribe\Project\Example\Contracts\String_Filter;

class Bad_Word_Filter implements String_Filter {

	/**
	 * @var string[]
	 */
	protected array $bad_words;
	protected string $replacement_character;

	public function __construct( array $bad_words, string $replacement_character = '*' ) {
		$this->bad_words             = $bad_words;
		$this->replacement_character = $replacement_character;
	}

	public function filter( string $text ): string {
		return preg_replace_callback(
			array_map( static fn( $w ) => '/\b' . preg_quote( $w, '/' ) . '\b/i', $this->bad_words ),
			fn( $match ) => str_repeat( $this->replacement_character, strlen( $match[0] ) ),
			$text
		);
	}

}
