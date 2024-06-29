<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Helpers;

use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Database\Eloquent\Collection;

trait SecondaryHeaderHelpers
{
    public function hasColumnsWithSecondaryHeader(): bool
    {
        return $this->columnsWithSecondaryHeader === true;
    }

    public function getSecondaryHeaderStatus(): bool
    {
        return $this->secondaryHeaderStatus;
    }

    public function secondaryHeaderIsEnabled(): bool
    {
        return $this->getSecondaryHeaderStatus() === true;
    }

    public function secondaryHeaderIsDisabled(): bool
    {
        return $this->getSecondaryHeaderStatus() === false;
    }

    /**
     * @return array<mixed>
     */
    public function getSecondaryHeaderTrAttributes(Collection|AbstractPaginator|array $rows): array
    {
        return $this->secondaryHeaderTrAttributesCallback ? call_user_func($this->secondaryHeaderTrAttributesCallback, $rows) : ['default' => true];
    }

    /**
     * @param  array  $rows
     * @return array<mixed>
     */
    public function getSecondaryHeaderTdAttributes(Column $column, Collection|AbstractPaginator|array $rows, int $index): array
    {
        return $this->secondaryHeaderTdAttributesCallback ? call_user_func($this->secondaryHeaderTdAttributesCallback, $column, $rows, $index) : ['default' => true];
    }
}
