<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MyLinkFactory extends Factory
{
    protected $model = \App\Models\MyLink::class;

    public function definition()
    {
        return [
            'user_id' => 1, // Pastikan ada user_id di database
            'total_views' => $this->faker->numberBetween(0, 100),
            'total_clicks' => $this->faker->numberBetween(0, 50),
        ];
    }
}
