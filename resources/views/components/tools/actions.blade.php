@aware(['component'])

<div>
    @foreach($component->actions as $action)
        @continue($action->isHidden())
        <a {{
            $attributes->merge($action->attributes)
            ->class(['btn btn-sm btn-success' => ! $action->hasClass()])
        }}
           @if($action->hasWireElement())
               wire:{{ $action->getWireElementType() }}="{{ $action->getWireElementComponentName() }} , @js($action->getWireElementParams())"
           @endif
        >
            {{ $action->label }}

            @if($action->hasIcon())
                <i class="ms-1 {{ $action->icon }}"></i>
            @endif
        </a>
    @endforeach
</div>