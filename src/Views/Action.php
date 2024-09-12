<?php

namespace Rappasoft\LaravelLivewireTables\Views;

use Illuminate\View\Component;
use Illuminate\View\ComponentAttributeBag;
use Rappasoft\LaravelLivewireTables\Views\Traits\Actions\{HasActionAttributes, HasRoute};
use Rappasoft\LaravelLivewireTables\Views\Traits\Columns\HasVisibility;
use Rappasoft\LaravelLivewireTables\Views\Traits\Core\{HasIcon, HasLabel, HasLabelAttributes, HasTheme, HasView, HasWireActions};
class Action extends Component
{
    use HasActionAttributes,
        HasIcon,
        HasLabel,
        HasLabelAttributes,
        HasRoute,
        HasTheme,
        HasView,
        HasVisibility,
        HasWireActions;

    protected string $view = 'livewire-tables::includes.actions.button';

    public function __construct(?string $label = null)
    {
        $this->label = trim(__($label));
    }

    public static function make(?string $label = null): self
    {
        return new static($label);
    }

    public function render(): null|string|\Illuminate\Support\HtmlString|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $view = view($this->getView())
            ->withAction($this)
            ->withIsBootstrap($this->isBootstrap())
            ->withIsTailwind($this->isTailwind())
            ->withAttributes($this->getActionAttributes());

        return $view;
    }
}
