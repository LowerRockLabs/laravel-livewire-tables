@props(['component', 'tableName'])

<div wire:key="{{ $tableName }}-wrapper" >
    <div {{ $attributes->merge($this->getComponentWrapperAttributes()) }}
        @if ($component->hasRefresh()) wire:poll{{ $component->getRefreshOptions() }} @endif
        @if ($component->isFilterLayoutSlideDown()) wire:ignore.self @endif>

        <div>
            @include('livewire-tables::includes.debug')
            @include('livewire-tables::includes.offline')

            {{ $slot }}
        </div>
    </div>
</div>
