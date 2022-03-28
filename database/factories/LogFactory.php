<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Log>
 */
class LogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $date = $this->faker->dateTimeBetween('-1 week', '+1 day');

        return [
            'params' => [
                'mobileMode' => $this->faker->boolean(),
                'toSearch' => [
                    'url' => $this->faker->url(),
                    'name' => $this->faker->company()
                ],
                'geolocation' => [
                    'display' => $this->faker->country(),
                    'language' => [
                        'lang' => $this->faker->languageCode(),
                        'accept-language' => $this->faker->countryCode()
                    ],
                    'timezone' => $this->faker->numberBetween(-7, 13),
                    'mobile' => [
                        'android' => $this->faker->numberBetween(0, 50),
                        'ios' => $this->faker->numberBetween(0, 50)
                    ],
                    'countryCode' => strtolower( $this->faker->countryCode() ),
                    'region' => 'all',
                    'city' => 'all'
                ],
            ],
            'position' => $this->faker->randomNumber(),
            'ended_at' => Carbon::parse($date),
            'ended_at_date' => date('Y/m/d', $date->getTimestamp())
        ];
    }
}
