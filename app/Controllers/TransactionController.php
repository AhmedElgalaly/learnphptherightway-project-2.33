<?php

declare(strict_types = 1);

namespace App\Controllers;

use App\View;

class TransactionController
{
    public function upload()
    {
        return View::make('upload');
    }
}