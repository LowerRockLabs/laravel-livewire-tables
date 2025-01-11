<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Core\Filters;

use Rappasoft\LaravelLivewireTables\Traits\Core\QueryStrings\HasQueryStringForFilter;

trait HandlesFilterTraits
{
    use ManagesFilters,
        HasFilterGenericData,
        HasFilterMenuStyling,
        HasFilterPillsStyling,
        HasQueryStringForFilter,
        HasFiltersStatus,
        HasFiltersVisibility;
}
