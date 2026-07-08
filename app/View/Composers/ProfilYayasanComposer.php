<?php

namespace App\View\Composers;

use App\Models\ProfilYayasan;
use Illuminate\View\View;

class ProfilYayasanComposer
{
    protected $profil;

    public function __construct()
    {
        $this->profil = ProfilYayasan::first();
    }

    public function compose(View $view): void
    {
        $view->with('profil', $this->profil);
    }
}
