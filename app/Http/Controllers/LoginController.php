<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // This method returns the view that contains your login form.
        // Ensure you have a 'login.blade.php' file in 'resources/views/auth'.
        return view('login');
    }

    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // 1. Validate the incoming request data.
        // We require the 'email' and 'password' fields.
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Attempt to authenticate the user.
        // The Auth::attempt method will automatically hash the password
        // and compare it to the hashed password in the database.
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            // 3. If authentication is successful, regenerate the session.
            // This is a security measure to prevent session fixation attacks.
            $request->session()->regenerate();

            // 4. Redirect the user based on their role.
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard'); // Arahkan ke dasbor admin
            }

            return redirect()->intended('/home'); // Arahkan ke home untuk pengguna biasa
        }

        // 5. If authentication fails, throw a validation exception.
        // This will redirect the user back to the login page and
        // automatically share the error message for the 'email' field.
        throw ValidationException::withMessages([
            'email' => __('auth.failed'),
        ]);
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
