<?php

namespace App\Modules\Dashboard\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __construct(){
        parent::__construct([
            'module' => 'dashboard'
        ]);
    }

    public function index(): View
    {
        return $this->moduleView('index');
    }
}
