<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Core;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;
use Closure;

trait HasCallback
{
    protected ?Closure $callback = null;

    public function hasCallback(): bool
    {
        return $this->callback !== null;
    }

    public function getCallback(): ?Closure
    {
        return $this->callback;
    }

    /**
     * @return $this
     */
    public function setCallback(Closure $callback): self
    {
        $this->callback = $callback;

        return $this;
    }
}
