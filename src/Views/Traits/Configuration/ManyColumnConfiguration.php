<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Configuration;

use Closure;

trait ManyColumnConfiguration
{
    public function setValueCallback(Closure $valueCallback): self
    {
        $this->valueCallback = $valueCallback;

        return $this;
    }

    public function setSeparator(string $separator): self
    {
        $this->separator = $separator;

        return $this;
    }

    public function setRelation(string $relation): self
    {
        $this->relation = $relation;

        return $this;
    }

    public function setRelatedValue(string $relatedValue): self
    {
        $this->relatedValue = $relatedValue;

        return $this;
    }
}
