<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\DetailBuku;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $peminjaman = Peminjaman::with(['anggota', 'detailBuku.buku'])
            ->when($search, function ($query) use ($search) {
                $query->where('id_pinjam', 'like', "%{$search}%")
                    ->orWhereHas('anggota', function ($q) use ($search) {
                        $q->where('nama_anggota', 'like', "%{$search}%");
                    })
                    ->orWhereHas('detailBuku', function ($q) use ($search) {
                        $q->where('no_buku', 'like', "%{$search}%");
                    });
            })
            ->latest('tgl_pinjam')
            ->paginate(10)
            ->withQueryString();

        return view('peminjaman.index', compact('peminjaman', 'search'));
    }

    public function create()
    {
        $anggota = Anggota::orderBy('nama_anggota')->get();

        $buku = DetailBuku::with('buku')
            ->where('status', 'ada')
            ->get();

        return view('peminjaman.create', compact('anggota', 'buku'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_pinjam' => 'required|string|max:10|unique:peminjaman,id_pinjam',
            'tgl_pinjam' => 'required|date',
            'id_anggota' => 'required|exists:anggota,id_anggota',
            'no_buku' => 'required|exists:detail_buku,no_buku',
        ]);

        DB::transaction(function () use ($data) {

            $detailBuku = DetailBuku::where('no_buku', $data['no_buku'])
                ->lockForUpdate()
                ->first();

            if (!$detailBuku || $detailBuku->status !== 'ada') {
                abort(422, 'Buku sedang dipinjam.');
            }

            Peminjaman::create([
                'id_pinjam' => $data['id_pinjam'],
                'tgl_pinjam' => $data['tgl_pinjam'],
                'id_anggota' => $data['id_anggota'],
                'no_buku' => $data['no_buku'],
                'status' => 'dipinjam',
            ]);

            $detailBuku->update([
                'status' => 'dipinjam',
            ]);
        });

        return redirect()->route('peminjaman.index')
            ->with('success', 'Peminjaman berhasil dicatat.');
    }

    public function returnBook(Peminjaman $peminjaman)
    {
        if ($peminjaman->status === 'dikembalikan') {
            return back()->with('success', 'Buku sudah dikembalikan.');
        }

        DB::transaction(function () use ($peminjaman) {

            $peminjaman->update([
                'status' => 'dikembalikan',
                'tgl_kembali' => now()->toDateString(),
            ]);

            $peminjaman->detailBuku()->update([
                'status' => 'ada',
            ]);
        });

        return redirect()->route('peminjaman.index')
            ->with('success', 'Buku berhasil dikembalikan.');
    }

    public function destroy(Peminjaman $peminjaman)
    {
        $peminjaman->delete();

        return redirect()->route('peminjaman.index')
            ->with('success', 'Data peminjaman berhasil dihapus.');
    }
}