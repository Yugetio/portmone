<?php

namespace App\Portmone\Controller;


use App\Portmone\Service\UserExist;
use App\Portmone\Service\UserDataValid;
use App\Portmone\Service\DataBaseSave;
use App\Portmone\Service\DataBaseConnection;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Portmone\Exception\InvalidSignUpException;
use App\Portmone\Exception\UserAlreadyExistException;
use App\Portmone\Exception\DataBaseConnectionException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;

class CreateUserController extends Controller
{

/**
*@Route("/user", methods={"POST"})
*/
  public function createAction() : Response
  {
    $userExist = new UserExist();
    $userDataValid = new UserDataValid();
    $dataBaseConnection = new DataBaseConnection();

    try {

        if ($userDataValid->validCheck()==false) {
            throw new InvalidSignUpException("Invalid Sign Up", 1);

        } elseif ($userExist->existCheck()==true) {
            throw new UserAlreadyExistException("User Already Exist", 1);

        } elseif ($dataBaseConnection->connectionCheck()==false) {
            throw new DataBaseConnectionException("Lost connection with Data Base", 1);

        } else {
            $dataBaseSave = new DataBaseSave();
            $dataBaseSave->saveToDb();

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
