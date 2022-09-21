<?php

namespace App\Observers;

use App\Enums\TransactionType;
use App\Models\FinanceTransaction;
use Illuminate\Support\Facades\Log;
use Money\Currency;
use Money\Money;

class TransactionObserver
{
    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    public bool $afterCommit = true;

    /**
     * Handle the FinanceTransaction "created" event.
     *
     * @param  \App\Models\FinanceTransaction  $transaction
     * @return void
     */
    public function created(FinanceTransaction $transaction)
    {
        $this->updateBalance($transaction->account);
    }

    /**
     * Handle the FinanceTransaction "updated" event.
     *
     * @param  \App\Models\FinanceTransaction  $transaction
     * @return void
     */
    public function updated(FinanceTransaction $transaction)
    {
        if (! $transaction->wasChanged('amount')) {
            Log::info('Transaction '.$transaction->id.' changed but amount is not updated, balance will not be updated...');

            return;
        }

        $this->updateBalance($transaction->account);
    }

    /**
     * Handle the FinanceTransaction "deleted" event.
     *
     * @param  \App\Models\FinanceTransaction  $transaction
     * @return void
     */
    public function deleted(FinanceTransaction $transaction)
    {
        $this->updateBalance($transaction->account);
    }

    /**
     * Handle the FinanceTransaction "restored" event.
     *
     * @param  \App\Models\FinanceTransaction  $transaction
     * @return void
     */
    public function restored(FinanceTransaction $transaction)
    {
        $this->updateBalance($transaction->account);
    }

    /**
     * Handle the FinanceTransaction "force deleted" event.
     *
     * @param  \App\Models\FinanceTransaction  $transaction
     * @return void
     */
    public function forceDeleted(FinanceTransaction $transaction)
    {
        $this->updateBalance($transaction->account);
    }

    public function updateBalance($account): void
    {
        $balance = new Money('0', new Currency($account->currency));

        foreach ($account->transactions as $transaction) {
            $amount = new Money($transaction->amount, new Currency($account->currency));

            $balance = match ($transaction->type) {
                TransactionType::EXPENSE => $balance->subtract($amount),
                TransactionType::INCOME => $balance->add($amount),
            };
        }

        $account->balance = $balance->getAmount();
        $account->save();
    }
}
