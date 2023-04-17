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
        hasCollapsedColumns: false, 
        isDesktop: false, 
        isMobile: false, 
        isTablet: false, 
        @if ($component->isFilterLayoutSlideDown()) filtersOpen: $wire.filterSlideDownDefaultVisible, @endif
        callResizeFunction()
        {
            this.isMobile = (window.innerWidth <= 640) ? true : false; 
            this.isTablet = (window.innerWidth > 640 && window.innerWidth <= 768) ? true : false; 
            this.isDesktop = (window.innerWidth > 768) ? true : false;
        },
    }"
    x-init="
    this.isMobile = (window.innerWidth < 640) ? true : false; 
    this.isTablet = (window.innerWidth > 640 && window.innerWidth <= 768) ? true : false;
    this.isDesktop = (window.innerWidth >= 768) ? true : false;
    "
    x-on:resize.window.debounce="callResizeFunction"
>
     @include('livewire-tables::includes.debug')
     @include('livewire-tables::includes.offline')

     {{ $slot }}
</div>
