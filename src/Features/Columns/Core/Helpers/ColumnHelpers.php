<?php

namespace Rappasoft\LaravelLivewireTables\Features\Columns\Core\Helpers;

use Livewire\Attributes\Computed;
use Rappasoft\LaravelLivewireTables\Collections\ColumnCollection;
use Rappasoft\LaravelLivewireTables\Features\Columns\Views\Column;

trait ColumnHelpers
{

    /**
     * Undocumented function
     *
     * @return ColumnCollection<int|string,Column>
     */
    public function getColumns(): ColumnCollection
    {
        if (! $this->hasRunColumnSetup) {
            $this->setupColumns();
        }

        return $this->columns;
    }

    /**
     * Undocumented function
     *
     * @param string $qualifiedColumn
     * @return Column|null
     */
    public function getColumn(string $qualifiedColumn): ?Column
    {
        return $this->getColumns()
            ->filter(fn (Column $column) => $column->isColumn($qualifiedColumn))
            ->first();
    }

    /**
     * Undocumented function
     *
     * @param string $qualifiedColumn
     * @return Column|null
     */
    public function getColumnBySelectName(string $qualifiedColumn): ?Column
    {
        return $this->getColumns()
            ->filter(fn (Column $column) => $column->isColumnBySelectName($qualifiedColumn))
            ->first();
    }

    /**
     * Undocumented function
     *
     * @param string $columnSlug
     * @return Column|null
     */
    public function getColumnBySlug(string $columnSlug): ?Column
    {
        return $this->getColumns()
            ->filter(fn (Column $column) => $column->isColumnBySlug($columnSlug))
            ->first();
    }

    public function getColumnCount(): int
    {
        return $this->getColumns()->count();
    }

    /**
     * Undocumented function
     *
     * @return ColumnCollection<int|string,Column>
     */
    public function getPrependedColumns(): ColumnCollection
    {
        return $this->prependedColumns ?? new ColumnCollection($this->prependColumns());
    }

    /**
     * Undocumented function
     *
     * @return ColumnCollection<int|string,Column>
     */
    public function getAppendedColumns(): ColumnCollection
    {
        return $this->appendedColumns ?? new ColumnCollection($this->appendColumns());
    }

    /**
     * Prepend columns.
     *
     * @return array<mixed>
     */
     public function prependColumns(): array
    {
        return [];
    }

    /**
     * Append Columns
     *
     * @return array<mixed>
     */
    public function appendColumns(): array
    {
        return [];
    }



    /**
     * @return array<mixed>
     */
    public function getColumnRelations(): array
    {
        return $this->getColumns()
            ->filter(fn (Column $column) => $column->hasRelations())
            ->map(fn (Column $column) => $column->getRelations())
            ->values()
            ->toArray();
    }

    /**
     * @return array<mixed>
     */
    public function getColumnRelationStrings(): array
    {
        return $this->getColumns()
            ->filter(fn (Column $column) => $column->hasRelations())
            ->map(fn (Column $column) => $column->getRelationString())
            ->values()
            ->toArray();
    }

    /**
     * Get Columns That Are Searchable
     *
     * @return ColumnCollection<int|string,Column>
     */
    public function getSearchableColumns(): ColumnCollection
    {
        return isset($this->searchableColumns) ? $this->searchableColumns : $this->searchableColumns = $this->getColumns()->searchable();
    }


    /**
     * Get Columns That Are Searchable But That Are Not Present In Query
     *
     * @return ColumnCollection<int|string,Column>
     */
    public function getSearchableSelectedColumns(): ColumnCollection
    {
        if($this->getExcludeDeselectedColumnsFromQuery() ?? false)
        {
            return $this->getSearchableColumns()->selectedSelectable($this->getSelectedColumns());
        }
        return $this->getSearchableColumns();
    }

    
    /**
     * Get Columns That Are Sortable
     *
     * @return ColumnCollection<int|string, Column>
     */
    public function getSortableColumns(): ColumnCollection
    {
        return isset($this->sortableColumns) ? $this->sortableColumns : $this->sortableColumns = $this->getColumns()->sortable()
            ->map(fn (Column $column) => $column->getColumnSelectName() ?? $column->getSlug())
            ->values();
    }


    /**
     * Get Columns That Are Sortable
     *
     * @return ColumnCollection<int|string, Column>
     */
    public function getSortableSelectedColumns(): ColumnCollection
    {
        $sortableCols = $this->getSortableColumns();

        if($this->getExcludeDeselectedColumnsFromQuery() ?? false)
        {
            $sortableCols = $sortableCols
            ->selectedSelectable($this->getSelectedColumns());
        }
        return $sortableCols
        ->map(fn (Column $column) => $column->getColumnSelectName() ?? $column->getSlug())
        ->values();            
    }

}
