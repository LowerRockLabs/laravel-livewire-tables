<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Configuration;

trait BladeManagementConfiguration
{
    public function setCustomBladeOfflinePath(string $offlineBladePath): self
    {
        $this->offlineBladePath = $offlineBladePath;

        return $this;

    }

    public function setCustomBladeDebugPath(string $debugBladePath): self
    {
        $this->debugBladePath = $debugBladePath;

        return $this;
    }
}
