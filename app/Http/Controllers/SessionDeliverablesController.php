<?php

namespace App\Http\Controllers;

use App\Models\session_deliverables;
use App\Models\Sessions;
use Illuminate\Http\Request;

class SessionDeliverablesController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function __construct()
    {
        $this->middleware('permission:View Session Deliverables')->only('index');

    }
    public function index()
    {
        return view('session_deliverables.index');
    }

    public function getDeliverablesData(Request $request)
    {
        if ($request->ajax()) {
            try {
                // Fetch sessions with joined tables for the related names
                $sessions = \DB::table('sessions')->get();
    
                return datatables()->of($sessions)
                    ->addIndexColumn() // Adds automatic row numbering
    
                    // Checkbox column
                    ->addColumn('checkbox', function ($row) {
                        return '<input type="checkbox" class="form-check-input session-checkbox" value="' . $row->id . '">';
                    })
    
                    // Session Name column
                    ->addColumn('name', function ($row) {
                        return $row->name;
                    })
    
                    // Add Deliverables button column
                    ->addColumn('add_deliverables', function ($row) {
                        // Pass session_id in the route as a parameter
                        return '<a href="'.route('sessions.add_deliverables', ['session_id' => $row->id]).'" class="btn btn-primary btn-sm">Add Deliverables</a>';
                    })
                    
    
                    
    
                    ->rawColumns(['checkbox', 'add_deliverables']) // Make columns raw HTML
                    ->make(true);
            } catch (\Exception $e) {
                // Log the error and return a server error response
                \Log::error('Error fetching sessions data: ' . $e->getMessage());
                return response()->json(['error' => 'Unable to fetch data'], 500);
            }
        }
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create($session_id)
{
    // Fetch the session using the session_id or handle logic
    $session = Sessions::find($session_id);

    // Ensure the session is found and then handle the rest of the logic
    if ($session) {
        return view('session_deliverables.create',compact('session'));
    } else {
        return redirect()->back()->withErrors('Session not found.');
    }
}


    public function storeSessionDeliverables(Request $request)
    {
        // Validate the incoming request to ensure files are uploaded
        $request->validate([
            'deliverables.*' => 'required|file', // Accepts all file types
        ]);
        

        // Retrieve the necessary data from the request
        $regionId = $request->input('region_id');
        $programId = $request->input('program_id');
        $userId = $request->input('user');
        $sessionId = $request->input('session_id');

        // Define the base directory path for storing deliverables
        $baseDirectory = public_path("regions/user_{$userId}_region_{$regionId}/program_{$programId}_session_{$sessionId}");

        // Create the directories if they don't exist
        if (!file_exists($baseDirectory)) {
            mkdir($baseDirectory, 0777, true); // Recursive directory creation
        }

        // Handle file uploads
        if ($request->hasFile('deliverables')) {
            $uploadedFiles = $request->file('deliverables');

            foreach ($uploadedFiles as $file) {
                // Get the original file name and prepend a timestamp to avoid conflicts
                $fileName = time() . '_' . $file->getClientOriginalName();

                // Move the file to the created directory
                $file->move($baseDirectory, $fileName);

                // Store the file path in the database
                session_deliverables::create([
                    'session_id' => $sessionId,
                    'path' => "regions/user_{$userId}_region_{$regionId}/program_{$programId}_session_{$sessionId}/{$fileName}",
                ]);
            }
        }

        // Redirect or return a response
        return redirect()->route('session_deliverables.index')->with('success', 'Deliverables added successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
