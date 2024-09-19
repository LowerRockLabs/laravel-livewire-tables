<div>
    @if ($this->debugIsEnabled())
        <p><strong>{{ __('livewire-tables::core.debugging_values') }}:</strong></p>

        @if (! app()->runningInConsole())
            <div class="mb-4">@dump((new \Rappasoft\LaravelLivewireTables\DataTransferObjects\DebuggableData($this))->toArray())</div>
        @endif
    @endif
</div>
