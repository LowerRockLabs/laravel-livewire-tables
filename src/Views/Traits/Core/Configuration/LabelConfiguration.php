<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Core\Configuration;

/**
 * Not to be confused with label() columns
 */
trait LabelConfiguration
{
    public function setCustomLabel(string $customLabel): self
    {
        $this->customLabel = $customLabel;

        return $this;
    }

    public function setCustomLabelAttributes(array $customLabelAttributes): self
    {
        $this->customLabelAttributes = [...['default' => false], ...$customLabelAttributes];

        return $this;
    }

    public function setCustomFilterLabel(string $filterCustomLabel): self
    {
        $this->setCustomLabel($filterCustomLabel);

        return $this;
    }

    public function setFilterLabelAttributes(array $filterLabelAttributes): self
    {
        $this->setCustomLabelAttributes($filterLabelAttributes);

        return $this;
    }
}
