<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\AccountDeletionLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        return view('profile.show');
    }

    public function edit()
    {
        return view('profile.edit');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'phone'       => 'nullable|string',
            'avatar'      => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $request->avatar->store('avatars', 'public');
        }

        $user->update($data);

        return redirect()->route('profile.show')
            ->with('success', 'Profil berhasil diperbarui');
    }

    public function password()
    {
        return view('profile.password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password'         => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini salah']);
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('profile.show')->with('success', 'Password berhasil diubah');
    }

    public function delete()
    {
        return view('profile.delete');
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'reason_option' => 'required|string',
            'reason_custom' => 'nullable|string',
        ]);

        $user = auth()->user();

        // Insert log
        AccountDeletionLog::create([
            'user_id'       => $user->id,
            'reason_option' => $request->reason_option,
            'reason_custom' => $request->reason_option === 'Lainnya'
                                ? $request->reason_custom
                                : null,
            'deactivated_at' => now(),
            'deleted_at'     => null,
        ]);

        // Nonaktifkan akun
        $user->is_active = 0;
        $user->save();

        auth()->logout();

        return redirect('/')
            ->with('success', 'Akun dinonaktifkan. Anda bisa mengaktifkan kembali dengan login dalam 10 hari.');
    }
}
