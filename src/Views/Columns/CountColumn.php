<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns;

use Rappasoft\LaravelLivewireTables\Views\Column;

class CountColumn extends Column
{
    use \Rappasoft\LaravelLivewireTables\Views\Traits\IsColumn;

    protected string $view = 'livewire-tables::includes.columns.count';

    public function __construct(string $title, ?string $from = null)
    {
        parent::__construct($title, $from);
        $this->label(function ($row, Column $column) use ($from) { return $row->{$from.'_count'};} );
        $this->sortable(
            fn($query, string $direction) => $query->orderBy($from.'_count', $direction)
        );
        $this->countField = $from;
        $this->countColumn = true;
    }
}
