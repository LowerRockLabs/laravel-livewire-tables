<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

use Livewire\Attributes\Computed;

trait CollapsingColumnHelpers
{
    public function getCollapsingColumnsStatus(): bool
    {
        return $this->collapsingColumnsStatus;
    }

    #[Computed(persist: true, seconds: 600)]
    public function hasCollapsingColumns(): bool
    {
        return $this->getCollapsingColumnsStatus() === true;
    }

    #[Computed(persist: true, seconds: 600)]
    public function collapsingColumnsAreEnabled(): bool
    {
        return $this->getCollapsingColumnsStatus() === true;
    }

    #[Computed(persist: true, seconds: 600)]
    public function collapsingColumnsAreDisabled(): bool
    {
        return $this->getCollapsingColumnsStatus() === false;
    }
}
