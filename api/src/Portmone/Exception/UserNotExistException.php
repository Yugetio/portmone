<?php
namespace App\Portmone\Exception;

class UserNotExistException extends \Exception
{
    public function __construct() {

        parent::__construct("User Not Found", 404);
    }
}
