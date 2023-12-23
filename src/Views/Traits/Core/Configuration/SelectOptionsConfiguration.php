<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Core\Configuration;

trait SelectOptionsConfiguration
{
    public function options(array $options = []): self
    {
        $this->options = $options;

        return $this;
    }

    public function setFirstOption(string $firstOption): self
    {
        $this->firstOption = $firstOption;

        return $this;
    }
}
