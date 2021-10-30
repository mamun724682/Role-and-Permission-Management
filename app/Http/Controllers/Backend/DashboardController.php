<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public $admin;
    public function __construct()
    {
        $this->middleware(function ($request, $next){
            $this->admin = auth()->guard('admin')->user();
            return $next($request);
        });
    }

    public function index()
    {
        abort_if(!$this->admin || !$this->admin->can('dashboard.view'), 403, 'You are not authorized to view dashboard');

        return view('backend.dashboard.index');
    }
}
