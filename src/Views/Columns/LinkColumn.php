<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns;

use Illuminate\Database\Eloquent\Model;
use Rappasoft\LaravelLivewireTables\Exceptions\{DataTableConfigurationException,NoLocationException, NoTitleException};
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Traits\Configuration\LinkColumnConfiguration;
use Rappasoft\LaravelLivewireTables\Views\Traits\Core\HasAttributes;
use Rappasoft\LaravelLivewireTables\Views\Traits\Core\HasLocation;
use Rappasoft\LaravelLivewireTables\Views\Traits\Core\HasView;
use Rappasoft\LaravelLivewireTables\Views\Traits\Helpers\LinkColumnHelpers;

class LinkColumn extends Column
{
    use LinkColumnConfiguration,
        LinkColumnHelpers,
        HasAttributes,
        HasLocation,
        HasView;

    protected string $view = 'livewire-tables::includes.columns.link';

    protected mixed $titleCallback = null;

    public function __construct(string $title, ?string $from = null)
    {
        parent::__construct($title, $from);

        $this->label(fn () => null);
    }

    public function getContents(Model $row): null|string|\Illuminate\Support\HtmlString|DataTableConfigurationException|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        if (! $this->hasTitleCallback()) {
            throw new NoTitleException('You must specify a title callback for an link column.');
        }

        if (! $this->hasLocationCallback()) {
            throw new NoLocationException('You must specify a location callback for an link column.');
        }

        return view($this->getView())
            ->withColumn($this)
            ->withTitle(app()->call($this->getTitleCallback(), ['row' => $row]))
            ->withPath(app()->call($this->getLocationCallback(), ['row' => $row]))
            ->withAttributes($this->hasAttributesCallback() ? app()->call($this->getAttributesCallback(), ['row' => $row]) : []);
    }
}
