<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InstituteController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\DiplomawiseCoursesController;
use App\Http\Controllers\DiplomaController;
use App\Http\Controllers\ExaminationCriteriaController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\MarksController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\StudentDiplomaController;
use App\Http\Controllers\SubjectController;
use App\Models\Certificate;
use App\Models\ExaminationCriteria;
use App\Models\StudentDiploma;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['web', 'auth:super_admin'])->group(function () {
    Route::resource('superAdmin', SuperAdminController::class);
});

Route::prefix('super-admin')
    ->middleware(['web', 'auth:super_admin'])
    ->group(function () {
        // Route::get('/dashboard', [SuperAdminController::class, 'index'])->name('super_admin.dashboard');
        Route::resource('/institute', InstituteController::class);
        Route::resource('/session', SessionController::class);
        Route::resource('/course', CourseController::class);
        Route::resource('/grade', GradeController::class);
        Route::resource('/marks', MarksController::class);
        Route::resource('/examination-criteria', ExaminationCriteriaController::class);
        Route::resource('/semester', SemesterController::class);
        Route::resource('/diplomawiseCourse', DiplomawiseCoursesController::class);
        Route::resource('/diploma', DiplomaController::class);
        Route::get('/view-admins', [SuperAdminController::class, 'viewAdmins'])->name('viewAdmins');
        Route::get('/print-certificate', [SuperAdminController::class, 'printcer'])->name('printcer');
        Route::get('/assigned-courses', [DiplomaController::class, 'assignedCourses'])->name('diploma.assignedCourses');
        Route::get('/students-results', [SuperAdminController::class, 'studentsResults'])->name('superAdmin.studentsResults');
        Route::get('/certificates-requests', [SuperAdminController::class, 'certificatesRequests'])->name('superAdmin.certificatesRequests');
        Route::get('/print-certificates', [SuperAdminController::class, 'printCertificates'])->name('superAdmin.printCertificates');
        Route::post('/print-front/{id}', [SuperAdminController::class, 'printFront'])->name('superAdmin.printFront');
        Route::post('/print-back/{id}', [SuperAdminController::class, 'printBack'])->name('superAdmin.printBack');
    });


Route::middleware(['web', 'admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::resource('/admin', AdminController::class)->names([
        'index' => 'admin.index',
        'create' => 'admin.create',
        'store' => 'admin.store',
        'edit' => 'admin.edit',
        'update' => 'admin.update',
        'destroy' => 'admin.destroy',
        'show' => 'admin.show',
    ]);

    Route::resource('student', StudentController::class);
    Route::resource('/result', ResultController::class);
    Route::resource('studentDiploma', StudentDiplomaController::class);
    // Route::get('request-certificate', [AdminController::class, 'requestCertificate'])->name('admin.requestCertificate');
    Route::get('requested-certificates', [AdminController::class, 'requestedCertificates'])->name('admin.viewCertificates');
    Route::resource('/certificate', CertificateController::class);
    // Route::post('/certificate/store/{id}', [CertificateController::class, 'store'])->name('certificate.store');
    // Route::get('admin/student/student-list', [StudentController::class, 'adminIndex'])->name('admin.studentList');

});



require __DIR__ . '/auth.php';
// $2y$12$MGUKRihIe1HCL1CKvl6da.QsRA7Hd/J9W540JOHYl8SEN5nUUqzh.