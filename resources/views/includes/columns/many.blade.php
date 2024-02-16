@if ($component->isTailwind())
<div @class([
                'items-center content-center place-content-center place-items-center' => $isTailwind,
            ])
>
    {{ $value }}
</div>
@else
<div>
    {{ $value }}
</div>
@endif
