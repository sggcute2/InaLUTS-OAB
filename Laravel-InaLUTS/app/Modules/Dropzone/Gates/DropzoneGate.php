<?php

namespace App\Modules\Dropzone\Gates;

use Illuminate\Support\Facades\Gate;
use App\Models\User;

class DropzoneGate {
    static public function apply(){
        $m = 'dropzone';

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
