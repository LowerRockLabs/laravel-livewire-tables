@aware(['isTailwind','isBootstrap'])
@props(['customAttributes' => [], 'displayMinimisedOnReorder' => true, 'rowIndex' => "-1" ])

<tr  data-id="tr-plain" {{ $attributes
        ->merge($customAttributes)
        ->class($isTailwind ? [
            'ignoresort',
            'laravel-livewire-tables-reorderingMinimised',
            '' => ($customAttributes['default'] ?? true),
        ] : 
        [
            'ignoresort',
            'laravel-livewire-tables-reorderingMinimised',
            '' => $customAttributes['default'] ?? true,
        ])
        ->except(['default','default-styling','default-colors'])
    }}
>
    {{ $slot }}
</tr>
