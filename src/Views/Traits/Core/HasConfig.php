<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Core;

use Rappasoft\LaravelLivewireTables\Views\Traits\Core\Configuration\ConfigConfiguration;
use Rappasoft\LaravelLivewireTables\Views\Traits\Core\Helpers\ConfigHelpers;

trait HasConfig
{
    use ConfigConfiguration,
        ConfigHelpers;

    public array $config = [];
}
