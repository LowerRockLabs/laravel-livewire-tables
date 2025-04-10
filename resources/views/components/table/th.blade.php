@aware(['isTailwind','isBootstrap'])
@props(['column', 'index'])

@php
    $allThAttributes = $this->getAllThAttributes($column);
    $customThAttributes = $allThAttributes['customAttributes'];
    $customSortButtonAttributes = $allThAttributes['sortButtonAttributes'];
    $customLabelAttributes = $allThAttributes['labelAttributes'];
    $customIconAttributes = $this->getThSortIconAttributes($column);
    $direction = $column->hasField() ? $this->getSort($column->getColumnSelectName()) : $this->getSort($column->getSlug()) ?? null;
@endphp

<th {{
    $attributes->merge($customThAttributes)
        ->class($isTailwind ? 
            [
            'text-gray-500 dark:bg-gray-800 dark:text-gray-400' => (($customThAttributes['default-colors'] ?? true) || ($customThAttributes['default'] ?? true)),
            'px-6 py-3 text-left text-xs font-medium whitespace-nowrap uppercase tracking-wider' => (($customThAttributes['default-styling'] ?? true) || ($customThAttributes['default'] ?? true)),
            'hidden' => $column->shouldCollapseAlways(),
            'hidden md:table-cell' => $column->shouldCollapseOnMobile(),
            'hidden lg:table-cell' => $column->shouldCollapseOnTablet(),
            ] : [
            '' => ($customThAttributes['default'] ?? true),
            'd-none' => $column->shouldCollapseAlways(),
            'd-none d-md-table-cell' => $column->shouldCollapseOnMobile(),
            'd-none d-lg-table-cell' => $column->shouldCollapseOnTablet(),
        ])
        ->except(['default', 'default-colors', 'default-styling'])
}}>
@if($column->getColumnLabelStatus())
        @unless ($this->sortingIsEnabled() && ($column->isSortable() || $column->getSortCallback()))

            <span {{ $customLabelAttributes->except(['default', 'default-colors', 'default-styling']) }}>
                {{ $column->getTitle() }}
            </span>

        @else
            @if ($isTailwind)

                <button wire:click="sortBy('{{ $column->getColumnSortKey() }}')" {{
                        $attributes->merge($customSortButtonAttributes)
                            ->class([
                                'text-gray-500 dark:text-gray-400' => (($customSortButtonAttributes['default-colors'] ?? true) || ($customSortButtonAttributes['default'] ?? true)),
                                'flex items-center space-x-1 text-left text-xs leading-4 font-medium uppercase tracking-wider group focus:outline-none' => (($customSortButtonAttributes['default-styling'] ?? true) || ($customSortButtonAttributes['default'] ?? true)),
                            ])
                            ->except(['default', 'default-colors', 'default-styling', 'wire:key'])
                }}>
                <span {{ $customLabelAttributes->except(['default', 'default-colors', 'default-styling']) }}>
                {{ $column->getTitle() }}
                </span>
                <span @class([
        'relative flex items-center' => $isTailwind,
        'relative d-flex align-items-center' => $isBootstrap
    ])
>

    @if($isTailwind)
        @switch($direction)
            @case('asc')
                <x-heroicon-o-chevron-up {{ $attributes->merge($customIconAttributes)
                    ->class([
                        'w-3 h-3' => $customIconAttributes['default-styling'] ?? ($customIconAttributes['default'] ?? true),
                        'absolute opacity-100 group-hover:opacity-0',
                    ])
                    ->except(['default', 'default-colors', 'default-styling', 'wire:key']) }} />
                <x-heroicon-o-chevron-down {{ $attributes->merge($customIconAttributes)
                    ->class([
                        'w-3 h-3' => $customIconAttributes['default-styling'] ?? ($customIconAttributes['default'] ?? true),
                        'absolute opacity-0 group-hover:opacity-100',
                    ])
                    ->except(['default', 'default-colors', 'default-styling', 'wire:key']) }}  />
            @break
            @case('desc')
                <x-heroicon-o-chevron-down {{ $attributes->merge($customIconAttributes)
                    ->class([
                        'w-3 h-3' => $customIconAttributes['default-styling'] ?? ($customIconAttributes['default'] ?? true),
                        'absolute opacity-100 group-hover:opacity-0',
                    ])
                    ->except(['default', 'default-colors', 'default-styling', 'wire:key']) }}   />
                <x-heroicon-o-x-circle  {{ $attributes->merge($customIconAttributes)
                    ->class([
                        'w-3 h-3' => $customIconAttributes['default-styling'] ?? ($customIconAttributes['default'] ?? true),
                        'absolute opacity-0 group-hover:opacity-100',
                    ])
                    ->except(['default', 'default-colors', 'default-styling', 'wire:key']) }}  />

            @break
            @default
                <x-heroicon-o-chevron-up-down {{ $attributes->merge($customIconAttributes)
                    ->class([
                        'w-3 h-3' => $customIconAttributes['default-styling'] ?? ($customIconAttributes['default'] ?? true),
                        'absolute opacity-100 group-hover:opacity-0',
                    ])
                    ->except(['default', 'default-colors', 'default-styling', 'wire:key'])  }}  />
                <x-heroicon-o-chevron-up {{ $attributes->merge($customIconAttributes)
                    ->class([
                        'w-3 h-3' => $customIconAttributes['default-styling'] ?? ($customIconAttributes['default'] ?? true),
                        'absolute opacity-0 group-hover:opacity-100',
                    ])
                    ->except(['default', 'default-colors', 'default-styling', 'wire:key']) }} />
            @endswitch


    @else
        @switch($direction)
            @case('asc')
                <x-heroicon-o-chevron-up {{ $attributes->merge($customIconAttributes)
                    ->class([
                        'laravel-livewire-tables-btn-smaller ms-1' => $customIconAttributes['default-styling'] ?? ($customIconAttributes['default'] ?? true),
                    ])
                    ->except(['default', 'default-colors', 'default-styling', 'wire:key']) }} />
                @break
            @case('desc')
                <x-heroicon-o-chevron-down {{ $attributes->merge($customIconAttributes)
                    ->class([
                        'laravel-livewire-tables-btn-smaller ms-1' => $customIconAttributes['default-styling'] ?? ($customIconAttributes['default'] ?? true),
                    ])
                    ->except(['default', 'default-colors', 'default-styling', 'wire:key']) }}  />
            @break
            @default
                <x-heroicon-o-chevron-up-down {{ $attributes->merge($customIconAttributes)
                    ->class([
                        'laravel-livewire-tables-btn-smaller ms-1' => $customIconAttributes['default-styling'] ?? ($customIconAttributes['default'] ?? true),
                    ])
                    ->except(['default', 'default-colors', 'default-styling', 'wire:key']) }}  />
        @endswitch
    @endif
