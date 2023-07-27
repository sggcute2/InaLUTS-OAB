<?php

namespace App\Modules\Kota\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Controllers\Controller;

class KotaController extends Controller
{
    public function __construct(){
        parent::__construct([
            'module' => 'kota'
        ]);
    }

    public function index(): View
    {
        return $this->moduleView('index');
    }
}
