<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Core\Helpers;

trait ConfigHelpers
{
    /**
     * Get the filter configs.
     *
     * @return array<mixed>
     */
    public function getConfigs(): array
    {
        return $this->config;
    }

    /**
     * Get a single filter config.
     *
     * @return mixed
     */
    public function getConfig(string $key)
    {
        return $this->config[$key] ?? null;
    }
    
    public function hasConfigs(): bool
    {
        return count($this->getConfigs()) > 0;
    }

    public function hasConfig(string $key): bool
    {
        return array_key_exists($key, $this->getConfigs()) && $this->getConfig($key) !== null;
    }


}