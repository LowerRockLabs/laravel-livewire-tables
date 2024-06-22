<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Configuration;

trait ViewComponentColumnConfiguration
{
    public function component(string $component): self
    {
        $this->componentView = 'components.'.$component;

        return $this;
    }

    public function slot(callable $callback): self
    {
        $this->slotCallback = $callback;

        return $this;
    }

    public function setComponentReference(string $componentReference): self
    {
        $this->componentReference = $componentReference;

        return $this;
    }

}
s