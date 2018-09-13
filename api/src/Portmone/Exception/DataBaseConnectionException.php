<?php
namespace App\Portmone\Exception;

class DataBaseConnectionException extends \Exception
{
    public function __construct() {

        parent::__construct("Internal server error", 500);
    }
}
