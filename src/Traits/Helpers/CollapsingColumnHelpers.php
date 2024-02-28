<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

use Livewire\Attributes\Computed;

trait CollapsingColumnHelpers
{
    public function getCollapsingColumnsStatus(): bool
    {
        return $this->collapsingColumnsStatus;
    }

    #[Computed()]
    public function hasCollapsingColumns(): bool
    {
        return $this->getCollapsingColumnsStatus() === true;
    }

    #[Computed()]
    public function collapsingColumnsAreEnabled(): bool
    {
        return $this->getCollapsingColumnsStatus() === true;
    }

    #[Computed()]
    public function collapsingColumnsAreDisabled(): bool
    {
        return $this->getCollapsingColumnsStatus() === false;
    }
}
