<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Features\Helpers;

use Livewire\Attributes\Computed;

trait TableCaptionHelpers
{
    public function hasTableCaptionMessage(): bool
    {
        return isset($this->tableCaptionMessage);
    }

    #[Computed]
    public function getTableCaptionMessage(): string
    {
        return $this->hasTableCaptionMessage() ? $this->tableCaptionMessage : '';
    }
}