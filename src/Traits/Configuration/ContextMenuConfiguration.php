<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Configuration;

trait ContextMenuConfiguration
{
    public function enableContextMenu(): self
    {
        $this->contextMenuEnabled = true;

        return $this;
    }

    public function disableContextMenu(): self
    {
        $this->contextMenuEnabled = false;

        return $this;
    }

    public function setContextMenuBlade(string $contextMenuBlade): self
    {
        $this->contextMenuBlade = $contextMenuBlade;

        return $this;
    }

    public function setContextMenuContent(string $contextMenuContent): self
    {
        $this->contextMenuContent = $contextMenuContent;

        return $this;
    }

    public function setContextMenuAttributes(array $contextMenuAttributes): self
    {
        $this->contextMenuAttributes = $contextMenuAttributes;

        return $this;
    }

}
