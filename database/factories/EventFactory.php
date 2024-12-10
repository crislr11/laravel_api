<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category; // Asegúrate de que esta línea sea correcta
use App\Models\User;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $start = $this->faker->dateTimeBetween('now', '2044-12-31');
        $end = $this->faker->dateTimeBetween($start, '2044-12-31');

        return [
            'organizer_id' => 2, 
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'category_id' => Category::inRandomOrder()->first()->id,
            'start_time' => $start,
            'end_time' => $end,
            'location' => $this->faker->address,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'max_attendees' => $this->faker->numberBetween(10, 100),
            'price' => $this->faker->randomFloat(2, 10, 100),
            'image_url' => 'storage\images\interrogante.jpg',
            'deleted' => 0,
        ];
    }

    public function user()
{
    return $this->belongsTo(User::class);
}
}
