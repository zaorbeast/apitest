<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use phpDocumentor\Reflection\Types\This;

class reportHouseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'idUser'=>$this->faker->text(10),
            'Message'=>$this->faker->text(500),
            'idhouse'=>$this->faker->text(10),
            'state'=>$this->faker->text(1)
        ];
    }
}
