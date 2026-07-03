<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight text-emerald-600">Formulir Donasi</h2>
    </x-slot>

    <div class="py-10 px-4">
        <div class="max-w-lg mx-auto">
            <div class="card bg-base-100 shadow-xl border-t-4 border-t-emerald-600">
                <div class="card-body p-8">
                    <div class="text-center mb-8">
                        <p class="text-slate-500 text-sm">Anda akan berdonasi untuk program:</p>
                        <p class="font-bold text-emerald-600 text-lg">{{ $campaign->title }}</p>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-error mb-6">
                            <ul class="text-sm font-semibold">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('donations.store', $campaign->id) }}" method="POST">
                        @csrf

                        <div class="mb-5">
                            <label class="label label-text font-semibold text-emerald-600">Nama Lengkap</label>
                            <input type="text" class="input input-bordered w-full bg-base-200" value="{{ $user->name }}" readonly>
                        </div>

                        <div class="mb-5">
                            <label class="label label-text font-semibold text-emerald-600">Alamat Email</label>
                            <input type="email" class="input input-bordered w-full bg-base-200" value="{{ $user->email }}" readonly>
                        </div>

                        <div class="mb-8">
                            <label class="label label-text font-semibold text-emerald-600">Nominal Donasi (Rp)</label>
                            <input type="number" name="amount" min="1000" required placeholder="Masukkan nominal..."
                                   class="input input-bordered w-full font-bold text-emerald-600 text-lg">
                        </div>

                        <button type="submit" class="btn btn-success text-white font-bold w-full shadow-lg">
                            Lanjut ke Pembayaran
                        </button>

                        <div class="mt-6 text-center">
                            <a href="{{ route('dashboard') }}" class="link link-hover text-slate-400 font-medium text-sm">Kembali ke Dashboard</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
