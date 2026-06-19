<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    /**
     * Show login form
     */
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('auth.login');
    }

    /**
     * Handle login request
     */
        public function login(Request $request)
        {
            try {

                $validator = Validator::make($request->all(), [
                    'email' => 'required|email',
                    'password' => 'required|min:6',
                ], [
                    'email.required' => 'Email address is required.',
                    'email.email' => 'Please enter a valid email address.',
                    'password.required' => 'Password is required.',
                    'password.min' => 'Password must be at least 6 characters.',
                ]);

                if ($validator->fails()) {
                    return redirect()->back()
                        ->withErrors($validator)
                        ->withInput($request->except('password'));
                }

                $user = User::where('email', $request->email)->first();

                if (!$user) {
                    Log::warning('Login attempt with non-existent email: ' . $request->email);

                    return redirect()->back()
                        ->with('error', 'Invalid email or password.')
                        ->withInput($request->except('password'));
                }

                // Active Status Check
                if ($user->status !== 'active') {

                    Log::warning('Login attempt by inactive user: ' . $request->email);

                    return redirect()->back()
                        ->with('error', 'Your account is currently inactive.')
                        ->withInput($request->except('password'));
                }

                // Password Check
                if (!Hash::check($request->password, $user->password)) {

                    Log::warning('Invalid password attempt for user: ' . $request->email);

                    return redirect()->back()
                        ->with('error', 'Invalid email or password.')
                        ->withInput($request->except('password'));
                }

                // Login User
                Auth::login($user, $request->remember);

                Log::info('User logged in successfully: ' . $user->email);

                // Role Based Redirect
                switch ($user->role) {

                    case 'admin':

                        return redirect()->route('admin.dashboard')
                            ->with('success', 'Welcome Admin ' . $user->name);

                    case 'faculty':
                        return redirect()->route('admin.faculty.dashboard')
                            ->with('success', 'Welcome ' . $user->name);

                    case 'student':

                        return redirect()->route('admin.students.dashboard')
                            ->with('success', 'Welcome ' . $user->name);

                    case 'parent':
                        return redirect()->route('admin.parents.dashboard')
                            ->with('success', 'Welcome ' . $user->name);

                    default:

                        Auth::logout();

                        return redirect()->route('login')
                            ->with('error', 'Invalid user role.');
                }

            } catch (\Exception $e) {

                Log::error('Login error: ' . $e->getMessage());

                return redirect()->back()
                    ->with('error', 'An error occurred during login.')
                    ->withInput($request->except('password'));
            }
        }
    /**
     * Show registration form
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle registration request (only by existing admins)
     */
    public function register(Request $request)
    {
        try {
            // Check if user is authenticated and is admin
            if (!Auth::check() || !Auth::user()->isAdmin()) {
                return redirect()->back()
                    ->with('error', 'Unauthorized to register new users.');
            }

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:100',
                'email' => 'required|email|unique:users,email',
                'phone' => 'nullable|string|max:15',
                'password' => 'required|min:8|confirmed',
                'role' => 'required|in:admin,faculty,student,parent',
            ], [
                'name.required' => 'Name is required.',
                'email.required' => 'Email is required.',
                'email.unique' => 'Email already exists.',
                'password.required' => 'Password is required.',
                'password.min' => 'Password must be at least 8 characters.',
                'password.confirmed' => 'Passwords do not match.',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput($request->except('password', 'password_confirmation'));
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'status' => 'active',
            ]);

            Log::info('New user registered: ' . $user->email);
            activity('user_created')
                ->performedOn($user)
                ->causedBy(Auth::user())
                ->log('New user created with role: ' . $request->role);

            return redirect()->back()
                ->with('success', 'User registered successfully.');

        } catch (\Exception $e) {
            Log::error('Registration error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'An error occurred during registration. Please try again.')
                ->withInput($request->except('password', 'password_confirmation'));
        }
    }

    /**
     * Handle logout request
     */
    public function logout(Request $request)
    {
        try {
            $user = Auth::user();
            
           

            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            Log::info('User logged out: ' . $user->email);

            return redirect(route('admin.login'))
                ->with('success', 'Logged out successfully.');

        } catch (\Exception $e) {
            Log::error('Logout error: ' . $e->getMessage());
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect(route('admin.login'));
        }
    }

    /**
     * Show forgot password form
     */
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle forgot password request
     */
    public function forgotPassword(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|exists:users,email',
            ], [
                'email.required' => 'Email is required.',
                'email.email' => 'Please enter a valid email address.',
                'email.exists' => 'Email address not found in our system.',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $user = User::where('email', $request->email)->first();

            if ($user->role !== 'admin') {
                return redirect()->back()
                    ->with('error', 'Password reset is only available for admin users.')
                    ->withInput();
            }

            // Send password reset email
            // Implement using Laravel's password reset functionality
            
            Log::info('Password reset requested for: ' . $request->email);

            return redirect()->back()
                ->with('success', 'Password reset link sent to your email.');

        } catch (\Exception $e) {
            Log::error('Forgot password error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'An error occurred. Please try again.')
                ->withInput();
        }
    }

    /**
     * Show reset password form
     */
    public function showResetPasswordForm($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    /**
     * Handle reset password request
     */
    public function resetPassword(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|exists:users,email',
                'token' => 'required',
                'password' => 'required|min:8|confirmed',
            ], [
                'password.required' => 'Password is required.',
                'password.min' => 'Password must be at least 8 characters.',
                'password.confirmed' => 'Passwords do not match.',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator);
            }

            $user = User::where('email', $request->email)->first();

            if (!$user || $user->role !== 'admin') {
                return redirect()->back()
                    ->with('error', 'Invalid request.');
            }

            $user->update([
                'password' => Hash::make($request->password),
            ]);

            Log::info('Password reset for user: ' . $user->email);

            return redirect(route('admin.login'))
                ->with('success', 'Password reset successfully. Please login with your new password.');

        } catch (\Exception $e) {
            Log::error('Reset password error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'An error occurred. Please try again.');
        }
    }
}
