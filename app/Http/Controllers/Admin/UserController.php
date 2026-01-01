<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Exception;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::latest()->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        try {
            $validated = $request->validated();
            $validated['password'] = Hash::make($validated['password']);

            User::create($validated);

            return redirect()->route('admin.users.index')
                ->with('success', 'User berhasil ditambahkan!');
        } catch (Exception $e) {
            Log::error('Error creating user: ' . $e->getMessage());

            return back()
                ->withErrors(['error' => 'Gagal menyimpan user: ' . $e->getMessage()])
                ->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUserRequest $request, User $user)
    {
        try {
            $validated = $request->validated();

            // Jika password diisi, hash password baru
            if (!empty($validated['password'])) {
                $validated['password'] = Hash::make($validated['password']);
            } else {
                // Jika password kosong, buang dari array
                unset($validated['password']);
            }

            $user->update($validated);

            return redirect()->route('admin.users.index')
                ->with('success', 'User berhasil diperbarui!');
        } catch (Exception $e) {
            Log::error('Error updating user: ' . $e->getMessage());

            return back()
                ->withErrors(['error' => 'Gagal memperbarui user: ' . $e->getMessage()])
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            // Cegah delete user sendiri
            if ($user->id === session('admin_id')) {
                return back()->withErrors(['error' => 'Anda tidak dapat menghapus akun sendiri!']);
            }

            $user->delete();

            return redirect()->route('admin.users.index')
                ->with('success', 'User berhasil dihapus!');
        } catch (Exception $e) {
            Log::error('Error deleting user: ' . $e->getMessage());

            return back()
                ->withErrors(['error' => 'Gagal menghapus user: ' . $e->getMessage()]);
        }
    }
}
