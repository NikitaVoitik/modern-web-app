<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use DB;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $countries = DB::table("countries")->get();
        return view('auth.register', compact('countries'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        Log::info('Request data:', $request->all());
        $request->validate([
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'passport_number' => ['required', 'string', 'max:255', 'unique:' . User::class, 'regex:/^[A-Z0-9]{6,9}$/'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'date_of_birth' => ['required', 'date', 'before:-18 years'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'country' => ['required', 'exists:countries,id'],
        ]);

        $user = User::create([
            'email' => $request->email,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'date_of_birth' => $request->date_of_birth,
            'passport_number' => $request->passport_number,
            'password' => Hash::make($request->password),
            'country' => $request->country,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('vote.index', absolute: false));
    }
}
