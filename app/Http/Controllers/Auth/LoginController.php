<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class LoginController extends Controller
{
    /**
     * Show the login form
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // First check if the user exists
        $user = User::where('email', $request->email)->first();
        
        if (!$user) {
            Log::info('Login failed: User not found with email ' . $request->email);
            throw ValidationException::withMessages([
                'email' => ['These credentials do not match our records.'],
            ]);
        }

        // Check if user is approved
        if ($user->status !== 'approved') {
            Log::info('Login failed: User not approved with email ' . $request->email);
            throw ValidationException::withMessages([
                'email' => ['Akun Anda belum disetujui oleh admin.'],
            ]);
        }

        // Try Laravel's built-in authentication first
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ], $request->filled('remember'))) {
            $request->session()->regenerate();
            Log::info('Login successful with Laravel authentication');
            
            // Redirect based on role
            switch (Auth::user()->role) {
                case 'admin':
                    return redirect()->intended(route('admin.dashboard'));
                case 'pelatih':
                    return redirect()->intended(route('pelatih.dashboard'));
                case 'siswa':
                    return redirect()->intended(route('siswa.dashboard'));
                case 'anggota':
                    return redirect()->intended(route('anggota.dashboard'));
                default:
                    return redirect('/');
            }
        }

        // If Laravel authentication fails, try manual password verification
        Log::info('Laravel authentication failed, trying manual verification');
        Log::info('Stored password format: ' . substr($user->password, 0, 10) . '...');
        
        if (Hash::check($request->password, $user->password)) {
            // Login successful with manual verification
            Auth::login($user, $request->filled('remember'));
            $request->session()->regenerate();
            Log::info('Login successful with manual password verification');
            
            // Redirect based on role
            switch (Auth::user()->role) {
                case 'admin':
                    return redirect()->intended(route('admin.dashboard'));
                case 'pelatih':
                    return redirect()->intended(route('pelatih.dashboard'));
                case 'siswa':
                    return redirect()->intended(route('siswa.dashboard'));
                case 'anggota':
                    return redirect()->intended(route('anggota.dashboard'));
                default:
                    return redirect('/');
            }
        }

        // If all verification methods fail
        Log::info('Login failed: All password verification methods failed for user ' . $request->email);
        throw ValidationException::withMessages([
            'email' => ['These credentials do not match our records.'],
        ]);
    }

    /**
     * Verify a non-bcrypt password with extensive format support.
     *
     * @param string $inputPassword
     * @param string $storedPassword
     * @return bool
     */
    protected function verifyNonBcryptPassword($inputPassword, $storedPassword)
    {
        // Check for prefixed formats
        
        // MD5 format (md5:hash)
        if (substr($storedPassword, 0, 4) === 'md5:') {
            $md5Password = substr($storedPassword, 4);
            $result = md5($inputPassword) === $md5Password;
            Log::info('Checking MD5 format: ' . ($result ? 'match' : 'no match'));
            return $result;
        }
        
        // Plain text format (plain:text)
        if (substr($storedPassword, 0, 6) === 'plain:') {
            $plainPassword = substr($storedPassword, 6);
            $result = $inputPassword === $plainPassword;
            Log::info('Checking plain format: ' . ($result ? 'match' : 'no match'));
            return $result;
        }
        
        // SHA1 format (sha1:hash)
        if (substr($storedPassword, 0, 5) === 'sha1:') {
            $sha1Password = substr($storedPassword, 5);
            $result = sha1($inputPassword) === $sha1Password;
            Log::info('Checking SHA1 format: ' . ($result ? 'match' : 'no match'));
            return $result;
        }
        
        // Check for unprefixed formats
        
        // Plain MD5 (32 chars hex)
        if (preg_match('/^[a-f0-9]{32}$/i', $storedPassword)) {
            $result = md5($inputPassword) === $storedPassword;
            Log::info('Checking raw MD5 format: ' . ($result ? 'match' : 'no match'));
            return $result;
        }
        
        // Plain SHA1 (40 chars hex)
        if (preg_match('/^[a-f0-9]{40}$/i', $storedPassword)) {
            $result = sha1($inputPassword) === $storedPassword;
            Log::info('Checking raw SHA1 format: ' . ($result ? 'match' : 'no match'));
            return $result;
        }
        
        // Plain text (as a last resort)
        $result = $inputPassword === $storedPassword;
        Log::info('Checking as plain text: ' . ($result ? 'match' : 'no match'));
        return $result;
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}