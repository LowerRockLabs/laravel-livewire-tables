<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Core\Configuration;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;

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
