@aware(['isTailwind', 'isBootstrap','hasCollapsingColumns','shouldCollapseAlways','shouldCollapseOnTablet','shouldCollapseOnMobile'])
@if ($hasCollapsingColumns)
    <th scope="col" :class="{ 'laravel-livewire-tables-reorderingMinimised': ! currentlyReorderingStatus }" {{
        $attributes->merge()
            ->class($isTailwind ? [
                'table-cell dark:bg-gray-800 laravel-livewire-tables-reorderingMinimised',
                'sm:hidden' => !$shouldCollapseOnTablet && !shouldCollapseAlways,
                'md:hidden' => !$shouldCollapseOnMobile && !$shouldCollapseOnTablet && !$shouldCollapseAlways,
                'lg:hidden' =>  !$shouldCollapseAlways,
            ] : [
                'd-table-cell laravel-livewire-tables-reorderingMinimised',
                'd-sm-none' => !$shouldCollapseOnTablet && !$shouldCollapseAlways,
                'd-md-none' => !$shouldCollapseOnMobile && !$shouldCollapseOnTablet && !$shouldCollapseAlways,
                'd-lg-none' => !$shouldCollapseAlways,
            ])
        }}></th>
@endif
