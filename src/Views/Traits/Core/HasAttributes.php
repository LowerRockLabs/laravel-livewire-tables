<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Core;

use Closure;
use Rappasoft\LaravelLivewireTables\Views\Traits\Core\Configuration\AttributesConfiguration;
use Rappasoft\LaravelLivewireTables\Views\Traits\Core\Helpers\AttributesHelpers;

trait HasAttributes
{
    use AttributesConfiguration,
        AttributesHelpers;

    protected ?Closure $attributesCallback = null;
}
