@aware(['component'])

<div>
    @foreach($component->actions as $action)
        @continue($action->isHidden())
        <a {{
            $attributes->merge($action->getAttributes())
            ->class(['inline-flex justify-center px-4 py-2 text-sm font-medium rounded-md border shadow-sm focus:ring focus:ring-opacity-50' => ($action->getAttributes()['default'] ?? true) && ($action->getAttributes()['default-styling'] ?? true)])
            ->class(['text-gray-700 bg-white border-gray-300 hover:bg-gray-50 focus:border-indigo-300 focus:ring-indigo-200 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600' => ($action->getAttributes()['default'] ?? true) && ($action->getAttributes()['default-colors'] ?? true)])
            ->class(['btn btn-sm btn-success' => ! $action->hasClass()])
        }}
           @if($action->hasWireElement())
            @if($action->hasWireDispatch())
                wire:click="$dispatch('openModal', { component: '{{ $this->modalPath }}', arguments: { modelID: ''  }})"    
            @else
                wire:{{ $action->getWireElementType() }}="{{ $action->getWireElementComponentName() }} , @js($action->getWireElementParams())"
            @endif
           @endif
        >
            {{ $action->label }}

            @if($action->hasIcon())
                <i class="ms-1 {{ $action->icon }}"></i>
            @endif
        </a>
    @endforeach
</div>
