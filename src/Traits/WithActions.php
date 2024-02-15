<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Illuminate\Support\Collection;

trait WithActions
{
    protected Collection $actions;

    public function bootWithActions(): void
    {
        $this->actions = collect($this->actions());
    }

    public function hasActions(): bool
    {
        return ! empty($this->actions);
    }

    public function actions(): array
    {
        return [];
    }
}
