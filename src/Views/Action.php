<?php

namespace Rappasoft\LaravelLivewireTables\Views;

use Rappasoft\LaravelLivewireTables\Views\Traits\Core\{HasAttributes,HasWireElement};

class Action
{
    use HasWireElement;
    use HasAttributes;

    public string $label;

    public string $icon = '';

    public string $route = '#';

    protected bool $hidden = false;

    public function __construct(?string $label = null)
    {
        $this->label = trim(__($label));
    }

    public static function make(?string $label = null): self
    {
        return new static($label);
    }

    public function route($route): self
    {
        $this->route = $route;
        $this->attributes['href'] = $route;

        return $this;
    }

    public function icon($icon): self
    {
        $this->icon = $icon;

        return $this;
    }

    public function hasIcon(): bool
    {
        return $this->icon !== '';
    }

    public function hasClass(): bool
    {
        return isset($this->attributes['class']) && $this->attributes['class'] !== '';
    }

    public function primary($outline = false): self
    {
        $outlineClass = $outline ? 'outline-' : '';

        $this->attributes['class'] .= "btn btn-{$outlineClass}primary btn-sm";

        return $this;
    }

    public function success($outline): self
    {
        $outlineClass = $outline ? 'outline' : '';

        $this->attributes['class'] .= "btn btn-{$outlineClass}success btn-sm";

        return $this;
    }

    public function hideIf($condition): self
    {
        $this->hidden = $condition;

        return $this;
    }

    public function isVisible(): bool
    {
        return $this->hidden !== true;
    }

    public function isHidden(): bool
    {
        return $this->hidden === true;
    }
}
