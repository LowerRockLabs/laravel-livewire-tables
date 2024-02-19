@aware(['component', 'tableName'])

<x-livewire-tables::table.tr.plain
    :customAttributes="$this->getSecondaryHeaderTrAttributes($this->getRows)"
    wire:key="{{ $tableName .'-secondary-header' }}"
>

    @if ($this->bulkActionsAreEnabled() && $this->hasBulkActions())
        <x-livewire-tables::table.td.plain :displayMinimisedOnReorder="true" wire:key="{{ $tableName .'-header-hasBulkActions' }}" />
    @endif

    @if ($this->collapsingColumnsAreEnabled() && $this->hasCollapsedColumns())
        <x-livewire-tables::table.td.collapsed-columns :hidden=true :displayMinimisedOnReorder="true" wire:key="{{ $tableName .'header-collapsed-hide' }}" rowIndex="-1"  />
    @endif

    @foreach($this->getColumns() as $colIndex => $column)
        @continue($column->isHidden())
        @continue($this->columnSelectIsEnabled() && ! $this->columnSelectIsEnabledForColumn($column))
        @continue($column->isReorderColumn() && !$this->getCurrentlyReorderingStatus() && $this->getHideReorderColumnUnlessReorderingStatus())

        <x-livewire-tables::table.td.plain :column="$column" :displayMinimisedOnReorder="true" wire:key="{{ $tableName .'-secondary-header-show-'.$column->getSlug() }}"  :customAttributes="$this->getSecondaryHeaderTdAttributes($column, $this->getRows, $colIndex)">
            {{ $column->getSecondaryHeaderContents($this->getRows, $this->getFilterGenericData) }}
        </x-livewire-tables::table.td.plain>
    @endforeach
</x-livewire-tables::table.tr.plain>
