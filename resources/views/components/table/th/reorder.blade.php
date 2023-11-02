@aware(['component', 'tableName'])
@php
    $theme = $component->getTheme();
    $customAttributes = $component->getThReorderAttributes();
@endphp

<th x-show="currentlyReorderingStatus" wire:key="{{ $tableName }}-thead-reorder" :displayMinimisedOnReorder="false"
        {{
            $attributes->merge($customAttributes)
            ->class(['px-6 py-3 text-left text-xs font-medium whitespace-nowrap text-gray-500 uppercase tracking-wider dark:bg-gray-800 dark:text-gray-400' => $customAttributes['default'] ?? true])
            ->except('default')
        }}
    >
    <div x-cloak x-show="currentlyReorderingStatus"></div>
</th>