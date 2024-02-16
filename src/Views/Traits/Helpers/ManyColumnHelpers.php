<?php

namespace Rappasoft\LaravelLivewireTables\Views\Traits\Helpers;

use Closure;

trait ManyColumnHelpers
{
    public function getSuccessValue(): bool
    {
        return $this->successValue;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getValue(Model $row): HtmlString
    {
        return new HtmlString(implode($this->separator, $row->{$this->relation}->pluck($this->relatedValue)->toArray()));
    }

    public function getContents(Model $row): null|string|\Illuminate\Support\HtmlString|DataTableConfigurationException|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $value = $this->getValue($row);

        return view($this->getView())
            ->withValue($value)
            ->withIsTailwind($this->getComponent()->isTailwind())
            ->withIsBootstrap($this->getComponent()->isBootstrap())
            ->withComponent($this->getComponent());
    }
}
