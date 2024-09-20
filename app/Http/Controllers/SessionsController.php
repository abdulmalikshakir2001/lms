<?php

namespace App\Http\Controllers;

use App\Models\Programs;
use App\Models\Regions;
use App\Models\Session_for;
use App\Models\Sessions;
use App\Models\User;
use Illuminate\Http\Request;
use Session;
use Validator;
use Yajra\DataTables\Services\DataTable;

class SessionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('sessions.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $programs = Programs::all();
        $trainers  = User::where('user_type','intra trainer')->get();
        $session_fors = Session_for::all();
        $regions = Regions::all();
        return view('sessions.create',compact('programs','trainers','session_fors','regions',));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[ 
            'session_name' => 'required|min:3',
        ]);

        if ($validator->passes()) {

            $session = new Sessions();
            $session->name = $request->session_name;
            $session->region_id = $request->region;
            $session->trainer = $request->trainer;
            $session->program_id = $request->program;
            $session->session_for_id = $request->session_for;
            $session->start_date = $request->start_date;
            $session->end_date = $request->end_date;
            
           
            if (!empty($request->description)) {
                $session->description = $request->description;
            }
            $session->save();  
           

            return redirect()->route('sessions.index')->with('success','Session Added successfully');
        }
        else {
            return redirect()->route('sessions.create')->withInput()->withErrors($validator);
        }
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
        $session = Sessions::findOrFail($id);
        $programs = Programs::all();
        $trainers  = User::where('user_type','intra trainer')->get();
        $session_fors = Session_for::all();
        $regions = Regions::all();
        return view('sessions.edit',compact('programs','trainers','session_fors','regions','session'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $validator = Validator::make($request->all(),[ 
            'session_name' => 'required|min:3',
        ]);

        if ($validator->passes()) {

            $session = Sessions::findOrFail($id);
            $session->name = $request->session_name;
            $session->region_id = $request->region;
            $session->trainer = $request->trainer;
            $session->program_id = $request->program;
            $session->session_for_id = $request->session_for;
            $session->start_date = $request->start_date;
            $session->end_date = $request->end_date;
            
           
            if (!empty($request->description)) {
                $session->description = $request->description;
            }
            $session->save();  
           

            return redirect()->route('sessions.index')->with('success','Session Updated successfully');
        }
        else {
            return redirect()->route('sessions.edit')->withInput()->withErrors($validator);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $session = Sessions::find($id);
        if ($session == null) {

            return redirect()->route('sessions.index')->with('error','Session Not Found');
            
        }else {
            $session->delete();
            return redirect()->route('sessions.index')->with('success','Session deleted successfully');

        }
    }


    public function getSessionsData(Request $request)
{
    if ($request->ajax()) {
        try {
            // Fetch sessions with joined tables for names
            $sessions = \DB::table('sessions')
                ->leftJoin('users', 'sessions.trainer', '=', 'users.id')
                ->leftJoin('session_fors', 'sessions.session_for_id', '=', 'session_fors.id')
                ->leftJoin('regions', 'sessions.region_id', '=', 'regions.id')
                ->leftJoin('programs', 'sessions.program_id', '=', 'programs.id')
                ->select(
                    'sessions.id',
                    'sessions.name',
                    'users.name as trainer_name',
                    'programs.name as program_name',
                    'session_fors.name as session_for_name',
                    'regions.name as region_name',
                    'sessions.start_date',
                    'sessions.end_date'
                )
                ->get();

            return datatables()->of($sessions)
                ->addIndexColumn() // Adds automatic row numbering

                // Add columns for names instead of IDs
                ->addColumn('trainer', function ($row) {
                    return $row->trainer_name;
                })
                ->addColumn('program', function ($row) {
                    return $row->program_name;
                })
                ->addColumn('session_for', function ($row) {
                    return $row->session_for_name;
                })
                ->addColumn('region', function ($row) {
                    return $row->region_name;
                })

                // Add Action column for Edit/Delete buttons
                ->addColumn('action', function ($row) {
                    return '
                    <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="'.route('sessions.details', $row->id).'">
                                <i class="bx bx-edit-alt me-1"></i> View  Details
                            </a>
                            <a class="dropdown-item" href="'.route('sessions.edit', $row->id).'">
                                <i class="bx bx-edit-alt me-1"></i> Edit
                            </a>
                            <button type="button" class="dropdown-item delete-button" data-id="' . $row->id . '" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                <i class="bx bx-trash me-1"></i> Delete
                            </button>
                        </div>
                    </div>';
                })

                ->rawColumns(['action']) // Make the action column raw HTML
                ->make(true);
        } catch (\Exception $e) {
            // Log the error and return a server error response
            \Log::error('Error fetching sessions data: '.$e->getMessage());
            return response()->json(['error' => 'Unable to fetch data'], 500);
        }
    }
}

    
    

    

    

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;

        // Delete all sessions with the specified IDs
        Sessions::whereIn('id', $ids)->delete();

        return response()->json(['success' => 'Sessions deleted successfully!']);
    }

    
    
}
