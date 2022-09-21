<?php

namespace Database\Seeders;

use App\Models\FinanceCurrency;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FinanceCurrency::create([
            'code' => 'TRY',
            'name' => 'Turkish Lira',
            'symbol' => '₺',
            'exchange_rates' => [
                'TRY' => 1,
                'USD' => 13.51,
                'EUR' => 15.44,
            ],
        ]);
        FinanceCurrency::create([
            'code' => 'USD',
            'name' => 'United States Dollar',
            'symbol' => '$',
            'exchange_rates' => [
                'TRY' => 13.51,
                'USD' => 1,
                'EUR' => 0.88,
            ],
        ]);
        FinanceCurrency::create([
            'code' => 'EUR',
            'name' => 'Euro',
            'symbol' => '€',
            'exchange_rates' => [
                'TRY' => 15.44,
                'USD' => 1.14,
                'EUR' => 1,
            ],
        ]);
    }
}
