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
        return view('umkm.submissions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'umkm_name' => 'required|string',
            'establishment_date' => 'required|date',
            'business_type' => 'required|string',
            'description' => 'required|string',
            'application_letter' => 'required|mimes:pdf|max:5120',
            'rab_document' => 'required|mimes:pdf|max:5120',
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
