<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Core\Helpers;

trait ColumnCollapsingHelpers
{
    public function shouldCollapseOnMobile(): bool
    {
        return $this->collapseOnMobile;
    }

    public function shouldCollapseOnTablet(): bool
    {
        return $this->collapseOnTablet;
    }

    public function shouldCollapseAlways(): bool
    {
        return $this->collapseAlways;
    }
}
