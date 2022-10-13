<?php declare(strict_types=1);

namespace Tribe\Project\Example;

use DI;
use Tribe\Libs\Container\Definer_Interface;
use Tribe\Project\Example\Contracts\String_Filter;
use Tribe\Project\Example\Contracts\String_Filter_Cache;

class Filter_Definer implements Definer_Interface {

	public const BAD_WORDS = 'example.bad_words';

	public function define(): array {
		return [
			self::BAD_WORDS            => DI\add( [
				'clown',
				'circus',
				'balloon',
				'bozo',
			] ),

			String_Filter::class       => DI\get( Bad_Word_Filter::class ),
			String_Filter_Cache::class => DI\get( Bad_Word_Filter_Cache::class ),
			Bad_Word_Filter::class     => DI\autowire()
				->constructorParameter( 'bad_words', DI\get( self::BAD_WORDS ) ),
		];
	}

}
