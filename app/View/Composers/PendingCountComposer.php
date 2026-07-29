<?php

namespace App\View\Composers;

use App\Models\Donation;
use App\Models\Sponsorship;
use Illuminate\View\View;

class PendingCountComposer
{
    public function compose(View $view): void
    {
        $view->with('pendingCount', Donation::where('status', 'pending')->count()
            + Sponsorship::where('status', 'pending')->count());
    }
}
