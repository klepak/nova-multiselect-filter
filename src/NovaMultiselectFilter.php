<?php declare(strict_types=1);

namespace Klepak\NovaMultiselectFilter;

use InvalidArgumentException;
use Klepak\NovaMultiselectFilter\Enums\Configuration;
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

    protected function configure(array $configuration): void
    {
        if (empty($configuration)) {
            return;
        }

        foreach ($configuration as $property => $value) {
            if (!in_array($property, Configuration::values(), true)) {
                throw new InvalidArgumentException('Invalid configuration property: ' . $property);
            }

            $this->withMeta([$property => $value]);
        }
    }
}
