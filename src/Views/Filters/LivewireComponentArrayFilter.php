<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters;

use Rappasoft\LaravelLivewireTables\Views\Filter;
use Rappasoft\LaravelLivewireTables\Views\Filters\Traits\{HasOptions, HasWireables, IsArrayFilter, IsLivewireComponentFilter};

class LivewireComponentArrayFilter extends Filter
{
    use HasWireables;
    use IsArrayFilter;
    use HasOptions;
    use IsLivewireComponentFilter;

    public string $wireMethod = 'blur';

    protected string $view = 'livewire-tables::components.tools.filters.livewire-component-array-filter';

    public function validate(array $value): array|bool
    {
        // $this->options($valueArray);

        return $value;
    }

    public function isEmpty(array $value = []): bool
    {
        if (empty($value) || count($value) == 0) {
            return true;
        }

        return false;
    }

    /**
     * Gets the Default Value for this Filter via the Component
     */
    public function getFilterDefaultValue(): ?array
    {
        return $this->filterDefaultValue ?? null;
    }

    public function getFilterPillValue($value): array|string|bool|null
    {
        return [];
    }

    public function getKeys(): array
    {
        return array_keys($this->options ?? []);
    }
}
