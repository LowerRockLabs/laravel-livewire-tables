<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Core\Configuration;

trait ConfigConfiguration
{
    /**
     * @param  array<mixed>  $config
     */
    public function config(array $config = []): self
    {
        $this->config = $config;

        return $this;
    }
}
