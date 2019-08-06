# Installation

```bash
composer require klepak/nova-multiselect-filter
```

# Description

Multiselect filter for Laravel Nova. Based on [vue-multiselect](https://vue-multiselect.js.org)

![example](https://raw.githubusercontent.com/klepak/nova-multiselect-filter/master/docs/example.gif)

# Usage

```php
use Illuminate\Http\Request;
use Klepak\NovaMultiselectFilter\NovaMultiselectFilter;

class CustomFilter extends NovaMultiselectFilter
{
    public function apply(Request $request, $query, $value)
    {
        return $query->whereIn('field', $value);
    }

    public function options(Request $request)
    {
        return [
            'Label 1' => 'value-1',
            'Label 2' => 'value-2',
            'Label 3' => 'value-3',
        ];
    }
}
```
