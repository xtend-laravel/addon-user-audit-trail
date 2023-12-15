<?php

namespace UserAuditTrail\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use XtendLunar\Addons\UserAuditTrail\Models\UserAuditTrail;

class UserAuditTrailFactory extends Factory
{
    protected $model = UserAuditTrail::class;

    public function definition(): array
    {
        return [
            'ip_address' => $this->faker->ipv4,
            'country' => $this->faker->country,
            'device' => [
                'platform' => $this->faker->randomElement(['Windows', 'Mac', 'Linux']),
                'platform_version' => $this->faker->randomFloat(2, 1, 10),
                'browser' => $this->faker->randomElement(['Chrome', 'Firefox', 'Safari', 'Edge']),
                'browser_version' => $this->faker->randomFloat(2, 1, 10),
                'device' => $this->faker->randomElement(['iPhone', 'iPad', 'Android', 'Desktop']),
                'deviceType' => $this->faker->randomElement(['desktop', 'phone', 'tablet', 'other']),
            ],
            'location' => [
                'latitude' => $this->faker->latitude,
                'longitude' => $this->faker->longitude,
                'country' => $this->faker->country,
                'country_code' => $this->faker->countryCode,
                'region' => $this->faker->word,
                'region_name' => $this->faker->word,
                'city' => $this->faker->city,
                'zip' => $this->faker->postcode,
                'lat' => $this->faker->latitude,
                'lon' => $this->faker->longitude,
                'timezone' => $this->faker->timezone,
                'isp' => $this->faker->company,
            ],
        ];
    }
}
