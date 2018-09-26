<?php
namespace App\Portmone\Exception;

class UserAlreadyExistException extends \Exception
{
    public function __construct() {

        parent::__construct("User Already Exist", 423);
    }
}
