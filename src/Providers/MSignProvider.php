<?php

namespace JoyRiddle\MSign\Providers;

use Illuminate\Support\ServiceProvider;
use JoyRiddle\MSign\MSignClient;

class MSignProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {


//        $this->app->singleton('MSignClient', function () {
//            return new MSignClient();
//        }
//        );

        //注册门面模式
        //绑定门面模式目标类的别名
        $this->app->bind('msign',"JoyRiddle\MSign\MSignServer");

        $this->app->bind('msignClient',"JoyRiddle\MSign\MSignClient");

        //绑定门面类的别名
//        class_alias("JoyRiddle\MSign\Facades\MSign","MSign");
//        class_alias("JoyRiddle\MSign\Facades\MSignClient","MSignClient");


    }


}
