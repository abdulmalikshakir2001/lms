<?php

namespace App\Http\Controllers;

use App\Models\Facilitators;
use App\Models\Parents;
use App\Models\Programs;
use App\Models\Regions;
use App\Models\session_deliverables;
use App\Models\Session_for;
use App\Models\Sessions;
use App\Models\Students;
use App\Models\Teachers;
use App\Models\User;
use Carbon\Carbon; // Add this import to use Carbon for date handling
use Illuminate\Http\Request;
use Session;
use Validator;
use Yajra\DataTables\Services\DataTable;
use ZipArchive;

class SessionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('permission:View Sessions')->only('index');
        $this->middleware('permission:Edit Sessions')->only('edit');
        $this->middleware('permission:Add Sessions')->only('create');
        $this->middleware('permission:Delete Sessions')->only('destroy');
    }
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
    // Validate the session form input
    $validator = Validator::make($request->all(), [
        'session_name' => 'required|min:3',
        'program' => 'required',
        'session_for' => 'required',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
        'deliverables.*' => 'file', // Ensure files are valid
    ]);

    if ($validator->passes()) {
        // Create new session
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
        $session->save();  // Save session

        // Handle deliverables file uploads
        if ($request->hasFile('deliverables')) {
            $uploadedFiles = $request->file('deliverables');
            $regionId = $session->region_id;
            $programId = $session->program_id;
            $userId = auth()->user()->id;
            $sessionId = $session->id;

            // Define the base directory for storing files
            $baseDirectory = public_path("regions/user_{$userId}_region_{$regionId}/program_{$programId}_session_{$sessionId}");

            // Create the directory if it doesn't exist
            if (!file_exists($baseDirectory)) {
                mkdir($baseDirectory, 0777, true);  // Create recursively
            }

            // Loop through the uploaded files and store them
            foreach ($uploadedFiles as $file) {
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move($baseDirectory, $fileName);

                // Save file path in the session_deliverables table
                session_deliverables::create([
                    'session_id' => $sessionId,
                    'path' => "regions/user_{$userId}_region_{$regionId}/program_{$programId}_session_{$sessionId}/{$fileName}",
                ]);
            }
        }

        return redirect()->route('sessions.index')->with('success', 'Session and Deliverables added successfully');
    } else {
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

    

    public function downloadDeliverables($sessionId)
    {
        // Retrieve all deliverables for the session
        $deliverables = session_deliverables::where('session_id', $sessionId)->get();

        // Define the name of the zip file
        $zipFileName = 'deliverables_' . $sessionId . '.zip';

        // Define the temporary path where the zip will be stored
        $zipFilePath = public_path($zipFileName);

        // Initialize ZipArchive
        $zip = new ZipArchive;

        if ($zip->open($zipFilePath, ZipArchive::CREATE) === TRUE) {
            // Loop through each deliverable and add it to the zip
            foreach ($deliverables as $deliverable) {
                $filePath = public_path($deliverable->path);

                if (file_exists($filePath)) {
                    $fileName = basename($filePath); // Get only the file name
                    $zip->addFile($filePath, $fileName); // Add file to zip
                }
            }

            // Close the zip file
            $zip->close();
        } else {
            return redirect()->back()->with('error', 'Failed to create zip file.');
        }

        // Return the zip file for download
        return response()->download($zipFilePath)->deleteFileAfterSend(true);
    }

    public function downloadSingleDeliverable($fileId)
    {
        // Find the deliverable by its ID
        $deliverable = session_deliverables::findOrFail($fileId);

        // Get the full path of the file
        $filePath = public_path($deliverable->path);

        // Check if the file exists
        if (file_exists($filePath)) {
            // Return the file for download
            return response()->download($filePath);
        }

        // If file doesn't exist, redirect back with an error message
        return redirect()->back()->with('error', 'File not found.');
    }

    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    // Validate the session form input
    $validator = Validator::make($request->all(), [
        'session_name' => 'required|min:3',
        'program' => 'required',
        'session_for' => 'required',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
        'deliverables.*' => 'file', // Ensure files are valid
    ]);

    if ($validator->passes()) {
        // Fetch the session by ID
        $session = Sessions::findOrFail($id);

        // Compare the start date
        if ($request->start_date && $request->start_date != $session->start_date) {
            // Check if the new start date is after the old start date (Postponed)
            if (Carbon::parse($request->start_date)->gt($session->start_date)) {
                $session->status = 'postponed';
            } 
            // Check if the new start date is before the old start date (Preponed/Advanced)
            elseif (Carbon::parse($request->start_date)->lt($session->start_date)) {
                $session->status = 'preponed'; // or 'advanced'
            }
        }

        // Update the session with the new data
        $session->name = $request->session_name;
        $session->region_id = $request->region;
        $session->trainer = $request->trainer;
        $session->program_id = $request->program;
        $session->session_for_id = $request->session_for;
        $session->start_date = $request->start_date;
        $session->end_date = $request->end_date;

        // Optional: Update description if provided
        if (!empty($request->description)) {
            $session->description = $request->description;
        }
        
        $session->save(); // Save session changes

        // Handle deliverables file uploads
        if ($request->hasFile('deliverables')) {
            $uploadedFiles = $request->file('deliverables');
            $regionId = $session->region_id;
            $programId = $session->program_id;
            $userId = auth()->user()->id;
            $sessionId = $session->id;

            // Define the base directory for storing files
            $baseDirectory = public_path("regions/user_{$userId}_region_{$regionId}/program_{$programId}_session_{$sessionId}");

            // Create the directory if it doesn't exist
            if (!file_exists($baseDirectory)) {
                mkdir($baseDirectory, 0777, true); // Create recursively
            }

            // Loop through the uploaded files and store them
            foreach ($uploadedFiles as $file) {
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move($baseDirectory, $fileName);

                // Save file path in the session_deliverables table
                session_deliverables::create([
                    'session_id' => $sessionId,
                    'path' => "regions/user_{$userId}_region_{$regionId}/program_{$programId}_session_{$sessionId}/{$fileName}",
                ]);
            }
        }

        // Redirect with success message
        if(auth()->user()->hasRole('Super Admin')){
            return redirect()->route('tables.sessions')->with('success', 'Session updated successfully.');
        }else{
            return redirect()->route('sessions.index')->with('success', 'Session updated successfully.');
        }
    } else {
        return redirect()->route('sessions.edit', $id)->withInput()->withErrors($validator);
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
            session_deliverables::where('session_id',$id)->delete();
            if(auth()->user()->hasRole('Super Admin')){
                return redirect()->route('tables.sessions')->with('success', 'Session Deleted successfully.');
            }else{
                return redirect()->route('sessions.index')->with('success', 'Session Deleted successfully.');
            }
        }
    }
    public function details($id){
        $session = Sessions::findOrFail($id);
        $program = Programs::where('id',$session->program_id)->first();
        $trainer  = User::where('id',$session->trainer)->first();
        $session_for = Session_for::where('id',$session->session_for_id)->first();
        $region = Regions::where('id',$session->region_id)->first();
        $teachers = Teachers::where('session_id',$session->id)->count();
        $students = Students::where('session_id',$session->id)->count();
        $facilitators = Facilitators::where('session_id',$session->id)->count();
        $parents = Parents::where('session_id',$session->id)->count();
        $deliverables = session_deliverables::where('session_id',$session->id)->get();
        return view('sessions.details',compact('session','program','trainer','session_for','region','students','teachers','deliverables','parents','facilitators'));
    }


    public function getSessionsData(Request $request)
    {
        if ($request->ajax()) {
            if (auth()->user()->hasRole('Local Facilitator')) {
                try {
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
                            'sessions.end_date',
                            'sessions.status'
                        )
                        ->where('sessions.region_id', auth()->user()->region_id) // Filter by user's region
                        ->where('sessions.trainer', auth()->user()->id); // Filter by user's region
                    
                    // Apply date filters if they are set
                    if ($request->start_date) {
                        $sessions->whereDate('start_date', '>=', $request->start_date);
                    }
                    if ($request->end_date) {
                        $sessions->whereDate('end_date', '<=', $request->end_date);
                    }
        
                    return datatables()->of($sessions)
                        ->addIndexColumn()
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
                        ->addColumn('status', function ($row) {
                            $badgeClass = 'bg-label-success';
                            if ($row->status === 'postponed') {
                                $badgeClass = 'bg-label-danger';
                            } elseif ($row->status === 'preponed') {
                                $badgeClass = 'bg-label-info';
                            }
                            return '<span class="badge ' . $badgeClass . ' my-1">' . ucfirst($row->status) . '</span>';
                        })
                        ->addColumn('action', function ($row) {
                            return '
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="'.route('sessions.details', $row->id).'">
                                        <i class="bx bx-edit-alt me-1"></i> View Details
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
                        ->rawColumns(['action', 'status'])
                        ->make(true);
                } catch (\Exception $e) {
                    \Log::error('Error fetching sessions data: ' . $e->getMessage());
                    return response()->json(['error' => 'Unable to fetch data'], 500);
                }
            }else{
                try {
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
                            'sessions.end_date',
                            'sessions.status'
                        )
                        ->where('sessions.region_id', auth()->user()->region_id); // Filter by user's region
                    
                    // Apply date filters if they are set
                    if ($request->start_date) {
                        $sessions->whereDate('start_date', '>=', $request->start_date);
                    }
                    if ($request->end_date) {
                        $sessions->whereDate('end_date', '<=', $request->end_date);
                    }
        
                    return datatables()->of($sessions)
                        ->addIndexColumn()
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
                        ->addColumn('status', function ($row) {
                            $badgeClass = 'bg-label-success';
                            if ($row->status === 'postponed') {
                                $badgeClass = 'bg-label-danger';
                            } elseif ($row->status === 'preponed') {
                                $badgeClass = 'bg-label-info';
                            }
                            return '<span class="badge ' . $badgeClass . ' my-1">' . ucfirst($row->status) . '</span>';
                        })
                        ->addColumn('action', function ($row) {
                            return '
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="'.route('sessions.details', $row->id).'">
                                        <i class="bx bx-edit-alt me-1"></i> View Details
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
                        ->rawColumns(['action', 'status'])
                        ->make(true);
                } catch (\Exception $e) {
                    \Log::error('Error fetching sessions data: ' . $e->getMessage());
                    return response()->json(['error' => 'Unable to fetch data'], 500);
                }

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
