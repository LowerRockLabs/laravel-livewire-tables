<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Core;

use Rappasoft\LaravelLivewireTables\Views\Column;

trait HandlesColumnSortPills
{
    protected function getColumnsForColumnSortPills(array $activeSorts = []): array
    {

        //this->getColumnBySelectName($columnSelectName) ?? $this->getColumnBySlug($columnSelectName)
        return $this->getColumns()
        ->reject(fn (Column $column) => $column->isHidden() || (!$column->isSortable() && !$column->hasSortCallback()) || ($column->isSelectable() && ! $this->columnSelectIsEnabledForColumn($column)))
        ->filter(function (Column $column, int $key) use ($activeSorts) {
            return(array_key_exists($column->getColumnSelectName(), $activeSorts) || array_key_exists($column->getSlug(), $activeSorts) );
        })
        ->each(function (Column $column, int $key) use ($activeSorts){

            $selectName = $column->getColumnSelectName();
            $slug = $column->getSlug();

            if(!is_null($selectName) && array_key_exists($selectName, $activeSorts))
            {
                $column->sortDetailsLabel = $column->getSortingPillTitle();
                $column->sortDetailsIndex = $selectName;
                $column->sortDetailsDirection = $column->getSortingPillDirectionLabel($activeSorts[$selectName], $this->getDefaultSortingLabelAsc(), $this->getDefaultSortingLabelDesc());

            }
            elseif(!is_null($slug) && array_key_exists($slug, $activeSorts))
            {
                $column->sortDetailsLabel = $column->getSortingPillTitle();
                $column->sortDetailsIndex = $slug;
                $column->sortDetailsDirection = $column->getSortingPillDirectionLabel($activeSorts[$slug], $this->getDefaultSortingLabelAsc(), $this->getDefaultSortingLabelDesc());

            }
            else
            {
                return false;
            }


        })->select(['sortDetailsIndex', 'sortDetailsLabel','sortDetailsDirection'])->keyBy('sortDetailsIndex')->toArray();
    }
}