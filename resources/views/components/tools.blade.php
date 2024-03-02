@aware(['component'])

<div tableSection="tools-wrapper" dusk="tools-wrapper" 
    @class([
        'flex-col' => $component->isTailwind(),
        'd-flex flex-column ' => ($component->isBootstrap()),
    ])
>
    {{ $slot }}
</div>
