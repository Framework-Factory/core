<?php

describe('cache tests', function () {
    test('the cache directory is successfully created', function () {
        expect(file_exists(Tests\TestState::$cachePath))->toBeTrue();
    });

    test('the cache file is successfully created and exists', function () {
        expect(file_exists(rtrim(Tests\TestState::$cachePath, '/') . '/app.php'))->toBeTrue();
    });

    test('the cache file includes the standard providers injected upon bootstrap', function () {
        $file = require rtrim(Tests\TestState::$cachePath, '/') . '/app.php';
        $providers = $file['providers'];

        expect($providers)->toContain(Tests\Providers\StandardServiceProvider::class);
    });

    test('the cache file includes the deferred providers injected upon bootstrap', function () {
        $file = require rtrim(Tests\TestState::$cachePath, '/') . '/app.php';
        $deferred = $file['deferred'];

        expect($deferred)
            ->toHaveKey('deferred_provider')
            ->and($deferred['deferred_provider'])
            ->toContain(Tests\Providers\DeferredServiceProvider::class);
    });

    test('the cache file includes the correct aliases for deferred providers', function () {
        $file = require rtrim(Tests\TestState::$cachePath, '/') . '/app.php';
        $aliases = $file['aliases'];

        expect($aliases)
            ->toHaveKey('deferred_provider')
            ->and($aliases['deferred_provider'])
            ->toEqual('deferred_provider');
    });
})->group('cache');
