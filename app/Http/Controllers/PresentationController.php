<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PresentationController extends Controller
{
    public function tentang()
    {
        return view('presentation.tentang');
    }

    public function umkm()
    {
        return view('presentation.umkm');
    }

    public function staff()
    {
        return view('presentation.staff');
    }

    public function kontak()
    {
        return view('presentation.kontak');
    }
}
