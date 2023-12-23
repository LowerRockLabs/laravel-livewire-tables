<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Core\Configuration;

use Closure;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

trait AttributesConfiguration
{
    public function attributes(Closure $callback): self
    {
        $this->attributesCallback = $callback;

        return $this;
    }
}
