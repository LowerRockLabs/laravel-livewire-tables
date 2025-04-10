@aware(['tableName','showBulkActionsSections', 'coreTableAttributes', 'currentlyReorderingStatus', 'showCollapsingColumnSections', 'selectedVisibleColumns', 'columnCollapseInfo', 'hasTableRowUrl'])
@props(['row','rowIndex','rowPk','customAttributes'])


<tbody @if($currentlyReorderingStatus) x-sort:item="'{{$rowPk}}'" data-id="{{$rowPk}}" @endif {{ $attributes->merge($coreTableAttributes['tbody'])
        ->class([
            'odd:bg-white odd:dark:bg-gray-700 odd:dark:text-white even:bg-gray-50 even:dark:bg-gray-800 even:dark:text-white',
            'divide-gray-200 dark:divide-none' => $coreTableAttributes['tbody']['default-colors'] ?? ($coreTableAttributes['tbody']['default'] ?? true),
            'divide-y' => $coreTableAttributes['tbody']['default-styling'] ?? ($coreTableAttributes['tbody']['default'] ?? true),
        ])
        ->except(['default','default-styling','default-colors']) 
    }} x-data="{ showCollapsed: false }"
>
    <x-livewire-tables::table.tr wire:key="{{ $tableName }}-row-wrap-{{ $rowPk }}" :rowUrl="$hasTableRowUrl ? $this->getTableRowUrl($row) : ''" :rowTarget="$hasTableRowUrl ? $this->getTableRowUrlTarget($row) : ''">
                            
        @if($currentlyReorderingStatus)
            <x-livewire-tables::table.td.reorder x-cloak x-show="currentlyReorderingStatus" />
        @endif
        @if($showBulkActionsSections)
            <x-livewire-tables::table.td.bulk-actions  />
        @endif
        @if ($showCollapsingColumnSections)
            <x-livewire-tables::table.td.collapsed-columns  />
        @endif

        @tableloop($selectedVisibleColumns as $colIndex => $column)
            <x-livewire-tables::table.td :colData="$columnCollapseInfo[$colIndex] ?? []" :slug="$columnCollapseInfo[$colIndex] ? $columnCollapseInfo[$colIndex]['slug'] : $column->getSlug()" :$colIndex :customAttributes="$this->getTdAttributes($column, $row, $colIndex, $rowIndex)"  >
                @if($column->isHtml())
                    {!! $column->setIndexes($rowIndex, $colIndex)->renderContents($row) !!}
                @else
                    {{ $column->setIndexes($rowIndex, $colIndex)->renderContents($row) }}
                @endif
            </x-livewire-tables::table.td>
        @endtableloop
    </x-livewire-tables::table.tr>

    @if ($showCollapsingColumnSections)
        <x-livewire-tables::table.collapsed-columns />
    @endif
</tbody>