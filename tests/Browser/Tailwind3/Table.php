<?php

namespace Rappasoft\LaravelLivewireTables\Tests\Browser\Tailwind3;

use Livewire\Component;

class Table extends Component
{
    public function render()
    {
        return <<<'HTML'
        <div dusk='component-view'>
            <livewire:pets-table />
        </div>
        HTML;
    }
}
