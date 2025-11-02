<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of users.
     */
    public function index()
    {
        return view('users.index');
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'phone' => $validated['phone'] ?? null,
            'level' => $validated['level'],
            'blood_type' => $validated['blood_type'] ?? null,
            'status' => User::STATUS_ACTIVE,
            'register_date' => now()->format('d/m/Y H:i'),
        ]);

        return redirect()->route('users.index')
            ->with('success', 'Usuário cadastrado com sucesso!');
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $validated = $request->validated();

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->phone = $validated['phone'] ?? null;
        $user->level = $validated['level'];
        $user->blood_type = $validated['blood_type'] ?? null;
        $user->status = $validated['status'];

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('users.index')
            ->with('success', 'Usuário atualizado com sucesso!');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'Usuário deletado com sucesso!'
        ]);
    }

    /**
     * Get users data for DataTables.
     */
    public function getData()
    {
        $users = User::select(['id', 'name', 'email', 'level', 'status'])
            ->get()
            ->map(function ($user) {
                return [
                    'id' => $user->id,
                    'nome' => $user->name,
                    'user_id' => $user->email,
                    'level' => $user->level_name,
                    'ativo' => $user->isActive() ? 'Sim' : 'Não',
                ];
            });

        return response()->json($users);
    }
}

