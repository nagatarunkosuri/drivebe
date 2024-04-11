<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the initial dashboard or welcome page for authenticated users.
     *
     * @return View
     */
    public function index(): View
    {
        // Assuming 'dashboard' is a view that needs authenticated access
        return view('dashboard');
    }

    /**
     * Display the login view.
     *
     * @return View
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param LoginRequest $request
     * @return RedirectResponse
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        // Log login attempt
        Log::info('Login successful: User ID ' . Auth::id());

        // Custom role-based redirection
        if (Auth::user()->role === 'admin') {
            return redirect()->intended('/admin/dashboard');  // Redirect admins to the admin dashboard
        }

        return redirect()->intended(RouteServiceProvider::HOME);  // Default redirection
    }

    /**
     * Destroy an authenticated session.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function destroy(Request $request): RedirectResponse
    {
        Log::info('Logout initiated: User ID ' . Auth::id());  // Log logout attempt

        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        Log::info('Logout successful: User ID ' . Auth::id());  // Confirm logout success

        return redirect('/');
    }
}
