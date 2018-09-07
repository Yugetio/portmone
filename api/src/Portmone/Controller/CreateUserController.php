<?php

namespace App\Portmone\Controller;

use App\Portmone\Exception\InvalidSignUpException;
use Symfony\Component\HttpFoundation\Response;
use App\Portmone\Exception\UserAlreadyExistException;
use App\Portmone\Exception\DataBaseConnectionException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;

class CreateUserController extends Controller
{
    public function createAction() : Response
    {
        try {
            return $this->formResponse(201, ['status'=>'created']);
        } catch (InvalidSignUpException $e) {
            $httpStatusCode = array('Bad request' => 400);
            return new Response(json_encode($httpStatusCode));
        } catch (UserAlreadyExistException $e) {
            $httpStatusCode = array('Locked' => 423);
            return new Response(json_encode($httpStatusCode));
        } catch (DataBaseConnectionException $e) {
            $httpStatusCode =  array('Origin Is Unreachable' =>523);
            return new Response(json_encode($httpStatusCode));
        } catch (\Exception $e) {
            $httpStatusCode = array('Internal Server Error' =>500);
            return new Response(json_encode($httpStatusCode));
        }
    }

    private function formResponse(int $code, array $data) : Response
    {
        return new Response(json_encode($data), $code);
    }
}
