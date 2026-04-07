@aware(['dataTableFingerprint','isTailwind', 'isTailwind4', 'isBootstrap'])
@php
    $customAttributes = $this->hasBulkActionsThAttributes() ? $this->getBulkActionsThAttributes() : $this->getAllThAttributes($this->getBulkActionsColumn())['customAttributes'];
    $bulkActionsThCheckboxAttributes = $this->getBulkActionsThCheckboxAttributes();
@endphp

<x-livewire-tables::table.th.plain  :displayMinimisedOnReorder="true" wire:key="{{ $dataTableFingerprint }}-thead-bulk-actions" :$customAttributes>
    <div x-init="$watch('selectedItems', value => indeterminateCheckbox = (value.length > 0 && value.length < paginationTotalItemCount))"
        @class([
            'inline-flex rounded-md shadow-sm' => $isTailwind,
            'tw4ph inline-flex rounded-md shadow-sm' => $isTailwind4,
            'form-check' => $isBootstrap,
        ])
    >
        <input {{
                $attributes->merge($bulkActionsThCheckboxAttributes)
                ->class($isTailwind ? [
                    'border-gray-300 text-indigo-600 focus:border-indigo-300 focus:ring-indigo-200 dark:bg-gray-900 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600 dark:focus:bg-gray-600' => ($bulkActionsThCheckboxAttributes['default-colors'] ?? ($bulkActionsThCheckboxAttributes['default'] ?? true)),
                    'rounded shadow-sm transition duration-150 ease-in-out focus:ring focus:ring-opacity-50 ' => ($bulkActionsThCheckboxAttributes['default-styling'] ?? ($bulkActionsThCheckboxAttributes['default'] ?? true)),
                    ] : []),
                ->class($isTailwind4 ? [
                    'border-gray-300 text-indigo-600 focus:border-indigo-300 focus:ring-indigo-200 dark:bg-gray-900 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600 dark:focus:bg-gray-600' =>($bulkActionsThCheckboxAttributes['default-colors'] ?? ($bulkActionsThCheckboxAttributes['default'] ?? true)),
                    'rounded shadow-sm transition duration-150 ease-in-out focus:ring focus:ring-opacity-50' => ($bulkActionsThCheckboxAttributes['default-styling'] ?? ($bulkActionsThCheckboxAttributes['default'] ?? true)),
                    ] : []),
                ->class($isBootstrap ? [
                    'form-check-input' => ($bulkActionsThCheckboxAttributes['default-styling'] ?? ($bulkActionsThCheckboxAttributes['default'] ?? true)),
                    ] : [])
                ->except(['default','default-styling','default-colors'])
            }}
        />
    </div>
</x-livewire-tables::table.th.plain>
