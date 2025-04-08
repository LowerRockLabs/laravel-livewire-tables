@aware([ 'row', 'rowIndex', 'tableName', 'primaryKey', 'rowPk', 'isTailwind','isBootstrap','rowUrl', 'rowTarget'])
@props(['column', 'colIndex'])

@php
    $customAttributes = $this->getTdAttributes($column, $row, $colIndex, $rowIndex);
@endphp

<td wire:key="{{ $tableName . '-table-td-'.$rowPk.'-'.$column->getSlug() }}" x-ref="{{ $tableName . "_" . $rowIndex."_".$colIndex}}"
    @if ($column->isClickable())
        @if($rowTarget === 'navigate') wire:navigate href="{{ $rowUrl }}"
        @else onclick="window.open('{{ $rowUrl }}', '{{ $rowTarget ?? '_self' }}')"
        @endif
    @endif
        {{
            $attributes->merge($customAttributes)
                ->class($isTailwind ? [
                        'px-6 py-4 whitespace-nowrap text-sm font-medium dark:text-white' => $isTailwind && ($customAttributes['default'] ?? true),
                        'hidden' => $column && $column->shouldCollapseAlways(),
                        'hidden md:table-cell' => $column && $column->shouldCollapseOnMobile(),
                        'hidden lg:table-cell' => $column && $column->shouldCollapseOnTablet(),
                    ] : [
                        '' => ($customAttributes['default'] ?? true),
                        'd-none' =>  $column && $column->shouldCollapseAlways(),
                        'd-none d-md-table-cell' =>  $column && $column->shouldCollapseOnMobile(),
                        'd-none d-lg-table-cell' => $column && $column->shouldCollapseOnTablet(),
                        'laravel-livewire-tables-cursor' => $column && $column->isClickable(),
                    ])
                ->except(['default','default-styling','default-colors'])
        }}
    >
        {{ $slot }}
</td>
