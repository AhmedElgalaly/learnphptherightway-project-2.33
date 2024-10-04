<?php

declare(strict_types = 1);

namespace App\Exceptions;

class FileTypeInvaildException extends \Exception
{
    protected $message = 'Invalid file type';
}