<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Carta;
use App\Models\Ninio;
use App\Policies\CartaPolicy;
use App\Policies\NinioPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Carta::class => CartaPolicy::class,
        Ninio::class=>NinioPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
