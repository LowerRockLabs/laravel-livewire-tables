@aware(['isTailwind','isBootstrap'])

<div {{
    $attributes->merge($this->getToolsAttributes())
        ->class([
            'flex-col' => $isTailwind && ($this->getToolsAttributes()['default-styling'] ?? true),
            'd-flex flex-column' => $isBootstrap && ($this->getToolsAttributes()['default-styling'] ?? true)
        ])
        ->except(['default','default-styling','default-colors'])
    }}
>
    @if ($this->showSortPillsSection())
        <x-livewire-tables::tools.sorting-pills />
    @endif
    @if($this->showFilterPillsSection())
        <x-livewire-tables::tools.filter-pills />
    @endif

    @includeWhen(
        $this->hasConfigurableAreaFor('before-toolbar'),
        $this->getConfigurableAreaFor('before-toolbar'),
        $this->getParametersForConfigurableArea('before-toolbar')
    )

    @if($this->shouldShowToolBar())
        <x-livewire-tables::tools.toolbar />
    @endif

    @if ($this->showFilterLayoutSlideDown())
        <x-livewire-tables::tools.toolbar.items.filter-slidedown  />
    @endif

    @includeWhen(
        $this->hasConfigurableAreaFor('after-toolbar'),
        $this->getConfigurableAreaFor('after-toolbar'),
        $this->getParametersForConfigurableArea('after-toolbar')
    )

</div>
