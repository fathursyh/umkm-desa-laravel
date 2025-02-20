<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UmkmController extends Controller
{
    public function index()
    {
        $umkm_users = User::where('role', 'umkm')->get();
        return view('admin.umkm.index', compact('umkm_users'));
    }

    public function show($id)
    {
        $umkm = User::with('products.images')->findOrFail($id);
        return view('admin.umkm.show', compact('umkm'));
    }

    public function approve($id)
    {
        $umkm = User::findOrFail($id);
        $umkm->update(['status' => 'approved']);


        return redirect()->route('admin.umkm.index')
            ->with('success', 'UMKM has been approved successfully');
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => 'required|string'
        ]);

        $umkm = User::findOrFail($id);
        $umkm->update([
            'status' => 'rejected',
            'rejection_reason' => $request->rejection_reason
        ]);

        return redirect()->route('admin.umkm.index')
            ->with('success', 'UMKM has been rejected');
    }
}
