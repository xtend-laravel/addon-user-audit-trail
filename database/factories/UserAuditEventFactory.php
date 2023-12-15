<?php

namespace UserAuditTrail\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use XtendLunar\Addons\UserAuditTrail\Models\UserAuditEvent;

class UserAuditEventFactory extends Factory
{
    protected $model = UserAuditEvent::class;

    public function definition(): array
    {
        return [
            'event' => $this->faker->word,
            'route' => $this->faker->word,
            'data' => [
                'id' => $this->faker->randomNumber(),
                'name' => $this->faker->name,
            ],
            'exception' => [
                'message' => $this->faker->sentence,
                'code' => $this->faker->randomElement([500, 404, 403, 401]),
            ],
            'visits_nb' => $this->faker->randomNumber(100),
            'last_visited_at' => $this->faker->dateTime,
            'last_visit_duration' => $this->faker->randomNumber(),
        ];
    }
}
