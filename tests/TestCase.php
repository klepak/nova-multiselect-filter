<?php

namespace Dukstra\NovaMultiselectFilter\Tests;

use Illuminate\Container\Container;
use Illuminate\Config\Repository;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Facade;
use Illuminate\Translation\ArrayLoader;
use Illuminate\Translation\Translator;
use PHPUnit\Framework\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected Application $app;

    protected function setUp(): void
    {
        parent::setUp();

        $this->app = new Application();
        $this->app->instance('config', new Repository([
            'app' => ['locale' => 'en'],
        ]));
        $this->app->instance('translator', new Translator(new ArrayLoader(), 'en'));
        Container::setInstance($this->app);
        Facade::setFacadeApplication($this->app);
    }

    protected function tearDown(): void
    {
        Facade::clearResolvedInstances();
        Facade::setFacadeApplication(null);
        Container::setInstance(null);

        parent::tearDown();
    }
}
