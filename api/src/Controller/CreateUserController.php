<?php
#api/src/Portmone/Controller/CreateUserController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Exception\InvalidSignUpException;
use App\Exception\UserAlreadyExistException;
use App\Exception\DataBaseConnectionException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use App\Service;

class CreateUserController extends Controller
{

  public function createAction() : Response
  {
    try {

         throw new InvalidSignUpException("Error Processing Request", 1);

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
