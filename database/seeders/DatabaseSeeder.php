<?php

namespace Database\Seeders;

use App\Models\FinanceAccount;
use App\Models\FinanceCategory;
use App\Models\FinanceTransaction;
use App\Models\Portfolio;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if (file_exists(storage_path('app/backups/mucahitugur.com.sql'))) {
            $this->call(SqlSeeder::class);
            Portfolio::factory(33)->create();

            return;
        }

        $this->call([
            CategorySeeder::class,
            PostSeeder::class,
            PageSeeder::class,
            UserSeeder::class,
            WebmentionSeeder::class,
            CurrencySeeder::class,
        ]);
        User::factory(10)->create();
        FinanceAccount::factory(9)->create();
        FinanceTransaction::factory(17)->create();
        FinanceTransaction::factory(9)->income()->create();
        FinanceCategory::factory(27)->create();
        Portfolio::factory(33)->create();
    }
}
