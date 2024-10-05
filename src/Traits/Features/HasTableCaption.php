<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Features;

use Rappasoft\LaravelLivewireTables\Traits\Features\Configuration\TableCaptionConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Features\Helpers\TableCaptionHelpers;

trait HasTableCaption
{
    use TableCaptionConfiguration,
        TableCaptionHelpers;

    protected ?string $tableCaptionMessage;
}
