<?php

namespace App\Providers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        // "component" => "Welcome"
        // "props" => array:1 [▶]
        // "url" => "/"
        // "version" => ""

        view()->composer('*', function ($view) {
            $data = $view->getData();

            if(!isset($data['page'])){
                $page = [
                    'component' => ltrim(request()->getPathInfo(), '/'),
                    'props' => $view->getData(),
                    'url' => request()->fullUrl(),
                    "version" => version()
                ];

                return $view->with('page', $page);

            }
        });
    }
}
