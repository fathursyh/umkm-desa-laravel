<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class PresentationController extends Controller
{
    public function tentang()
    {
        return view('presentation.tentang');
    }

    public function umkm()
    {
        $umkm = User::where('role', 'umkm')->get();
        return view('presentation.umkm', compact('umkm'));
    }

    public function productview($id)
    {
        $productview = User::with('products.images')->findOrFail($id);
        return view('presentation.productview', compact('productview'));
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
