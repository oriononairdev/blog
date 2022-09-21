<?php

namespace Database\Factories;

use App\Enums\TransactionType;
use App\Models\FinanceTransaction;
use Brick\Money\Money;
use Illuminate\Database\Eloquent\Factories\Factory;

class FinanceTransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FinanceTransaction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type' => TransactionType::EXPENSE,
            'amount' => Money::ofMinor($this->faker->numberBetween(100, 34567), collect(['TRY', 'USD', 'EUR'])->random())->getMinorAmount()->toInt(),
            'description' => $this->faker->paragraphs(2, true),
            'category_id' => $this->faker->randomDigitNotZero(),
            'account_id' => $this->faker->randomDigitNotZero(),
            'date' => $this->faker->dateTimeThisDecade(),
        ];
    }

    /**
     * Indicate that the model's type should be income.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function income()
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => TransactionType::INCOME,
            ];
        });
    }
}
