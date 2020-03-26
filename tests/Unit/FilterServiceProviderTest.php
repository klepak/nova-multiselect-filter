<?php

namespace Klepak\NovaMultiselectFilter\Tests\Unit;

use Illuminate\Support\Facades\App;
use Klepak\NovaMultiselectFilter\FilterServiceProvider;
use Klepak\NovaMultiselectFilter\Tests\TestCase;

class FilterServiceProviderTest extends TestCase
{
    public function test_can_get_translations_from_app_locale()
    {
        $provider = new FilterServiceProvider($this->app);

        $default = $provider->getTranslationsFromAppLocale();

        $this->assertNull(
            $default
        );

        App::setLocale('de');

        $german = $provider->getTranslationsFromAppLocale();

        $this->assertStringContainsString(
            'de/filter.json',
            $german
        );
    }
}
