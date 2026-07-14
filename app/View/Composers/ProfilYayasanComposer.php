<?php

namespace App\View\Composers;

use App\Models\ProfilYayasan;
use Illuminate\View\View;

class ProfilYayasanComposer
{
    public function compose(View $view): void
    {
        $view->with('profil', ProfilYayasan::first());
    }
}
