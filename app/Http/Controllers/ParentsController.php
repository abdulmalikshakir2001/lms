<?php

namespace App\Http\Controllers;

use App\Models\Parents;
use App\Models\Sessions;
use Illuminate\Http\Request;

class ParentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('permission:View Parents')->only('index');
        $this->middleware('permission:Edit Parents')->only('edit');
        $this->middleware('permission:Add Parents')->only('create');
        $this->middleware('permission:Delete Parents')->only('destroy');
    }
    public function index()
    {
        return view('parents.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->user()->hasRole('Local Facilitator')) {
            $sessions = Sessions::where('region_id',auth()->user()->region_id)
            ->where('trainer',auth()->user()->id)->get();
        }else{
            $sessions = Sessions::where('region_id',auth()->user()->region_id)->get();
            
        }
        return view('parents.create',compact('sessions'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'region_id'   => 'required|exists:regions,id',
            'session_id'  => 'required|exists:sessions,id'
             // Assuming there's a regions table
        ]);

        $session = Sessions::find($request->input('session_id'));


        // Store the parent information
        Parents::create([
            'father_name' => $request->input('father_name'),
            'mother_name' => $request->input('mother_name'),
            'region_id'   => $request->input('region_id'),
            // You can also add 'program_id' and 'session_id' if needed
            'program_id'  => $session->program_id, // Optional, defaults to null
            'session_id'  => $request->input('session_id', null), // Optional, defaults to null
            'trainer_id'  => auth()->user()->id, // Optional, defaults to null
        ]);

        // Redirect with a success message
        return redirect()->route('parents.index')->with('success', 'Parent details have been added successfully.');
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
        $parent = Parents::findOrFail($id);
        if(!auth()->user()->hasRole("Super Admin")){
        $sessions = Sessions::where('region_id',auth()->user()->region_id)->get();
        return view('parents.edit',compact('parent','sessions'));
        }else{
        $sessions = Sessions::where('trainer',auth()->user()->id)->get();
        return view('parents.edit',compact('parent','sessions'));
        }


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'region_id' => 'required|exists:regions,id',
        ]);

        // Find the parent by ID
        $parent = Parents::findOrFail($id);
        $session = Sessions::find($request->input('session_id'));

        // Update the parent with the request data
        $parent->father_name = $request->input('father_name');
        $parent->mother_name = $request->input('mother_name');
        $parent->region_id = $request->input('region_id');
        // You may add additional fields if necessary
        $parent->session_id = $request->input('session_id'); // Optional: Only update if provided
        $parent->program_id  = $session->program_id; // Optional, defaults to null


        // Save the changes to the database
        $parent->save();

        // Redirect back with a success message
        return back()->with('success', 'Parent Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $parents = Parents::find($id);
        if ($parents == null) {
            return back()->with('error','Parents Not Found');
            
        }else {
            $parents->delete();
            return back()->with('success', 'Parent deleted successfully.');

        }
    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $parents = Parents::select(['parents.id', 'father_name', 'mother_name', 'regions.name as region_name', 'programs.name as program_name'])
                ->leftJoin('regions', 'parents.region_id', '=', 'regions.id')
                ->leftJoin('programs', 'parents.program_id', '=', 'programs.id')
                ->where('parents.region_id', auth()->user()->region_id) // Filter by user's region
                ->get();

    
            return datatables()->of($parents)
                ->addColumn('action', function ($row) {
                    $editUrl = route('parents.edit', $row->id);
                    
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
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;

        // Delete all sessions with the specified IDs
        Parents::whereIn('id', $ids)->delete();

        return response()->json(['success' => 'Parents deleted successfully!']);
    }
    

}
