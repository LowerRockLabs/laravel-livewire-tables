@aware(['isTailwind', 'isTailwind4', 'dataTableFingerprint'])
<x-livewire-tables::table.tr.plain {{ $attributes->merge([
            'x-cloak' => '',
            'x-show' => 'selectedItems.length > 0 && !currentlyReorderingStatus',
            'data-id' => 'bil',
            'wire:key' => $dataTableFingerprint . "-bulk-select-message",
        ])
        ->class($isTailwind ? [
            'bg-indigo-50 dark:bg-gray-900 dark:text-white'
            ] : []),
        ->class($isTailwind4 ? [
            'bg-indigo-50 dark:bg-gray-900 dark:text-white'
            ] : []),
    }}
>
    {{  $slot  }}
</x-livewire-tables::table.tr.plain>