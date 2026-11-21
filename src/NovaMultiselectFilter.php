<?php declare(strict_types=1);

namespace Klepak\NovaMultiselectFilter;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Laravel\Nova\Http\Requests\NovaRequest;
use InvalidArgumentException;
use Klepak\NovaMultiselectFilter\Enums\Config;
use Laravel\Nova\Filters\Filter;

abstract class NovaMultiselectFilter extends Filter
{
    /**
     * The filter's component.
     *
     * @var string
     */
    public $component = 'nova-multiselect-filter';

    public function __construct(array $configuration = [])
    {
        $this->configure($configuration);
    }

    /**
     * Apply the filter to the query.
     *
     * Nova 5 requires filters to return an Eloquent builder. Keeping that
     * contract here makes incompatibilities visible when an application filter
     * is loaded instead of failing later while Nova handles a request.
     */
    public function apply(NovaRequest $request, Builder $query, mixed $value): Builder
    {
        return $query;
    }

    protected function configure(array $configuration): void
    {
        if (empty($configuration)) {
            return;
        }

        foreach ($configuration as $property => $value) {
            if (!in_array($property, Config::getProperties(), true)) {
                throw new InvalidArgumentException('Invalid property: ' . $property);
            }

            $this->withMeta([$property => $value]);
        }
    }
}
