<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Core;

use Closure;

trait HasLocation
{
    protected ?Closure $locationCallback = null;

    public function location(Closure $callback): self
    {
        $this->locationCallback = $callback;

        return $this;
    }

    public function getLocationCallback(): ?Closure
    {
        return $this->locationCallback;
    }

    public function hasLocationCallback(): bool
    {
        return $this->locationCallback !== null;
    }
}
