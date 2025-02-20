<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Submission;
use App\Notifications\SubmissionStatusChanged;
use Carbon\Carbon;

class AdminSubmissionController extends Controller
{
    public function index(Request $request)
    {
        $query = Submission::query();

        // Filter by Status
        if ($request->status) {
            $query->where('status', $request->status);
        }

        // Get paginated results
        $submissions = $query->latest()->paginate(10)->withQueryString();

        // Get counts for stats
        $stats = [
            'total' => Submission::count(),
            'pending' => Submission::where('status', 'pending')->count(),
            'approved' => Submission::where('status', 'approved')->count(),
            'rejected' => Submission::where('status', 'rejected')->count(),
        ];

        return view('admin.submissions.index', compact('submissions', 'stats'));
    }

    public function show(Submission $submission)
    {
        return view('admin.submissions.show', compact('submission'));
    }

    public function approve(Submission $submission)
    {
        $submission->update(['status' => 'approved']);
        return back()->with('success', 'Submission approved');
    }

    public function reject(Request $request, Submission $submission)
    {
        $request->validate([
            'admin_notes' => 'required|string'
        ]);

        $submission->update([
            'status' => 'rejected',
            'admin_notes' => $request->admin_notes
        ]);

        return back()->with('success', 'Submission rejected');
    }

    public function requestRevision(Request $request, Submission $submission)
    {
        $validated = $request->validate([
            'admin_notes' => 'required|string|max:1000'
        ]);

        $submission->update([
            'status' => 'revision',
            'admin_notes' => $validated['admin_notes']
        ]);

        $submission->user->notify(new SubmissionStatusChanged($submission));

        return back()->with('success', 'Revision requested.');
    }
}
