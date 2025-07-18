<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Forest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'forest_id' => 'required|exists:forests,id',
            'description' => 'required|string',
            'photo' => 'nullable|image|max:5120', // 5MB
            'reported_at' => 'required|date',
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('report-photos', 'public');
        }

        Report::create([
            'user_id' => Auth::id(),
            'forest_id' => $request->forest_id,
            'title' => $request->title,
            'description' => $request->description,
            'photo' => $photoPath,
            'status' => 'pending',
            'reported_at' => $request->reported_at,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Laporan berhasil dikirim. Tim kami akan segera menindaklanjuti.',
        ]);
    }
}
