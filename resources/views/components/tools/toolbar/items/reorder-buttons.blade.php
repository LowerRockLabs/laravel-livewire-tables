@aware(['component', 'tableName'])
<div x-data x-cloak x-show="reorderStatus"
    @class([
        'mr-0 mr-md-2 mb-3 mb-md-0' => $component->isBootstrap4(),
        'me-0 me-md-2 mb-3 mb-md-0' => $component->isBootstrap5()
    ])
>
    <button
        x-on:click="reorderToggle"
        type="button"
        {{
            $attributes->merge($component->getReorderBtnAttributes())
                ->class(['btn btn-default d-block d-md-inline' => $component->isBootstrap() && (($component->getReorderBtnAttributes()['default'] ?? true) || ($component->getReorderBtnAttributes()['default-styling'] ?? true))])
                ->class(['justify-center items-center w-full md:w-auto px-4 py-2 border shadow-sm text-sm font-medium rounded-md focus:ring focus:ring-opacity-50 active:bg-gray-50 transition ease-in-out duration-150' => $component->isTailwind() && (($component->getReorderBtnAttributes()['default'] ?? true) || ($component->getReorderBtnAttributes()['default-styling'] ?? true))])
                ->class(['border-gray-300  dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600 text-gray-700 bg-white hover:text-gray-500 focus:border-indigo-300 focus:ring-indigo-200 active:text-gray-800' => $component->isTailwind() && (($component->getReorderBtnAttributes()['default'] ?? true) || ($component->getReorderBtnAttributes()['default-colors'] ?? true))]);
        }}
    >
        <span x-cloak x-show="currentlyReorderingStatus">
            @lang('Cancel')
        </span>

        <span x-cloak x-show="!currentlyReorderingStatus">
            @lang('Reorder')
        </span>

    </button>
    
    <button
        type="button"
        x-cloak x-show="currentlyReorderingStatus" 
        x-on:click="updateOrderedItems"

        {{
            $attributes->merge($component->getReorderBtnAttributes())
                ->class(['btn btn-default d-block d-md-inline' => $component->isBootstrap() && (($component->getReorderBtnAttributes()['default'] ?? true) || ($component->getReorderBtnAttributes()['default-styling'] ?? true))])
                ->class(['justify-center items-center w-full md:w-auto px-4 py-2 border shadow-sm text-sm font-medium rounded-md focus:ring focus:ring-opacity-50 active:bg-gray-50 transition ease-in-out duration-150' => $component->isTailwind() && (($component->getReorderBtnAttributes()['default'] ?? true) || ($component->getReorderBtnAttributes()['default-styling'] ?? true))])
                ->class(['border-gray-300  dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600 text-gray-700 bg-white hover:text-gray-500 focus:border-indigo-300 focus:ring-indigo-200 active:text-gray-800' => $component->isTailwind() && (($component->getReorderBtnAttributes()['default'] ?? true) || ($component->getReorderBtnAttributes()['default-colors'] ?? true))]);
        }}
        :class="currentlyReorderingStatus ? 'inline-flex' : ''"
    >
        <span>
            @lang('Save')
        </span>
    </button>

</div>