</span>
                </button>
            @elseif ($isBootstrap)
                <div wire:click="sortBy('{{ $column->getColumnSortKey() }}')" {{
                        $attributes->merge($customSortButtonAttributes)
                            ->class([
                                'd-flex align-items-center laravel-livewire-tables-cursor' => (($customSortButtonAttributes['default-styling'] ?? true) || ($customSortButtonAttributes['default'] ?? true))
                            ])
                            ->except(['default', 'default-colors', 'default-styling', 'wire:key'])
                }}>
                <span {{ $customLabelAttributes->except(['default', 'default-colors', 'default-styling']) }}>
                    {{ $column->getTitle() }}
                </span>
                <span @class([
        'relative flex items-center' => $isTailwind,
        'relative d-flex align-items-center' => $isBootstrap
    ])
>

    @if($isTailwind)
        @switch($direction)
            @case('asc')
                <x-heroicon-o-chevron-up {{ $attributes->merge($customIconAttributes)
                    ->class([
                        'w-3 h-3' => $customIconAttributes['default-styling'] ?? ($customIconAttributes['default'] ?? true),
                        'absolute opacity-100 group-hover:opacity-0',
                    ])
                    ->except(['default', 'default-colors', 'default-styling', 'wire:key']) }} />
                <x-heroicon-o-chevron-down {{ $attributes->merge($customIconAttributes)
                    ->class([
                        'w-3 h-3' => $customIconAttributes['default-styling'] ?? ($customIconAttributes['default'] ?? true),
                        'absolute opacity-0 group-hover:opacity-100',
                    ])
                    ->except(['default', 'default-colors', 'default-styling', 'wire:key']) }}  />
            @break
            @case('desc')
                <x-heroicon-o-chevron-down {{ $attributes->merge($customIconAttributes)
                    ->class([
                        'w-3 h-3' => $customIconAttributes['default-styling'] ?? ($customIconAttributes['default'] ?? true),
                        'absolute opacity-100 group-hover:opacity-0',
                    ])
                    ->except(['default', 'default-colors', 'default-styling', 'wire:key']) }}   />
                <x-heroicon-o-x-circle  {{ $attributes->merge($customIconAttributes)
                    ->class([
                        'w-3 h-3' => $customIconAttributes['default-styling'] ?? ($customIconAttributes['default'] ?? true),
                        'absolute opacity-0 group-hover:opacity-100',
                    ])
                    ->except(['default', 'default-colors', 'default-styling', 'wire:key']) }}  />

            @break
            @default
                <x-heroicon-o-chevron-up-down {{ $attributes->merge($customIconAttributes)
                    ->class([
                        'w-3 h-3' => $customIconAttributes['default-styling'] ?? ($customIconAttributes['default'] ?? true),
                        'absolute opacity-100 group-hover:opacity-0',
                    ])
                    ->except(['default', 'default-colors', 'default-styling', 'wire:key'])  }}  />
                <x-heroicon-o-chevron-up {{ $attributes->merge($customIconAttributes)
                    ->class([
                        'w-3 h-3' => $customIconAttributes['default-styling'] ?? ($customIconAttributes['default'] ?? true),
                        'absolute opacity-0 group-hover:opacity-100',
                    ])
                    ->except(['default', 'default-colors', 'default-styling', 'wire:key']) }} />
            @endswitch


    @else
        @switch($direction)
            @case('asc')
                <x-heroicon-o-chevron-up {{ $attributes->merge($customIconAttributes)
                    ->class([
                        'laravel-livewire-tables-btn-smaller ms-1' => $customIconAttributes['default-styling'] ?? ($customIconAttributes['default'] ?? true),
                    ])
                    ->except(['default', 'default-colors', 'default-styling', 'wire:key']) }} />
                @break
            @case('desc')
                <x-heroicon-o-chevron-down {{ $attributes->merge($customIconAttributes)
                    ->class([
                        'laravel-livewire-tables-btn-smaller ms-1' => $customIconAttributes['default-styling'] ?? ($customIconAttributes['default'] ?? true),
                    ])
                    ->except(['default', 'default-colors', 'default-styling', 'wire:key']) }}  />
            @break
            @default
                <x-heroicon-o-chevron-up-down {{ $attributes->merge($customIconAttributes)
                    ->class([
                        'laravel-livewire-tables-btn-smaller ms-1' => $customIconAttributes['default-styling'] ?? ($customIconAttributes['default'] ?? true),
                    ])
                    ->except(['default', 'default-colors', 'default-styling', 'wire:key']) }}  />
        @endswitch
    @endif
</span>
                    
                    
                </div>
            @endif

        @endunless
    @endif
</th>
