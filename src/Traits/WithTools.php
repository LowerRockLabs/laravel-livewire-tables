<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Rappasoft\LaravelLivewireTables\Traits\Configuration\ToolsConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Helpers\ToolsHelpers;

trait WithTools
{
    use ToolsConfiguration,
        ToolsHelpers;

    protected bool $toolsStatus = true;

    protected bool $toolBarStatus = true;

    protected array $toolsAttributes = ['default-styling' => true, 'default-colors' => true, 'class' => ''];

    protected array $toolBarAttributes = ['default-styling' => true, 'default-colors' => true, 'class' => ''];
}
