@props(['component'])

@php
    $refresh = $this->getRefreshStatus();
    $theme = $component->getTheme();
@endphp

 <div
    {{ $attributes->merge($this->getComponentWrapperAttributes()) }}

    @if ($component->hasRefresh())
        wire:poll{{ $component->getRefreshOptions() }}
    @endif
    wire:ignore.self 

    x-data="{ 
        visibleRows: $wire.entangle('collapsedColumnStatuses').defer,
        hasCollapsedColumns: false, 
        isDesktop: false, 
        isMobile: false, 
        isTablet: false, 
        @if ($component->isFilterLayoutSlideDown()) filtersOpen: $wire.filterSlideDownDefaultVisible, @endif
        callResizeFunction()
        {
            this.isDesktop = (window.innerWidth > 768) ? true : false;
            this.isMobile = (window.innerWidth <= 640) ? true : false; 
            this.isTablet = (window.innerWidth > 640 && window.innerWidth <= 768) ? true : false; 
        },
        init()
        {
            this.callResizeFunction();
        }
    }"
    x-on:resize.window.debounce="callResizeFunction"
    
>
     @include('livewire-tables::includes.debug')
     @include('livewire-tables::includes.offline')

     {{ $slot }}
</div>
