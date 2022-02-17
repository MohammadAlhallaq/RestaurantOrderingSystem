<?php

namespace Database\Factories;

use App\Enums\AccountStatus;
use App\Enums\ApprovalStatus;
use App\Models\Account;
use App\Models\Owner;
use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Account>
 */
class AccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'account_name' => $this->faker->company,
            'email' => $this->faker->email,
            'phone_number' => $this->faker->phoneNumber,
            'national_number' => $this->faker->numerify('### ### ####'),
            'password' => $this->faker->password,
            'package_id' => $this->faker->randomElement([1,2,3,4,5,6]),
            'account_type_id' => false,
            'status_id' => AccountStatus::INCOMPLETE,
            'work_status_id' => Owner::class,
            'logo_path' => 'image.png',
            'license_path' => 'license.pdf',
        ];
    }

    public function approved(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                $attributes['approved'] => ApprovalStatus::Approved,
            ];
        });
    }
}
