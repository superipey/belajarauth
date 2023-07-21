<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
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
        Response::macro('success', function ($data, $code = 200) {
            return Response::json([
                'status' => 'success',
                'data' => $data,
            ], $code);
        });

        Response::macro('error', function ($message, $status = 400) {
            return Response::json([
                'status'  => 'error',
                'message' => $message,
            ], $status);
        });
    }
}
