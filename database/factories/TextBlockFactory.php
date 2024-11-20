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
            'text' => $this->faker->sentence(),
            'font_family' => $this->faker->randomElement(['Roboto', 'Lobster', 'Arial']),
            'font_color' => $this->faker->hexColor(),
            'font_size' => $this->faker->numberBetween(12, 24),
            'alignment' => $this->faker->randomElement(['left', 'center', 'right']),
        ];
    }
}
