<?php

namespace App\Http\Controllers;

use App\Models\Parents;
use App\Models\Schools;
use App\Models\Sessions;
use App\Models\Students;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('permission:View Students')->only('index');
        $this->middleware('permission:Edit Students')->only('edit');
        $this->middleware('permission:Add Students')->only('create');
        $this->middleware('permission:Delete Students')->only('destroy');
    }
    public function index()
    {
        return view('students.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sessions = Sessions::where('region_id',auth()->user()->region_id)
        ->where('trainer',auth()->user()->id)
        ->get();
        $parents = Parents::where('region_id',auth()->user()->region_id)
        ->where('trainer_id',auth()->user()->id)
        ->get();
        $schools = Schools::where('region_id',auth()->user()->region_id)
        ->where('trainer_id',auth()->user()->id)
        ->get();
        return view('students.create',compact('sessions','parents','schools'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the input
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'required|exists:parents,id',
            'school_id' => 'required|exists:schools,id',
            'session_id' => 'required|exists:sessions,id',
        ]);
        $session = Sessions::find($request->input('session_id'));

        // Create the student
        $student = new Students();
        $student->name = $request->input('name');
        $student->parent_id = $request->input('parent_id');
        $student->school_id = $request->input('school_id');
        $student->session_id = $request->input('session_id');
        $student->program_id = $session->program_id;
        $student->region_id = auth()->user()->region_id; // Assuming the user is logged in and has a region
        $student->trainer_id = auth()->user()->id; // Assuming the user is logged in and has a region
        $student->save();

        // Redirect to the index page with a success message
        return redirect()->route('students.index')->with('success', 'Student added successfully.');
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
        if(!auth()->user()->hasRole('Super Admin')){
            $student = Students::findOrFail($id);
            $sessions = Sessions::where('region_id',auth()->user()->region_id)->get();
            $parents = Parents::where('region_id',auth()->user()->region_id)->get();
            $schools = Schools::where('region_id',auth()->user()->region_id)->get();
            return view('students.edit',compact('sessions','parents','student','schools'));
        }else{
            $student = Students::findOrFail($id);
            $sessions = Sessions::get();
            $parents = Parents::get();
            $schools = Schools::get();
            return view('students.edit',compact('sessions','parents','student','schools'));
        }


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
         // Validate the input
         $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'required|exists:parents,id',
            'school_id' => 'required|exists:schools,id',
            'session_id' => 'required|exists:sessions,id',
        ]);
        $session = Sessions::find($request->input('session_id'));

        // Create the student
        $student = Students::findOrFail($id);
        $student->name = $request->input('name');
        $student->parent_id = $request->input('parent_id');
        $student->school_id = $request->input('school_id');
        $student->session_id = $request->input('session_id');
        $student->program_id = $session->program_id;
        $student->region_id = $request->input('region_id'); // Assuming the user is logged in and has a region
        $student->trainer_id = auth()->user()->id; // Assuming the user is logged in and has a region
        $student->save();

        // Redirect to the index page with a success message
        if (!auth()->user()->hasRole('Super Admin')) {
            return redirect()->route('students.index')->with('success', 'Student added successfully.');
        }else{
            return redirect()->route('tables.students')->with('success', 'Student added successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $students = Students::find($id);
        if ($students == null) {

            return redirect()->route('students.index')->with('error','Student Not Found');
            
        }else {
            $students->delete();
            if (auth()->user()->hasRole('Super Admin')) {
                return redirect()->route('tables.students')->with('success','Student deleted successfully');
            }else{
                return redirect()->route('students.index')->with('success','Student deleted successfully');
            }

        }
    }
    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $students = Students::select([
                'students.id',
                'students.name',
                'parents.father_name',
                'regions.name as region_name',
                'programs.name as program_name',
                'sessions.name as session_name'
            ])
            ->leftJoin('parents', 'students.parent_id', '=', 'parents.id')
            ->leftJoin('regions', 'students.region_id', '=', 'regions.id')
            ->leftJoin('programs', 'students.program_id', '=', 'programs.id')
            ->leftJoin('sessions', 'students.session_id', '=', 'sessions.id')
            ->where('students.region_id', auth()->user()->region_id) // Filter by user's region
            ->get();

    
            return datatables()->of($students)
                ->addColumn('action', function ($row) {
                    $editUrl = route('students.edit', $row->id);
    
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
        Students::whereIn('id', $ids)->delete();

        return response()->json(['success' => 'Students deleted successfully!']);
    }
    

}

