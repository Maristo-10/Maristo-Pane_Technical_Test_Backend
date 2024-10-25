<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lead;
use App\Models\Salesperson;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class LeadController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
        ]);

        $lead = Lead::create($validated);

        $salesperson = $this->getNextSalesperson();
        $lead->salesperson_id = $salesperson->id;
        $lead->save();

        return response()->json(['message' => 'Lead created and assigned to salesperson', 'lead' => $lead]);
    }

    private function getNextSalesperson()
    {
        $salesperson = Salesperson::where('is_penalized', false)
            ->orderBy('last_assigned', 'asc')
            ->first();

        $salesperson->update([
            'last_assigned' => Carbon::now()
        ]);

        return $salesperson;
    }

    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required'
        ]);

        $lead = Lead::findOrFail($id);

        $lead->update([
            'status' => $validated['status']
        ]);

        if($validated['status'] === 'deal'){
            $defaultPassword = 'Leads123';
            if (!User::where('email', $lead->email)->exists()) {
                $defaultPassword = 'Leads123';

                $user = User::create([
                    'name' => $lead->name,
                    'email' => $lead->email,
                    'password' => Hash::make($defaultPassword),
                ]);
            }
        }

        return response()->json(['message' => 'Lead status updated', 'lead' => $lead]);
    }

    public function transferLead(Request $request, $id)
    {
        $lead = Lead::findOrFail($id);
        $lead->update([
            'salesperson_id' =>  $request->input('salesperson_id')
        ]);

        return response()->json(['message' => 'Lead transferred', 'lead' => $lead]);
    }
}
