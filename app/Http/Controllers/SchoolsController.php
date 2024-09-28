<?php

namespace App\Http\Controllers;

use App\Models\Schools;
use Illuminate\Http\Request;

class SchoolsController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function __construct()
    {
        $this->middleware('permission:View Schools')->only('index');
        $this->middleware('permission:Edit Schools')->only('edit');
        $this->middleware('permission:Add Schools')->only('create');
        $this->middleware('permission:Delete Schools')->only('destroy');
    }
    public function index()
    {
        return view('schools.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('schools.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $trainerId =auth()->user()->id;
       
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'region_id' => 'required|integer|exists:users,region_id', // Ensure region_id is valid
        ]);

        // Create a new School record
        Schools::create([
            'name' => $request->input('name'),
            'location' => $request->input('location'),
            'contact' => $request->input('contact'),
            'region_id' => $request->input('region_id'),
            'trainer_id' => $trainerId
        ]);

        // Redirect to the schools index page with a success message
        return redirect()->route('schools.index')->with('success', 'School added successfully!');
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
        $school = Schools::findOrFail($id);
        return view('schools.edit',compact('school'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the incoming data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
        ]);
    
        // Find the school by ID
        $school = Schools::findOrFail($id);
    
        // Update the school's attributes
        $school->name = $request->input('name');
        $school->location = $request->input('location');
        $school->contact = $request->input('contact');
        
    
        // Save the updated data to the database
        $school->save();
    
        // Redirect back with a success message
        if (auth()->user()->hasRole('Super Admin')) {
            return redirect()->route('tables.schools')->with('success', 'School updated successfully.');
        }else{
            return redirect()->route('schools.index')->with('success', 'School updated successfully.');
        }
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $school = Schools::find($id);

        if ($school == null) {

            return redirect()->route('schools.index')->with('error','School Not Found');
            
        }else {
            $school->delete();
            if (!auth()->user()->hasRole('Super Admin')) {
                return redirect()->route('tables.schools')->with('success', 'School deleted successfully.');
            }else{
                return redirect()->route('schools.index')->with('success', 'School deleted successfully.');
            }

        }

    }

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $schools = Schools::select(['id', 'name', 'location', 'contact'])->where('region_id',auth()->user()->region_id)->get();
    
            return datatables()->of($schools)
                ->addColumn('action', function ($row) {
                    $editUrl = route('schools.edit', $row->id);
                    $deleteButton = '';
                   

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
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;

        // Delete all sessions with the specified IDs
        Schools::whereIn('id', $ids)->delete();

        return response()->json(['success' => 'Schools deleted successfully!']);
    }
    

    
}
