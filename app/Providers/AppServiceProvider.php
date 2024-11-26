<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Model\AppSetting;
use App\Model\Tag;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        view()->composer('*', function ($view) {
            $appname = AppSetting::getSettingByCode(100);
            $address = AppSetting::getSettingByCode(101);
            $phoneno = AppSetting::getSettingByCode(102);
            $email   = AppSetting::getSettingByCode(103);
            $insta   = AppSetting::getSettingByCode(104);
            $facebook= AppSetting::getSettingByCode(105);
            $twitter = AppSetting::getSettingByCode(106);
            $google  = AppSetting::getSettingByCode(107);
            $footer  = AppSetting::getSettingByCode(108);
            $tags    = Tag::select('tag')->groupBy('tag')->orderByRaw('COUNT(*) DESC')->limit(7)->get();
            $shippingdays = AppSetting::getSettingByCode(111);
            $shipping = AppSetting::getSettingByCode(109);
            
            $view->with('appname', $appname );  
            $view->with('phoneno', $phoneno );
            $view->with('address', $address );  
            $view->with('email', $email );
            $view->with('insta', $insta );  
            $view->with('facebook', $facebook );
            $view->with('twitter', $twitter );  
            $view->with('google', $google );
            $view->with('footer', $footer );  
            $view->with('tags', $tags );   
            $view->with('shippingdays', $shippingdays ); 
            $view->with('shipping', $shipping ); 
        });
    }
}
