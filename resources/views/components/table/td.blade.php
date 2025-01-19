@aware([ 'row', 'rowIndex', 'tableName', 'primaryKey','isTailwind','isBootstrap', 'tableRowUrl', 'tableRowUrlTarget'])
@props(['column', 'colIndex'])

@php
    $customTdAttributes = $this->getTdAttributesForBlade($column, $row, $colIndex, $rowIndex, $tableRowUrl, $tableRowUrlTarget);

@endphp

<td wire:key="{{ $tableName . '-table-td-'.$row->{$primaryKey}.'-'.$column->getSlug() }}"
        {{
            $attributes->merge($customTdAttributes)
                ->class([
                    'px-6 py-4 whitespace-nowrap text-sm font-medium dark:text-white' => $isTailwind && ($customTdAttributes['default'] ?? true),
                    'hidden' =>  $isTailwind && ($customTdAttributes['shouldCollapseAlways'] ?? false),
                    'hidden md:table-cell' => $isTailwind && ($customTdAttributes['shouldCollapseOnMobile'] ?? false),
                    'hidden lg:table-cell' => $isTailwind && ($customTdAttributes['shouldCollapseOnTablet'] ?? false),
                    '' => $isBootstrap && ($customTdAttributes['default'] ?? true),
                    'd-none' => $isBootstrap && $customTdAttributes['shouldCollapseAlways'],
                    'd-none d-md-table-cell' => $isBootstrap && $customTdAttributes['shouldCollapseOnMobile'],
                    'd-none d-lg-table-cell' => $isBootstrap && $customTdAttributes['shouldCollapseOnTablet'],
                    'laravel-livewire-tables-cursor' => $isBootstrap && $column->isClickable(),
                ])
                ->except(['default','default-styling','default-colors', 'shouldCollapseNever', 'shouldCollapseAlways', 'shouldCollapseOnMobile', 'shouldCollapseOnTablet'])
        }}
    >
        {{ $slot }}
</td>
