<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Core;

use Rappasoft\LaravelLivewireTables\Views\Traits\Core\Configuration\ColumnSortingConfiguration;
use Rappasoft\LaravelLivewireTables\Views\Traits\Core\Helpers\ColumnSortingHelpers;

trait HasColumnSorting
{
    use ColumnSortingConfiguration,
    ColumnSortingHelpers;

    protected ?string $sortingPillTitle = null;

    protected ?string $sortingPillDirectionAsc = null;

    protected ?string $sortingPillDirectionDesc = null;
    
    protected bool $sortable = false;

    protected mixed $sortCallback = null;
}