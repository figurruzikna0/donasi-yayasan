<?php

/*
 * FosterChild — Model untuk tabel 'foster_children'
 * ==================================================
 * Tabel ini menyimpan data anak asuh yayasan.
 * Setiap anak bisa memiliki banyak sponsorship (riwayat komitmen).
 * Status anak: 'Tersedia' (belum ada yang asuh) atau 'Diasuh' (ada sponsorship aktif).
 *
 * Alur data:
 *   1. Admin daftarkan anak asuh lewat form
 *   2. Donatur lihat daftar anak asuh di dashboard
 *   3. Donatur pilih → isi form sponsorship
 *   4. Admin approve → status anak berubah jadi 'Diasuh'
 *   5. Jika sponsorship expired & tidak diperpanjang → status kembali 'Tersedia'
 *
 * Relasi:
 *   - hasMany Sponsorship      → riwayat semua sponsorship anak ini
 *   - hasOne activeSponsorship → sponsorship aktif terakhir (status success, expires_at terbaru)
 *   - hasMany ChildDevelopment → laporan perkembangan anak
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class FosterChild extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',          // Nama anak asuh
        'age',           // Usia (string, misal: "7 tahun")
        'description',   // Deskripsi / cerita anak
        'photo',         // Foto anak (path storage)
        'status',        // 'Tersedia' | 'Diasuh'
        'jenis_kelamin', // Laki-laki | Perempuan
    ];

    // EVENT: saat anak asuh dihapus, hapus juga foto dari storage
    protected static function booted(): void
    {
        static::deleted(function (FosterChild $fosterChild) {
            if ($fosterChild->photo) {
                Storage::disk('public')->delete($fosterChild->photo);
            }
        });
    }

    // RELASI: satu anak punya banyak sponsorship (riwayat komitmen)
    public function sponsorships()
    {
        return $this->hasMany(Sponsorship::class);
    }

    // RELASI: satu anak punya satu sponsorship aktif (status success, expires_at terbaru)
    // Dipakai di halaman kontak admin untuk cek status terkini
    public function activeSponsorship()
    {
        return $this->hasOne(Sponsorship::class)
            ->where('status', 'success')
            ->latestOfMany('expires_at');
    }

    // RELASI: satu anak punya banyak laporan perkembangan (diurutkan dari terbaru)
    public function developments()
    {
        return $this->hasMany(ChildDevelopment::class)
            ->orderByDesc('tanggal');
    }
}