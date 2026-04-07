@aware(['dataTableFingerprint', 'localisationPath', 'filterLayout', 'isTailwind', 'isTailwind4', 'isBootstrap', 'isBootstrap4', 'isBootstrap5', 'filterMenuResetButtonAttributes'])
@props(['filter', 'filterLabelAttributes', 'filterInputAttributes', 'customLabelAttributes'])
@php
    $defaultValue = ($filter->hasFilterDefaultValue() ? $filter->getFilterDefaultValue() : null)
@endphp
<x-livewire-tables::tools.filters.wrapper x-data="stringFilter($wire, '{{ $filter->getKey() }}', '{{ $dataTableFingerprint }}', '{{ $defaultValue }}')">
 <x-slot:label>
    <x-livewire-tables::tools.filter-label :$filter :$filterLayout   :$filterLabelAttributes :$customLabelAttributes />
</x-slot:label>
 <x-slot:clearButton>
        <template x-if="($wire.get('appliedFilters.{{ $filter->getKey() }}') ?? null) !== null">
            <div class="w-1/12 inline-flex items-end justify-end ">
                <button @click="toggleStatusWithReset(); filterPopoverOpen = false;" 
                    {{ $this->getFilterMenuResetButtonAttributesBag()->merge(['type' => 'button'])
                    ->class($isTailwind ? [
                        'w-min rounded-full focus:outline-none' => ($filterMenuResetButtonAttributes['default-styling'] ?? true),    
                        'text-indigo-400 hover:bg-indigo-200 hover:text-indigo-500 focus:bg-indigo-500 focus:text-white' => ($filterMenuResetButtonAttributes['default-colors'] ?? true),
                    ] : [])
                    ->class($isTailwind4 ? [
                        'w-min rounded-full focus:outline-none' => ($filterMenuResetButtonAttributes['default-styling'] ?? true),    
                        'text-indigo-400 hover:bg-indigo-200 hover:text-indigo-500 focus:bg-indigo-500 focus:text-white' => ($filterMenuResetButtonAttributes['default-colors'] ?? true),
                    ] : [])
                    ->except(['default-colors','default-styling']) 
                }}>
                    <span class="sr-only">{{ __($localisationPath.'Remove filter option') }}</span>
                    <x-heroicon-m-x-mark class="h-6 w-6" />
                </button>

            </div>
        </template>  
</x-slot:clearButton>
    <div @class([
        'basis-full w-full flex flex-row items-center rounded-md shadow-sm' => $isTailwind,
        'tw4ph rounded-md shadow-sm' => $isTailwind4,
        'mb-3 mb-md-0 input-group' => $isBootstrap,
    ])>
    @if ($slot->isEmpty())
        <input {!! $filter->getWireMethod('appliedFilters.'.$filter->getKey()) !!} {{ 
                $filterInputAttributes->merge()
                ->class($isTailwind ? [
                    'block w-full rounded-md shadow-sm transition duration-150 ease-in-out focus:ring focus:ring-opacity-50' => ($filterInputAttributes['default-styling'] ?? true),
                    'border-gray-300 focus:border-indigo-300 focus:ring-indigo-200 dark:bg-gray-800 dark:text-white dark:border-gray-600' => ($filterInputAttributes['default-colors'] ?? true),
                    ] : [])
                ->class($isTailwind4 ? [
                    'block w-full rounded-md shadow-sm transition duration-150 ease-in-out focus:ring focus:ring-opacity-50' => ($filterInputAttributes['default-styling'] ?? true),
                    'border-gray-300 focus:border-indigo-300 focus:ring-indigo-200 dark:bg-gray-800 dark:text-white dark:border-gray-600' => ($filterInputAttributes['default-colors'] ?? true),
                    ] : [])
                ->class($isBootstrap4 ? [
                    'form-control' => ($filterInputAttributes['default-styling'] ?? true),
                ] : [])
                ->class($isBootstrap5 ? [
                    'form-select' => ($filterInputAttributes['default-styling'] ?? true),
                ] : [])
                ->except(['default-styling','default-colors']) 
            }} />
    @else
        {{ $slot }}
    @endif


    </div>

 </x-livewire-tables::tools.filters.wrapper>
