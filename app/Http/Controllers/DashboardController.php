<?php

namespace App\Http\Controllers;

use App\Models\Facilitators;
use App\Models\Parents;
use App\Models\Regions;
use App\Models\Schools;
use App\Models\Sessions;
use App\Models\Students;
use App\Models\Teachers;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function adminDashboard()
    {
        $totStudents = Students::all()->count();
        $totTeachers = Teachers::all()->count();
        $totParents = Parents::all()->count();
        $totSchools = Schools::all()->count();
        $totSessions = Sessions::all()->count();
        // Get students count by region
        $studentData = Students::selectRaw('region_id, count(*) as count')
            ->groupBy('region_id')
            ->pluck('count')
            ->toArray();

        $parentsData = Parents::selectRaw('region_id, count(*) as count')
            ->groupBy('region_id')
            ->pluck('count')
            ->toArray();
        $teachersData = Teachers::selectRaw('region_id, count(*) as count')
            ->groupBy('region_id')
            ->pluck('count')
            ->toArray();
        $schoolsData = Schools::selectRaw('region_id, count(*) as count')
            ->groupBy('region_id')
            ->pluck('count')
            ->toArray();
        
        // Get the region names if needed (optional)
        $stdRegionNames = Regions::whereIn('id', Students::pluck('region_id')->unique())->pluck('name')->toArray();
        $parRegionNames = Regions::whereIn('id', Parents::pluck('region_id')->unique())->pluck('name')->toArray();
        $tchRegionNames = Regions::whereIn('id', Teachers::pluck('region_id')->unique())->pluck('name')->toArray();
        $schRegionNames = Regions::whereIn('id', Schools::pluck('region_id')->unique())->pluck('name')->toArray();

        return view('admin_dashboard.index', compact(
            'studentData', 'stdRegionNames', 'parentsData', 'teachersData', 'schoolsData', 'parRegionNames', 
            'tchRegionNames', 'schRegionNames','totStudents','totTeachers','totParents','totSchools','totSessions'));
    }

    public function regFacilitator()
    {
        $regionId = auth()->user()->region_id;

        $totStudents = Students::where('region_id', $regionId)->count();
        $totTeachers = Teachers::where('region_id', $regionId)->count();
        $totParents = Parents::where('region_id', $regionId)->count();
        $totSchools = Schools::where('region_id', $regionId)->count();
        $totSessions = Sessions::where('region_id', $regionId)->count();

        // Get students count by region
        $studentData = Students::selectRaw('region_id, count(*) as count')
            ->where('region_id', $regionId)
            ->groupBy('region_id')
            ->pluck('count')
            ->toArray();

        $parentsData = Parents::selectRaw('region_id, count(*) as count')
            ->where('region_id', $regionId)
            ->groupBy('region_id')
            ->pluck('count')
            ->toArray();

        $teachersData = Teachers::selectRaw('region_id, count(*) as count')
            ->where('region_id', $regionId)
            ->groupBy('region_id')
            ->pluck('count')
            ->toArray();

        $schoolsData = Schools::selectRaw('region_id, count(*) as count')
            ->where('region_id', $regionId)
            ->groupBy('region_id')
            ->pluck('count')
            ->toArray();
        $sessionsData = Sessions::selectRaw('region_id, count(*) as count')
            ->where('region_id', $regionId)
            ->groupBy('region_id')
            ->pluck('count')
            ->toArray();

        // Get the region name (optional)
        $regionName = Regions::where('id', $regionId)->pluck('name')->first();

        return view('reg_facilitator_dashboard.index', compact(
            'studentData', 'parentsData', 'teachersData', 'schoolsData', 'regionName',
            'totStudents', 'totTeachers', 'totParents', 'totSchools', 'totSessions', 'sessionsData','regionId'
        ));
    }
    public function superAdminDashboards($region_id)
    {
        if (auth()->user()->hasRole('Super Admin')) {
            $regionId = $region_id;
        }

        $totStudents = Students::where('region_id', $regionId)->count();
        $totTeachers = Teachers::where('region_id', $regionId)->count();
        $totParents = Parents::where('region_id', $regionId)->count();
        $totSchools = Schools::where('region_id', $regionId)->count();
        $totSessions = Sessions::where('region_id', $regionId)->count();

        // Get students count by region
        $studentData = Students::selectRaw('region_id, count(*) as count')
            ->where('region_id', $regionId)
            ->groupBy('region_id')
            ->pluck('count')
            ->toArray();

        $parentsData = Parents::selectRaw('region_id, count(*) as count')
            ->where('region_id', $regionId)
            ->groupBy('region_id')
            ->pluck('count')
            ->toArray();

        $teachersData = Teachers::selectRaw('region_id, count(*) as count')
            ->where('region_id', $regionId)
            ->groupBy('region_id')
            ->pluck('count')
            ->toArray();

        $schoolsData = Schools::selectRaw('region_id, count(*) as count')
            ->where('region_id', $regionId)
            ->groupBy('region_id')
            ->pluck('count')
            ->toArray();
        $sessionsData = Sessions::selectRaw('region_id, count(*) as count')
            ->where('region_id', $regionId)
            ->groupBy('region_id')
            ->pluck('count')
            ->toArray();

        // Get the region name (optional)
        $regionName = Regions::where('id', $regionId)->pluck('name')->first();

        return view('reg_facilitator_dashboard.index', compact(
            'studentData', 'parentsData', 'teachersData', 'schoolsData', 'regionName',
            'totStudents', 'totTeachers', 'totParents', 'totSchools', 'totSessions', 'sessionsData','regionId'
        ));
    }


    public function locFacilitator()
    {
        $regionId = auth()->user()->region_id;
        $trainerId = auth()->user()->id; 

        $totStudents = Students::where('region_id', $regionId)->where('trainer_id',$trainerId )->count();
        $totTeachers = Teachers::where('region_id', $regionId)->where('trainer_id',$trainerId )->count();
        $totParents = Parents::where('region_id', $regionId)->where('trainer_id',$trainerId )->count();
        $totSchools = Schools::where('region_id', $regionId)->where('trainer_id',$trainerId )->count();
        $totSessions = Sessions::where('region_id', $regionId)->where('trainer',$trainerId )->count();

        // Get students count by region
        $studentData = Students::selectRaw('region_id, count(*) as count')
            ->where('region_id', $regionId)
            ->where('trainer_id', $trainerId)
            ->groupBy('region_id')
            ->pluck('count')
            ->toArray();

        $parentsData = Parents::selectRaw('region_id, count(*) as count')
            ->where('region_id', $regionId)
            ->where('trainer_id', $trainerId)
            ->groupBy('region_id')
            ->pluck('count')
            ->toArray();

        $teachersData = Teachers::selectRaw('region_id, count(*) as count')
            ->where('region_id', $regionId)
            ->where('trainer_id', $trainerId)
            ->groupBy('region_id')
            ->pluck('count')
            ->toArray();

        $schoolsData = Schools::selectRaw('region_id, count(*) as count')
            ->where('region_id', $regionId)
            ->where('trainer_id', $trainerId)
            ->groupBy('region_id')
            ->pluck('count')
            ->toArray();
        $sessionsData = Sessions::selectRaw('region_id, count(*) as count')
            ->where('region_id', $regionId)
            ->where('trainer', $trainerId)
            ->groupBy('region_id')
            ->pluck('count')
            ->toArray();

        // Get the region name (optional)
        $regionName = Regions::where('id', $regionId)->pluck('name')->first();

        return view('loc_facilitator_dashboard.index', compact(
            'studentData', 'parentsData', 'teachersData', 'schoolsData', 'regionName',
            'totStudents', 'totTeachers', 'totParents', 'totSchools', 'totSessions', 'sessionsData'
        ));
    }
    

}
