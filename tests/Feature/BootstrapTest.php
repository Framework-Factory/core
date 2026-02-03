<?php

use FrameworkFactory\Application;
use FrameworkFactory\Contracts;

describe('bootstrap tests', function () {
    test('the application bootstrap build process completes properly', function () {
        expect(Tests\TestState::$app)->toBeInstanceOf(Contracts\Application\ApplicationInstance::class);
    });

    test('the version number can be assigned to the application', function () {
        Tests\TestState::$app->asVersion('1.2.3');
        expect(Application::version())->toBe('1.2.3');
    });
})->group('bootstrap');
