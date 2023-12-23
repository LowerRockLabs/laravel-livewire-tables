<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters;

use DateTime;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class DateFilter extends Filter
{
    protected string $view = 'livewire-tables::components.tools.filters.date';

    public string $configPath = 'livewire-tables.dateFilter.defaultConfig';

    public function config(array $config = []): DateFilter
    {
        $this->config = [...config($this->configPath), ...$config];

        return $this;
    }

    public function validate(string $value): string|bool
    {
        if (DateTime::createFromFormat('Y-m-d', $value) === false) {
            return false;
        }

        return $value;
    }

    public function isEmpty(?string $value): bool
    {
        return is_null($value) || $value === '';
    }

    public function getFilterPillValue($value): ?string
    {
        if ($this->validate($value)) {
            return DateTime::createFromFormat('Y-m-d', $value)->format($this->getConfig('pillFormat'));
        }

        return null;
    }

    /**
     * Gets the Default Value for this Filter via the Component
     */
    public function getFilterDefaultValue(): ?string
    {
        return $this->filterDefaultValue ?? null;
    }
}
