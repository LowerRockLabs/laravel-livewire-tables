<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Helpers;

trait BooleanColumnHelpers
{
    public function getSuccessValue(): bool
    {
        return $this->successValue;
    }

    public function getType(): string
    {
        return $this->type;
    }
}
