<?php

namespace Rappasoft\LaravelLivewireTables\Features\SimpleModals;

trait WithSimpleModals
{
    protected string $simpleModalsView = 'livewire-tables::includes.simple-modals.table-widget';

    protected array $simpleModalsViewAttributes = [];

    public function simpleModalsAreEnabled(): bool
    {
        return true;
    }
    
    public function getSimpleModalsView(): string
    {
        return $this->simpleModalsView;
    }

    public function setSimpleModalsView(string $view): self
    {
        $this->simpleModalsView = $view;
        return $this;
    }

    
    public function getSimpleModalsViewAttributes(): array
    {
        return array_merge(['tableClassName' => get_class($this), 'tableComponentId' => $this->getId()], $this->simpleModalsViewAttributes);


    }

    public function setSimpleModalsViewAttributes(array $viewAttributes): self
    {
        $this->simpleModalsViewAttributes = $viewAttributes;

        return $this;
    }

}