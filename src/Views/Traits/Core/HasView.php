<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Core;

trait HasView
{

    public function getView(): string
    {
        return $this->view;
    }
    
    /**
     * @return $this
     */
    public function setView(string $view): self
    {
        $this->view = $view;

        return $this;
    }

}
