<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Illuminate\Support\Collection;
use Livewire\Attributes\Locked;
use Rappasoft\LaravelLivewireTables\Traits\Filters\HandlesFilterTraits;

trait WithFilters
{
    use HandlesFilterTraits;

    #[Locked]
    public int $filterCount;

    protected ?Collection $filterCollection;

    public function filters(): array
    {
        return [];
    }
}
