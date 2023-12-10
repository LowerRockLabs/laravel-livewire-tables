<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Configuration;

trait BooleanColumnConfiguration
{
    public function setSuccessValue(bool $value): self
    {
        $this->successValue = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function icons(): self
    {
        $this->type = 'icons';

        return $this;
    }

    /**
     * @return $this
     */
    public function yesNo()
    {
        $this->type = 'yes-no';

        return $this;
    }
}
