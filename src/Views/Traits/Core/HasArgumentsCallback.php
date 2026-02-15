<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Core;

trait HasArgumentsCallback
{
    protected mixed $argumentsCallback = null;

    public function arguments(callable $callback): self
    {
        $this->argumentsCallback = $callback;

        return $this;
    }

    public function getArgumentsCallback(): ?callable
    {
        return $this->argumentsCallback;
    }

    public function hasArgumentsCallback(): bool
    {
        return $this->argumentsCallback !== null;
    }
}
