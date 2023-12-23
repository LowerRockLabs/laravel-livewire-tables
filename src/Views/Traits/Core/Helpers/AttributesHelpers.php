<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Core\Helpers;

use Closure;
use Illuminate\View\ComponentAttributeBag;

trait AttributesHelpers
{
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

    
    /**
     * @param  array<mixed>  $attributes
     * @return mixed
     */
    public function arrayToAttributes(array $attributes)
    {
        return implode(' ', array_map(function ($key) use ($attributes) {
            if (is_bool($attributes[$key])) {
                return $attributes[$key] ? $key : '';
            }

            return $key.'="'.$attributes[$key].'"';
        }, array_keys($attributes)));
    }

}
