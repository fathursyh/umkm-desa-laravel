<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class SubmissionController extends Controller
{
    public function index()
    {
        $submissions = Auth::user()->submissions()->latest()->get();
        return view('umkm.submissions.index', compact('submissions'));
    }

    public function create()
    {
        return view('umkm.submissions.create', [
            'submition_count' => Auth::user()->submissions->count() >= 10,
        ]);
    }

    public function store(Request $request)
    {
        // Check if user is not admin
        if (Auth::user()->role === 'admin' || Auth::user()->submissions->count() >= 10) {
            abort(403);
        }

        $request->validate([
            'tujuan_pengajuan' => 'required|string|min:1|max:255',
            'pendapatan_bulan' => 'required|numeric|decimal:0,2|min:0|max:9999999999999.99',
            'application_letter' => 'required|file|mimes:pdf|max:5120',
            'rab_document' => 'required|file|mimes:pdf|max:5120',
        ]);

        $submission = new Submission($request->except(['application_letter', 'rab_document']));
        $submission->user_id = Auth::id();

        // Handle file uploads
        $submission->application_letter = $request->file('application_letter')->store('submissions', 'public');
        $submission->rab_document = $request->file('rab_document')->store('submissions', 'public');

        $submission->save();

        return redirect()->route('submissions.index')
            ->with('success', 'Submission created successfully');
    }

    public function show(Submission $submission)
    {
        // Check if user owns this submission or is admin
        if ($submission->user_id !== Auth::id() && Auth::user()->role !== 'admin') {
            abort(403);
        }

        return view('umkm.submissions.show', compact('submission'));
    }
}
