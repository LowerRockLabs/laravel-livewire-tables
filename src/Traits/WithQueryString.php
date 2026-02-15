<?php

namespace Rappasoft\LaravelLivewireTables\Traits;

use Livewire\Attributes\Locked;
use Rappasoft\LaravelLivewireTables\Traits\Configuration\QueryStringConfiguration;
use Rappasoft\LaravelLivewireTables\Traits\Helpers\QueryStringHelpers;

trait WithQueryString
{
    use QueryStringConfiguration,
        QueryStringHelpers;

    
    /**
     * Undocumented variable
     *
     * @var array<mixed>
     */
    #[Locked]
    public array $queryStringConfig = [
        'columns' => ['status' => false, 'alias' => null],
        'filters' => ['status' => false, 'alias' => null],
        'pagination' => ['status' => false, 'alias' => null],
        'search' => ['status' => false, 'alias' => null],
        'sorts' => ['status' => false, 'alias' => null],
    ];

    #[Locked]
    public bool $queryStringStatus = false;

    #[Locked]
    public ?string $queryStringAlias = null;

    public function bootWithQueryString(): void
    {
        $this->queryStringAlias = $this->getTableName();
    }
    /**
     * Set the custom query string array for this specific table
     *
     * @return array<mixed>
     */
    protected function queryStringWithQueryString(): array
    {

        if ($this->queryStringIsEnabled()) {
            return [
                'table' => ['except' => null, 'history' => false, 'keep' => false, 'as' => $this->getQueryStringAlias()],
            ];
        }

        return [];
    }
}
