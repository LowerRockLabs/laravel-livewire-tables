<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns;

use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Views\Column;

class ManyColumn extends Column
{
    use \Rappasoft\LaravelLivewireTables\Views\Traits\IsColumn,
        \Rappasoft\LaravelLivewireTables\Views\Traits\Configuration\ManyColumnConfiguration,
        \Rappasoft\LaravelLivewireTables\Views\Traits\Helpers\ManyColumnHelpers,
        \Rappasoft\LaravelLivewireTables\Views\Traits\Columns\HasDefaultStringValue,
        \Rappasoft\LaravelLivewireTables\Views\Traits\Core\HasCallback;

    protected string $view = 'livewire-tables::includes.columns.many';

    protected string $separator = '<br />';

    protected string $relation = '';

    protected string $relatedValue = '';

    protected ?Closure $valueCallback = null;

    public function __construct(string $title, ?string $from = null)
    {
        parent::__construct($title, $from);
        $this->label(fn () => null);
    }
}
