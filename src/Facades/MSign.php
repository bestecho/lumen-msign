<?php
namespace JoyRiddle\MSign\Facades;

use Illuminate\Support\Facades\Facade;

class MSign extends Facade{

    protected static function getFacadeAccessor()
    {
        return 'msign';
    }

}


