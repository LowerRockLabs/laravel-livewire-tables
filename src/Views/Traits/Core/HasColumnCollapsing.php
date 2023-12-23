<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Core;

use Rappasoft\LaravelLivewireTables\Views\Traits\Core\Configuration\ColumnCollapsingConfiguration;
use Rappasoft\LaravelLivewireTables\Views\Traits\Core\Helpers\ColumnCollapsingHelpers;

trait HasColumnCollapsing
{
    use ColumnCollapsingConfiguration,
        ColumnCollapsingHelpers;

    protected bool $collapseOnMobile = false;

    protected bool $collapseOnTablet = false;

    protected bool $collapseAlways = false;
}
