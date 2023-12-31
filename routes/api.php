<?php

use App\Http\Controllers\ClasseController;
use App\Http\Controllers\CoursDeroulerController;
use App\Http\Controllers\CoursEnrollerController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\SemestreController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfesseurController;
use App\Http\Controllers\ProgramUeController;
use App\Http\Controllers\TableUeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// routes/api.php

Route::get('/users',[AuthController::class,'index']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');
Route::get('/showUser/{id}',[AuthController::class,'show']);





//Module
Route::get('/module',[ModuleController::class,'index']);
Route::post('/storeModule',[ModuleController::class,'store']);
Route::get('/showModule/{id}',[ModuleController::class,'show']);
Route::put('/updateModule/{id}',[ModuleController::class,'update']);
Route::delete('/deleteModule/{id}',[ModuleController::class,'destroy']);

//Semestre
Route::get('/semestre',[SemestreController::class,'index']);
Route::post('/storeSemestre',[SemestreController::class,'store']);
Route::get('/showSemestre/{id}',[SemestreController::class,'show']);
Route::put('/updateSemestre/{id}',[SemestreController::class,'update']);
Route::delete('/deleteSemestre/{id}',[SemestreController::class,'destroy']);


//TableUe
Route::get('/tableUe',[TableUeController::class,'index']);
Route::post('/storeTableUe',[TableUeController::class,'store']);
Route::get('/showTableUe/{id}',[TableUeController::class,'show']);
Route::put('/updateTableUe/{id}',[TableUeController::class,'store']);
Route::delete('/deleteTableUe/{id}',[TableUeController::class,'destroy']);


//ProgramUe
Route::get('/programUe',[ProgramUeController::class,'index']);
Route::post('/storeProgramUe',[ProgramUeController::class,'store']);
Route::get('/programUe/showModulesByClass/{id}',[ProgramUeController::class,'showModulesByClass']);
Route::get('/showProgramUe/{id}',[ProgramUeController::class,'show']);
Route::get('/programUe/showModulesByClass/{classeId}', [ProgramUeController::class, 'showModulesByClass']);
Route::get('/programUe/showModuleByUeByClass/{classeId}/{ueId}', [ProgramUeController::class, 'showModuleByUeByClass']);
Route::get('/programUe/showUeByClass/{classeId}', [ProgramUeController::class, 'showUeByClass']);
Route::put('/updateProgramUe/{id}',[ProgramUeController::class,'store']);
Route::delete('/deleteProgramUe/{id}',[ProgramUeController::class,'destroy']);

//Classe
Route::get('/classe',[ClasseController::class,'index']);
Route::post('/storeClasse',[ClasseController::class,'store']);
Route::get('/showClasse/{id}', [ClasseController::class, 'show']);
Route::put('/updateClasse/{id}', [ClasseController::class, 'update']);
Route::delete('/deleteClasse/{id}', [ClasseController::class, 'destroy']);

//Professeurs
//Classe
Route::get('/professeur',[ProfesseurController::class,'index']);
Route::post('/storeProf',[ProfesseurController::class,'store']);
Route::get('/showProf/{id}', [ProfesseurController::class, 'show']);
Route::put('/updateProf/{id}', [ProfesseurController::class, 'update']);
Route::delete('/deleteProf/{id}', [ProfesseurController::class, 'destroy']);



//Cours_Enroller
Route::get('/coursE',[CoursEnrollerController::class,'index']);
Route::post('/storeCoursE',[CoursEnrollerController::class,'store']);
Route::get('/showCoursE/{id}', [CoursEnrollerController::class, 'show']);
Route::get('/coursE/showClassById/{id}', [CoursEnrollerController::class, 'showClassById']);

Route::put('/updateCoursE/{id}', [CoursEnrollerController::class, 'update']);
Route::delete('/deleteCoursE/{id}', [CoursEnrollerController::class, 'destroy']);


//Cours_Derouler
Route::get('/coursD',[CoursDeroulerController::class,'index']);
Route::post('/storeCoursD',[CoursDeroulerController::class,'store']);
Route::get('/showCoursD/{id}', [CoursDeroulerController::class, 'show']);
Route::put('/updateCoursD/{id}', [CoursDeroulerController::class, 'update']);
Route::delete('/deleteCoursD/{id}', [CoursDeroulerController::class, 'destroy']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}

);
