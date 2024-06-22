<?php

namespace Rappasoft\LaravelLivewireTables\Views\Columns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;
use Illuminate\View\ComponentAttributeBag;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Traits\Configuration\ViewComponentColumnConfiguration;
use Rappasoft\LaravelLivewireTables\Views\Traits\Helpers\ViewComponentColumnHelpers;

class ViewComponentColumn extends Column
{
    use ViewComponentColumnConfiguration,
        ViewComponentColumnHelpers;

    protected mixed $slotCallback = null;

    public string $componentReference;

    public function __construct(string $title, ?string $from = null)
    {
        parent::__construct($title, $from);
    }

    public function getContents(Model $row): null|string|HtmlString|DataTableConfigurationException|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        if ($this->isLabel()) {
            throw new DataTableConfigurationException('You can not use a label column with a component column');
        }

        if (! $this->hasComponentReference()) {
            throw new DataTableConfigurationException('You must setComponentReference when using a View Component Column');
        }

        $attributes = [];
        $value = $this->getValue($row);
        $slotContent = $value;

        if ($this->hasAttributesCallback()) {
            $attributes = call_user_func($this->getAttributesCallback(), $value, $row, $this);

            if (! is_array($attributes)) {
                throw new DataTableConfigurationException('The return type of callback must be an array');
            }
        }
        if ($this->hasSlotCallback()) {
            $slotContent = call_user_func($this->getSlotCallback(), $value, $row, $this);
            if (is_string($slotContent)) {
                $slotContent = new HtmlString($slotContent);
            }
        }
        $viewComponent = new ($this->getComponentReference())($attributes);

        return $viewComponent->render();

    }
}
