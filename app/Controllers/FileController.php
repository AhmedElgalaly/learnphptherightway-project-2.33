<?php 

declare(strict_types = 1);

namespace App\Controllers;

use App\Exceptions\FileTypeInvaildException;
use App\Models\Utilities\DataFileParser;
use App\Models\Transaction;
use App\View;
use DateTime;

class FileController
{
    public function upload(): View
    {
        return View::make('upload');
    }

    public function store(): void
    {
        $file = $_FILES['files'];

        foreach ($file['name'] as $key => $name) {
            $filePath = STORAGE_PATH . '/' . $name;

            move_uploaded_file($file['tmp_name'][$key], $filePath);

            // TODO call read method
            $this->read($filePath);
        }

        header('Location: /transactions');
        
    }

    public function read($file): void{
        $fileExtension = pathinfo($file, PATHINFO_EXTENSION);

        $transactions = $fileExtension === 'csv' ? DataFileParser::parseCSV($file) :

        ($fileExtension === 'xlsx' ? DataFileParser::parseXLSX($file) : throw new FileTypeInvaildException());

        $transactionModel = new Transaction();

        foreach($transactions as $transaction) {
            $transactionModel->create(
                $transaction['date'],
                $transaction['check'],
                $transaction['description'],
                $transaction['amount'],
                null
            );
        }

    }

}