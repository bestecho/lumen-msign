<?php
namespace JoyRiddle\MSign\Facades;

use Illuminate\Support\Facades\Facade;

class MSignClient extends Facade{

    protected static function getFacadeAccessor()
    {
        return 'msignClient';
    }

}


