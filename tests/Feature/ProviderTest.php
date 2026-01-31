<?php

use FrameworkFactory\Application;

describe('provider tests', function() {
	test('providers can be successfully added to the container', function() {
		expect(Application::providers())->toContain(Tests\Providers\DeferredServiceProvider::class);
	});
})->group('providers');