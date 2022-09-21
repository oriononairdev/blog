<?php

namespace App\Models;

use App\Actions\ConvertCurrency;
use App\Enums\AccountStatus;
use App\Enums\AccountType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//use Brick\Money\Money;

class FinanceAccount extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    protected $casts = [
        'type' => AccountType::class,
        'status' => AccountStatus::class,
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::saving(static function ($account) {
            if ($account->isDirty('balance')) {
                $account->balance_in_try = (new ConvertCurrency)
                    ->convert($account->balance, $account->currency)
                    ->getAmount();
            }
        });
    }

    /**
     * Get the comments for the blog post.
     */
    public function transactions()
    {
        return $this->hasMany(FinanceTransaction::class, 'account_id', 'id');
    }
}
