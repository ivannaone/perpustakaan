<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $bukuTerbaru = Buku::withCount([
            'detailBuku as stok_tersedia' => function ($q) {
                $q->where('status', 'ada');
            },
        ])
        ->latest()
        ->take(8)
        ->get();

        return view('home', compact('bukuTerbaru'));
    }

    public function katalog(Request $request)
    {
        $search = $request->input('search');

        $buku = Buku::withCount([
            'detailBuku as stok_tersedia' => function ($q) {
                $q->where('status', 'ada');
            },
        ])
        ->when($search, function ($query) use ($search) {
            $query->where('id_buku', 'like', "%{$search}%")
                ->orWhere('judul_buku', 'like', "%{$search}%")
                ->orWhere('pengarang', 'like', "%{$search}%")
                ->orWhere('penerbit', 'like', "%{$search}%");
        })
        ->latest()
        ->paginate(12)
        ->withQueryString();

        $sudahTerhubung = auth()->check() && auth()->user()->id_anggota;

        return view('user.buku', compact('buku', 'search', 'sudahTerhubung'));
    }

    public function informasi()
    {
        return view('user.informasi');
    }
}
