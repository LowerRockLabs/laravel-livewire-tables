<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters;

use Rappasoft\LaravelLivewireTables\Views\Traits\Core\HasSelectOptions;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class MultiSelectDropdownFilter extends Filter
{
    use HasSelectOptions;

    protected string $view = 'livewire-tables::components.tools.filters.multi-select-dropdown';

    public function validate(int|string|array $value): array|int|string|bool
    {
        if (is_array($value)) {
            foreach ($value as $index => $val) {
                // Remove the bad value
                if (! in_array($val, $this->getKeys())) {
                    unset($value[$index]);
                }
            }

            return $value;
        }

        return (is_string($value) || is_numeric($value)) ? $value : false;
    }

    /**
     * Get the filter default options.
     */
    public function getDefaultValue(): array
    {
        return [];
    }

    /**
     * Gets the Default Value for this Filter via the Component
     */
    public function getFilterDefaultValue(): array
    {
        return $this->filterDefaultValue ?? [];
    }

    public function getFilterPillValue($value): ?string
    {
        $values = [];

        foreach ($value as $item) {
            $found = $this->getCustomFilterPillValue($item)
                        ?? collect($this->getOptions())
                            ->mapWithKeys(fn ($options, $optgroupLabel) => is_iterable($options) ? $options : [$optgroupLabel => $options])[$item]
                        ?? null;

            if ($found) {
                $values[] = $found;
            }
        }

        return implode(', ', $values);
    }

    public function isEmpty($value): bool
    {
        if (! is_array($value)) {
            return true;
        } elseif (in_array('all', $value)) {
            return true;
        }

        return false;
    }
}
