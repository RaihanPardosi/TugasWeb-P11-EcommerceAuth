<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ManageUserController extends Controller
{
    public function index(): View
    {
        $users = User::withCount('posts')->orderBy('name')->paginate(15);

        return view('manage.users.index', compact('users'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        if ($user->is($request->user())) {
            return back()->with('error', 'Anda tidak dapat mengubah peran akun sendiri.');
        }

        $data = $request->validate([
            'role' => ['required', Rule::enum(Role::class)],
        ]);

        $user->forceFill(['role' => $data['role']])->save();

        return back()->with('success', "Peran {$user->name} diubah menjadi ".Role::from($data['role'])->label().'.');
    }
}
