<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Features\Configuration;

trait TableCaptionConfiguration
{
    public function setTableCaptionMessage(string $tableCaptionMessage): self
    {
        $this->tableCaptionMessage = $tableCaptionMessage;

        return $this;
    }
}
