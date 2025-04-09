@aware(['tableName', 'primaryKey','isTailwind','isBootstrap'])
<x-slot name="tfoot">
    <tfoot data-id="tfoot" wire:key="{{ $tableName }}-tfoot">

        @if ($this->useHeaderAsFooterIsEnabled())
            <x-livewire-tables::table.tr.secondary-header  />
        @else
            <x-livewire-tables::table.tr.footer  />
        @endif
    </tfoot>
</x-slot>   
