<?php

namespace Tests\Feature;

use App\Models\Certification;
use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class EmployeeTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_get_employee_success(): void
    {
        Employee::factory()->has(Certification::factory())->create();

        $response = $this->getJson('/api/employees');

        $response->assertStatus(200)
            ->assertJson(function (AssertableJson $json) {
                $json->hasAll(['message', 'data'])
                        ->whereType('message', 'string')
                    ->has('data', 1, function (AssertableJson $json) {
                        $json->hasAll(['id', 'name', 'age', 'contract', 'certifications'])
                            ->whereAllType([
                                'id' => 'integer',
                                'name' => 'string',
                                'age' => 'integer'
                            ])
                            ->has('contract', function (AssertableJson $json) {
                                $json->has('name')
                                    ->whereType('name', 'string');
                            })
                            ->has('certifications', 1, function (AssertableJson $json) {
                                $json->hasAll(['id', 'name', 'description'])
                                    ->whereAllType([
                                        'id' => 'integer',
                                        'name' => 'string',
                                        'description' => 'string'
                                ]);
                        });
                    });
            });
    }
}
