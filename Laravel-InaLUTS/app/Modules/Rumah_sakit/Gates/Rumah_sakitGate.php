<?php

namespace App\Modules\Rumah_sakit\Gates;

use Illuminate\Support\Facades\Gate;
use App\Models\User;

class Rumah_sakitGate {
    static public function apply(){
        $m = 'rumah_sakit';

        Gate::define($m.'-menu', function(User $user) {
            return USER_IS_ADM;
        });
        Gate::define($m.'-add', function(User $user) {
            return USER_IS_ADM;
        });
        Gate::define($m.'-view', function(User $user) {
            return USER_IS_ADM;
        });
        Gate::define($m.'-edit', function(User $user) {
            return USER_IS_ADM;
        });
        Gate::define($m.'-delete', function(User $user) {
            return false;
        });
    }
}
