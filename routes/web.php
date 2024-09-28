<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FacilitatorsController;
use App\Http\Controllers\ParentsController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SchoolsController;
use App\Http\Controllers\SessionDeliverablesController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\TablesController;
use App\Http\Controllers\TeachersController;
use App\Http\Controllers\UserController;
use App\Models\Facilitators;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['middleware' => ['role:Super Admin']], function() {
    Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/regFacilitator/dashboard/{region_id}', [DashboardController::class, 'superAdminDashboards'])->name('superAdmin.dashboard');

});

Route::group(['middleware' => ['role:Regional Facilitator']], function() {
    Route::get('/regFacilitator/dashboard', [DashboardController::class, 'regFacilitator'])->name('regFacilitator.dashboard');
});

Route::group(['middleware' => ['role:Local Facilitator']], function() {
    Route::get('/locFacilitator/dashboard', [DashboardController::class, 'locFacilitator'])->name('locFacilitator.dashboard');
});


Route::middleware('auth')->group(function () {
    
    // Roles
    Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/roles/{id}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::put('/roles/{id}', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('/roles/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');
    Route::get('/roles-data', [RoleController::class, 'getData'])->name('roles.getData');
    Route::post('roles/bulk-delete', [RoleController::class, 'bulkDelete'])->name('roles.bulkDelete');
    
    // Permissions
    Route::get('/permissions/create', [PermissionsController::class, 'create'])->name('permissions.create');
    Route::post('/permissions', [PermissionsController::class, 'store'])->name('permissions.store');
    Route::get('/permissions', [PermissionsController::class, 'index'])->name('permissions.index');
    Route::get('/permissions/{id}/edit', [PermissionsController::class, 'edit'])->name('permissions.edit');
    Route::put('/permissions', [PermissionsController::class, 'update'])->name('permissions.update');
    Route::delete('/permissions/{id}', [PermissionsController::class, 'destroy'])->name('permissions.destroy');
    Route::get('/permissions-data', [PermissionsController::class, 'getData'])->name('permissions.getData');

    // Users
    Route::get('users',[UserController::class, 'index'])->name('users.index');
    Route::get('users/create',[UserController::class, 'create'])->name('users.create');
    Route::post('users/store',[UserController::class, 'store'])->name('users.store');
    Route::get('users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::delete('users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::put('users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::get('users-data', [UserController::class, 'getUsersData'])->name('users.data');
    Route::post('users/bulk-delete', [UserController::class, 'bulkDelete'])->name('users.bulkDelete');


    // Sessions
    Route::get('sessions',[SessionsController::class, 'index'])->name('sessions.index');
    Route::get('sessions/create',[SessionsController::class, 'create'])->name('sessions.create');
    Route::get('sessions/details/{id}',[SessionsController::class, 'details'])->name('sessions.details');
    Route::post('sessions/store',[SessionsController::class, 'store'])->name('sessions.store');
    Route::get('sessions/{id}/edit', [SessionsController::class, 'edit'])->name(name: 'sessions.edit');
    Route::put('sessions/{id}', [SessionsController::class, 'update'])->name('sessions.update');
    Route::delete('sessions/{id}', [SessionsController::class, 'destroy'])->name('sessions.destroy');
    Route::get('sessions-data', [SessionsController::class, 'getSessionsData'])->name('sessions.data');
    Route::post('sessions/bulk-delete', [SessionsController::class, 'bulkDelete'])->name('sessions.bulkDelete');
    Route::get('sessions/downloadDeliverables/{id}', [SessionsController::class, 'downloadDeliverables'])->name('sessions.downloadDeliverables');
    Route::get('sessions/downloadSingleDeliverable/{file}', [SessionsController::class, 'downloadSingleDeliverable'])->name('sessions.downloadSingleDeliverable');


    // Session deliverables
    Route::get('session_deliverables',[SessionDeliverablesController::class, 'index'])->name('session_deliverables.index');
    Route::get('session_deliverables-data', [SessionDeliverablesController::class, 'getDeliverablesData'])->name('session_deliverables.data');
    Route::get('add_deliverables/{session_id}', [SessionDeliverablesController::class, 'create'])->name('sessions.add_deliverables');
    Route::post('session_deliverables/store',[SessionDeliverablesController::class, 'storeSessionDeliverables'])->name('session_deliverables.store');


    //    Schools
    Route::get('/schools', [SchoolsController::class, 'index'])->name('schools.index');
    Route::get('/schools/create', [SchoolsController::class, 'create'])->name('schools.create');
    Route::post('/schools', [SchoolsController::class, 'store'])->name('schools.store');
    Route::get('/schools/{id}/edit', [SchoolsController::class, 'edit'])->name('schools.edit');
    Route::put('/schools/{id}', [SchoolsController::class, 'update'])->name('schools.update');
    Route::delete('/schools/{id}', [SchoolsController::class, 'destroy'])->name('schools.destroy');
    Route::get('/schools-data', [SchoolsController::class, 'getData'])->name('schools.getData');
    Route::post('schools/bulk-delete', [SchoolsController::class, 'bulkDelete'])->name('schools.bulkDelete');



     //    Parents
     Route::get('/parents', [ParentsController::class, 'index'])->name('parents.index');
     Route::get('/parents/create', [ParentsController::class, 'create'])->name('parents.create');
     Route::post('/parents', [ParentsController::class, 'store'])->name('parents.store');
     Route::get('/parents/{id}/edit', [ParentsController::class, 'edit'])->name('parents.edit');
     Route::put('/parents/{id}', [ParentsController::class, 'update'])->name('parents.update');
     Route::delete('/parents/{id}', [ParentsController::class, 'destroy'])->name('parents.destroy');
     Route::get('/parents-data', [ParentsController::class, 'getData'])->name('parents.getData');
     Route::post('parents/bulk-delete', [ParentsController::class, 'bulkDelete'])->name('parents.bulkDelete');
 
    //    Students
    Route::get('/students', [StudentsController::class, 'index'])->name('students.index');
    Route::get('/students/create', [StudentsController::class, 'create'])->name('students.create');
    Route::post('/students', [StudentsController::class, 'store'])->name('students.store');
    Route::get('/students/{id}/edit', [StudentsController::class, 'edit'])->name('students.edit');
    Route::put('/students/{id}', [StudentsController::class, 'update'])->name('students.update');
    Route::delete('/students/{id}', [StudentsController::class, 'destroy'])->name('students.destroy');
    Route::get('/students-data', [StudentsController::class, 'getData'])->name('students.getData');
    Route::post('students/bulk-delete', [StudentsController::class, 'bulkDelete'])->name('students.bulkDelete');

     //    Teachers
     Route::get('/teachers', [TeachersController::class, 'index'])->name('teachers.index');
     Route::get('/teachers/create', [TeachersController::class, 'create'])->name('teachers.create');
     Route::post('/teachers', [TeachersController::class, 'store'])->name('teachers.store');
     Route::get('/teachers/{id}/edit', [TeachersController::class, 'edit'])->name('teachers.edit');
     Route::put('/teachers/{id}', [TeachersController::class, 'update'])->name('teachers.update');
     Route::delete('/teachers/{id}', [TeachersController::class, 'destroy'])->name('teachers.destroy');
     Route::get('/teachers-data', [TeachersController::class, 'getData'])->name('teachers.getData');
     Route::post('teachers/bulk-delete', [TeachersController::class, 'bulkDelete'])->name('teachers.bulkDelete');
    
     //    Teachers
     Route::get('/facilitators', [FacilitatorsController::class, 'index'])->name('facilitators.index');
     Route::get('/facilitators/create', [FacilitatorsController::class, 'create'])->name('facilitators.create');
     Route::post('/facilitators', [FacilitatorsController::class, 'store'])->name('facilitators.store');
     Route::get('/facilitators/{id}/edit', [FacilitatorsController::class, 'edit'])->name('facilitators.edit');
     Route::put('/facilitators/{id}', [FacilitatorsController::class, 'update'])->name('facilitators.update');
     Route::delete('/facilitators/{id}', [FacilitatorsController::class, 'destroy'])->name('facilitators.destroy');
     Route::get('/facilitators-data', [FacilitatorsController::class, 'getData'])->name('facilitators.getData');
     Route::post('facilitators/bulk-delete', [FacilitatorsController::class, 'bulkDelete'])->name('facilitators.bulkDelete');
     Route::get('/teacher-chart', [TeachersController::class, 'showChart']);

    

     //For super admin tables
     Route::get('students_table/{region_Id}',[TablesController::class, 'students_table'])->name('tables.students');
     Route::get('getStudentsData/{region_Id}',[TablesController::class, 'getStudentsData'])->name('tables.getStudentsData');
     Route::get('parents_table/{region_Id}',[TablesController::class, 'parents_table'])->name('tables.parents');
     Route::get('getParentsData/{region_Id}',[TablesController::class, 'getParentsData'])->name('tables.getParentsData');
     Route::get('teachers_table/{region_Id}',[TablesController::class, 'teachers_table'])->name('tables.teachers');
     Route::get('getTeachersData/{region_Id}',[TablesController::class, 'getTeachersData'])->name('tables.getTeachersData');
     Route::get('schools_table/{region_Id}',[TablesController::class, 'schools_table'])->name('tables.schools');
     Route::get('getSchoolsData/{region_Id}',[TablesController::class, 'getSchoolsData'])->name('tables.getSchoolsData');
     Route::get('sessions_table/{region_Id}',[TablesController::class, 'sessions_table'])->name('tables.sessions');
     Route::get('getSessionsData/{region_Id}',[TablesController::class, 'getSessionsData'])->name('tables.getSessionsData');
  
    // For Other users
    Route::get('students_table',[TablesController::class, 'students_table'])->name('tables.students');
    Route::get('getStudentsData',[TablesController::class, 'getStudentsData'])->name('tables.getStudentsData');
    Route::get('parents_table',[TablesController::class, 'parents_table'])->name('tables.parents');
    Route::get('getParentsData',[TablesController::class, 'getParentsData'])->name('tables.getParentsData');
    Route::get('teachers_table',[TablesController::class, 'teachers_table'])->name('tables.teachers');
    Route::get('getTeachersData',[TablesController::class, 'getTeachersData'])->name('tables.getTeachersData');
    Route::get('schools_table',[TablesController::class, 'schools_table'])->name('tables.schools');
    Route::get('getSchoolsData',[TablesController::class, 'getSchoolsData'])->name('tables.getSchoolsData');
    Route::get('sessions_table',[TablesController::class, 'sessions_table'])->name('tables.sessions');
    Route::get('getSessionsData',[TablesController::class, 'getSessionsData'])->name('tables.getSessionsData');

   
});


// Include the authentication routes
require __DIR__.'/auth.php';