@aware(['isTailwind','isBootstrap'])
@props(['column', 'index'])

@php
    $allThAttributes = $this->getAllThAttributes($column);
    $columnTitle = $column->getTitle();
    $customSortButtonAttributes = $allThAttributes['sortButtonAttributes'];
    $customThAttributes = $allThAttributes['customAttributes'];
@endphp

<th {{
    $attributes->merge($customThAttributes)
        ->class([
            'text-gray-500 dark:bg-gray-800 dark:text-gray-400' => $isTailwind && (($customThAttributes['default-colors'] ?? true) || ($customThAttributes['default'] ?? true)),
            'px-6 py-3 text-left text-xs font-medium whitespace-nowrap uppercase tracking-wider' => $isTailwind && (($customThAttributes['default-styling'] ?? true) || ($customThAttributes['default'] ?? true)),
            'hidden' => $isTailwind && ($allThAttributes['shouldCollapseAlways'] ?? false),
            'hidden md:table-cell' => $isTailwind && ($allThAttributes['shouldCollapseOnMobile'] ?? false),
            'hidden lg:table-cell' => $isTailwind && ($allThAttributes['shouldCollapseOnTablet'] ?? false),
            '' => $isBootstrap && ($customThAttributes['default'] ?? true),
            'd-none' => $isBootstrap && ($allThAttributes['shouldCollapseAlways'] ?? false),
            'd-none d-md-table-cell' => $isBootstrap && ($allThAttributes['shouldCollapseOnMobile'] ?? false),
            'd-none d-lg-table-cell' => $isBootstrap && ($allThAttributes['shouldCollapseOnTablet'] ?? false),
        ])
        ->except(['default', 'default-colors', 'default-styling'])
}}>
    @if($column->getColumnLabelStatus())
        @unless ($this->sortingIsEnabled && ($column->isSortable() || $column->hasSortCallback()))
            <x-livewire-tables::table.th.label :customLabelAttributes="$allThAttributes['labelAttributes']" :$columnTitle />
        @else
            @php
                $direction = $column->hasField() ? $this->getSort($column->getColumnSelectName()) : ($this->getSort($column->getSlug()) ?? null);

            @endphp
            @if ($isTailwind)

                <button wire:click="sortBy('{{ $column->getColumnSortKey() }}')" {{
                        $attributes->merge($customSortButtonAttributes)
                            ->class([
                                'text-gray-500 dark:text-gray-400' => (($customSortButtonAttributes['default-colors'] ?? true) || ($customSortButtonAttributes['default'] ?? true)),
                                'flex items-center space-x-1 text-left text-xs leading-4 font-medium uppercase tracking-wider group focus:outline-none' => (($customSortButtonAttributes['default-styling'] ?? true) || ($customSortButtonAttributes['default'] ?? true)),
                            ])
                            ->except(['default', 'default-colors', 'default-styling', 'wire:key'])
                }}>
                    <x-livewire-tables::table.th.label :customLabelAttributes="$allThAttributes['labelAttributes']" :$columnTitle />
                    <x-livewire-tables::table.th.sort-icons :$direction :customIconAttributes="$allThAttributes['sortIconAttributes']" />
                </button>
            @elseif ($isBootstrap)
                <div wire:click="sortBy('{{ $column->getColumnSortKey() }}')" {{
                        $attributes->merge($customSortButtonAttributes)
                            ->class([
                                'd-flex align-items-center laravel-livewire-tables-cursor' => (($customSortButtonAttributes['default-styling'] ?? true) || ($customSortButtonAttributes['default'] ?? true))
                            ])
                            ->except(['default', 'default-colors', 'default-styling', 'wire:key'])
                }}>
                    <x-livewire-tables::table.th.label :customLabelAttributes="$allThAttributes['labelAttributes']" :$columnTitle />
                    <x-livewire-tables::table.th.sort-icons :$direction :customIconAttributes="$allThAttributes['sortIconAttributes']" />

                </div>
            @endif

        @endunless
    @endif
</th>
