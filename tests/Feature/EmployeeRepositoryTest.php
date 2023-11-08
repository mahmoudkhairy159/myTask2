<?php

namespace Tests\Feature;

use App\Repositories\EmployeeRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class EmployeeRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    protected $employeeRepository;

    public function setUp(): void
    {
        parent::setUp();
        $this->employeeRepository = new EmployeeRepository();
    }

    public function testGetAllReturnsCollection()
    {

        $employees = $this->employeeRepository->getAll();

        $this->assertInstanceOf(\Illuminate\Support\Collection::class, $employees);

    }
}
