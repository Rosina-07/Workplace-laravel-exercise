<?php

namespace Database\Factories;

use App\Models\Certification;
use App\Models\Contract;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\DatabaseMigrations;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    use DatabaseMigrations;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'age' => rand(18, 60),
            'start_date' => $this->faker->date(),
            'contract_id' => Contract::factory()
        ];
    }
}
