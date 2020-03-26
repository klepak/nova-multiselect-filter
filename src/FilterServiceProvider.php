<?php declare(strict_types=1);

namespace Klepak\NovaMultiselectFilter;

use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Nova;

class FilterServiceProvider extends ServiceProvider
{
    protected const SCRIPT_FILE = __DIR__ . '/../dist/js/filter.js';
    protected const DE_LANGUAGE_FILE = __DIR__ . '/../resources/lang/de/filter.json';

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        Nova::serving(static function () {
            Nova::script('nova-multiselect-filter', self::SCRIPT_FILE);
            Nova::translations(self::DE_LANGUAGE_FILE);
        });
    }
}
