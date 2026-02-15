@aware(['isTailwind', 'isTailwind4', 'isBootstrap'])
@props(['direction' => 'none', 'customIconAttributes'])
<span @class([
        'relative flex items-center' => $isTailwind || $isTailwind4,
        'w-5 h-5' =>  ($isTailwind || $isTailwind4) && ($customIconAttributes['default-styling'] ?? ($customIconAttributes['default'] ?? true)),
        'relative d-flex align-items-center' => $isBootstrap
    ])
>
    @if($isTailwind || $isTailwind4)
        @switch($direction)
            @case('asc')
                <x-livewire-tables::icons.sort.up />
                <x-livewire-tables::icons.sort.down_hover/>

            @break
            @case('desc')
                <x-livewire-tables::icons.sort.down  />
                <x-livewire-tables::icons.sort.clear />
            @break
            @default
                <x-livewire-tables::icons.sort.unsorted  />
                <x-livewire-tables::icons.sort.up_hover  />
            @endswitch
    @else
        @switch($direction)
            @case('asc')
                <x-livewire-tables::icons.sort.up />
            @break
            @case('desc')
                <x-livewire-tables::icons.sort.down />
            @break
            @default
                <x-livewire-tables::icons.sort.unsorted />
        @endswitch
    @endif
</span>
