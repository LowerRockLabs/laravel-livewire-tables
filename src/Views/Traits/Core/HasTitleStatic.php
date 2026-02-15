<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Core;

trait HasTitleStatic
{
    protected ?string $titleStatic = null;

    // TODO: Test
    public function titleStatic(string $titleStatic): self
    {
        $this->titleStatic = $titleStatic;

        return $this;
    }

    // TODO: Test
    public function getTitleStatic(): ?string
    {
        return $this->titleStatic;
    }

    public function hasTitleStatic(): bool
    {
        return isset($this->titleStatic) && $this->titleStatic !== null;
    }
}
