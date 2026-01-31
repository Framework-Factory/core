<?php

namespace Tests\Accessors {

	use FrameworkFactory\Application\Accessor;

	/**
	 * @method static message(string $message): string
	 */
	class DeferredAccessor extends Accessor
	{
		/** @inheritdoc */
		protected static string $key = 'deferred_provider';
	}
}