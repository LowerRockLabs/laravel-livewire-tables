@aware([ 'tableName','primaryKey','isTailwind','isBootstrap','row', 'rowPk', 'rowIndex', 'customAttributes', 'hasTableRowUrl', 'hasDisplayLoadingPlaceholder', 'currentlyReorderingStatus'])
@props(['rowUrl' => '', 'rowTarget' => '']) 

<tr
    rowpk='{{ $rowPk }}'
    @if($hasDisplayLoadingPlaceholder) 
        wire:loading.class.add="hidden d-none"
    @else
        wire:loading.class.delay="opacity-50 dark:bg-gray-900 dark:opacity-60"
    @endif
    id="{{ $tableName }}-row-{{ $rowPk }}"
    wire:key="{{ $tableName }}-tablerow-tr-{{ $rowPk }}"
    loopType="{{ ($rowIndex % 2 === 0) ? 'even' : 'odd' }}"
    {{
        $attributes->merge($customAttributes)
                ->class($isTailwind ? [
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
