<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Core;

use Rappasoft\LaravelLivewireTables\Views\Traits\Core\Configuration\SelectOptionsConfiguration;
use Rappasoft\LaravelLivewireTables\Views\Traits\Core\Helpers\SelectOptionsHelpers;

trait HasSelectOptions
{
    use SelectOptionsConfiguration,
        SelectOptionsHelpers;

    public array $options = [];

    protected string $firstOption = '';
}
