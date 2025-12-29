<?php

namespace App\Providers;

use App\Models\Student;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Route::bind('student', function ($value) {
            return Crypt::decrypt($value);
        });

        Route::bind('quiz', function ($value) {
            return Crypt::decrypt($value);
        });

        Route::bind('question', function ($value) {
            return Crypt::decrypt($value);
        });

        Route::bind('studentDiploma', function ($value) {
            return Crypt::decrypt($value);
        });

        Route::bind('institute', function ($value) {
            return Crypt::decrypt($value);
        });
        Route::bind('admin', function ($value) {
            return Crypt::decrypt($value);
        });
        Route::bind('id', function ($value) {
            return Crypt::decrypt($value);
        });
        Route::bind('studentCard', function ($value) {
            return Crypt::decrypt($value);
        });
        Route::bind('result', function ($value) {
            return Crypt::decrypt($value);
        });
        
    }
}
