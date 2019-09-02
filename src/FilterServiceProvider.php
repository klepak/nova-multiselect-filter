<?php declare(strict_types=1);

namespace Klepak\NovaMultiselectFilter;

use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Nova;

class FilterServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        Nova::serving(static function () {
            Nova::script('nova-multiselect-filter', __DIR__ . '/../dist/js/filter.js');
        });
    }
}
