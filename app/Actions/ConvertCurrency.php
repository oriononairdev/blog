<?php

namespace App\Actions;

use App\Models\FinanceCurrency;
use Money\Converter;
use Money\Currencies\ISOCurrencies;
use Money\Currency;
use Money\Exchange\FixedExchange;
use Money\Money;

class ConvertCurrency
{
    public array $exchange_rates = [];

    public function __construct()
    {
        $this->exchange_rates = [
            'EUR' => [
                'TRY' => (string) FinanceCurrency::firstWhere('code', 'EUR')->exchange_rates['TRY'],
            ],
            'USD' => [
                'TRY' => (string) FinanceCurrency::firstWhere('code', 'USD')->exchange_rates['TRY'],
            ],
            'TRY' => [
                'TRY' => "1",
            ],
        ];
    }

    /**
     * Convert money to given currency.
     *
     * @param  Money|int  $amount
     * @param  string  $from
     * @param  string  $to
     * @return Money
     */
    public function convert(Money|int $amount, string $from = 'USD', string $to = 'TRY'): Money
    {
        if (is_int($amount)) {
            $amount = (new Money($amount, new Currency($from)));
        }

        $exchange = new FixedExchange($this->exchange_rates);

        return (new Converter(new ISOCurrencies(), $exchange))
            ->convert($amount, new Currency($to));
    }
}
