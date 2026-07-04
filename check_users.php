<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;
use App\Models\Donation;
use App\Models\Sponsorship;

echo "Admin users:\n";
foreach (User::where('role', 'admin')->get() as $u) {
    echo "  {$u->id} | {$u->name} | {$u->email}\n";
}

echo "\nDonatur count: " . User::where('role', 'donatur')->count() . "\n";
echo "Donations count: " . Donation::count() . "\n";
echo "Sponsorships count: " . Sponsorship::count() . "\n";
