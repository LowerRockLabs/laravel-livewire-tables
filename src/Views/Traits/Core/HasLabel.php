<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Core;

use Rappasoft\LaravelLivewireTables\Views\Traits\Core\Configuration\LabelConfiguration;
use Rappasoft\LaravelLivewireTables\Views\Traits\Core\Helpers\LabelHelpers;

/**
 * Not to be confused with label() columns
 */
trait HasLabel
{
    use LabelConfiguration, 
    LabelHelpers;

    protected ?string $customLabel = null;

    protected array $customLabelAttributes = [];

    protected ?string $filterCustomLabel = null;

    protected array $filterLabelAttributes = [];

}