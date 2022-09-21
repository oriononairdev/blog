<?php

namespace Database\Factories;

use App\Enums\AccountStatus;
use App\Enums\AccountType;
use App\Models\FinanceAccount;
use Brick\Money\Money;
use Illuminate\Database\Eloquent\Factories\Factory;

class FinanceAccountFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FinanceAccount::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $currencyCode = collect(['TRY', 'USD', 'EUR'])->random();

        return [
            'name' => $this->faker->unique()->word(),
            'status' => collect(AccountStatus::cases())->random(),
            'type' => collect(AccountType::cases())->random(),
            'balance' => Money::ofMinor($this->faker->numberBetween(100, 34567), $currencyCode)->getMinorAmount()->toInt(),
            'currency' => $currencyCode,
        ];
    }
}
