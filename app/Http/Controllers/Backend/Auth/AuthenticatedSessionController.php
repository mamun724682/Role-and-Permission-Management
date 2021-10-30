<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        if (\auth()->guard('admin')->check()){
            return redirect()->route('admin.dashboard');
        }
        return view('backend.auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::guard('admin')->attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            return redirect()->intended(RouteServiceProvider::ADMIN);
        }else{
            if (Auth::guard('admin')->attempt(['username' => $request->email, 'password' => $request->password], $request->boolean('remember'))) {
                return redirect()->intended(RouteServiceProvider::ADMIN);
            }

            $notification = array(
                'message' => 'Invalid credentials!',
                'alert-type' => 'error'
            );

            return  back()->with($notification);
        }

    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('admin')->logout();

        return redirect()->route('admin.login');
    }
}
