<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Rappasoft\LaravelLivewireTables\Traits\Configuration\ContextMenuConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Helpers\ContextMenuHelpers;

trait WithContextMenu
{
    use ContextMenuConfiguration,
        ContextMenuHelpers;

    public bool $contextMenuEnabled = false;

    public string $contextMenuContent = '';

    public ?string $contextMenuBlade = null;

    public array $contextMenuAttributes = ['default' => true];


}