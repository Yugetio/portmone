<?php
namespace App\Portmone\Exception;

class InvalidCardException extends \RuntimeException
{
    public function __construct() {

        parent::__construct("Invalid Card Name", 400);
    }
}
