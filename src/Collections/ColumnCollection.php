<?php

namespace Rappasoft\LaravelLivewireTables\Collections;

use Illuminate\Support\Collection;
use Rappasoft\LaravelLivewireTables\Features\Columns\Views\Column;

/**
 * Collection of Columns
 * 
 * @extends \Illuminate\Support\Collection<int|string,Column> 
 */
class ColumnCollection extends Collection
{
    public function visible(): self
    {
        return $this->reject(fn (Column $column) => $column->isHidden());
    }

    public function selectable(): self
    {
        return $this->reject(fn (Column $column) => !$column->isSelectable());
    }

    public function unselectable(): self 
    {
        return $this->reject(fn (Column $column) => $column->isSelectable());
    }

    public function selected(): self
    {
        return $this->reject(fn (Column $column) => $column->isSelectable() && ! $column->isSelected());
    }

    public function sortable(): self 
    {
        return $this->reject(fn (Column $column) => !$column->isSortable() && !$column->hasSortCallback());
    }

    public function searchable(): self 
    {
        return $this->filter(fn (Column $column) => $column->isSearchable() || $column->hasSearchCallback());
    }

    public function visibleSortableColumns(): self 
    {
        return $this
            ->visible()
            ->sortable();
    }

    /**
     * Undocumented function
     *
     * @param array<mixed> $sortKeys
     * @return self
     */
    public function visibleSortableColumnsKeyed(array $sortKeys = []): self 
    {
        return $this
            ->visible()
            ->sortable()
            ->whereIn('slug', $sortKeys)
            ->keyBy('slug');
    }

    /**
     * Undocumented function
     *
     * @param array<mixed> $sortKeys
     * @return self
     */
    public function sortableColumnsKeyed(array $sortKeys = []): self 
    {
        return $this
            ->sortable()
            ->whereIn('slug', $sortKeys)
            ->keyBy('slug');
    }

    /**
     * Undocumented function
     *
     * @param array<mixed> $selectedColumns
     * @return self
     */
    public function selectedInTable(array $selectedColumns): self 
    {
        return $this->reject(function (Column $column) use ($selectedColumns) {
            return !empty($selectedColumns) && in_array($column->getSlug(), $selectedColumns, true);
        });
    }


    /**
     * Undocumented function
     *
     * @param array<mixed> $selectedColumns
     * @return self
     */
    public function rejectUnselectedColumns(array $selectedColumns): self 
    {
        return $this->reject(function (Column $column) use ($selectedColumns) {
            return $column->isSelectable() && !empty($selectedColumns) && in_array($column->getSlug(), $selectedColumns, true);
        });
    }


    /**
     * Undocumented function
     *
     * @return self
     */
    public function visibleOnReorder(): self
    {
        return $this->reject(fn (Column $column) => !$column->isVisibleOnReorder());
    }

    /**
     * Undocumented function
     *
     * @param boolean $currentlyReordering
     * @return self
     */
    public function rejectInvisibleWhileReordering(bool $currentlyReordering = false): self
    {
        return $this->reject(function (Column $column) use ($currentlyReordering) {
            return $currentlyReordering && !$column->isVisibleOnReorder();
        });
    }

    /**
     * Undocumented function
     *
     * @return self
     */
    public function reorder(): self 
    {
        return $this->reject(fn (Column $column) => !$column->isVisibleOnReorder());
    }

    /**
     * Undocumented function
     *
     * @return self
     */
    public function visibleSelectable(): self 
    {
        return $this->visible()->selectable();
    }



    /**
     * Undocumented function
     *
     * @param array<mixed> $selectedColumns
     * @return self
     */
    public function selectedSelectable(array $selectedColumns): self 
    {
        return $this
        ->reject(function (Column $column) use ($selectedColumns) {
            return ($column->isSelectable() && !empty($selectedColumns) && !in_array($column->getSlug(), $selectedColumns, true));
        });
    }

    public function addSlugValue(): self 
    {
        return $this->each(function (Column $column) {
            $column->slugVal = $column->getSlug();
        });
    }

}
