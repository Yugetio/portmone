<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Config\Definition\Exception\Exception;
use App\Portmone\Exception\InvalidLoginException;
use App\Portmone\Exception\InvalidPassException;
use App\Portmone\Exception\UserAlreadyExistException;
use App\Portmone\Exception\DataBaseConnectionException;
class CreateUserController #контролер для створення користувачів
{

  function createAction() #метод контролера по створенню користувача
  {
    try {
      
    throw new InvalidLoginException("Error Processing Request", 1);

    }
      #не валідне значення логіну
    catch (InvalidLoginException $e) {
        $url = 'http://localhost:8080/';
        $data = array('status' => '400');


    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data)
            )
        );
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    if ($result === FALSE) { /* Handle error */ }

    var_dump($result);
    }
      #не валідне значення паролю
    catch (InvalidPassException $e){

    }
      #користувач існує
    catch (UserAlreadyExistException $e){

    }
      #відсутнє з'єднання за БД
    catch (DataBaseConnectionException $e){

    }
      #все разом, включно з 500-сигналом
    catch (Exception $e){

    }
  }
}
