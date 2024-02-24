<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Core;

use Closure;
use Rappasoft\LaravelLivewireTables\Views\{Column,Filter};

trait HasIcon
{
    public string $icon = '';

    public function icon($icon): self
    {
        $this->icon = $icon;

        return $this;
    }

    public function hasIcon(): bool
    {
        return $this->icon !== '';
    }

}