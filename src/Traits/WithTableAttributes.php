<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Closure;
use Rappasoft\LaravelLivewireTables\Traits\Configuration\TableAttributeConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Helpers\TableAttributeHelpers;
use Rappasoft\LaravelLivewireTables\Views\Filter;

trait WithTableAttributes
{
    use TableAttributeConfiguration,
        TableAttributeHelpers;

    protected array $componentWrapperAttributes = [];

    protected array $tableWrapperAttributes = [];

    protected array $tableAttributes = [];

    protected array $theadAttributes = [];

    protected array $tbodyAttributes = [];

    protected mixed $thAttributesCallback = null;

    protected mixed $thSortButtonAttributesCallback = null;

    protected mixed $trAttributesCallback = null;

    protected mixed $tdAttributesCallback = null;

    protected mixed $trUrlCallback = null;

    protected mixed $trUrlTargetCallback = null;
}
