<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation; // <-- Ini yang bener, manggil model Donation
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    // Menampilkan halaman daftar transaksi donasi
    public function index()
    {
        // Ambil data dari tabel donations beserta info kampanyenya
        $donations = Donation::with('campaign')->latest()->get();
        
        // Lempar variabel $donations ke tampilan
        return view('admin.transactions.index', compact('donations'));
    }

    // Fungsi untuk menghapus data donasi (biasanya buat hapus data testing)
    public function destroy($id)
    {
        // Cari data donasinya berdasarkan ID
        $donation = Donation::findOrFail($id);
        
        // Hapus data dari database
        $donation->delete();

        // Balikin admin ke halaman tadi sambil bawa pesan sukses
        return redirect()->back()->with('success', 'Data transaksi berhasil dihapus dari sistem!');
    }
}