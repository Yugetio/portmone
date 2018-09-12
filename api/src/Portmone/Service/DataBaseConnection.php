<?php

namespace App\Portmone\Service;

/**
 *
 */
class DataBaseConnection
{


    public function connectionCheck()
    {
        $data=json_decode( file_get_contents('php://input'), true );
        
        $isConnect = false;
        return $isConnect;
    }
}
