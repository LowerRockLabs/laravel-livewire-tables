<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

trait BladeManagementHelpers
{
    public function hasCustomBladeOfflinePath(): bool
    {
        return isset($this->offlineBladePath);
    }

    public function getCustomBladeOfflinePath(): string
    {
        return $this->offlineBladePath ?? 'livewire-tables::non-existent';
    }

    public function getCustomBladeOfflinePathDefault(): string
    {
        return 'livewire-tables::includes.offline';
    }
    

    public function hasCustomBladeDebugPath(): bool
    {
        return isset($this->debugBladePath);
    }

    public function getCustomBladeDebugPath(): string
    {
        return $this->debugBladePath ?? 'livewire-tables::non-existent';
    }
    
    public function getCustomBladeDebugPathDefault(): string
    {
        return 'livewire-tables::includes.debug';
    }

}
