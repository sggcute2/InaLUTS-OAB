<?php

namespace App\Modules\Dokter_pemeriksa\Gates;

use Illuminate\Support\Facades\Gate;
use App\Models\User;

class Dokter_pemeriksaGate {
    static public function apply(){
        $m = 'dokter_pemeriksa';

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
