<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Filters;

use Rappasoft\LaravelLivewireTables\Traits\Filters\Styling\{HasFilterMenuStyling,HasFilterPillsStyling};
use Rappasoft\LaravelLivewireTables\Traits\Filters\Configuration\FilterConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Filters\Helpers\FilterHelpers;

trait HandlesFilterTraits
{
    use FilterConfiguration,
        FilterHelpers,
        ManagesFilters,
        HasFilterGenericData,
        HasFilterMenuStyling,
        HasFilterPillsStyling,
        HasFilterQueryString,
        HasFiltersStatus,
        HasFiltersVisibility;
}
