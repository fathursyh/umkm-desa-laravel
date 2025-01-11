<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Submission;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return view('admin.dashboard', [
                'user' => $user,
                'submissions' => Submission::latest()->limit(5)->get(),
                'total' => Submission::count(),
                'pending' => Submission::where('status', 'pending')->count(),
                'approved' => Submission::where('status', 'approved')->count(), 
                'rejected' => Submission::where('status', 'rejected')->count()
            ]);
        }

        return view('umkm.dashboard', [
            'user' => $user,
            'submissions' => $user->submissions()->latest()->limit(5)->get(),
            'total' => $user->submissions()->count(),
            'pending' => $user->submissions()->where('status', 'pending')->count(),
            'approved' => $user->submissions()->where('status', 'approved')->count(),
            'rejected' => $user->submissions()->where('status', 'rejected')->count()
        ]);
    }
}
