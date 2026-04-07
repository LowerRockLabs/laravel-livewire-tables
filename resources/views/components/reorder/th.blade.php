@aware(['isTailwind','isTailwind4', 'isBootstrap', 'dataTableFingerprint'])
@php
    $customThAttributes = $this->hasReorderThAttributes() ? $this->getReorderThAttributes() : $this->getAllThAttributes($this->getReorderColumn())['customAttributes'];
@endphp

<x-livewire-tables::table.th.plain x-cloak x-show="currentlyReorderingStatus" wire:key="{{ $dataTableFingerprint }}-thead-reorder" :displayMinimisedOnReorder="false" 
    {{ 
        $attributes->merge($customThAttributes)
            ->class($isTailwind ? [
                'table-cell px-6 py-3 text-left text-xs font-medium whitespace-nowrap tracking-wider' => (($customThAttributes['default-styling'] ?? true) || ($customThAttributes['default'] ?? true)),
                'text-gray-500 dark:bg-gray-800 dark:text-gray-400' => (($customThAttributes['default-colors'] ?? true) || ($customThAttributes['default'] ?? true)),
                ] : [])
            ->class($isTailwind4 ? [
                'tw4ph table-cell px-6 py-3 text-left text-xs font-medium whitespace-nowrap tracking-wider' => (($customThAttributes['default-styling'] ?? true) || ($customThAttributes['default'] ?? true)),
                'tw4ph text-gray-500 dark:bg-gray-800 dark:text-gray-400' => (($customThAttributes['default-colors'] ?? true) || ($customThAttributes['default'] ?? true)),
                ] : [])
            ->class($isBootstrap ? [
                'laravel-livewire-tables-reorderingMinimised' => ($customThAttributes['default'] ?? true),
                ] : [])
            ->except(['default','default-styling','default-colors'])
    }}
>
    <div x-cloak x-show="currentlyReorderingStatus"></div>
</x-livewire-tables::table.th.plain>

