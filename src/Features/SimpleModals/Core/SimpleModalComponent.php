<?php

namespace Rappasoft\LaravelLivewireTables\Features\SimpleModals\Core;

use Livewire\Component;
use Illuminate\Support\Facades\{Auth,Cache, Hash};
use Rappasoft\LaravelLivewireTables\Features\SimpleModals\Core\SimpleModalManager;
use Livewire\Attributes\Locked; 

class SimpleModalComponent extends Component
{
    #[Locked]
    public ?string $tableComponentId = null;

    public function refreshParentTable()
    {
        $this->dispatch('closingsaving');
    }
}
