<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits;

use Rappasoft\LaravelLivewireTables\Views\Traits\Configuration\FilterConfiguration;
use Rappasoft\LaravelLivewireTables\Views\Traits\Helpers\FilterHelpers;
use Rappasoft\LaravelLivewireTables\Views\Traits\Core\HasLabel;
use Rappasoft\LaravelLivewireTables\Views\Traits\Core\HasDefaultValue;
use Rappasoft\LaravelLivewireTables\Views\Traits\Core\HasView;

trait IsFilter
{
    use FilterConfiguration,
        FilterHelpers,
        HasLabel,
        HasDefaultValue,
        HasView;

    protected string $name;

    protected string $key;

    protected bool $hiddenFromMenus = false;

    protected bool $hiddenFromPills = false;

    protected bool $hiddenFromFilterCount = false;

    protected bool $resetByClearButton = true;

    protected mixed $filterCallback = null;

    public array $config = [];

    protected ?string $filterPillTitle = null;

    protected array $filterPillValues = [];

    public ?string $filterPosition = null;

    protected ?int $filterSlidedownRow = null;

    protected ?int $filterSlidedownColspan = null;

    protected ?string $filterCustomPillBlade = null;

    public array $genericDisplayData = [];
}
