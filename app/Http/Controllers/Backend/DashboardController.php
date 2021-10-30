<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        abort_if(!auth()->guard('admin')->user() || !auth()->guard('admin')->user()->can('dashboard.view'), 403, 'You are not authorized to view dashboard');

        return view('backend.dashboard.index');
    }
}
