<?php

namespace Rappasoft\LaravelLivewireTables\Features\ColumnSelect\Concerns;

use Rappasoft\LaravelLivewireTables\Events\ColumnsSelected;

trait HandlesColumnSelectDropdown
{

    /**
     * Select All Columns
     *
     * @return void
     */
    public function selectAllColumns(): void
    {
        $this->selectedColumns = $this->columnSelectConfig['selected'] = $this->columnSelectConfig['selectableColumns'] = [];
        
        foreach ($this->getSelectableColumns() as $column) {
            $this->columnSelectConfig['selected'][] = $column->getSlug();
            $this->selectedColumns[] = $column->getSlug();
            $this->columnSelectConfig['selectableColumns'][$column->getSlug()] = in_array($column->getSlug(), $this->getSelectedColumns(), true);
        }
        $this->pushToQueryString($this->getSelectedColumns());
        $this->storeColumnSelectValues();

        if ($this->getEventStatusColumnSelect()) {
            event(new ColumnsSelected($this->getTableName(), $this->getColumnSelectSessionKey(), $this->getSelectedColumns()));
        }
    }

    /**
     * Deselect All Columns
     *
     * @return void
     */
    public function deselectAllColumns(): void
    {
        $this->selectedColumns = $this->columnSelectConfig['selected'] = $this->columnSelectConfig['selectableColumns'] = [];

        foreach ($this->getSelectableColumns() as $column) {
            $this->columnSelectConfig['selectableColumns'][] = $column->getSlug();
        }
        $this->pushToQueryString($this->getSelectedColumns());
        session([$this->getColumnSelectSessionKey() => []]);
        if ($this->getEventStatusColumnSelect()) {
            event(new ColumnsSelected($this->getTableName(), $this->getColumnSelectSessionKey(), $this->getSelectedColumns()));
        }
    }

    /**
     * Toggle Columns Between All and None
     *
     * @return void
     */
    public function toggleAllColumns(): void
    {
        if ($this->getSelectableSelectedColumns()->count() == $this->getSelectableColumns()->count())
        {
            $this->deselectAllColumns();
        }
        else
        {
            $this->selectAllColumns();
        }
    }

}