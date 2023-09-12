<?php

namespace Rappasoft\LaravelLivewireTables\DataTransferObjects;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Filter;

class FilterRenderData
{
    public DataTableComponent $component;

    public array $globalData = [];

    public function __construct(DataTableComponent $component)
    {
        $this->component = $component;

        $this->setupGlobalData();
    }

    protected function setupGlobalData()
    {
        $this->globalData = [
            'filterLayout' => $this->component->getFilterLayout(),
            'tableName' => $this->component->getTableName(),
            'isTailwind' => $this->component->isTailwind(),
            'isBootstrap' => $this->component->isBootstrap(),
            'isBootstrap4' => $this->component->isBootstrap4(),
            'isBootstrap5' => $this->component->isBootstrap5(),
            'filter' => null,
            'filter-key' => null,
            'filter-id' => null,
        ];
    }

    public function filterDataToArray(Filter $filter): array
    {
        $tempArray = $this->globalData;
        $tempArray['filter'] = $filter;

        return $tempArray;
    }

    public function toArray(): array
    {
        return $this->globalData;
    }
}
