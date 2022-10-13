<?php declare(strict_types=1);

namespace Tribe\Project\Example\Contracts;

interface String_Filter_Cache {

	public function filter( string $text, int $post_id ): string;
	public function get_key_format(): string;
	public function get_cache_key( int $post_id ): string;

}
