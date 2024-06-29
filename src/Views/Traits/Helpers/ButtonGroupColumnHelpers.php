<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Helpers;

use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Illuminate\Support\Collection;

trait ButtonGroupColumnHelpers
{
    public function getButtons(): array
    {
        return (new Collection($this->buttons))
            ->reject(fn ($button) => ! $button instanceof LinkColumn)
            ->toArray();
    }
}
