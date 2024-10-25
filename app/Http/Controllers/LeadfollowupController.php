<?php

namespace App\Http\Controllers;

use App\Models\LeadFollowUp;
use Illuminate\Http\Request;
use App\Models\Lead;

class LeadfollowupController extends Controller
{
    public function store(Request $request, $id)
{
    $validated = $request->validate([
        'notes' => 'required',
        'status' => 'required|in:follow_up,final_proposal'
    ]);

    $validated['lead_id'] = $id;

    $leadfollowup = LeadFollowUp::create($validated);

    $lead = Lead::findOrFail($id);
        $lead->update([
            'status' => $request->input('status')
        ]);

    return response()->json(['message' => 'Lead Follow Up has been sent', 'leadfollowup' => $leadfollowup]);
}
}
