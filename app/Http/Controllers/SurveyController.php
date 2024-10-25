<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Http\Request;
use App\Models\Lead;

class SurveyController extends Controller
{
    public function store(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:survey_request,survey_approved, survey_rejected, survey_completed',
            'date' => 'required',
            'survey_result' => 'required',
        ]);

        $validated['lead_id'] = $id;

        $survey = Survey::create($validated);

        $lead = Lead::findOrFail($id);
        $lead->update([
            'status' => $request->input('status')
        ]);

        return response()->json(['message' => 'Lead Follow Up has been sent', 'survey' => $survey]);
    }
}
