<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Rappasoft\LaravelLivewireTables\Traits\Core\SessionStorage\{HasColumnSelectSessionStorage, HasFilterSessionStorage};

trait WithSessionStorage
{
    use HasFilterSessionStorage,
        HasColumnSelectSessionStorage;

    public array $sessionStorageStatus = [
        'columnselect' => true,
        'filters' => false,
    ];

    protected function getSessionStorageStatus(string $name): bool
    {
        return $this->sessionStorageStatus[$name] ?? false;
    }

    protected function setSessionStorageStatus(string $name, bool $status): self
    {
        $this->sessionStorageStatus[$name] = $status;

        return $this;
    }
}
