<?php

namespace App\Http\Controllers;

use App\Models\Parents;
use App\Models\Regions;
use App\Models\Schools;
use App\Models\Students;
use App\Models\Teachers;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TablesController extends Controller
{
    public function students_table($region_Id = null)
    {
        
        if (auth()->user()->hasRole('Super Admin')) {
            
            if (isset($_GET['region_id'])) {
                $regions = Regions::all();
                return view('tables.students', ['regionId' => $_GET['region_Id'],'regions'=>$regions]);
            }else{
                $regions = Regions::all();
                return view('tables.students',['regionId' => null,'regions'=>$regions]);
            }
        } else {
            return view('tables.students',['regionId' => auth()->user()->region_id]);
        }
    }
    
    public function parents_table($regionId = null){
        if (auth()->user()->hasRole('Super Admin')) {
            if (isset($_GET['region_id'])) {
                $regions = Regions::all();
                return view('tables.parents', ['regionId' => $_GET['region_Id'],'regions'=>$regions]);
            }else{
                $regions = Regions::all();
                return view('tables.parents',['regionId' => null,'regions'=>$regions]);
            }
        } else {
            return view('tables.parents',['regionId' => auth()->user()->region_id]);
        }
    }
    public function teachers_table($regionId = null){
        if (auth()->user()->hasRole('Super Admin')) {
            if (isset($_GET['region_id'])) {
                $regions = Regions::all();
                return view('tables.teachers', ['regionId' => $_GET['region_Id'],'regions'=>$regions]);
            }else{
                $regions = Regions::all();
                return view('tables.teachers',['regionId' => null,'regions'=>$regions]);
            }
        } else {
            return view('tables.teachers',['regionId' => auth()->user()->region_id]);
        }
    }
    public function schools_table($regionId = null){
        if (auth()->user()->hasRole('Super Admin')) {
            if (isset($_GET['region_id'])) {
                $regions = Regions::all();
                return view('tables.schools', ['regionId' => $_GET['region_Id'],'regions'=>$regions]);
            }else{
                $regions = Regions::all();
                return view('tables.schools',['regionId' => null,'regions'=>$regions]);
            }
        } else {
            return view('tables.schools',['regionId' => auth()->user()->region_id]);
        }
    }
    public function sessions_table($regionId = null){
        if (auth()->user()->hasRole('Super Admin')) {
            if (isset($_GET['region_id'])) {
                $regions = Regions::all();
                return view('tables.sessions', ['regionId' => $_GET['region_Id'],'regions'=>$regions]);
            }else{
                $regions = Regions::all();
                return view('tables.sessions',['regionId' => null,'regions'=>$regions]);
            }
        } else {
            return view('tables.sessions',['regionId' => auth()->user()->region_id]);
        }
    }
    public function getStudentsData(Request $request, $regionId = null)
    {
        if ($request->ajax()) {
            $query = Students::select([
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
            ->leftJoin('sessions', 'students.session_id', '=', 'sessions.id');
    
            // Apply region filtering based on user role or region filter
            if (auth()->user()->hasRole('Super Admin') && $request->region_id) {
                $query->where('students.region_id', $request->region_id);
            } elseif (auth()->user()->hasRole('Regional Facilitator')) {
                $query->where('students.region_id', auth()->user()->region_id);
            } elseif (auth()->user()->hasRole('Local Facilitator')) {
                $query->where('students.trainer_id', auth()->user()->id)
                      ->where('students.region_id', auth()->user()->region_id);
            }
    
            $students = $query->get();
    
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
                ->make(true);
        }
    }
    public function getParentsData(Request $request)
    {
        if ($request->ajax()) {
            $query = Parents::select([
                'parents.id',
                'father_name',
                'mother_name',
                'regions.name as region_name',
                'programs.name as program_name'
            ])
            ->leftJoin('regions', 'parents.region_id', '=', 'regions.id')
            ->leftJoin('programs', 'parents.program_id', '=', 'programs.id');
    
            // Apply region filter if selected
            if ($request->has('region_id') && $request->region_id != '') {
                $query->where('parents.region_id', $request->region_id);
            }
    
            $parents = $query->get();
    
            return datatables()->of($parents)
                ->addIndexColumn()
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
                ->editColumn('region_name', function ($row) {
                    return $row->region_name;
                })
                ->editColumn('program_name', function ($row) {
                    return $row->program_name;
                })
                ->make(true);
        }
    }
    


    public function getTeachersdata(Request $request)
    {
        $regionId = $request->get('region_id'); // Get the region_id from the request
    
        if ($request->ajax()) {
            $query = Teachers::select([
                'teachers.id',
                'teachers.name as teacher_name',
                'teachers.contact',  // Assuming contact is a column in the teachers table
                'regions.name as region_name',
                'programs.name as program_name',
                'sessions.name as session_name'
            ])
            ->leftJoin('regions', 'teachers.region_id', '=', 'regions.id')
            ->leftJoin('programs', 'teachers.program_id', '=', 'programs.id')
            ->leftJoin('sessions', 'teachers.session_id', '=', 'sessions.id');
    
            // Filter based on user roles
            if(auth()->user()->hasRole('Regional Facilitator')) {
                $query->where('teachers.region_id', auth()->user()->region_id);
            } elseif(auth()->user()->hasRole('Local Facilitator')) {
                $query->where('teachers.trainer_id', auth()->user()->id)
                      ->where('teachers.region_id', auth()->user()->region_id);
            }
    
            // Filter by region if a region is selected
            if (!empty($regionId)) {
                $query->where('teachers.region_id', $regionId);
            }
    
            return DataTables::of($query)
                ->addIndexColumn()
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
                ->make(true);
        }
    }
    

public function getSchoolsData(Request $request)
{
    // Ensure that this only executes for AJAX requests (e.g., for DataTables)
    if ($request->ajax()) {
        // Start building the query
        $query = Schools::select(['id', 'name', 'location', 'contact']);

        // Check if region_id is provided in the request
        if ($request->has('region_id') && $request->region_id != '') {
            $query->where('region_id', $request->region_id);
        }

        // Check the user's role and apply additional filters
        if (auth()->user()->hasRole('Regional Facilitator')) {
            $query->where('region_id', auth()->user()->region_id);
        } elseif (auth()->user()->hasRole('Local Facilitator')) {
            $query->where('trainer_id', auth()->user()->id);
        }

        // Get the schools data
        $schools = $query->get();

        // Return the schools data to DataTables with indexing (for Sr No)
        return datatables()->of($schools)
            ->addIndexColumn() // Automatically add row index (Sr No)
            ->addColumn('action', function ($row) {
                $editUrl = route('schools.edit', $row->id);
                return '
                    <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="' . $editUrl . '">
                                <i class="bx bx-edit-alt me-1"></i> Edit
                            </a>
                            <button type="button" class="dropdown-item delete-button" data-id="' . $row->id . '" data-bs-toggle="modal" data-bs-target="#modalCenter">
                                <i class="bx bx-trash me-1"></i> Delete
                            </button>
                        </div>
                    </div>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    // If it's not an AJAX request, return a suitable response (e.g., an error)
    return response()->json(['error' => 'Invalid request type.'], 400);
}






public function getSessionsData(Request $request)
{
    if ($request->ajax()) {
        $regionId = $request->region_id; // Get region ID from the request

        // Regional Facilitator
        if (auth()->user()->hasRole('Regional Facilitator')) {
            return $this->fetchSessions($request, auth()->user()->region_id);
        }
        // Local Facilitator
        elseif (auth()->user()->hasRole('Local Facilitator')) {
            return $this->fetchSessions($request, auth()->user()->region_id, auth()->user()->id);
        }
        // Super Admin with Region Filter
        elseif (auth()->user()->hasRole('Super Admin')) {
            return $this->fetchSessions($request, $regionId);
        }
        // General case for Super Admin without Region Filter
        else {
            return $this->fetchSessions($request);
        }
    }
}


private function fetchSessions($request, $regionId = null, $trainerId = null)
{
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
        );

    // Apply region filter if provided
    if ($regionId) {
        $sessions->where('sessions.region_id', $regionId);
    }

    // Apply trainer filter if provided
    if ($trainerId) {
        $sessions->where('sessions.trainer', $trainerId);
    }

    // Apply date filters
    if ($request->start_date) {
        $sessions->whereDate('start_date', '>=', $request->start_date);
    }
    if ($request->end_date) {
        $sessions->whereDate('end_date', '<=', $request->end_date);
    }

    return datatables()->of($sessions)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
            return '<div class="dropdown"><button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button><div class="dropdown-menu"><a class="dropdown-item" href="'.route('sessions.edit', $row->id).'"><i class="bx bx-edit-alt me-1"></i> Edit</a><button type="button" class="dropdown-item delete-button" data-id="' . $row->id . '" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="bx bx-trash me-1"></i> Delete</button></div></div>';
        })
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
        ->rawColumns(['action', 'status'])
        ->make(true);
}






}
