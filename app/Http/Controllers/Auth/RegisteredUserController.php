<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;
use App\Models\Customer;
use App\Models\Technician;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', 'in:customer,technician,staff'],
        ]);

        $role = $request->role;

        if ($role === 'customer') {
            $rules = array_merge($rules, [
                'address' => ['required', 'string', 'max:255'],
                'phone' => ['required', 'string', 'max:20'],
            ]);
        } elseif ($role === 'technician') {
            $rules = array_merge($rules, [
                'expertise' => ['required', 'string'],
            ]);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($role === 'customer') {
            $customer = Customer::create([
                'user_id' => $user->id,
                'address' => $request->address,
                'phone' => $request->phone,
            ]);
        } elseif ($role === 'technician') {
            $technician = Technician::create([
                'user_id' => $user->id,
                'address' => $request->address,
                'phone' => $request->phone,
                'expertise' => $request->expertise,
            ]);
        }

        // Assign role based on registration form
        if ($request->has('role')) {
            $role = Role::findByName($request->role);
            if ($role) {
                $user->assignRole($role);
            }
        }
        
        event(new Registered($user));

        Auth::login($user);
        
        return redirect(route('dashboard', absolute: false));
    }
}
