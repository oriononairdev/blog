<?php

namespace App\Http\Controllers;

use App\Imports\TransactionImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TransactionController extends Controller
{
    public function import(Request $request)
    {
        Excel::import(new TransactionImport, storage_path('app/file-manager/imports/transactions.xlsx'));

        return redirect('/nova')->with('success', 'All good!');
    }
}
