@aware([ 'row', 'rowIndex', 'tableName', 'primaryKey', 'rowPk', 'isTailwind','isBootstrap','rowUrl', 'rowTarget', 'collapsingColumnDetails', 'columnCollapseInfo'])
@props(['customAttributes', 'colData', 'colIndex'])


<td wire:key="{{ $tableName . '-table-td-'.$rowPk.'-'.$colData['slug'] }}" x-ref="{{ $tableName . "_" . $rowIndex.  "_" . $colIndex }}"
    @if ($colData['isClickable'] ?? false)
        @if($rowTarget === 'navigate') wire:navigate href="{{ $rowUrl }}"
        @else onclick="window.open('{{ $rowUrl }}', '{{ $rowTarget ?? '_self' }}')"
        @endif
    @endif
        {{
            $attributes->merge($customAttributes)
                ->class($isTailwind ? [
                        'px-6 py-4 whitespace-nowrap text-sm font-medium dark:text-white' => $isTailwind && ($customAttributes['default'] ?? true),
                        'hidden' => $colData['shouldCollapseAlways'] ?? false,
                        'hidden md:table-cell' => $colData['shouldCollapseOnMobile'] ?? false,
                        'hidden lg:table-cell' => $colData['shouldCollapseOnTablet'] ?? false,
                    ] : [
                        '' => ($customAttributes['default'] ?? true),
                        'd-none' =>  $colData['shouldCollapseAlways'] ?? false,
                        'd-none d-md-table-cell' =>  $colData['shouldCollapseOnMobile'] ?? false,
                        'd-none d-lg-table-cell' => $colData['shouldCollapseOnTablet'] ?? false,
                        'laravel-livewire-tables-cursor' => $colData['isClickable'] ?? false,
                    ])
                ->except(['default','default-styling','default-colors'])
        }}
    >
        {{ $slot }}
</td>
