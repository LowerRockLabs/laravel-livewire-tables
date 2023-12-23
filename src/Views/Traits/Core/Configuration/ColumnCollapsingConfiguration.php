<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Core\Configuration;

trait ColumnCollapsingConfiguration
{
    /**
     * @return $this
     */
    public function collapseOnMobile(): self
    {
        $this->collapseOnMobile = true;

        return $this;
    }

    /**
     * @return $this
     */
    public function collapseOnTablet(): self
    {
        $this->collapseOnTablet = true;

        return $this;
    }

    /**
     * @return $this
     */
    public function collapseAlways(): self
    {
        $this->collapseAlways = true;

        return $this;
    }
}