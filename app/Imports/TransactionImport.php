<?php

namespace App\Imports;

use App\Enums\TransactionType;
use App\Models\FinanceAccount;
use App\Models\FinanceCategory;
use App\Models\FinanceTransaction;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class TransactionImport implements ToModel, WithCalculatedFormulas, WithChunkReading, ShouldQueue
{
    public function chunkSize(): int
    {
        return 200;
    }

    /**
     * @param  array  $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $category = FinanceCategory::firstOrCreate(
            ['name' => $row[1]],
        );

        $account = FinanceAccount::firstOrCreate(
            ['name' => $row[2]],
        );

        $type = match ($row[3]) {
            '-' => TransactionType::EXPENSE,
            '+' => TransactionType::INCOME,
        };

        return new FinanceTransaction([
            'date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[0]),
            'category_id' => $category->id,
            'account_id' => $account->id,
            'type' => $type,
            'amount' => $row[4] * 100,
        ]);
    }
}
