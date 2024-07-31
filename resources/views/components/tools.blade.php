@aware(['component', 'isTailwind','isBootstrap','isBootstrap4','isBootstrap5'])

<div @class([
    'flex-col' => $isTailwind,
    'd-flex flex-column ' => ($isBootstrap),
])>
    {{ $slot }}
</div>
