<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Core;

use Illuminate\View\ComponentAttributeBag;

trait HasAttributes
{
    protected mixed $attributesCallback = null;

    public function attributes(callable $callback): self
    {
        $this->attributesCallback = $callback;

        return $this;
    }
    
    public function getAttributesCallback(): ?callable
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