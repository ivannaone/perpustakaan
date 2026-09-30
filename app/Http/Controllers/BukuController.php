<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $buku = Buku::query()
            ->when($search, function ($query) use ($search) {
                $query->where('id_buku', 'like', "%{$search}%")
                    ->orWhere('judul_buku', 'like', "%{$search}%")
                    ->orWhere('pengarang', 'like', "%{$search}%")
                    ->orWhere('penerbit', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('buku.index', compact('buku', 'search'));
    }

    public function create()
    {
        return view('buku.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_buku' => 'required|string|max:10|unique:buku,id_buku',
            'judul_buku' => 'required|string|max:150',
            'pengarang' => 'required|string|max:100',
            'penerbit' => 'nullable|string|max:100',
            'tahun_terbit' => 'nullable|integer|digits:4',
            'jumlah' => 'required|integer|min:0',
        ]);

        Buku::create($data);

        return redirect()->route('buku.index')
            ->with('success', 'Data buku berhasil ditambahkan.');
    }

    public function edit(Buku $buku)
    {
        return view('buku.edit', compact('buku'));
    }

    public function update(Request $request, Buku $buku)
    {
        $data = $request->validate([
            'judul_buku' => 'required|string|max:150',
            'pengarang' => 'required|string|max:100',
            'penerbit' => 'nullable|string|max:100',
            'tahun_terbit' => 'nullable|integer|digits:4',
            'jumlah' => 'required|integer|min:0',
        ]);

        $buku->update($data);

        return redirect()->route('buku.index')
            ->with('success', 'Data buku berhasil diperbarui.');
    }

    public function destroy(Buku $buku)
    {
        $buku->delete();

        return redirect()->route('buku.index')
            ->with('success', 'Data buku berhasil dihapus.');
    }
}