<?php

namespace App\Modules\Profile\Gates;

use Illuminate\Support\Facades\Gate;
use App\Models\User;

class ProfileGate {
    static public function apply(){
        $m = 'profile';

        Gate::define($m.'-menu', function(User $user) {
            return true;
        });
        Gate::define($m.'-add', function(User $user) {
            return false;
        });
        Gate::define($m.'-view', function(User $user) {
            return false;
        });
        Gate::define($m.'-edit', function(User $user) {
            return true;
        });
        Gate::define($m.'-delete', function(User $user) {
            return false;
        });
    }
}
