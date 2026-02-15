<?php

namespace Rappasoft\LaravelLivewireTables\Features\SimpleModals\Views;

use Illuminate\Database\Eloquent\Model;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Rappasoft\LaravelLivewireTables\Features\Columns\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Traits\Core\{HasActionCallback,HasArgumentsCallback,HasConfirmation, HasTitleCallback, HasTitleStatic};

class SimpleModalLinkColumn extends Column
{
    use HasArgumentsCallback,
        HasTitleCallback,
        HasTitleStatic,
        HasConfirmation;

    protected string $view = 'livewire-tables::includes.columns.simple-modal-link';

    protected ?string $modalComponentName;

    public function __construct(string $title, ?string $from = null)
    {
        parent::__construct($title, $from);

        $this->label(fn () => null);
    }

    public function setModalComponentName(string $modalComponentName): self
    {
        $this->modalComponentName = $modalComponentName;
        return $this;
    }
    
    public function getModalComponentName(): string
    {
        return $this->modalComponentName;
    }

    public function hasModalComponentName(): bool
    {
        return isset($this->modalComponentName) && !is_null($this->modalComponentName);
    }

    public function modalName(string $modalComponentName): self
    {
        return $this->setModalComponentName($modalComponentName);
    }

    public function modalArguments(callable $callback): self
    {
       return  $this->arguments($callback);
    }



    public function getContents(Model $row): null|string|\Illuminate\Support\HtmlString|DataTableConfigurationException|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        if (! $this->hasModalComponentName()) {
            throw new DataTableConfigurationException('You must specify a valid SimpleModalComponent for a SimpleModalLink column.');
        }

        if (! $this->hasTitleCallback() && ! $this->hasTitleStatic()) {
            throw new DataTableConfigurationException('You must specify a title callback or title static for a SimpleModalLink column.');
        }

        if (! $this->hasArgumentsCallback()) {
            throw new DataTableConfigurationException('You must specify an argument callback for a SimpleModalLink column.');
        }

        return $this->getColumnViewWithDefaults()
            ->withColumn($this)
            ->withTitle($this->hasTitleCallback() ? app()->call($this->getTitleCallback(), ['row' => $row]) : $this->getTitleStatic())
            ->withModalComponentName($this->getModalComponentName())
            ->withArguments(json_encode(app()->call($this->getArgumentsCallback(), ['row' => $row])))
            ->withAttributes($this->arrayToAttributes(array_merge($this->getConfirmMessageAttribute(), $this->hasAttributesCallback() ? app()->call($this->getAttributesCallback(), ['row' => $row]) : [])));

    }
}
