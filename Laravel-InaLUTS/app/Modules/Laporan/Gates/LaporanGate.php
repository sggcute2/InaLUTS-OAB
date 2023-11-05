<?php

namespace App\Modules\Laporan\Gates;

use Illuminate\Support\Facades\Gate;
use App\Models\User;

class LaporanGate {
    static public function apply(){
        $m = 'laporan';

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
