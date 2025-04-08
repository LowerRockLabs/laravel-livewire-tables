@aware([ 'tableName','primaryKey','isTailwind','isBootstrap','row', 'rowPk', 'rowIndex', 'customAttributes', 'hasTableRowUrl', 'hasDisplayLoadingPlaceholder'])
@props(['rowUrl' => '', 'rowTarget' => '']) 

<tr
    rowpk='{{ $rowPk }}'
    x-on:dragstart.self="currentlyReorderingStatus && dragStart(event)"
    x-on:drop.prevent="currentlyReorderingStatus && dropEvent(event)"
    x-on:dragover.prevent.throttle.500ms="currentlyReorderingStatus && dragOverEvent(event)"
    x-on:dragleave.prevent.throttle.500ms="currentlyReorderingStatus && dragLeaveEvent(event)"
    @if($hasDisplayLoadingPlaceholder) 
        wire:loading.class.add="hidden d-none"
    @else
        wire:loading.class.delay="opacity-50 dark:bg-gray-900 dark:opacity-60"
    @endif
    id="{{ $tableName }}-row-{{ $rowPk }}"
    :draggable="currentlyReorderingStatus"
    wire:key="{{ $tableName }}-tablerow-tr-{{ $rowPk }}"
    loopType="{{ ($rowIndex % 2 === 0) ? 'even' : 'odd' }}"
    {{
        $attributes->merge($customAttributes)
                ->class($isTailwind ? [
                    'bg-white dark:bg-gray-700 dark:text-white rappasoft-striped-row' => (($customAttributes['default'] ?? true) && $rowIndex % 2 === 0),
                    'bg-gray-50 dark:bg-gray-800 dark:text-white rappasoft-striped-row' => (($customAttributes['default'] ?? true) && $rowIndex % 2 !== 0),
                    'cursor-pointer' => ($hasTableRowUrl && ($customAttributes['default'] ?? true)),
                ] : 
                [
                    'bg-light rappasoft-striped-row' => ($rowIndex % 2 === 0 && ($customAttributes['default'] ?? true)),
                    'bg-white rappasoft-striped-row' => ($rowIndex % 2 !== 0 && ($customAttributes['default'] ?? true)),

                ])
                ->except(['default','default-styling','default-colors'])
    }}

>
    {{ $slot }}
</tr>
