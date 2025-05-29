<?php

namespace App\Modules\Follow_up_v2\Gates;

use Illuminate\Support\Facades\Gate;
use App\Models\User;

class Follow_up_v2Gate {
    static public function apply(){
        $m = 'follow_up_v2';

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
