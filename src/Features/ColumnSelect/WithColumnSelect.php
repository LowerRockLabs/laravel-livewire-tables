<?php

namespace Rappasoft\LaravelLivewireTables\Features\ColumnSelect;

use Livewire\Attributes\Locked;
use Rappasoft\LaravelLivewireTables\Events\ColumnsSelected;
use Rappasoft\LaravelLivewireTables\Features\ColumnSelect\Configuration\ColumnSelectConfiguration;
use Rappasoft\LaravelLivewireTables\Features\ColumnSelect\Helpers\ColumnSelectHelpers;
use Rappasoft\LaravelLivewireTables\Features\ColumnSelect\QueryString\HasColumnSelectQueryString;
use Rappasoft\LaravelLivewireTables\Features\ColumnSelect\Styling\HasColumnSelectStyling;
use Rappasoft\LaravelLivewireTables\Features\ColumnSelect\Traits\HasColumnSelectSessionStorage;
use Rappasoft\LaravelLivewireTables\Features\ColumnSelect\Concerns\{HandlesColumnSelectDropdown, HandlesColumnSelectRemembering, HandlesColumnSelectStatus, HandlesColumnSelectVisibility};
use Rappasoft\LaravelLivewireTables\Collections\ColumnCollection;

trait WithColumnSelect
{
    use HandlesColumnSelectDropdown,
        HandlesColumnSelectStatus,
        HandlesColumnSelectVisibility,
        HandlesColumnSelectRemembering,
        ColumnSelectConfiguration,
        ColumnSelectHelpers,
        HasColumnSelectSessionStorage,
        HasColumnSelectQueryString,
        HasColumnSelectStyling;

    /**
     * New Configuration for Column Select Config
     *
     * @var array<mixed>
     */
    #[Locked]
    public array $columnSelectConfig = ['setupRun' => false, 'defaultDeselectedColumnsSetup' => false, 'excludeDeselectedColumnsFromQuery' => false, 'columnSelectDelay' => 1500, 'selected' => [], 'deselected' => [], 'defaultdeselected' => [], 'selectableColumns' => [], 'selectableColumnCount' => 0, 'selectableSelectedColumnCount' => 0, 'selectedColumnsQsData' => ''];


    /**
     * Array of selected columns
     *
     * @var array<mixed>
     */
    public array $selectedColumns = [];

    /**
     * Determines whether this was recently updated
     *
     * @var boolean
     */
    protected bool $hasRecentlyUpdated = false;

    /**
     * Determines whether to run the Select updates or not
     *
     * @var boolean
     */
    protected bool $runSelectUpdates = false;

    public function mountWithColumnSelect(): void
    {
        if (strlen($this->columnSelectConfig['selectedColumnsQsData']) > 0)
        {
            $selectedColumns = explode(",", $this->columnSelectConfig['selectedColumnsQsData']);
            $this->selectedColumns = empty($selectedColumns) ? $this->getDefaultVisibleColumns() : $selectedColumns;

        }
        else
        {
            $this->selectedColumns = $this->getDefaultVisibleColumns();

        }
    }

    public function bootWithColumnSelect(): void
    {

    }


    public function bootedWithColumnSelect(): void
    {
        $this->columnSelectConfig['selected'] = $this->getSelectedColumns();
    }




    /**
     * Runs when selecedColumns is updated (to store)
     *
     * @return void
     */
    public function updatedSelectedColumns(): void
    {
        $this->columnSelectConfig['selected'] = $this->getSelectedColumns();

        $this->pushToQueryString($this->getSelectedColumns());
        if($this->runSelectUpdates)
        {
            $this->storeColumnSelect();
        }
    }

    public function storeColumnSelect(): void
    {
        $this->storeColumnSelectValues();

        if ($this->getEventStatusColumnSelect()) {
            event(new ColumnsSelected($this->getTableName(), $this->getColumnSelectSessionKey(), $this->getSelectedColumns()));
        }
    }

    /**
     * Pre-Render Setup for ColumnSelect
     *
     * @param \Illuminate\View\View $view
     * @param array<mixed> $data
     * @return void
     */
    public function renderingWithColumnSelect(\Illuminate\View\View $view, array $data = []): void
    {

        if((count($this->getSelectedColumns()) == 0) && ($this->getUnSelectableColumns()->count() == 0))
        {
            $this->selectedColumns = $this->getDefaultVisibleColumns();
        }

        $this->columnSelectConfig = array_merge($this->columnSelectConfig, $this->fixColumnSelectConfig());


        
        $this->selectedVisibleColumnsRaw();
        if (! $this->getComputedPropertiesStatus()) {
            $view->with([
                'selectedVisibleColumns' => $this->selectedVisibleColumns(),
                'selectedVisibleColumnsData' => $this->selectedVisibleColumnsData(),
            ]);
        }
    }
}
