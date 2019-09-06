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

    public function placeholder(string $placeholder): self
    {
        return $this->withMeta([__FUNCTION__ => $placeholder]);
    }

    public function showLabels(bool $showLabels): self
    {
        return $this->withMeta([__FUNCTION__ => $showLabels]);
    }

    public function selectLabel(string $selectLabel): self
    {
        return $this->withMeta([__FUNCTION__ => $selectLabel]);
    }

    public function selectedLabel(string $selectedLabel): self
    {
        return $this->withMeta([__FUNCTION__ => $selectedLabel]);
    }

    public function deselectLabel(string $deselectLabel): self
    {
        return $this->withMeta([__FUNCTION__ => $deselectLabel]);
    }

    public function noOptionsLabel(string $noOptionsLabel): self
    {
        return $this->withMeta([__FUNCTION__ => $noOptionsLabel]);
    }
}
