@aware(['tableName', 'coreTableAttributes'])
<thead data-id="thead"  {{ $attributes->merge($coreTableAttributes['thead'])
            ->class([
                'ignoresort',
                'bg-gray-50 dark:bg-gray-800' => $coreTableAttributes['thead']['default-colors'] ?? ($coreTableAttributes['thead']['default'] ?? true),
                '' => $coreTableAttributes['thead']['default-styling'] ?? ($coreTableAttributes['thead']['default'] ?? true),
            ])
            ->except(['default','default-styling','default-colors']) }}
    >
    <tr>
        @if($this->getCurrentlyReorderingStatus())
            <x-livewire-tables::table.th.reorder x-cloak x-show="currentlyReorderingStatus"  />
        @endif
        @if($this->showBulkActionsSections())
            <x-livewire-tables::table.th.bulk-actions :displayMinimisedOnReorder="true" />
        @endif
        @if ($this->showCollapsingColumnSections())
            <x-livewire-tables::table.th.collapsed-columns />
        @endif

        @tableloop($this->selectedVisibleColumns() as $index => $column)
            <x-livewire-tables::table.th wire:key="{{ $tableName.'-table-head-'.$index }}" :$column :$index />
        @endtableloop
    </tr>
</thead>
