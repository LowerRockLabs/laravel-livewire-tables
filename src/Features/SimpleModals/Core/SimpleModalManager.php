<?php

namespace Rappasoft\LaravelLivewireTables\Features\SimpleModals\Core;

use Livewire\Component;
use Illuminate\Support\Facades\{Auth,Blade,Cache, Hash};
use Livewire\Attributes\{Locked, On}; 
use Livewire\Mechanisms\ComponentRegistry;
use Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException;
use Livewire\Exceptions\ComponentNotFoundException;
use Rappasoft\LaravelLivewireTables\Features\SimpleModals\Exceptions\{SimpleModalInvalidSubclassException,SimpleModalInvalidTableException};

class SimpleModalManager extends Component
{
    #[Locked] 
    public ?string $modalComponent = null;

    #[Locked] 
    public ?string $tableComponentId;

    #[Locked]
    public ?string $tableClassName;

    #[Locked] 
    public string $closeBehaviour = 'close';

    #[Locked] 
    public array $componentArguments = [];

    public bool $modalOpen = false;

    protected ?string $implodedAttributes;


    protected function checkForValidComponent(string $componentName): bool
    {
        $testComponent = app(ComponentRegistry::class)->getClass($componentName);        
        if(!is_subclass_of($testComponent, SimpleModalComponent::class))
        {
            throw new SimpleModalInvalidSubclassException('Component:"'.$componentName.'" is not a subclass of Rappasoft\LaravelLivewireTables\Features\SimpleModals\SimpleModalComponent');
        }
        return true;
    }

    protected function checkForValidTable(?string $tableComponentId = null): bool
    {
        if(isset($tableComponentId) && !is_null($tableComponentId))
        {
            if($tableComponentId != $this->tableComponentId)
            {
                throw new SimpleModalInvalidTableException("Invalid Table: ".$tableComponentId. ' does not match: '.$this->tableComponentId);
            }
        }
        return true;
    }

    #[On('simplemodalload')] 
    public function updateSimpleModalPath(string $modalComponent, array $arguments = [], ?string $tableComponentId = null)
    {
        try {
            if($this->checkForValidComponent($modalComponent) && $this->checkForValidTable($tableComponentId ?? (array_key_exists('tableComponentId', $arguments) ? $arguments['tableComponentId'] : null)))
            {
                $this->modalComponent = $modalComponent;
                $this->componentArguments = $arguments;
                $this->modalOpen = true;
            }


        }
        catch (ComponentNotFoundException $e)
        {
           throw new \Exception("SimpleModalComponent: '".$modalComponent."' Not Found"); 
        }
        catch (SimpleModalInvalidSubclassException $e)
        {
           throw new \Exception($e->getMessage()); 
        }
        catch (SimpleModalInvalidTableException $e)
        {
           return false;
        }

    }
    
    #[On('simplemodalreopen')] 
    public function reopenSimpleModal()
    {
        $this->modalOpen = true;
    }

    #[On('simplemodalclose')] 
    public function closeSimpleModal()
    {
        $this->modalOpen = false;
        if($this->closeBehaviour == 'reset')
        {
            $this->resetSimpleModal();
        }
    }

    #[On('simplemodalreset')] 
    public function resetSimpleModal()
    {
        $this->modalComponent = null;
        $this->implodedAttributes = '';
        $this->componentArguments = [];
    }

    /**
     * Implodes defined attributes to be used
     *
     * @param array<mixed> $attributes
     * @return string
     */
    protected function implodeAttributes(array $attributes): string
    {
        return collect($attributes)->map(function ($value, $key) {
            return ':'.$key.'="$'.$key.'"';
        })->implode(' ');
    }

    protected function getImplodedAttributes()
    {
        if(!isset($this->implodedAttributes) || is_null($this->implodedAttributes))
        {
            $this->implodedAttributes = $this->implodeAttributes($this->componentArguments);
        }
        return $this->implodedAttributes;
    }

    public function getComponentKey(): string
    {
        $implodedAttributes = $this->getImplodedAttributes();
        return Hash::make($this->modalComponent ?? 'unknown-component' .'-'.$implodedAttributes);
    }

    public function savingFromChildModal()
    {
        $this->closeSimpleModal();
        $this->dispatch('refreshDatatable')->to($this->tableClassName);
    }


    public function getLivewireString()
    {
        $implodedAttributes = $this->getImplodedAttributes();
        if(isset($this->modalComponent))
        {
        return Blade::render(
            '<livewire:dynamic-component @closingsaving="savingFromChildModal" :tableComponentId="$tableComponentId" :component="$component" :key="$key" '.$implodedAttributes.' />',
            [
                'tableComponentId' => $this->tableComponentId,
                'component' => $this->modalComponent,
                'key' => $this->getComponentKey(),
                ...$this->componentArguments,
            ],
        );

        }
        return Blade::render('<div></div>');


    }

    public function render(): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('livewire-tables::includes.simple-modals.simple-modal-manager');
    }

}