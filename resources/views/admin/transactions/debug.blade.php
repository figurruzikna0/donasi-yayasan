<x-admin-layout>
<div class="max-w-7xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-black mb-6">DEBUG TRANSACTIONS</h1>

    <div class="mb-6 p-4 bg-yellow-100 border border-yellow-300 rounded-lg">
        <h2 class="font-bold text-lg">Donasi count: {{ $donations->count() }}</h2>
        <ul>
        @foreach($donations as $d)
            <li>{{ $d->donor_name }} — {{ $d->status }} — {{ $d->target }} — Rp{{ number_format($d->amount) }}</li>
        @endforeach
        </ul>
    </div>

    <div class="mb-6 p-4 bg-blue-100 border border-blue-300 rounded-lg">
        <h2 class="font-bold text-lg">Sponsor count: {{ $sponsorships->count() }}</h2>
        <ul>
        @foreach($sponsorships as $s)
            <li>{{ $s->donor_name }} — {{ $s->status }} — {{ $s->target }} — Rp{{ number_format($s->amount) }}</li>
        @endforeach
        </ul>
    </div>

    <div class="card bg-base-100 shadow-md border border-base-300">
        <div class="overflow-x-auto">
            <table class="table w-full">
                <thead>
                    <tr class="bg-base-200/40">
                        <th>Donatur</th>
                        <th>Kampanye</th>
                        <th>Nominal</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($donations as $item)
                    <tr>
                        <td class="font-bold">{{ $item->donor_name }}</td>
                        <td>{{ $item->target }}</td>
                        <td>Rp{{ number_format($item->amount, 0, ',', '.') }}</td>
                        <td><span class="badge badge-success badge-sm">{{ $item->status }}</span></td>
                    </tr>
                @empty
                    <tr><td colspan="4">KOSONG</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
</x-admin-layout>
