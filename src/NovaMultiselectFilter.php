<?php declare(strict_types=1);

namespace Klepak\NovaMultiselectFilter;

use Laravel\Nova\Filters\Filter;

abstract class NovaMultiselectFilter extends Filter
{
    /**
     * The filter's component.
     *
     * @var string
     */
    public $component = 'nova-multiselect-filter';
}
