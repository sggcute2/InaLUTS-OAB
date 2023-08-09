<?php

namespace App\Modules\Pasien\Gates;

use Illuminate\Support\Facades\Gate;
use App\Models\User;

class PasienGate {
    static public function apply(){
        $m = 'pasien';

        Gate::define($m.'-menu', function(User $user) {
            return USER_IS_SUB;
        });
        Gate::define($m.'-add', function(User $user) {
            return USER_IS_SUB;
        });
        Gate::define($m.'-view', function(User $user) {
            return USER_IS_SUB;
        });
        Gate::define($m.'-edit', function(User $user) {
            return USER_IS_SUB;
        });
        Gate::define($m.'-delete', function(User $user) {
            return false;
        });
    }
}
