<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Helpers;

use Illuminate\Support\Collection;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

trait ButtonGroupColumnHelpers
{
    public function getButtons(): array
    {
        return (new Collection($this->buttons))
            ->reject(fn ($button) => ! $button instanceof LinkColumn)
            ->toArray();
    }
}
