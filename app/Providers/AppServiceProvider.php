<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        // Course::class => CoursePolicy::class,  // <<< COMMENT DÒNG NÀY LẠI
    ];

    public function boot(): void
    {
        //
    }
}