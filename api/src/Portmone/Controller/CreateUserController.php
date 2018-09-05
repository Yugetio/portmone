<?php

namespace Portmone\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Portmone\Exception\InvalidSignUpException;
use App\Portmone\Exception\UserAlreadyExistException;
use App\Portmone\Exception\DataBaseConnectionException;
use Symfony\Component\Config\Definition\Exception\Exception;

class CreateUserController #контролер для створення користувачів
{

  public function createAction() : Response
  {
    try {
        $data=json_decode( file_get_contents('php://input'), true );
        $str = sprintf("%s %s", $data['name'], $data['email']."\r\n");

        if(strlen($data['name'])<5 || strlen($data['name'])>32){
             throw new InvalidLoginException("Error Processing Request", 1);
        }elseif (strlen($data['email'])<5 || strlen($data['email'])>32) {
            throw new InvalidLoginException("Error Processing Request", 1);
        }

    } catch (InvalidSignUpException $e) {
      $httpStatusCode = array('Bad request' => 400);
      return new Response(json_encode($httpStatusCode));

    } catch (UserAlreadyExistException $e) {
      $httpStatusCode = array('Locked' => 423);
      return new Response(json_encode($httpStatusCode));

    } catch (DataBaseConnectionException $e) {
      $httpStatusCode =  array('Origin Is Unreachable' =>523);
      return new Response(json_encode($httpStatusCode));

    } catch (Exception $e) {
      $httpStatusCode = array('Internal Server Error' =>500);
      return new Response(json_encode($httpStatusCode));
    }
  }
}
