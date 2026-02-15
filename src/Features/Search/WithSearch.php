<?php

namespace Rappasoft\LaravelLivewireTables\Features\Search;

use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Computed;
use Rappasoft\LaravelLivewireTables\Events\SearchApplied;
use Rappasoft\LaravelLivewireTables\Features\Search\QueryString\HasQueryStringForSearch;
use Rappasoft\LaravelLivewireTables\Features\Search\Styling\{HasSearchIcon, HasSearchInputStyling};
use Rappasoft\LaravelLivewireTables\Features\Search\Traits\{HandlesSearchInput,HandlesSearchModifiers,HandlesSearchStatus, HandlesSearchTrim,HandlesSearchVisibility};
use Rappasoft\LaravelLivewireTables\Collections\ColumnCollection;

trait WithSearch
{
    use HandlesSearchStatus,
        HandlesSearchModifiers,
        HandlesSearchTrim,
        HandlesSearchVisibility,
        HasQueryStringForSearch,
        HasSearchIcon,
        HasSearchInputStyling,
        HandlesSearchInput;


    /**
     * Undocumented variable
     *
     * @var ?ColumnCollection<int|string,\Rappasoft\LaravelLivewireTables\Features\Columns\Views\Column>
     */
    protected ?ColumnCollection $searchableColumns;

    /**
     * Undocumented function
     *
     * @return Builder<\Illuminate\Database\Eloquent\Model>
     */
    public function applySearch(): Builder
    {
        if ($this->searchIsEnabled() && $this->shouldApplySearch() && $this->hasSearch()) {

            $searchableColumns = $this->getSearchableSelectedColumns();

            $search = $this->getSearch();

            $this->callHook('searchUpdated', ['value' => $search]);
            $this->callTraitHook('searchUpdated', ['value' => $search]);

            if ($this->getEventStatusSearchApplied() && $search != null) {
                event(new SearchApplied($this->getTableName(), $search));
            }

            if ($searchableColumns->count()) {
                $this->setBuilder($this->getBuilder()->where(function ($query) use ($searchableColumns, $search) {
                    foreach ($searchableColumns as $index => $column) {
                        if ($column->hasSearchCallback()) {
                            ($column->getSearchCallback())($query, $search);
                        } else {
                            $query->{$index === 0 ? 'where' : 'orWhere'}($column->getColumnForQuery($this->getBuilder()->getModel()->getTable()), 'like', $column->isWildcardSearchable() ? '%'.$search.'%' : $search);
                        }
                    }
                }));
            }
        }

        return $this->getBuilder();
    }

    /**
     * Pre-Render Setup for Search
     *
     * @param \Illuminate\View\View $view
     * @param array<mixed> $data
     * @return void
     */
    public function renderingWithSearch(\Illuminate\View\View $view, array $data = []): void
    {
        if(!$this->shouldDisplaySearch())
        {
            $this->clearSearch();
            $this->setSearchVisibilityDisabled();
        }
    }
    
}
