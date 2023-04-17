@aware(['component'])
@props(['row', 'rowIndex'])

@if ($component->collapsingColumnsAreEnabled() && $component->hasCollapsedColumns())
    @php
        $theme = $component->getTheme();
        $columns = collect([]);

        if ($component->shouldCollapseOnMobile() && $component->shouldCollapseOnTablet()) {
            $columns->push($component->getCollapsedMobileColumns());
            $columns->push($component->getCollapsedTabletColumns());
        } elseif ($component->shouldCollapseOnTablet() && ! $component->shouldCollapseOnMobile()) {
            $columns->push($component->getCollapsedTabletColumns());
        } elseif ($component->shouldCollapseOnMobile() && ! $component->shouldCollapseOnTablet()) {
            $columns->push($component->getCollapsedMobileColumns());
        }

        $columns = $columns->collapse();

        // TODO: Column count
        $colspan = $columns->count() + 1;
    @endphp

    @if ($theme === 'tailwind')
        <tr
            wire:key="row-{{ $row->{$component->getPrimaryKey()} }}-collapsed-contents"
            wire:loading.class.delay="opacity-50 dark:bg-gray-900 dark:opacity-60"
            x-data = "{ rowExpanded: visibleRows[{{ $row->{$component->getPrimaryKey()} }}] ?? false }"
            x-init="$watch('visibleRows[{{ $row->{$component->getPrimaryKey()} }}]', (value, oldValue) => rowExpanded = value); 
            $watch('isDesktop', (value, oldValue) => rowExpanded = value); 
            "
            :class="(!isDesktop && rowExpanded) ? 'pt-4 pb-2 px-4 bg-white dark:bg-gray-700 dark:text-white' : 'collapse pt-0 pb-0 px-0'"
        >
            <td :class="rowExpanded ? '' : 'hidden'" colspan="{{ $colspan }}">
                <div class="inline">
                    @foreach($columns as $colIndex => $column)
                        @continue($column->isHidden())
                        @continue($this->columnSelectIsEnabled() && ! $this->columnSelectIsEnabledForColumn($column))
                        
                        <p 
                        @class([
                            'block mb-2',
                            'sm:hidden' => $column->shouldCollapseOnMobile(),
                            'md:hidden' => $column->shouldCollapseOnTablet()
                            ])>
                            <strong>{{ $column->getTitle() }}</strong>: {{ $column->renderContents($row) }}
                        </p>
                    @endforeach
                </div>
            </td>
        </tr>
    @elseif ($theme === 'bootstrap-4' || $theme === 'bootstrap-5')
        <tr
            wire:key="row-{{ $row->{$component->getPrimaryKey()} }}-collapsed-contents"
            x-data = "{ rowExpanded: visibleRows[{{ $row->{$component->getPrimaryKey()} }}] ?? false }"
            x-init="$watch('visibleRows[{{ $row->{$component->getPrimaryKey()} }}]', (value, oldValue) => rowExpanded = value);"
            x-show="rowExpanded"
        >
            <td class="pt-3 p-2" colspan="{{ $colspan }}">
                <div>
                    @foreach($columns as $colIndex => $column)
                        @continue($column->isHidden())
                        @continue($this->columnSelectIsEnabled() && ! $this->columnSelectIsEnabledForColumn($column))
                        
                        <p class="d-block mb-2 @if($column->shouldCollapseOnMobile()) d-sm-none @endif @if($column->shouldCollapseOnTablet()) d-md-none @endif">
                            <strong>{{ $column->getTitle() }}</strong>: {{ $column->renderContents($row) }}
                        </p>
                    @endforeach
                </div>
            </td>
        </tr>
    @endif
@endif
