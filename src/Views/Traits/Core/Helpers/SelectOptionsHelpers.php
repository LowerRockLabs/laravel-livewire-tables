<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Core\Helpers;

trait SelectOptionsHelpers
{
    public function getOptions(): array
    {
        return $this->options;
    }

    public function getFirstOption(): string
    {
        return $this->firstOption;
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
    /*
        public function getKeys(): array
    {
        return collect($this->getOptions())
            ->map(fn ($value, $key) => is_iterable($value) ? collect($value)->keys() : $key)
            ->flatten()
            ->map(fn ($value) => (string) $value)
            ->filter(fn ($value) => strlen($value) > 0)
            ->values()
            ->toArray();
    }

*/
}
