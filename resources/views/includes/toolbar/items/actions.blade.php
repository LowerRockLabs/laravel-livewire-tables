@aware(['isTailwind', 'isTailwind4', 'isBootstrap', 'dataTableFingerprint', 'localisationPath'])

@php($actions = $this->getActions())

@if(count($actions) > 0)
    @if($showActionsInToolbar && ($showActionsAsDropdown || count($actions) >= 5))

        <x-livewire-tables::dropdown.wrapper>
            {{-- The Button Used To Toggle The Menu --}}
            <x-livewire-tables::dropdown.button id="{{ $dataTableFingerprint }}-actionsDropdownButton" aria-controls="{{ $dataTableFingerprint }}-actionsDropdownBody" {{ $attributes->merge($actionButtonAttributes) }}>
                {{ __($localisationPath.'Actions') }}

                @if($isTailwind || $isTailwind4)
                    <x-heroicon-m-chevron-down class="-mr-1 ml-2 h-5 w-5" />
                @endif
            </x-livewire-tables::dropdown.button>

            {{-- The Body of The Menu --}}
            <x-livewire-tables::dropdown.body id="{{ $dataTableFingerprint }}-actionsDropdownBody" aria-labelledby="{{ $dataTableFingerprint }}-actionsDropdownButton" {{ $attributes->merge($actionsMenuAttributes) }}>
                @foreach($actions as $action)
                    {{ $action->setInMenu(true)->render() }}
                @endforeach
            </x-livewire-tables::dropdown.body>
        </x-livewire-tables::dropdown.wrapper>

    @else
            <div {{ $attributes
                        ->merge($actionWrapperAttributes)
                        ->class([
                            // All
                            'justify-start' => $actionsPosition === 'left',
                            'justify-center' => $actionsPosition === 'center',
                            'justify-end' => $actionsPosition === 'right',
                            'pl-2' => $showActionsInToolbar && $actionsPosition === 'left',
                            'pr-2' => $showActionsInToolbar && $actionsPosition === 'right',                    
                        ])
                        ->class($isTailwind ? [
                            'h-full flex flex-cols py-2 space-x-2' => ($actionWrapperAttributes['default-styling'] ?? true),
                            '' =>  ($actionWrapperAttributes['default-colors'] ?? true),
                        ] : [])
                        ->class($isTailwind4 ? [
                            'flex flex-cols py-2 space-x-2' => ($actionWrapperAttributes['default-styling'] ?? true),
                            '' => ($actionWrapperAttributes['default-colors'] ?? true),
                        ] : [])
                        ->class($isBootstrap ? [
                            'd-flex flex-cols py-2 space-x-2' =>  ($actionWrapperAttributes['default-styling'] ?? true),
                            '' =>  ($actionWrapperAttributes['default-colors'] ?? true),
                        ] : [])
                        ->except(['default','default-styling','default-colors'])
                    }} >

                        @foreach($actions as $action)
                            {{ $action->render() }}
                        @endforeach

            </div>
    @endif

@endif
