<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\InventoryCategory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inventory>
 */
class InventoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name" => fake() -> catchPhrase(),
            "desc" => fake() -> text(),
            "user_id" => 1,
            "picture" => "https://picsum.photos/200/300",
            "category_id" =>  rand(1, InventoryCategory::count()),
        ];
    }
}
