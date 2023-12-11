<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

trait ContextMenuHelpers
{
    public function getContextMenuIsEnabled(): bool
    {
        return $this->contextMenuEnabled ?? false;
    }

    public function hasContextMenuContent(): bool
    {
        return $this->getContextMenuContent() != '';
    }

    public function getContextMenuContent(): string
    {
        return $this->contextMenuContent;
    }

    public function hasContextMenuBlade(): bool
    {
        return isset($this->contextMenuBlade);
    }

    public function getContextMenuBlade(): string
    {
        return $this->contextMenuBlade;
    }

    public function getContextMenuAttributes(): array
    {
        return [...['default' => true], ...$this->contextMenuAttributes];
    }
}
