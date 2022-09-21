<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SqlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $db = \Config::get('database.connections.mysql.database');
        $host = \Config::get('database.connections.mysql.host');
        $user = \Config::get('database.connections.mysql.username');
        $pass = \Config::get('database.connections.mysql.password');

        $path = storage_path('app/backups/mucahitugur.com.sql');
        $command = 'mysql -h'.$host.' -u'.$user.' '.($pass ? "-p'".$pass."'" : '').' '.$db.' < '.$path;
        exec($command);
    }
}
