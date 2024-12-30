<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        return view('Admin.userread', compact('users'));
    }

    public function create()
    {
        return view('Admin.usercreate');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'email' => 'required|email|unique:users,email',
                'name' => 'required|min:3',
                'password' => 'required|min:6|confirmed',
                'role' => 'required|in:admin,member',
            ]);

            $user = User::create([
                'email' => $validated['email'],
                'name' => $validated['name'],
                'password' => Hash::make($validated['password']),
                'role' => $validated['role'],
            ]);

            if (!$user) {
                throw new \Exception('Failed to create user');
            }

            return redirect()->route('user.index')
                ->with('success', 'Pengguna berhasil ditambahkan');
                
        } catch (\Exception $e) {
            Log::error('User creation failed: ' . $e->getMessage());
            
            return back()
                ->withInput()
                ->withErrors(['error' => 'Gagal menambahkan pengguna. ' . $e->getMessage()]);
        }
    }

    public function edit($email)
    {
        $user = User::where('email', $email)->firstOrFail();
        return view('Admin.useredit', compact('user'));
    }

    public function update(Request $request, $email)
    {
        $user = User::where('email', $email)->firstOrFail();

        $validationRules = [
            'name' => 'required|string|max:255',
            'email' => [
                'required', 
                'email', 
                Rule::unique('users')->ignore($user->id)
            ],
            'role' => 'required|in:admin,member',
            'password' => 'nullable|min:8|confirmed'
        ];

        $validatedData = $request->validate($validationRules);

        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->role = $validatedData['role'];

        if (!empty($validatedData['password'])) {
            $user->password = Hash::make($validatedData['password']);
        }

        $user->save();

        return redirect()->route('user.index')->with('success', 'User updated successfully.');
    }

    public function delete($email)
    {
        $user = User::where('email', $email)->firstOrFail();
        $user->delete();
        
        return redirect()->route('user.index')->with('success', 'User deleted successfully');
    }
}