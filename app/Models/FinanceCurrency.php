<?php

namespace App\Models;

use App\Actions\ConvertCurrency;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinanceCurrency extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'exchange_rates' => 'array',
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::updated(static function ($currency) {
            // TODO turn this operation into a queued one
            if ($currency->wasChanged('exchange_rates')) {
                FinanceAccount::all()->each(function ($account) {
                    $account->balance_in_try = (new ConvertCurrency)
                        ->convert($account->balance, $account->currency)
                        ->getAmount();
                    $account->save();
                });
            }
        });
    }
}
