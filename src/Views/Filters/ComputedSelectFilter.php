<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters;

use Illuminate\Support\Collection;
use Rappasoft\LaravelLivewireTables\Views\Filter;
use Rappasoft\LaravelLivewireTables\Views\Traits\Core\HasWireables;
use Rappasoft\LaravelLivewireTables\Views\Traits\Filters\{HasOptions,IsStringFilter};

class ComputedSelectFilter extends Filter
{
    use IsStringFilter;
    use HasWireables;

    public string $wireMethod = 'live';

    protected string $view = 'livewire-tables::components.tools.filters.computed-select';

    protected string $configPath = 'livewire-tables.selectFilter.defaultConfig';

    protected string $optionsPath = 'livewire-tables.selectFilter.defaultOptions';

    public array $options = [];

    protected string $firstOption = '';

    public ?string $computedOptions;

    public function hasComputedOptions(): bool
    {
        return isset($this->computedOptions);
    }

    public function getComputedOptions(): string
    {
        return $this->computedOptions;
    }

    public function setComputedOptions(string $computedOptions): self
    {
        $this->computedOptions = $computedOptions;

        return $this;
    }

    public function setFirstOption(string $firstOption): self
    {
        $this->firstOption = $firstOption;

        return $this;
    }

    public function getFirstOption(): string
    {
        return $this->firstOption;
    }

    public function options(array $options = []): self
    {
        $this->options = $options;

        return $this;
    }

    public function getOptions(): array
    {
        return $this->options ?? $this->options = config($this->optionsPath, []);
    }

    public function getKeys(): array
    {
        return collect($this->getOptions())
            ->keys()
            ->map(fn ($value) => (string) $value)
            ->filter(fn ($value) => strlen($value))
            ->values()
            ->toArray();
    }

    public function validate(string $value, $opti            ->keys()
            ->map(fn ($value) => (string) $value)
            ->filter(fn ($value) => strlen($value))
            ->values()
            ->toArray())) {

) => strlen($value))
        ->values()
        ->toArray())) {
             false;
        }

        return $value;
    }

    public function getFilterPillValue($value): ?string
    {

        return $this->getCustomFilterPillValue($value)
            ?? (new Collection($this->getOptions()))
                ->mapWithKeys(fn ($options, $optgroupLabel) => is_iterable($options) ? $options : [$optgroupLabel => $options])[$value]
            ?? null;
    }
}
