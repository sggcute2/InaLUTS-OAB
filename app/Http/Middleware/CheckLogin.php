<?php

namespace App\Http\Middleware;

use Closure;
use App\Enums\UserType;

class CheckLogin
{
    /**
     * Check Login
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $user = $request->user();

        define('USER_ID', $user->id);
        define('USER_NAME', $user->name);
        define('USER_TYPE', $user->type);

        define('USER_IS_ADM', $user->type == UserType::Administrator);
        define('USER_IS_NAT_COO', $user->type == UserType::NationalCoordinator);
        define('USER_IS_REG_COO', $user->type == UserType::RegionalCoordinator);
        define('USER_IS_LOC_COO', $user->type == UserType::LocalCoordinator);
        define('USER_IS_SUB', $user->type == UserType::Submitter);

        $user_role = '';
        if (USER_IS_ADM) $user_role = 'Administrator';
        if (USER_IS_NAT_COO) $user_role = 'National Coordinator';
        if (USER_IS_REG_COO) $user_role = 'Regional Coordinator';
        if (USER_IS_LOC_COO) $user_role = 'Local Coordinator';
        if (USER_IS_SUB) $user_role = 'Submitter';
        define('USER_ROLE', $user_role);

        return $next($request);
    }
}
