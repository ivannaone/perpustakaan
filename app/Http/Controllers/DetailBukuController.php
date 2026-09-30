<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\DetailBuku;
use Illuminate\Http\Request;

class DetailBukuController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $detailBuku = DetailBuku::with('buku')
            ->when($search, function ($query) use ($search) {
                $query->where('no_buku', 'like', "%{$search}%")
                    ->orWhere('id_buku', 'like', "%{$search}%")
                    ->orWhere('status', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('detail_buku.index', compact('detailBuku', 'search'));
    }

    public function create()
    {
        $buku = Buku::orderBy('judul_buku')->get();

        return view('detail_buku.create', compact('buku'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'no_buku' => 'required|string|max:20|unique:detail_buku,no_buku',
            'id_buku' => 'required|exists:buku,id_buku',
            'status' => 'required|in:ada,dipinjam',
        ]);

        DetailBuku::create($data);

        return redirect()->route('detail-buku.index')
            ->with('success', 'Detail buku berhasil ditambahkan.');
    }

    public function generate(Buku $buku)
    {
        for ($i = 1; $i <= $buku->jumlah; $i++) {
            $noBuku = $buku->id_buku . '-' . str_pad($i, 2, '0', STR_PAD_LEFT);

            DetailBuku::firstOrCreate(
                ['no_buku' => $noBuku],
                [
                    'id_buku' => $buku->id_buku,
                    'status' => 'ada',
                ]
            );
        }

        return redirect()->route('detail-buku.index')
            ->with('success', 'Detail buku berhasil dibuat otomatis.');
    }

    public function edit(DetailBuku $detailBuku)
    {
        $buku = Buku::orderBy('judul_buku')->get();

        return view('detail_buku.edit', compact('detailBuku', 'buku'));
    }

    public function update(Request $request, DetailBuku $detailBuku)
    {
        $data = $request->validate([
            'id_buku' => 'required|exists:buku,id_buku',
            'status' => 'required|in:ada,dipinjam',
        ]);

        $detailBuku->update($data);

        return redirect()->route('detail-buku.index')
            ->with('success', 'Detail buku berhasil diperbarui.');
    }

    public function destroy(DetailBuku $detailBuku)
    {
        $detailBuku->delete();

        return redirect()->route('detail-buku.index')
            ->with('success', 'Detail buku berhasil dihapus.');
    }
}