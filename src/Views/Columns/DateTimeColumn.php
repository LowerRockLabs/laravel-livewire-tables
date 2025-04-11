<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns;

use Rappasoft\LaravelLivewireTables\Views\Columns\Traits\Configuration\DateColumnConfiguration;
use Rappasoft\LaravelLivewireTables\Views\Columns\Traits\{HasInputOutputFormat, IsColumn};
use Rappasoft\LaravelLivewireTables\Views\Columns\Traits\Helpers\DateColumnHelpers;

class DateTimeColumn extends DateColumn
{
    use IsColumn,
        HasInputOutputFormat,
        DateColumnConfiguration,
        DateColumnHelpers { DateColumnHelpers::getValue insteadof IsColumn; }

    public string $inputFormat = 'Y-m-d H:i:s';

    public string $outputFormat = 'Y-m-d H:i:s';

    public string $emptyValue = '';

    protected string $view = 'livewire-tables::includes.columns.date';

}
