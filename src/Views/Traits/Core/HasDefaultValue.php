<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Core;

use Rappasoft\LaravelLivewireTables\Views\Traits\Core\Configuration\DefaultValueConfiguration;
use Rappasoft\LaravelLivewireTables\Views\Traits\Core\Helpers\DefaultValueHelpers;


trait HasDefaultValue
{
    use DefaultValueConfiguration,
        DefaultValueHelpers;

    protected string $defaultValue = '';

    protected mixed $filterDefaultValue = null;

}
