<button {!! $attributes !!}
    wire:click="$dispatch('simplemodalload', { modalComponent: '{{ $modalComponentName }}', arguments: {{ $arguments }} })"
>{{ $title }}</button>
