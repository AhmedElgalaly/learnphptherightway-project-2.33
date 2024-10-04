<?php

declare(strict_types = 1);

namespace App\Models\Utilities;

require_once __DIR__ . '/../../../vendor/autoload.php';

use Shuchkin\SimpleXLSX;
use DateTime;

class DataFileParser
{
    public static function parseCSV(string $file): array
    {
        $file = fopen($file, 'r');

        fgetcsv($file); // Skip the first line

        $transactions = [];

        while (($data = fgetcsv($file)) !== false) {
            $transactions[] = [
                'date' => new DateTime($data[0]),
                'check' => (int)$data[1],
                'description' => $data[2],
                'amount' => (float) filter_var($data[3],FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
            ];
        }

        fclose($file);

        return $transactions;
    }

    public static function parseXLSX($file)
    {
        if($transactionsSheet = SimpleXLSX::parse($file)) {
            $transactions = $transactionsSheet->rows();

            array_shift($transactions); // Remove the first row

            $formattedTransactions = [];

            foreach($transactions as $transaction) {
                $formattedTransactions[] = [
                    'date' => new DateTime($transaction[0]),
                    'check' => (int)$transaction[1],
                    'description' => $transaction[2],
                    'amount' => (float) filter_var($transaction[3],FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
                ];

                
            }

            return $formattedTransactions;
        }

    }
}