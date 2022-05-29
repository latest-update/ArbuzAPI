<?php

namespace App\Exceptions;

use App\Custom\Response\ShortResponse;
use Exception;

class InvalidPurchaseException extends Exception
{
    public function render()
    {
        return ShortResponse::errorMessage('Invalid offset');
    }
}
