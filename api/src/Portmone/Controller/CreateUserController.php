<?php
#api/src/Portmone/Controller/CreateUserController.php
namespace Portmone\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Portmone\Exception\InvalidSignUpException;
use App\Portmone\Exception\UserAlreadyExistException;
use App\Portmone\Exception\DataBaseConnectionException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Portmone\Service;

class CreateUserController extends Controller
{

  public function createAction(UserDataValid $userDataValid,UserExist $userExist,
  DataBaseConnection $dataBaseConnection) : Response
  {
    try {

        $isValid = $userDataValid->validCheck();
        if ($isValid == false) {
            throw new InvalidSignUpException("Error Processing Request", 1);

        }
        $isUserExist = $userExist->existCheck();
        if ($isUserExist == false) {
            throw new UserAlreadyExistException("Error Processing Request", 1);

        }
        $isConnect = $dataBaseConnection->connectionCheck();
        if ($isConnect == false) {
            throw new DataBaseConnectionException("Error Processing Request", 1);

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
