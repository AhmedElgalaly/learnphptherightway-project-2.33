<?php

declare(strict_types = 1);

namespace App\Controllers;

use App\View;
use App\Models\Transaction;

class TransactionController
{
    public function index(): View
    {
        $transaction = new Transaction();
        return View::make('transactions', [
            'transactions' => $transaction->all(),
            'revenue' => $transaction->getRevenue(),
            'expenses' => $transaction->getExpenses(),
            // + sign was added beacuse the getExpenses method returns a negative value
            'netTotal' => $transaction->getRevenue() + $transaction->getExpenses()
        ]);
    }
}