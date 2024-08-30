<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ByRoleController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\FitnessController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MedicalRecordsController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\PrintRecordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\statusController;
use App\Http\Controllers\UserController;
use App\Models\Doctor;
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

Route::get('/', function () {

   $doctors =  Doctor::Paginate(5);
    return view('welcome', compact('doctors'));
});
//Login
Route::get('/login', [LoginController::class, 'login'])->name('login');


//HOMECONTROLLER FOR Dashboard and home
Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
// Route::get('/home', [HomeController::class, 'home'])->name('home');
// Route::post('/api/user', [HomeController::class, 'dashboard']);

//Users
Route::resource('user', UserController::class);

//Role
Route::resource('role', RoleController::class);

//Patient
Route::resource('patient', PatientController::class);

//Doctor
Route::resource('doctor', DoctorController::class);

//Appiointment
Route::resource('appointment', AppointmentController::class);

//Status Updates
Route::resource('status', statusController::class);

//Prescriptions
Route::resource('prescription', PrescriptionController::class);

//PatientProfile
Route::get('/patientRole/{id}', [HomeController::class, 'viewPatient']);


//Medical Records
Route::resource('record', MedicalRecordsController::class);

//Printing Records
Route::resource('print', PrintRecordController::class);



///////this controller is for by role view because the api's are really hard to handle by role
Route::get('/patientRole', [ByRoleController::class, 'clickHere']);

Route::get('CreatePatientAppointment/{id}', [HomeController::class, 'CreatePatientAppointment'])->name('CreatePatientAppointment');

Route::get('recordPatient/{id}', [HomeController::class, 'recordPatient']);

Route::post('/updatePatient/{id}', [HomeController::class, 'update'])->name('updatePatient');

Route::post('createAppointment', [HomeController::class, 'createAppointment'])->name('createAppointment');


//////This is Doctor Role Side
Route::get('/doctor-dashboard', [HomeController::class, 'doctorDashboard']);

Route::get('/fitness', [FitnessController::class, 'index']);