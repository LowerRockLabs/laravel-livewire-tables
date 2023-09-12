<?php

namespace Rappasoft\LaravelLivewireTables\Views\Filters;

use Rappasoft\LaravelLivewireTables\Views\Filter;
use Illuminate\Support\Str;

class LivewireComponentFilter extends Filter
{
    public string $filterComponentPath = '';
    public array $filterComponentOptions = [];

    public function validate(mixed $value): mixed
    {
        return $value;
    }

    public function isEmpty($value): bool
    {
        return $value === '';
    }

    /**
     * Gets the Default Value for this Filter via the Component
     */
    public function getFilterDefaultValue(): ?string
    {
        return $this->filterDefaultValue ?? null;
    }

    public function setFilterComponentPath(string $filterComponentPath): self
    {
        $this->filterComponentPath = (Str::startsWith($filterComponentPath, 'livewire:')) ? substr($filterComponentPath, 9) : $filterComponentPath;

        return $this;
    }

    public function setFilterComponentOptions(array $filterComponentOptions): self
    {
        $this->filterComponentOptions = $filterComponentOptions;

        return $this;
    }

    public function config(array $config = []): LivewireComponentFilter
    {
        $this->config = $config;

        if ($this->filterComponentPath == '' && $this->hasConfig('filterComponentPath'))
        {
            $this->setFilterComponentPath($this->getConfig('filterComponentPath'));
        }

        if ($this->filterComponentOptions == [] && $this->hasConfig('filterComponentOptions'))
        {
            $this->setFilterComponentOptions($this->getConfig('filterComponentOptions'));
        }

        return $this;
    }


    
    

    public function render(): string|\Illuminate\Contracts\Foundation\Application|\Illuminate\View\View|\Illuminate\View\Factory
    {
        return view('livewire-tables::components.tools.filters.livewire-component-filter', [...$this->getFilterSpecificViewData(), ...[
            'wirekey' => 'test12312' . '-filter-'. $this->getKey() . ($this->hasCustomPosition() ? '-'.$this->getCustomPosition() : ''),
            'livewireComponent' => $this->filterComponentPath,
            'modelableValue' => 'filterComponents.'.$this->getKey(),
            ...$this->filterComponentOptions,
        ]]);



    }
}
