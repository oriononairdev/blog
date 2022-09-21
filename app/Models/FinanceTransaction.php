<?php

namespace App\Models;

use App\Enums\TransactionType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Tags\HasTags;

class FinanceTransaction extends Model
{
    use HasFactory,
        HasTags;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    protected $casts = [
        'type' => TransactionType::class,
        'date' => 'date',
    ];

    public $with = ['tags', 'account', 'category'];

    /**
     * Get the account that owns the transaction.
     */
    public function account(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(FinanceAccount::class, 'account_id', 'id');
    }

    /**
     * Get the transaction category.
     */
    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(FinanceCategory::class, 'category_id', 'id')
            ->withDefault([
                'name' => 'Others',
            ]);
    }
}
