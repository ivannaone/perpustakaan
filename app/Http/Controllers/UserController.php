<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $users = User::with('anggota')
            ->where('role', 'user')
            ->when($search, function ($query) use ($search) {
                $query->where('nama', 'like', "%{$search}%")
                    ->orWhere('username', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $anggota = Anggota::orderBy('nama_anggota')->get();

        return view('admin.users', compact('users', 'anggota', 'search'));
    }

    public function kaitkan(Request $request, User $user)
    {
        if ($user->role !== 'user') {
            return back()->with('error', 'Akun ini bukan user biasa.');
        }

        $data = $request->validate([
            'id_anggota' => [
                'nullable',
                Rule::exists('anggota', 'id_anggota'),
                Rule::unique('users', 'id_anggota')->ignore($user->id),
            ],
        ]);

        try {
            $user->update(['id_anggota' => $data['id_anggota'] ?: null]);
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->with(
                'error',
                'Anggota ini sudah dikaitkan ke akun lain. Pilih anggota yang berbeda.'
            );
        }

        $pesan = $data['id_anggota']
            ? 'Akun berhasil dikaitkan dengan anggota.'
            : 'Kaitan akun dengan anggota berhasil dihapus.';

        return back()->with('success', $pesan);
    }
}
