<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Buku;
use App\Models\DetailBuku;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $peminjaman = Peminjaman::with([
            'anggota',
            'detailBuku.buku'
        ])
            ->when($search, function ($query) use ($search) {
                $query->where('id_pinjam', 'like', "%{$search}%")
                    ->orWhereHas('anggota', function ($q) use ($search) {
                        $q->where(
                            'nama_anggota',
                            'like',
                            "%{$search}%"
                        );
                    })
                    ->orWhereHas('detailBuku', function ($q) use ($search) {
                        $q->where(
                            'no_buku',
                            'like',
                            "%{$search}%"
                        );
                    });
            })
            ->latest('tgl_pinjam')
            ->paginate(10)
            ->withQueryString();

        return view(
            'peminjaman.index',
            compact('peminjaman', 'search')
        );
    }

    public function create()
    {
        $anggota = Anggota::orderBy('nama_anggota')->get();

        $buku = DetailBuku::with('buku')
            ->where('status', 'ada')
            ->get();

        return view(
            'peminjaman.create',
            compact('anggota', 'buku')
        );
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

            $detailBuku = DetailBuku::where(
                'no_buku',
                $data['no_buku']
            )
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

        return redirect()
            ->route('peminjaman.index')
            ->with(
                'success',
                'Peminjaman berhasil dicatat.'
            );
    }

    public function returnBook(Peminjaman $peminjaman)
    {
        if ($peminjaman->status === 'dikembalikan') {
            return back()->with(
                'success',
                'Buku sudah dikembalikan.'
            );
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

        return redirect()
            ->route('peminjaman.index')
            ->with(
                'success',
                'Buku berhasil dikembalikan.'
            );
    }

    public function destroy(Peminjaman $peminjaman)
    {
        $peminjaman->delete();

        return redirect()
            ->route('peminjaman.index')
            ->with(
                'success',
                'Data peminjaman berhasil dihapus.'
            );
    }

    public function saya(Request $request)
    {
        $user = $request->user();

        if (!$user->id_anggota) {
            return view('user.peminjaman', [
                'peminjaman' => collect(),
                'tidakTerhubung' => true,
            ]);
        }

        $peminjaman = Peminjaman::with([
            'anggota',
            'detailBuku.buku'
        ])
            ->where('id_anggota', $user->id_anggota)
            ->latest('tgl_pinjam')
            ->paginate(10);

        return view('user.peminjaman', compact('peminjaman'));
    }

    public function ajukan(Request $request, \App\Models\Buku $buku)
    {
        $user = $request->user();

        if (!$user->id_anggota) {
            return back()->with(
                'error',
                'Akun kamu belum terhubung ke data anggota perpustakaan. Hubungi petugas untuk mengaitkan akunmu.'
            );
        }

        $hasDipinjam = Peminjaman::where('id_anggota', $user->id_anggota)
            ->where('status', 'dipinjam')
            ->whereHas('detailBuku', function ($q) use ($buku) {
                $q->where('id_buku', $buku->id_buku);
            })
            ->exists();

        if ($hasDipinjam) {
            return back()->with(
                'error',
                'Kamu sudah meminjam buku ini dan belum mengembalikannya.'
            );
        }

        try {
            DB::transaction(function () use ($user, $buku) {

                $detailBuku = DetailBuku::where('id_buku', $buku->id_buku)
                    ->where('status', 'ada')
                    ->lockForUpdate()
                    ->first();

                if (!$detailBuku) {
                    throw new \Exception('Semua eksemplar buku ini sedang dipinjam.');
                }

                $lastId = Peminjaman::lockForUpdate()
                    ->orderByDesc('id_pinjam')
                    ->value('id_pinjam');

                $nextNumber = 1;
                if ($lastId) {
                    $nextNumber = ((int) ltrim($lastId, 'P')) + 1;
                }

                $idPinjam = 'P' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

                Peminjaman::create([
                    'id_pinjam'  => $idPinjam,
                    'tgl_pinjam' => now()->toDateString(),
                    'id_anggota' => $user->id_anggota,
                    'no_buku'    => $detailBuku->no_buku,
                    'status'     => 'dipinjam',
                ]);

                $detailBuku->update(['status' => 'dipinjam']);
            });
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }

        return back()->with(
            'success',
            'Peminjaman berhasil diajukan. Ambil buku di perpustakaan.'
        );
    }
}