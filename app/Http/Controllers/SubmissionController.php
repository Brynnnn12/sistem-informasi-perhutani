<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SubmissionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'attachment' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120', // 5MB
            'submitted_at' => 'required|date',
        ]);

        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('submission-attachments', 'public');
        }

        Submission::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'attachment' => $attachmentPath,
            'status' => 'pending',
            'submitted_at' => $request->submitted_at,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pengajuan berhasil dikirim. Mohon tunggu proses verifikasi.',
        ]);
    }
}
