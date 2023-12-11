@props(['component'])
@if($this->getContextMenuIsEnabled() && !$this->currentlyReorderingStatus)
<template x-teleport="body">
        <div x-cloak x-show="contextMenuOpen" @click.away="contextMenuOpen=false" x-ref="contextmenu" 
        {{ 
            $attributes->merge($this->getContextMenuAttributes())->class([
                'z-50 min-w-[8rem] text-neutral-800 rounded-md border border-neutral-200/70 bg-white text-sm fixed p-1 shadow-md w-64' => ($this->getContextMenuAttributes()['default'] ?? true)
            ])
        }}
        >
            @if($this->hasContextMenuBlade())
                @include($this->getContextMenuBlade())
            @else
                {!! $this->getContextMenuContent() !!}
            @endif

        </div>
</template>
@else
<span></span>
@endif
