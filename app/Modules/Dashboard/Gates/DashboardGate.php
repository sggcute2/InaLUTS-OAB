<?php

namespace App\Modules\Dashboard\Gates;

use Illuminate\Support\Facades\Gate;
use App\Models\User;

class DashboardGate {
    static public function apply(){
        $m = 'dashboard';

        Gate::define($m.'-menu', function(User $user) {
            return true;
        });
        Gate::define($m.'-add', function(User $user) {
            return false;
        });
        Gate::define($m.'-view', function(User $user) {
            return true;
        });
        Gate::define($m.'-edit', function(User $user) {
            return false;
        });
        Gate::define($m.'-delete', function(User $user) {
            return true;
        });
    }
}
