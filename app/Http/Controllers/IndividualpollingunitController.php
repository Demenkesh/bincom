<?php

namespace App\Http\Controllers;

use App\Models\lga;
use Illuminate\Support\Str;
use App\Models\polling_unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\announced_pu_results;

class IndividualpollingunitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $pollingunit = polling_unit::get();
        return view('welcome');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function getPollingUnitResults(Request $request)
    {
        $pollingUnitId =  $request->input('polling_unit_id');

        if ($pollingUnitId) {
            $results = polling_unit::where('polling_unit_id', $pollingUnitId)->first();
        } else {
            return response()->json(['error' => 'Please provide a polling unit ID or select an LGA.']);
        }

        return response()->json(['results' => $results,]);
    }

    public function summedview()
    {
        $lga = lga::all();
        return view('summedview', compact('lga'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function summed(Request $request)
    {
        try {
            $lgaId =  $request->input('lga');

            // Query the database to sum the total result of all polling units under the selected LGA
            $summedTotal = DB::table('polling_unit')
                ->where('lga_id', $lgaId)
                ->sum('polling_unit_id'); // Adjust this based on your database schema
            // dd($summedTotal);
            // Return the summed total as a JSON response
            return response()->json(['summed_total' => $summedTotal]);
        } catch (\Exception $e) {
            // Handle any exceptions and return an error response
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function showNewPollingUnitForm()
    {
        return view('new_polling_unit');
    }

    public function storeNewPollingUnitData(Request $request)
    {
        try {
            // Validate the form data
            $validatedData = $request->validate([
                'result_id' => 'required|numeric',
                'polling_unit_uniqueid' => 'required|numeric',
                'party_abbreviation' => 'required|string|max:255',
                'party_score' => 'required|numeric',
                'entered_by_user' => 'required|string|max:255',
            ]);

            // Create a new instance of AnnouncedPuResult model
            $result = new announced_pu_results();
            $result->result_id = $validatedData['result_id'];
            $result->polling_unit_uniqueid = $validatedData['polling_unit_uniqueid'];
            // Trim input to fit within column length
            $partyAbbreviation = Str::substr($request->input('party_abbreviation'), 0, 3); // Adjust 50 to match column length

            // Assign trimmed value to model attribute
            $result->party_abbreviation = $partyAbbreviation;
            $result->party_score = $validatedData['party_score'];
            $result->entered_by_user = $validatedData['entered_by_user'];
            $result->date_entered = now();
            // $result->updated_at = now();
            // $result->created_at = now();
            $result->user_ip_address = $request->ip();
            // Save the data to the database
            $result->save();

            // Redirect back to the form or to a confirmation page
            return redirect()->back()->with('message', 'Data for all parties in the new polling unit has been stored successfully.');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
