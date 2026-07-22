<?php
// === RekapController (Admin): menampilkan dan mengekspor rekap donasi, donatur, & orang tua asuh ===

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\Sponsorship;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class RekapController extends Controller
{
    private function applyDateFilter($query, Request $request)
    {
        if ($start = $request->get('start_date')) {
            $query->whereDate('created_at', '>=', $start);
        }
        if ($end = $request->get('end_date')) {
            $query->whereDate('created_at', '<=', $end);
        }
        return $query;
    }

    // --- REKAP DONASI: filter/search/paginate data donasi, hitung total amount & status counts, tampilkan halaman rekap donasi ---
    public function donasi(Request $request)
    {
        $query = Donation::with(['campaign', 'user'])->latest();
        $query = $this->applyDateFilter($query, $request);

        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('donor_name', 'like', "%{$search}%")
                  ->orWhere('donor_email', 'like', "%{$search}%")
                  ->orWhere('order_id', 'like', "%{$search}%");
            });
        }

        if ($status = $request->get('status')) {
            $query->where('status', $status);
        }

        $donations = $query->paginate(20)->withQueryString();

        $baseQuery = Donation::query();
        $baseQuery = $this->applyDateFilter($baseQuery, $request);
        $totalAmount = (clone $baseQuery)->where('status', 'success')->sum('amount');
        $totalCount  = (clone $baseQuery)->count();
        $pendingCount = (clone $baseQuery)->where('status', 'pending')->count();
        $successCount = (clone $baseQuery)->where('status', 'success')->count();

        return view('admin.rekap.donasi', compact('donations', 'totalAmount', 'totalCount', 'pendingCount', 'successCount'));
    }

    // --- EXPORT CSV DONASI: filter data donasi, generate & download file CSV dengan BOM UTF-8 ---
    public function donasiExport(Request $request)
    {
        $query = Donation::with(['campaign', 'user'])->latest();
        $query = $this->applyDateFilter($query, $request);

        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('donor_name', 'like', "%{$search}%")
                  ->orWhere('donor_email', 'like', "%{$search}%")
                  ->orWhere('order_id', 'like', "%{$search}%");
            });
        }
        if ($status = $request->get('status')) {
            $query->where('status', $status);
        }

        $donations = $query->get();
        $filename = 'rekap-donasi-' . now()->format('Y-m-d') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename={$filename}",
        ];

        $callback = function () use ($donations) {
            $file = fopen('php://output', 'w');
            fwrite($file, "\xEF\xBB\xBF");
            fputcsv($file, ['Order ID', 'Donatur', 'Email', 'Kampanye', 'Nominal', 'Metode', 'Status', 'Tanggal']);
            foreach ($donations as $d) {
                fputcsv($file, [
                    $d->order_id,
                    $d->donor_name,
                    $d->donor_email,
                    $d->campaign?->title ?? '-',
                    $d->amount,
                    $d->payment_method ?? '-',
                    $d->status,
                    $d->created_at ? $d->created_at->format('d/m/Y H:i') : '-',
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    // --- REKAP DONATUR: filter/search/paginate data donatur dengan jumlah donasi & sponsorship, tampilkan halaman rekap donatur ---
    public function donatur(Request $request)
    {
        $query = User::where('role', 'donatur')->withCount(['donations', 'sponsorships'])->latest();
        $query = $this->applyDateFilter($query, $request);

        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('nik', 'like', "%{$search}%");
            });
        }

        $donaturs = $query->paginate(20)->withQueryString();

        $baseQuery = User::where('role', 'donatur');
        $baseQuery = $this->applyDateFilter($baseQuery, $request);
        $totalDonatur = (clone $baseQuery)->count();

        $totalDonasiAll = Donation::where('status', 'success')->sum('amount');
        $totalSponsorshipAll = Sponsorship::where('status', 'success')->count();

        return view('admin.rekap.donatur', compact('donaturs', 'totalDonatur', 'totalDonasiAll', 'totalSponsorshipAll'));
    }

    // --- EXPORT CSV DONATUR: filter data donatur, generate & download file CSV ---
    public function donaturExport(Request $request)
    {
        $query = User::where('role', 'donatur')->withCount(['donations', 'sponsorships'])->latest();
        $query = $this->applyDateFilter($query, $request);

        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('nik', 'like', "%{$search}%");
            });
        }

        $donaturs = $query->get();
        $filename = 'rekap-donatur-' . now()->format('Y-m-d') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename={$filename}",
        ];

        $callback = function () use ($donaturs) {
            $file = fopen('php://output', 'w');
            fwrite($file, "\xEF\xBB\xBF");
            fputcsv($file, ['Nama', 'Email', 'No. HP', 'NIK', 'Alamat', 'Total Donasi', 'Jml Sponsorship', 'Status Verifikasi', 'Terdaftar']);
            foreach ($donaturs as $u) {
                fputcsv($file, [
                    $u->name,
                    $u->email,
                    $u->phone ?? '-',
                    $u->nik ?? '-',
                    $u->address ?? '-',
                    $u->donations_count,
                    $u->sponsorships_count,
                    $u->email_verified_at ? 'Terverifikasi' : 'Belum',
                    $u->created_at->format('d/m/Y'),
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    // --- REKAP ORANG TUA ASUH: filter/search/paginate data sponsorship dengan status aktif/pending/kadaluarsa, tampilkan halaman ---
    public function orangTuaAsuh(Request $request)
    {
        $query = Sponsorship::with(['fosterChild', 'user'])->latest();
        $query = $this->applyDateFilter($query, $request);

        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('donor_name', 'like', "%{$search}%")
                  ->orWhere('donor_email', 'like', "%{$search}%")
                  ->orWhere('donor_phone', 'like', "%{$search}%")
                  ->orWhere('order_id', 'like', "%{$search}%");
            });
        }

        $statusFilter = $request->get('status');
        if ($statusFilter) {
            $now = now();
            $query->where(function ($q) use ($statusFilter, $now) {
                match ($statusFilter) {
                    'aktif' => $q->where('status', 'success')
                                 ->where(function ($q2) use ($now) {
                                     $q2->whereNull('expires_at')->orWhere('expires_at', '>=', $now);
                                 }),
                    'pending' => $q->where('status', 'pending'),
                    'kadaluarsa' => $q->where(function ($q2) use ($now) {
                                     $q2->where('status', 'success')->where('expires_at', '<', $now)
                                        ->orWhere('status', 'expired');
                                 }),
                    'gagal' => $q->where('status', 'failed'),
                    default => null,
                };
            });
        }

        $sponsorships = $query->paginate(20)->withQueryString();

        $baseQuery = Sponsorship::query();
        $baseQuery = $this->applyDateFilter($baseQuery, $request);
        $totalAmount = (clone $baseQuery)->where('status', 'success')->sum('amount');
        $activeCount = (clone $baseQuery)->where('status', 'success')
            ->where(function ($q) { $q->whereNull('expires_at')->orWhere('expires_at', '>=', now()); })->count();
        $totalCount = (clone $baseQuery)->count();

        return view('admin.rekap.orang_tua_asuh', compact('sponsorships', 'totalAmount', 'activeCount', 'totalCount'));
    }

    // --- EXPORT CSV ORANG TUA ASUH: filter data sponsorship, generate & download file CSV ---
    public function orangTuaAsuhExport(Request $request)
    {
        $query = Sponsorship::with(['fosterChild', 'user'])->latest();
        $query = $this->applyDateFilter($query, $request);

        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('donor_name', 'like', "%{$search}%")
                  ->orWhere('donor_email', 'like', "%{$search}%")
                  ->orWhere('donor_phone', 'like', "%{$search}%")
                  ->orWhere('order_id', 'like', "%{$search}%");
            });
        }
        if ($statusFilter = $request->get('status')) {
            $now = now();
            $query->where(function ($q) use ($statusFilter, $now) {
                match ($statusFilter) {
                    'aktif' => $q->where('status', 'success')->where(function ($q2) use ($now) { $q2->whereNull('expires_at')->orWhere('expires_at', '>=', $now); }),
                    'pending' => $q->where('status', 'pending'),
                    'kadaluarsa' => $q->where(function ($q2) use ($now) { $q2->where('status', 'success')->where('expires_at', '<', $now)->orWhere('status', 'expired'); }),
                    'gagal' => $q->where('status', 'failed'),
                    default => null,
                };
            });
        }

        $sponsorships = $query->get();
        $filename = 'rekap-orang-tua-asuh-' . now()->format('Y-m-d') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename={$filename}",
        ];

        $callback = function () use ($sponsorships) {
            $file = fopen('php://output', 'w');
            fwrite($file, "\xEF\xBB\xBF");
            fputcsv($file, ['Order ID', 'Donatur', 'Email', 'No. HP', 'Anak Asuh', 'Paket', 'Nominal', 'Metode', 'Status', 'Mulai', 'Berakhir']);
            foreach ($sponsorships as $s) {
                $isExpired = $s->expires_at && $s->expires_at->isPast();
                $label = match(true) {
                    $s->status == 'pending' => 'Pending',
                    $s->status == 'success' && !$isExpired => 'Aktif',
                    $s->status == 'success' && $isExpired => 'Kadaluarsa',
                    $s->status == 'expired' => 'Kadaluarsa',
                    default => 'Gagal',
                };
                fputcsv($file, [
                    $s->order_id,
                    $s->donor_name,
                    $s->donor_email,
                    $s->donor_phone ?? '-',
                    $s->fosterChild?->name ?? '-',
                    $s->package ?? '-',
                    $s->amount,
                    $s->payment_method ?? '-',
                    $label,
                    $s->starts_at ? $s->starts_at->format('d/m/Y') : '-',
                    $s->expires_at ? $s->expires_at->format('d/m/Y') : '-',
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    // --- EXPORT PDF DONASI: filter data donasi, generate & download file PDF landscape ---
    public function donasiExportPdf(Request $request)
    {
        $query = Donation::with(['campaign', 'user'])->latest();
        $query = $this->applyDateFilter($query, $request);

        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('donor_name', 'like', "%{$search}%")
                  ->orWhere('donor_email', 'like', "%{$search}%")
                  ->orWhere('order_id', 'like', "%{$search}%");
            });
        }
        if ($status = $request->get('status')) {
            $query->where('status', $status);
        }

        $donations = $query->get();
        $totalAmount = $donations->where('status', 'success')->sum('amount');

        $pdf = Pdf::loadView('admin.rekap.donasi_pdf', compact('donations', 'totalAmount'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->download('rekap-donasi-' . now()->format('Y-m-d') . '.pdf');
    }

    // --- EXPORT PDF DONATUR: filter data donatur, generate & download file PDF landscape ---
    public function donaturExportPdf(Request $request)
    {
        $query = User::where('role', 'donatur')->withCount(['donations', 'sponsorships'])->latest();
        $query = $this->applyDateFilter($query, $request);

        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('nik', 'like', "%{$search}%");
            });
        }

        $donaturs = $query->get();
        $totalDonasiAll = Donation::where('status', 'success')->sum('amount');
        $totalSponsorshipAll = Sponsorship::where('status', 'success')->count();

        $pdf = Pdf::loadView('admin.rekap.donatur_pdf', compact('donaturs', 'totalDonasiAll', 'totalSponsorshipAll'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->download('rekap-donatur-' . now()->format('Y-m-d') . '.pdf');
    }

    // --- EXPORT PDF ORANG TUA ASUH: filter data sponsorship, generate & download file PDF landscape ---
    public function orangTuaAsuhExportPdf(Request $request)
    {
        $query = Sponsorship::with(['fosterChild', 'user'])->latest();
        $query = $this->applyDateFilter($query, $request);

        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('donor_name', 'like', "%{$search}%")
                  ->orWhere('donor_email', 'like', "%{$search}%")
                  ->orWhere('donor_phone', 'like', "%{$search}%")
                  ->orWhere('order_id', 'like', "%{$search}%");
            });
        }
        if ($statusFilter = $request->get('status')) {
            $now = now();
            $query->where(function ($q) use ($statusFilter, $now) {
                match ($statusFilter) {
                    'aktif' => $q->where('status', 'success')->where(function ($q2) use ($now) { $q2->whereNull('expires_at')->orWhere('expires_at', '>=', $now); }),
                    'pending' => $q->where('status', 'pending'),
                    'kadaluarsa' => $q->where(function ($q2) use ($now) { $q2->where('status', 'success')->where('expires_at', '<', $now)->orWhere('status', 'expired'); }),
                    'gagal' => $q->where('status', 'failed'),
                    default => null,
                };
            });
        }

        $sponsorships = $query->get();
        $totalAmount = $sponsorships->where('status', 'success')->sum('amount');

        $pdf = Pdf::loadView('admin.rekap.orang_tua_asuh_pdf', compact('sponsorships', 'totalAmount'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->download('rekap-orang-tua-asuh-' . now()->format('Y-m-d') . '.pdf');
    }
}
