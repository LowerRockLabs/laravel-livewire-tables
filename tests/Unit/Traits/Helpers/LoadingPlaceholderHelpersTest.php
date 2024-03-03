<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Unit\Traits\Helpers;

use Rappasoft\LaravelLivewireTables\Tests\Unit\TestCase;

class LoadingPlaceholderHelpersTest extends TestCase
{
    /** @test */
    public function can_get_loading_placeholder_status(): void
    {
        $this->assertFalse($this->basicTable->hasDisplayLoadingPlaceholder());

        $this->basicTable->setLoadingPlaceholderEnabled();

        $this->assertTrue($this->basicTable->getDisplayLoadingPlaceholder());

        $this->assertTrue($this->basicTable->hasDisplayLoadingPlaceholder());

    }
}
