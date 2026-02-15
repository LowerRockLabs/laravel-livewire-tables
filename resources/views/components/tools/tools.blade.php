@aware(['isTailwind','isTailwind4', 'isBootstrap','dataTableFingerprint', 'appliedFilters'])

@php($filterMenuResetButtonAttributes = $this->getFilterMenuResetButtonAttributes())
@php($toolsAttributes = $this->getToolsAttributes())

<div {{
    $attributes->merge($toolsAttributes)->merge(['x-data' => 'tools($wire)'])
        ->class(['table-toolbar-section'])
        ->class($isTailwind ? [
            'flex-col' => ($toolsAttributes['default-styling'] ?? true),
        ] : [])
        ->class($isTailwind ? [
            'flex-col' => ($toolsAttributes['default-styling'] ?? true),
        ] : [])
        ->class($isBootstrap ? [
            'd-flex flex-column' => ($toolsAttributes['default-styling'] ?? true),
        ] : [])
        ->except(['default','default-styling','default-colors'])
    }}
>


    @if(method_exists($this, 'showSortPillsSection') ? $this->showSortPillsSection() : false)
        <x-livewire-tables::tools.sorting-pills />
    @endif

    @if(method_exists($this, 'showFilterPillsSection') ? $this->showFilterPillsSection() : false)
        <x-livewire-tables::tools.filter-pills />
    @endif

    @includeWhen(!$this->showActionsInToolbar(), 'livewire-tables::includes.toolbar.items.actions', $this->getToolbarActionAttributes())


    @includeWhen(
        $this->hasConfigurableAreaFor('before-toolbar'),
        $this->getConfigurableAreaFor('before-toolbar'),
        $this->getParametersForConfigurableArea('before-toolbar')
    )

    @if($this->shouldShowToolBar())
        <x-livewire-tables::tools.toolbar :$filterMenuResetButtonAttributes />
    @endif

    @if ($this->shouldShowToolsFilterSlidedown())
        <x-livewire-tables::tools.toolbar.items.filter-slidedown  />
    @endif
    
    @includeWhen(
        $this->hasConfigurableAreaFor('after-toolbar'),
        $this->getConfigurableAreaFor('after-toolbar'),
        $this->getParametersForConfigurableArea('after-toolbar')
    )

</div>

