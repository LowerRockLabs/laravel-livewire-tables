<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Core;

use Closure;
use Illuminate\View\ComponentAttributeBag;

trait HasAttributes
{
    protected ?Closure $attributesCallback = null;

    public function attributes(Closure $callback): self
    {
        $this->attributesCallback = $callback;

        return $this;
    }

    public function getAttributesCallback(): ?Closure
    {
        return $this->attributesCallback;
    }

    public function hasAttributesCallback(): bool
    {
        return $this->attributesCallback !== null;
    }

    // TODO: Test
    public function getAttributeBag($row)
    {
        return new ComponentAttributeBag($this->hasAttributesCallback() ? app()->call($this->getAttributesCallback(), ['row' => $row]) : []);
    }
}
