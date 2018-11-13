<?php
namespace App\Portmone\Exception;

class InvalidSignUpException extends \RuntimeException
{
    public function __construct() {
        
        parent::__construct("Invalid Sign Up", 400);
    }
}
