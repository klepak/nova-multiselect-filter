<?php

namespace Dukstra\NovaMultiselectFilter\Tests\Unit;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Dukstra\NovaMultiselectFilter\NovaMultiselectFilter;
use Laravel\Nova\Filters\Filter;
use Laravel\Nova\Http\Requests\NovaRequest;
use Dukstra\NovaMultiselectFilter\Tests\TestCase;

class NovaMultiselectFilterTest extends TestCase
{
    public function test_it_remains_a_nova_filter_and_keeps_supported_configuration(): void
    {
        $filter = new TestNovaMultiselectFilter([
            'placeholder' => 'Choose an option',
            'closeOnSelect' => false,
        ]);

        $this->assertInstanceOf(Filter::class, $filter);
        $this->assertSame('nova-multiselect-filter', $filter->component);
        $this->assertSame('Choose an option', $filter->meta()['placeholder']);
        $this->assertFalse($filter->meta()['closeOnSelect']);
    }

    public function test_it_rejects_unknown_configuration_keys(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid property: unsupported');

        new TestNovaMultiselectFilter(['unsupported' => true]);
    }

    public function test_apply_uses_the_nova_builder_return_contract(): void
    {
        $method = new \ReflectionMethod(NovaMultiselectFilter::class, 'apply');

        $this->assertSame(Builder::class, (string) $method->getReturnType());
    }
}

class TestNovaMultiselectFilter extends NovaMultiselectFilter
{
    public function options(NovaRequest $request)
    {
        return ['First' => 1, 'Second' => 2];
    }
}
