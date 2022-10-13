<?php declare(strict_types=1);

namespace Tribe\Project\Example\Contracts;

interface String_Filter {

	public function filter( string $text ): string;

}
