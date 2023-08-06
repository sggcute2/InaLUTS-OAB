<?php

namespace App\Providers;

use App\Modules\Dashboard\Gates\DashboardGate;
use App\Modules\Kota\Gates\KotaGate;
use App\Modules\Rumah_sakit\Gates\Rumah_sakitGate;
use App\Modules\Departemen\Gates\DepartemenGate;
use App\Modules\User\Gates\UserGate;
use App\Modules\Profile\Gates\ProfileGate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // Gates
        DashboardGate::apply();
        KotaGate::apply();
        Rumah_sakitGate::apply();
        DepartemenGate::apply();
        UserGate::apply();
        ProfileGate::apply();
    }
}
