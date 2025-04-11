<div>

    <div x-data="{ currentlyReorderingStatus: false }">
        <div {{ $this->getTopLevelAttributes() }}>

            @includeWhen(
                $this->hasConfigurableAreaFor('before-wrapper'),
                $this->getConfigurableAreaFor('before-wrapper'),
                $this->getParametersForConfigurableArea('before-wrapper')
            )

            <x-livewire-tables::wrapper 
            :tableName="$tableName"
            :primaryKey="$primaryKey"
            :isTailwind="$this->isTailwind()" 
            :isBootstrap="$this->isBootstrap()"
            :isBootstrap4="$this->isBootstrap4()" 
            :isBootstrap5="$this->isBootstrap5()" 
            :localisationPath="$this->getLocalisationPath()" 
            :collapsingColumnDetails="$this->getCollapsedColumnsForContentNew()" 
            :bulkActionsTdAttributes="$this->getBulkActionsTdAttributes()" 
            :bulkActionsTdCheckboxAttributes="$this->getBulkActionsTdCheckboxAttributes()" 
            :collapsingColumnButtonExpandAttributes="$this->getCollapsingColumnButtonExpandAttributes()" 
            :collapsingColumnButtonCollapseAttributes="$this->getCollapsingColumnButtonCollapseAttributes()" 
            :hasCollapsingColumns="($this->collapsingColumnsAreEnabled() && $this->hasCollapsedColumns())" 
            :shouldCollapseAlways="$this->shouldCollapseAlways()" 
            :shouldCollapseOnTablet="$this->shouldCollapseOnTablet()" 
            :shouldCollapseOnMobile="$this->shouldCollapseOnMobile()" 
            :currentlyReorderingStatus="$this->getCurrentlyReorderingStatus()" 
            :showBulkActionsSections="$this->showBulkActionsSections()" 
            :coreTableAttributes="$this->getCoreTableAttributes()" 
            :showCollapsingColumnSections="$this->showCollapsingColumnSections()" 
            :selectedVisibleColumns="$this->selectedVisibleColumns()" 
            :hasDisplayLoadingPlaceholder="$this->hasDisplayLoadingPlaceholder()" 
            :hasTableRowUrl="$this->hasTableRowUrl()" 
            :colspanCount="$this->getColspanCount()" 
            :columnCollapseInfo="$this->getCollapsedColumnsForContentAll()"
            >
                @if($this->hasActions() && !$this->showActionsInToolbar())
                    <x-livewire-tables::includes.actions/>
                @endif

                @includeWhen(
                    $this->hasConfigurableAreaFor('before-tools'),
                    $this->getConfigurableAreaFor('before-tools'),
                    $this->getParametersForConfigurableArea('before-tools')
                )

                @if($this->shouldShowTools())
                    <x-livewire-tables::tools />
                @endif

                @includeWhen(
                    $this->hasConfigurableAreaFor('after-tools'),
                    $this->getConfigurableAreaFor('after-tools'),
                    $this->getParametersForConfigurableArea('after-tools')
                )

                <x-livewire-tables::table >
                    <x-slot name="thead">
                        <x-livewire-tables::table.thead />
                    </x-slot>

                    @if($this->shouldShowSecondaryHeader() && !$this->getCurrentlyReorderingStatus())
                        <x-livewire-tables::table.tr.secondary-header :filterGenericData="$this->getFilterGenericData()" />
                    @endif

                    @if($this->hasDisplayLoadingPlaceholder())
                        <x-livewire-tables::includes.loading colCount="{{ $this->columns->count()+1 }}" />
                    @endif

                    @if($this->showBulkActionsSections() && !$this->getCurrentlyReorderingStatus())
                        <x-livewire-tables::table.tr.bulk-actions  :displayMinimisedOnReorder="true" />
                    @endif
                    @if(count($currentRows = $this->getRows) > 0)

                        @tableloop ($currentRows as $rowIndex => $row)
                                @php($rowPk = $row->{$primaryKey})
                                <x-livewire-tables::table.tbody wire:key="{{ $tableName }}-row-wrap-{{ $rowPk }}" :$row :$rowIndex :$rowPk :customAttributes="$this->getTrAttributes($row, $rowIndex)" />

                        @endtableloop

                    @else
                        <x-livewire-tables::table.empty />
                    @endif
                    

                    @if ($this->shouldShowFooter())
                        <x-livewire-tables::table.tfoot />
                    @endif
                </x-livewire-tables::table>

                <x-livewire-tables::pagination :$currentRows />

                @includeIf($customView)
            </x-livewire-tables::wrapper>

            @includeWhen(
                $this->hasConfigurableAreaFor('after-wrapper'),
                $this->getConfigurableAreaFor('after-wrapper'),
                $this->getParametersForConfigurableArea('after-wrapper')
            )

        </div>
    </div>
</div>
