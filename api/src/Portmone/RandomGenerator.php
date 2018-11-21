<?php

namespace App\Portmone;


class RandomGenerator
{
    static function generateRandomEmail(int $length)
    {
        $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString ."@mail.com";
    }

    static function generateRandomName(int $length)
    {
        $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    static function generateRandomNumber(int $numbers)
    {
        return str_pad(rand(0, pow(10, $numbers)-1), $numbers, '0', STR_PAD_LEFT);
    }
}