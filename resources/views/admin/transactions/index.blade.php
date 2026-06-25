<x-app-layout>
    <!-- MENGGUNAKAN LAYOUT FULL SCREEN SAAS -->
    <div class="flex h-screen bg-[#F8FAFC] font-sans overflow-hidden text-[#0F172A]">
        
        <!-- SIDEBAR MODERN -->
        <aside class="w-64 bg-white border-r border-slate-200 flex flex-col hidden md:flex z-20 shadow-[4px_0_24px_rgba(0,0,0,0.02)]">
            <div class="h-16 flex items-center px-6 border-b border-slate-100">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-[#2563EB] flex items-center justify-center shadow-lg shadow-blue-500/30">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <span class="text-xl font-black tracking-tight text-[#0F172A]">Yayasan<span class="text-[#2563EB]">Hub</span></span>
                </div>
            </div>
            
            <div class="flex-1 overflow-y-auto py-6 px-4 flex flex-col gap-1.5">
                <p class="px-2 text-xs font-bold text-[#64748B] uppercase tracking-wider mb-2">Main Menu</p>
                
                <a href="#" class="flex items-center gap-3 px-3 py-2.5 text-[#64748B] hover:bg-slate-50 hover:text-[#0F172A] rounded-xl font-medium transition-all group">
                    <svg class="w-5 h-5 group-hover:text-[#2563EB] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Dashboard Overview
                </a>
                
                <a href="#" class="flex items-center gap-3 px-3 py-2.5 text-[#64748B] hover:bg-slate-50 hover:text-[#0F172A] rounded-xl font-medium transition-all group">
                    <svg class="w-5 h-5 group-hover:text-[#2563EB] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    Manajemen User
                </a>

                <!-- MENU AKTIF: Manajemen Donasi -->
                <a href="#" class="flex items-center gap-3 px-3 py-2.5 bg-[#2563EB]/10 text-[#2563EB] rounded-xl font-semibold transition-all relative">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Manajemen Donasi
                    <span class="absolute right-3 bg-[#2563EB] text-white text-[10px] font-bold px-2 py-0.5 rounded-full">{{ $donations->where('status', 'pending')->count() }}</span>
                </a>

                <a href="#" class="flex items-center gap-3 px-3 py-2.5 text-[#64748B] hover:bg-slate-50 hover:text-[#0F172A] rounded-xl font-medium transition-all group">
                    <svg class="w-5 h-5 group-hover:text-[#2563EB] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    Orang Tua Asuh
                </a>
            </div>
            
            <div class="p-4 border-t border-slate-200">
                <div class="flex items-center gap-3 p-2 hover:bg-slate-50 rounded-xl cursor-pointer transition">
                    <img src="https://ui-avatars.com/api/?name=Admin&background=f8fafc&color=0f172a&rounded=true&bold=true" class="w-10 h-10 rounded-full border border-slate-200" alt="Admin">
                    <div class="flex-1 overflow-hidden">
                        <p class="text-sm font-bold text-[#0F172A] truncate">Admin Pusat</p>
                        <p class="text-xs text-[#64748B] truncate">admin@yayasan.org</p>
                    </div>
                </div>
            </div>
        </aside>

        <!-- MAIN CONTENT AREA -->
        <div class="flex-1 flex flex-col overflow-hidden relative">
            
            <!-- TOP NAVBAR -->
            <header class="h-16 bg-white/80 backdrop-blur-md border-b border-slate-200 flex items-center justify-between px-6 z-10 sticky top-0">
                <div class="flex items-center gap-4">
                    <button class="md:hidden text-[#64748B] hover:text-[#0F172A]">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                    <!-- Global Search Nav -->
                    <div class="relative hidden sm:block w-64 lg:w-96">
                        <svg class="w-4 h-4 absolute left-3 top-2.5 text-[#64748B]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        <input type="text" placeholder="Pencarian cepat (Ctrl+K)" class="w-full pl-9 pr-4 py-1.5 bg-[#F8FAFC] border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-[#2563EB]/20 focus:border-[#2563EB] focus:bg-white transition-all outline-none">
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <button class="relative p-2 text-[#64748B] hover:text-[#0F172A] transition bg-slate-50 hover:bg-slate-100 rounded-full">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                    </button>
                </div>
            </header>

            <!-- SCROLLABLE CONTENT -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-[#F8FAFC] p-6 lg:p-8">
                
                <!-- TOAST NOTIFICATION -->
                @if(session('success'))
                    <div id="toast-success" class="fixed top-20 right-8 z-50 flex items-center w-full max-w-sm p-4 text-[#0F172A] bg-white rounded-xl shadow-xl border border-slate-100" style="animation: slideDown 0.4s ease-out forwards;" role="alert">
                        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-[#10B981] bg-[#10B981]/10 rounded-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <div class="ml-3 text-sm font-bold">{{ session('success') }}</div>
                        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-[#64748B] hover:text-[#EF4444] rounded-lg p-1.5 hover:bg-slate-50 inline-flex h-8 w-8 transition" onclick="document.getElementById('toast-success').remove()">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>
                @endif
                <style>@keyframes slideDown { from { transform: translateY(-20px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }</style>

                <!-- PAGE HEADER -->
                <div class="mb-6 flex flex-col sm:flex-row sm:items-end justify-between gap-4">
                    <div>
                        <nav class="flex text-sm text-[#64748B] font-medium mb-1.5">
                            <ol class="flex items-center space-x-2">
                                <li><a href="#" class="hover:text-[#2563EB] transition">Dashboard</a></li>
                                <li><span class="mx-2">/</span></li>
                                <li class="text-[#0F172A]">Manajemen Donasi</li>
                            </ol>
                        </nav>
                        <h1 class="text-2xl font-black text-[#0F172A] tracking-tight">Manajemen Donasi</h1>
                        <p class="text-[#64748B] mt-1 text-sm">Kelola semua transaksi donasi yang masuk ke sistem yayasan.</p>
                    </div>
                    
                    <!-- Tombol Aksi Premium -->
                    <div class="flex gap-3">
                        <button class="px-4 py-2 text-sm font-semibold text-[#0F172A] bg-white border border-slate-200 rounded-xl hover:bg-slate-50 transition shadow-sm flex items-center gap-2">
                            <svg class="w-4 h-4 text-[#64748B]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            Export CSV
                        </button>
                    </div>
                </div>

                <!-- TABLE SECTION (SaaS Grade) -->
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden flex flex-col">
                    
                    <!-- TOOLBAR (Search & Filters) -->
                    <div class="p-4 border-b border-slate-200 flex flex-col lg:flex-row gap-4 items-center justify-between bg-white">
                        
                        <!-- Search Box Modern -->
                        <div class="relative w-full lg:w-80">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <svg class="h-4 w-4 text-[#64748B]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                            <input type="text" id="tableSearch" class="block w-full pl-10 pr-3 py-2 border border-slate-200 rounded-xl leading-5 bg-[#F8FAFC] placeholder-[#64748B] text-sm text-[#0F172A] focus:outline-none focus:bg-white focus:ring-2 focus:ring-[#2563EB]/20 focus:border-[#2563EB] transition-all" placeholder="Cari nama, email, order ID...">
                        </div>

                        <!-- Filters Dropdown -->
                        <div class="flex gap-3 w-full lg:w-auto">
                            <!-- Status Filter -->
                            <div class="relative w-full lg:w-40">
                                <select id="statusFilter" class="appearance-none block w-full pl-3 pr-10 py-2 text-sm font-semibold text-[#0F172A] bg-white border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#2563EB]/20 focus:border-[#2563EB] cursor-pointer transition">
                                    <option value="all">Semua Status</option>
                                    <option value="success">Sukses</option>
                                    <option value="pending">Tertunda</option>
                                    <option value="gagal">Gagal</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-[#64748B]">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                            </div>
                            <!-- Waktu Filter -->
                            <div class="relative w-full lg:w-40">
                                <select id="timeFilter" class="appearance-none block w-full pl-3 pr-10 py-2 text-sm font-semibold text-[#0F172A] bg-white border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#2563EB]/20 focus:border-[#2563EB] cursor-pointer transition">
                                    <option value="all">Semua Waktu</option>
                                    <option value="today">Hari Ini</option>
                                    <option value="week">Minggu Ini</option>
                                    <option value="month">Bulan Ini</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-[#64748B]">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TABLE CONTENT -->
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <!-- STICKY HEADER -->
                            <thead class="bg-[#F8FAFC] border-b border-slate-200 text-[#64748B] sticky top-0 z-10">
                                <tr>
                                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider whitespace-nowrap cursor-pointer hover:text-[#0F172A] transition group">
                                        Donatur & Program
                                        <svg class="inline w-3 h-3 ml-1 opacity-0 group-hover:opacity-100" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"></path></svg>
                                    </th>
                                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider whitespace-nowrap cursor-pointer hover:text-[#0F172A] transition group">
                                        Nominal Transaksi
                                    </th>
                                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-center whitespace-nowrap">
                                        Status
                                    </th>
                                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider whitespace-nowrap text-right">
                                        Tanggal Dibuat
                                    </th>
                                    <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-center whitespace-nowrap">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            
                            <tbody id="tableBody" class="divide-y divide-slate-100 bg-white">
                                @forelse($donations as $donation)
                                    <!-- BARIS DATA DENGAN HOVER MODERN -->
                                    <tr class="hover:bg-[#F8FAFC] transition-colors duration-200 data-row group" 
                                        data-search="{{ strtolower($donation->donor_name . ' ' . $donation->donor_email . ' ' . $donation->order_id) }}"
                                        data-status="{{ strtolower($donation->status == 'cancel' ? 'gagal' : $donation->status) }}"
                                        data-date="{{ $donation->created_at ? $donation->created_at->format('Y-m-d') : '' }}">
                                        
                                        <!-- KOLOM 1: Donatur -->
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center gap-3">
                                                <img class="h-10 w-10 rounded-full border border-slate-200 object-cover" src="https://ui-avatars.com/api/?name={{ urlencode($donation->donor_name) }}&background=f1f5f9&color=0f172a&rounded=true&bold=true" alt="Avatar">
                                                <div>
                                                    <div class="text-sm font-bold text-[#0F172A]">{{ $donation->donor_name }}</div>
                                                    <div class="text-xs text-[#64748B] mb-1">{{ $donation->donor_email }}</div>
                                                    <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-bold bg-slate-100 text-[#64748B] border border-slate-200">
                                                        {{ $donation->campaign->title ?? 'Program Dihapus' }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>

                                        <!-- KOLOM 2: Nominal -->
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-black text-[#0F172A]">
                                                Rp {{ number_format($donation->amount, 0, ',', '.') }}
                                            </div>
                                            <div class="text-[11px] font-mono font-semibold text-[#64748B] mt-1 flex items-center gap-1">
                                                <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path></svg>
                                                {{ $donation->order_id ?? '-' }}
                                            </div>
                                        </td>

                                        <!-- KOLOM 3: Status Badge -->
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            @if($donation->status == 'success')
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold bg-[#10B981]/10 text-[#10B981] border border-[#10B981]/20">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-[#10B981] mr-1.5"></span> Sukses
                                                </span>
                                            @elseif($donation->status == 'pending')
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold bg-[#F59E0B]/10 text-[#F59E0B] border border-[#F59E0B]/20">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-[#F59E0B] mr-1.5 animate-pulse"></span> Tertunda
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold bg-[#EF4444]/10 text-[#EF4444] border border-[#EF4444]/20">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-[#EF4444] mr-1.5"></span> Gagal
                                                </span>
                                            @endif
                                        </td>

                                        <!-- KOLOM 4: Tanggal -->
                                        <td class="px-6 py-4 whitespace-nowrap text-right">
                                            <div class="text-sm font-semibold text-[#0F172A]">
                                                {{ $donation->created_at ? $donation->created_at->format('d M Y') : '-' }}
                                            </div>
                                            <div class="text-xs font-medium text-[#64748B] mt-0.5">
                                                {{ $donation->created_at ? $donation->created_at->format('H:i') . ' WIB' : '' }}
                                            </div>
                                        </td>

                                        <!-- KOLOM 5: Aksi (Hover muncul) -->
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <form action="{{ route('admin.transactions.destroy', $donation->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data donasi ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <!-- Tombol Delete bergaya modern, background transparan saat diam, merah saat dihover -->
                                                <button type="submit" class="p-2 text-[#64748B] hover:text-[#EF4444] hover:bg-[#EF4444]/10 rounded-lg transition-all focus:ring-2 focus:ring-[#EF4444]/20 outline-none" title="Hapus Data">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <!-- EMPTY STATE DESIGN -->
                                    <tr id="emptyInitRow">
                                        <td colspan="5" class="px-6 py-20 text-center">
                                            <div class="flex flex-col items-center justify-center">
                                                <div class="w-16 h-16 bg-[#F8FAFC] border border-slate-100 rounded-2xl flex items-center justify-center mb-4 shadow-sm">
                                                    <svg class="w-8 h-8 text-[#64748B]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                                </div>
                                                <h3 class="text-lg font-bold text-[#0F172A]">Belum Ada Data Transaksi</h3>
                                                <p class="text-sm text-[#64748B] mt-1">Data donasi yang masuk ke Midtrans akan muncul di sini.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                                
                                <!-- BARIS JIKA PENCARIAN KOSONG -->
                                <tr id="noResultRow" class="hidden">
                                    <td colspan="5" class="px-6 py-20 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg class="w-12 h-12 text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                            <h3 class="text-base font-bold text-[#0F172A]">Data Tidak Ditemukan</h3>
                                            <p class="text-sm text-[#64748B] mt-1">Coba gunakan kata kunci pencarian yang lain.</p>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- PAGINATION FOOTER -->
                    <div class="px-6 py-4 border-t border-slate-200 bg-white flex flex-col sm:flex-row justify-between items-center gap-4">
                        <div id="paginationInfo" class="text-sm text-[#64748B]">
                            Menampilkan <span class="font-bold text-[#0F172A]">0</span> hasil
                        </div>
                        <div class="flex items-center gap-2">
                            <button id="prevBtn" class="px-4 py-2 border border-slate-200 rounded-lg text-sm font-semibold text-[#0F172A] bg-white hover:bg-[#F8FAFC] transition disabled:opacity-50 disabled:cursor-not-allowed">
                                Previous
                            </button>
                            <div id="pageNumbers" class="flex gap-1 hidden sm:flex"></div>
                            <button id="nextBtn" class="px-4 py-2 border border-slate-200 rounded-lg text-sm font-semibold text-[#0F172A] bg-white hover:bg-[#F8FAFC] transition disabled:opacity-50 disabled:cursor-not-allowed">
                                Next
                            </button>
                        </div>
                    </div>

                </div>
            </main>
        </div>
    </div>

    <!-- JAVASCRIPT UNTUK FILTER, SEARCH & PAGINATION -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const rowsPerPage = 5; 
            let currentPage = 1;
            
            const searchInput = document.getElementById('tableSearch');
            const statusFilter = document.getElementById('statusFilter');
            const timeFilter = document.getElementById('timeFilter');
            const allRows = Array.from(document.querySelectorAll('.data-row'));
            const noResultRow = document.getElementById('noResultRow');
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');
            const pageNumbersContainer = document.getElementById('pageNumbers');
            const paginationInfo = document.getElementById('paginationInfo');

            let filteredRows = [...allRows];

            function checkDateMatch(rowDateStr, filterValue) {
                if (filterValue === 'all') return true;
                if (!rowDateStr) return false;
                const today = new Date(); today.setHours(0,0,0,0);
                const rowDate = new Date(rowDateStr); rowDate.setHours(0,0,0,0);
                const diffDays = Math.ceil((today - rowDate) / (1000 * 60 * 60 * 24));
                if (filterValue === 'today') return diffDays === 0;
                if (filterValue === 'week') return diffDays >= 0 && diffDays <= 7;
                if (filterValue === 'month') return diffDays >= 0 && diffDays <= 30;
                return true;
            }

            function updateTable() {
                const totalRows = filteredRows.length;
                
                if (totalRows === 0) {
                    noResultRow.classList.remove('hidden');
                    paginationInfo.innerHTML = "Menampilkan <span class='font-bold text-[#0F172A]'>0</span> hasil";
                    prevBtn.disabled = true; nextBtn.disabled = true;
                    pageNumbersContainer.innerHTML = '';
                    allRows.forEach(r => r.classList.add('hidden'));
                    return;
                } else {
                    noResultRow.classList.add('hidden');
                }

                const totalPages = Math.ceil(totalRows / rowsPerPage);
                if (currentPage > totalPages) currentPage = totalPages;
                if (currentPage < 1) currentPage = 1;

                const startIdx = (currentPage - 1) * rowsPerPage;
                const endIdx = Math.min(startIdx + rowsPerPage, totalRows);

                allRows.forEach(r => r.classList.add('hidden'));
                for (let i = startIdx; i < endIdx; i++) {
                    filteredRows[i].classList.remove('hidden');
                }

                paginationInfo.innerHTML = `Menampilkan <span class="font-bold text-[#0F172A]">${startIdx + 1} - ${endIdx}</span> dari <span class="font-bold text-[#0F172A]">${totalRows}</span> hasil`;
                prevBtn.disabled = (currentPage === 1);
                nextBtn.disabled = (currentPage === totalPages);

                pageNumbersContainer.innerHTML = '';
                for (let i = 1; i <= totalPages; i++) {
                    const btn = document.createElement('button');
                    btn.textContent = i;
                    // Styling tombol nomor halaman ala SaaS
                    btn.className = `w-9 h-9 rounded-lg text-sm font-semibold transition ${i === currentPage ? 'bg-[#2563EB] text-white' : 'text-[#64748B] hover:bg-[#F8FAFC]'}`;
                    btn.addEventListener('click', () => { currentPage = i; updateTable(); });
                    pageNumbersContainer.appendChild(btn);
                }
            }

            function applyFilters() {
                const query = searchInput.value.toLowerCase().trim();
                const stat = statusFilter.value;
                const time = timeFilter.value;

                filteredRows = allRows.filter(row => {
                    let textMatch = row.getAttribute('data-search').includes(query);
                    let statMatch = (stat === 'all') ? true : row.getAttribute('data-status') === stat;
                    let timeMatch = checkDateMatch(row.getAttribute('data-date'), time);
                    
                    return textMatch && statMatch && timeMatch;
                });

                currentPage = 1; 
                updateTable();
            }

            searchInput.addEventListener('input', applyFilters);
            statusFilter.addEventListener('change', applyFilters);
            timeFilter.addEventListener('change', applyFilters);
            prevBtn.addEventListener('click', () => { if (currentPage > 1) { currentPage--; updateTable(); } });
            nextBtn.addEventListener('click', () => { if (currentPage < Math.ceil(filteredRows.length / rowsPerPage)) { currentPage++; updateTable(); } });

            updateTable();
        });
    </script>
</x-app-layout>