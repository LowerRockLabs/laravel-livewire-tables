<?php

namespace Tests\Browser\Feature;

use Laravel\Dusk\Browser;
use Tests\Browser\DuskTestCase;

class Tailwind3Test extends DuskTestCase
{
    /**
     * All Filters Load
     */
    public function testCorrectThemeDisplays(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/tailwind');
            $browser->assertSee('Tailwind 2 Implementation');
            $browser->assertDontSee('Tailwind 3 Implementation');
            $browser->assertDontSee('Bootstrap 4 Implementation');
            $browser->assertDontSee('Bootstrap 5 Implementation');
        });
    }
}
