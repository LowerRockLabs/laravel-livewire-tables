@aware([ 'tableName', 'hasCollapsingColumns', 'showBulkActionsSections', 'currentlyReorderingStatus'])
@props(['filterGenericData'])

@if(!$currentlyReorderingStatus)
<x-livewire-tables::table.tr.plain data-id="tr-secondaryheader" :rowIndex="-1"
    :customAttributes="$this->hasSecondaryHeaderTrAttributes() ? $this->getSecondaryHeaderTrAttributes($this->getRows) : []"
    wire:key="{{ $tableName .'-secondary-header' }}"
>
    {{-- TODO: Remove --}}
    <x-livewire-tables::table.td.plain x-cloak x-show="currentlyReorderingStatus" :displayMinimisedOnReorder="true" wire:key="{{ $tableName .'-header-test' }}" />

    @if ($showBulkActionsSections)
        <x-livewire-tables::table.td.plain :displayMinimisedOnReorder="true" wire:key="{{ $tableName .'-header-hasBulkActions' }}" />
    @endif

    @if ($hasCollapsingColumns)
        <x-livewire-tables::table.td.collapsed-columns :hidden=true :displayMinimisedOnReorder="true" wire:key="{{ $tableName .'header-collapsed-hide' }}"  />
    @endif

    @tableloop($this->selectedVisibleColumns as $colIndex => $column)
        <x-livewire-tables::table.td.secondaryheader :$column :displayMinimisedOnReorder="true" wire:key="{{ $tableName .'-secondary-header-show-'.$column->getSlug() }}"  :customAttributes="$this->hasSecondaryHeaderTdAttributes() ? $this->getSecondaryHeaderTdAttributes($column, $this->getRows, $colIndex) : []" />
    @endtableloop
</x-livewire-tables::table.tr.plain>
@endif