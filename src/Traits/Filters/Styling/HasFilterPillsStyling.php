<?php

namespace Rappasoft\LaravelLivewireTables\Traits\Filters\Styling;

use Livewire\Attributes\{Computed, Locked};
use Rappasoft\LaravelLivewireTables\Traits\Filters\Styling\Configuration\FilterPillsStylingConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Filters\Styling\Helpers\FilterPillsStylingHelpers;
use Rappasoft\LaravelLivewireTables\Views\Filter;

trait HasFilterPillsStyling
{
    use FilterPillsStylingConfiguration,
        FilterPillsStylingHelpers;

    #[Locked]
    public bool $filterPillsStatus = true;

    protected array $filterPillsItemAttributes = ['default-styling' => true, 'default-colors' => true, 'class' => ''];

    protected array $filterPillsResetFilterButtonAttributes = ['default-styling' => true, 'default-colors' => true, 'class' => ''];

    protected array $filterPillsResetAllButtonAttributes = ['default-styling' => true, 'default-colors' => true, 'class' => ''];
}
