<?php

namespace App\Service;

/**
 *
 */
class UserDataValid
{

    public function validCheck()
    {
        $data=json_decode( file_get_contents('php://input'), true );
        $str = sprintf("%s %s", $data['name'], $data['email']."\r\n");

        if(strlen($data['name'])<5 || strlen($data['name'])>32){
            return false;

        }elseif (strlen($data['name']) != strlen(utf8_decode($data['name']))) {
            return false;

        }elseif (strlen($data['email'])<5 || strlen($data['email'])>32) {
            return false;

        }elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL) ||
         strlen($data['email']) != strlen(utf8_decode($data['email']))) {
            return false;
        } else return true;
    }
}
