<?php

namespace App\Http\Controllers;

use App\Models\Parents;
use App\Models\Schools;
use App\Models\Sessions;
use App\Models\Students;
use App\Models\Teachers;
use Illuminate\Http\Request;



class TeachersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('teachers.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sessions = Sessions::all();
        return view('teachers.create',compact('sessions'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validate the input
    $request->validate([
        'name' => 'required|string|max:255',      // Validate teacher's name
        'contact' => 'required|string|max:255',   // Validate contact information
        'session_id' => 'required|exists:sessions,id',  // Ensure session ID exists
    ]);

    // Retrieve the session for additional details like program_id
    $session = Sessions::find($request->input('session_id'));

    // Create a new Teacher instance
    $teacher = new Teachers();
    $teacher->name = $request->input('name');          // Set the teacher's name
    $teacher->contact = $request->input('contact');    // Set the teacher's contact
    $teacher->session_id = $request->input('session_id'); // Set the session ID
    $teacher->program_id = $session->program_id;       // Set the program ID based on the session
    $teacher->region_id = auth()->user()->region_id;   // Set region ID from the logged-in user
    $teacher->save();  // Save the teacher to the database

    // Redirect to the index page with a success message
    return redirect()->route('teachers.index')->with('success', 'Teacher added successfully.');
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
        $teacher = Teachers::findOrFail($id);
        $sessions = Sessions::all();
        return view('teachers.edit',compact('sessions','teacher'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the input data
        $request->validate([
            'name' => 'required|string|max:255',      // Teacher's name validation
            'contact' => 'required|string|max:255',   // Contact validation
            'session_id' => 'required|exists:sessions,id',  // Ensure session ID exists
        ]);

        // Find the teacher by ID
        $teacher = Teachers::findOrFail($id);

        // Find the session to get the program ID
        $session = Sessions::find($request->input('session_id'));

        // Update the teacher's details
        $teacher->name = $request->input('name');          // Update the name
        $teacher->contact = $request->input('contact');    // Update the contact
        $teacher->session_id = $request->input('session_id'); // Update session ID
        $teacher->program_id = $session->program_id;       // Update program ID based on the session
        $teacher->region_id = auth()->user()->region_id;   // Update the region ID
        $teacher->save();  // Save the updated teacher record

        // Redirect to the index page with a success message
        return redirect()->route('teachers.index')->with('success', 'Teacher updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $teachers = Teachers::find($id);
        if ($teachers == null) {

            return redirect()->route('teachers.index')->with('error','Teacher Not Found');
            
        }else {
            $teachers->delete();
            return redirect()->route('teachers.index')->with('success','Teacher deleted successfully');

        }
    }
    public function getData(Request $request)
{
    if ($request->ajax()) {
        $teachers = Teachers::select([
                'teachers.id',
                'teachers.name as teacher_name',
                'teachers.contact',  // Assuming `contact` is a column in the teachers table
                'regions.name as region_name',
                'programs.name as program_name',
                'sessions.name as session_name'
            ])
            ->leftJoin('regions', 'teachers.region_id', '=', 'regions.id')
            ->leftJoin('programs', 'teachers.program_id', '=', 'programs.id')
            ->leftJoin('sessions', 'teachers.session_id', '=', 'sessions.id')
            ->get();
        
        return datatables()->of($teachers)
            ->addIndexColumn()  // Automatically add row index (for Sr No)
            ->addColumn('action', function ($row) {
                $editUrl = route('teachers.edit', $row->id);
                
                return '
                    <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="' . $editUrl . '">
                                <i class="bx bx-edit-alt me-1"></i> Edit
                            </a>
                            <button type="button" class="dropdown-item delete-button" data-id="' . $row->id . '" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                <i class="bx bx-trash me-1"></i> Delete
                            </button>
                        </div>
                    </div>';
            })
            ->editColumn('region', function($row) {
                return $row->region_name;
            })
            ->editColumn('program', function($row) {
                return $row->program_name;
            })
            ->editColumn('session', function($row) {
                return $row->session_name;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}

    
    

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;

        // Delete all sessions with the specified IDs
        Teachers::whereIn('id', $ids)->delete();

        return response()->json(['success' => 'Students deleted successfully!']);
    }
    

}
