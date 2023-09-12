<?php

namespace Rappasoft\LaravelLivewireTables\Tests\DataTransferObjects;

use Rappasoft\LaravelLivewireTables\Tests\TestCase;

class DebuggableDataTest extends TestCase
{
    /** @test */
    public function can_create_debuggable_data_dto(): void
    {
        $nonDTO = [
            'query' => (clone $this->basicTable->getBuilder())->toSql(),
            'filters' => $this->basicTable->getAppliedFilters(),
            'sorts' => $this->basicTable->getSorts(),
            'search' => $this->basicTable->getSearch(),
            'select-all' => $this->basicTable->getSelectAllStatus(),
            'selected' => $this->basicTable->getSelected(),
        ];

        $dto = ((new \Rappasoft\LaravelLivewireTables\DataTransferObjects\DebuggableData($this->basicTable))->toArray());
        $this->assertSame($nonDTO, $dto);
    }
}
