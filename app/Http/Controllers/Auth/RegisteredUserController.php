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
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    // INI YANG BARU: Otomatis buat kategori default untuk user baru
    $defaultCategories = [
        // Pemasukan
        ['name' => 'Gaji', 'type' => 'income'],
        ['name' => 'Bonus', 'type' => 'income'],
        ['name' => 'Freelance', 'type' => 'income'],
        ['name' => 'Hadiah', 'type' => 'income'],
        ['name' => 'Lain-lain', 'type' => 'income'],

        // Pengeluaran
        ['name' => 'Makan & Minum', 'type' => 'expense'],
        ['name' => 'Transportasi', 'type' => 'expense'],
        ['name' => 'Belanja', 'type' => 'expense'],
        ['name' => 'Hiburan', 'type' => 'expense'],
        ['name' => 'Tagihan', 'type' => 'expense'],
        ['name' => 'Kesehatan', 'type' => 'expense'],
        ['name' => 'Pendidikan', 'type' => 'expense'],
        ['name' => 'Lain-lain', 'type' => 'expense'],
    ];

    foreach ($defaultCategories as $cat) {
        $user->categories()->create($cat);
    }

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
