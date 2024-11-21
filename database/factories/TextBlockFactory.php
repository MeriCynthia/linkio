<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\MyLink;

class TextBlockFactory extends Factory
{
    protected $model = \App\Models\TextBlock::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'mylink_id' => MyLink::factory(), // Relasi ke MyLink
            'title' => $this->faker->sentence(),
            'font' => $this->faker->randomElement(['Arial', 'Roboto', 'Lobster']),
            'alignment' => $this->faker->randomElement(['left', 'center', 'right']),
            'bold' => $this->faker->boolean(),
            'italic' => $this->faker->boolean(),
            'color' => $this->faker->hexColor(),
        ];
    }
}
