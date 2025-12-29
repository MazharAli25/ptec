<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DiplomaController;
use App\Http\Controllers\DiplomawiseCoursesController;
use App\Http\Controllers\ExaminationCriteriaController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\InstituteController;
use App\Http\Controllers\MarksController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\StudentCardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentDiplomaController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\StudentQuizController;
use App\Models\Certificate;
use App\Models\Quiz;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

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

Route::middleware('auth:student')->prefix('student')->group(function () {
    Route::get('/student', [StudentController::class, 'studentDashboard'])->name('student.dashboard');
    Route::get('/courses', [StudentController::class, 'studentCourses'])->name('student.courses');
    Route::get('/my-quizzes', [QuizController::class, 'myQuizzes'])->name('student.myQuizzes');
});

Route::prefix('super-admin')
    ->middleware(['web', 'auth:super_admin'])
    ->group(function () {
        // Route::get('/dashboard', [SuperAdminController::class, 'index'])->name('super_admin.dashboard');
        Route::resource('/institute', InstituteController::class);
        Route::get('student/', [StudentController::class, 'index'])->name('student.index');

        Route::resource('/session', SessionController::class);
        Route::resource('/course', CourseController::class);
        Route::resource('/grade', GradeController::class);
        Route::resource('/marks', MarksController::class);
        Route::resource('/examination-criteria', ExaminationCriteriaController::class);
        Route::resource('/semester', SemesterController::class);
        Route::resource('/diplomawiseCourse', DiplomawiseCoursesController::class);
        Route::resource('/diploma', DiplomaController::class);
        Route::resource('/quiz', QuizController::class);
        Route::resource('/question', QuestionsController::class);
        Route::get('/view-admins', [SuperAdminController::class, 'viewAdmins'])->name('viewAdmins');
        Route::get('/print-certificate', [SuperAdminController::class, 'printcer'])->name('printcer');
        Route::get('/assigned-courses', [DiplomaController::class, 'assignedCourses'])->name('diploma.assignedCourses');
        Route::get('/students-results', [SuperAdminController::class, 'studentsResults'])->name('superAdmin.studentsResults');
        Route::get('/certificates-requests', [SuperAdminController::class, 'certificatesRequests'])->name('superAdmin.certificatesRequests');
        Route::get('/print-certificates', [SuperAdminController::class, 'printCertificates'])->name('superAdmin.printCertificates');
        Route::post('/print-front/{id}', [SuperAdminController::class, 'printFront'])->name('superAdmin.printFront');
        Route::post('/print-back/{id}', [SuperAdminController::class, 'printBack'])->name('superAdmin.printBack');
        Route::get('/student-cards/requests', [SuperAdminController::class, 'studentCardRequests'])->name('superCard.requests');
        Route::put('/student-card/request/{studentCard}', [StudentCardController::class, 'update'])->name('card.update');
        Route::get('/student-cards/print-cards', [StudentCardController::class, 'printCards'])->name('card.printCards');
        Route::post('/student-cards/print-front/{id}', [StudentCardController::class, 'printFront'])->name('card.printFront');
        Route::get('/student-cards/print-front/{id}', [StudentCardController::class, 'printFront'])->name('card.printFront');
        Route::post('/student-cards/print-back/{id}', [StudentCardController::class, 'printBack'])->name('card.printBack');
        Route::get('/student-cards/print-back/{id}', [StudentCardController::class, 'printBack'])->name('card.printBack');
        Route::get('/get-super-sessions/{diplomaName}', [DiplomawiseCoursesController::class, 'getSessions']);
    });

Route::middleware(['web', 'admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::get('student/change-password', [StudentController::class, 'changeStudentPassword'])->name('student.changePassword');
    Route::post('student/update-password/{student}', [StudentController::class, 'updateStudentPassword'])->name('student.updatePassword');
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
    Route::get('admin/student/registered-student-list', [AdminController::class, 'registeredStudentsList'])->name('admin.registeredStudentList');
    Route::get('admin/student/assigned-diplomas', [AdminController::class, 'assignedDiplomas'])->name('admin.assignedDiplomas');

    // Student Card Routes
    Route::get('student-card/request', [StudentCardController::class, 'create'])->name('card.create');
    Route::post('student-card/store', [StudentCardController::class, 'store'])->name('card.store');
    Route::get('student-card/requested-cards', [StudentCardController::class, 'index'])->name('card.index');
    Route::delete('student-card/{studentCard}', [StudentCardController::class, 'destroy'])
        ->name('card.destroy');
    // Route::get('/get-sessions/{diplomaId}', [App\Http\Controllers\StudentDiplomaController::class, 'getSessions'])->name('get.sessions');
    Route::get('/get-sessions/{diplomaName}', [StudentDiplomaController::class, 'getSessions']);
    Route::get('/student-list', [StudentController::class, 'studentList'])->name('admin.studentList');
    Route::get('/students-accounts-list', [StudentController::class, 'studentAccountsList'])->name('student.accountsList');
    Route::get('/students-accounts/{student}/edit', [StudentController::class, 'editStudentAccount'])->name('student.editStudentAccount');
    Route::post('/students-accounts/{student}', [StudentController::class, 'updateStudentAccount'])->name('student.updateStudentAccount');
    Route::post('/student/toggle-status/{id}', [StudentController::class, 'toggleStatus'])
        ->name('student.toggleStatus');

    // Quiz Routes
    Route::get('admin/quiz/list', [QuizController::class, 'adminQuizIndex'])->name('admin.quiz.list');
    Route::get('admin/quiz/view/{quiz}', [QuizController::class, 'viewQuizAdmin'])->name('admin.quiz.view');
    Route::get('admin/quiz/assign', [QuizController::class, 'assignQuizToStudents'])->name('admin.quiz.assign');
    Route::post('admin/quiz/assign', [QuizController::class, 'storeAssignedQuiz'])->name('admin.quiz.storeAssignedQuiz');
    Route::get('admin/assigned-quizzes/list', [QuizController::class, 'assginedQuizzesList'])->name('admin.assigned.quizzes.list');
});


Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

require __DIR__.'/auth.php';
// $2y$12$MGUKRihIe1HCL1CKvl6da.QsRA7Hd/J9W540JOHYl8SEN5nUUqzh.
