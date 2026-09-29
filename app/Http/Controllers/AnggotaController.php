<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $anggota = Anggota::query()
            ->when($search, function ($query) use ($search) {
                $query->where('id_anggota', 'like', "%{$search}%")
                    ->orWhere('nama_anggota', 'like', "%{$search}%")
                    ->orWhere('jenis_anggota', 'like', "%{$search}%")
                    ->orWhere('kelas_prodi', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('anggota.index', compact('anggota', 'search'));
    }

    public function create()
    {
        return view('anggota.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_anggota' => 'required|string|max:10|unique:anggota,id_anggota',
            'nama_anggota' => 'required|string|max:100',
            'jenis_anggota' => 'required|in:Siswa,Guru,Mahasiswa,Staff,Umum',
            'kelas_prodi' => 'nullable|string|max:50',
            'tempat_lahir' => 'nullable|string|max:30',
            'tgl_lahir' => 'nullable|date',
        ]);

        Anggota::create($data);

        return redirect()->route('anggota.index')
            ->with('success', 'Data anggota berhasil ditambahkan.');
    }

    public function edit(Anggota $anggota)
    {
        return view('anggota.edit', compact('anggota'));
    }

    public function update(Request $request, Anggota $anggota)
    {
        $data = $request->validate([
            'nama_anggota' => 'required|string|max:100',
            'jenis_anggota' => 'required|in:Siswa,Guru,Mahasiswa,Staff,Umum',
            'kelas_prodi' => 'nullable|string|max:50',
            'tempat_lahir' => 'nullable|string|max:30',
            'tgl_lahir' => 'nullable|date',
        ]);

        $anggota->update($data);

        return redirect()->route('anggota.index')
            ->with('success', 'Data anggota berhasil diperbarui.');
    }

    public function destroy(Anggota $anggota)
    {
        $anggota->delete();

        return redirect()->route('anggota.index')
            ->with('success', 'Data anggota berhasil dihapus.');
    }
}