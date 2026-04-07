@aware(['dataTableFingerprint', 'localisationPath', 'filterLayout', 'isTailwind', 'isTailwind4', 'isBootstrap', 'isBootstrap4', 'isBootstrap5', 'filterMenuResetButtonAttributes'])
 <x-livewire-tables::tools.filters.wrapper-string :$filter :$filterInputAttributes :$filterLabelAttributes :$customLabelAttributes>
    <div @class([
        'basis-full w-full flex flex-row items-center rounded-md shadow-sm' => $isTailwind,
        'tw4ph rounded-md shadow-sm' => $isTailwind4,
        'mb-3 mb-md-0 input-group' => $isBootstrap,
    ])>
        <select {!! $filter->getWireMethod('appliedFilters.'.$filter->getKey()) !!} {{ $filterInputAttributes->merge()
                ->class($isTailwind ? [
                    'block w-full transition duration-150 ease-in-out rounded-md shadow-sm focus:ring focus:ring-opacity-50' => ($filterInputAttributes['default-styling'] ?? true),
                    'border-gray-300 focus:border-indigo-300 focus:ring-indigo-200 dark:bg-gray-800 dark:text-white dark:border-gray-600' => ($filterInputAttributes['default-colors'] ?? true),
                    ] : [])
                ->class($isTailwind4 ? [
                    'block w-full transition duration-150 ease-in-out rounded-md shadow-sm focus:ring focus:ring-opacity-50' => ($filterInputAttributes['default-styling'] ?? true),
                    'border-gray-300 focus:border-indigo-300 focus:ring-indigo-200 dark:bg-gray-800 dark:text-white dark:border-gray-600' => ($filterInputAttributes['default-colors'] ?? true),
                    ] : [])
                ->class($isBootstrap4 ? [
                    'form-control' => ($filterInputAttributes['default-styling'] ?? true),
                    ] : [])
                ->class($isBootstrap5 ? [
                    'form-select' => ($filterInputAttributes['default-styling'] ?? true),
                    ] : [])
                ->except(['default-styling','default-colors']) 
            }}
        >
            @foreach($filter->getOptions() as $key => $value)
                @if (is_iterable($value))
                    <optgroup label="{{ $key }}">
                        @foreach ($value as $optionKey => $optionValue)
                            <option value="{{ $optionKey }}">{{ $optionValue }}</option>
                        @endforeach
                    </optgroup>
                @else
                    <option value="{{ $key }}">{{ $value }}</option>
                @endif
            @endforeach
        </select>
    </div>
 </x-livewire-tables::tools.filters.wrapper-string>

