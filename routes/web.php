<?php
//to av

use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\ProgramController as AdminProgramController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\Admin\AssignmentController as AdminAssignmentController;

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
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes (protected by auth and admin role)
Route::prefix('admin')->middleware(['auth', 'EnsureRole:admin'])->group(function () {
    //display users in the dashboard only
    Route::get('/dashboard', [UserController::class, 'showDashboard'])->name('admindash');
    Route::post('/{id}/approve', [UserController::class, 'approve'])->name('users.approve');
    Route::post('/{id}/block', [UserController::class, 'block'])->name('users.block');
    Route::get('/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    // Blog Routes
    Route::get('/blogs', [AdminBlogController::class, 'index'])->name('blogs.index');
    Route::get('/blogs/create', [AdminBlogController::class, 'create'])->name('blogs.create');
    Route::post('/blogs', [AdminBlogController::class, 'store'])->name('blogs.store');
    Route::get('/blogs/{blog}', [AdminBlogController::class, 'show'])->name('blogs.show');
    Route::get('/blogs/{blog}/edit', [AdminBlogController::class, 'edit'])->name('blogs.edit');
    Route::put('/blogs/{blog}', [AdminBlogController::class, 'update'])->name('blogs.update');
    Route::delete('/blogs/{blog}', [AdminBlogController::class, 'destroy'])->name('blogs.destroy');

   // Event Routes
Route::get('/events', [AdminEventController::class, 'index'])->name('events.index');
Route::get('/events/create', [AdminEventController::class, 'create'])->name('events.create');
Route::post('/events', [AdminEventController::class, 'store'])->name('events.store');
Route::get('/events/{id}/edit',[AdminEventController::class,'edit'])->name('events.edit');
Route::put('/events/{id}',[AdminEventController::class,'update'])->name('events.update');
Route::delete('/events/{id}',[AdminEventController::class,'destroy'])->name('events.destroy');

//program Routes 
    Route::get('/programs',[AdminProgramController::class,'index'])->name('programs.index');
    Route::get('/programs/create',[AdminProgramController::class,'create'])->name('programs.creat');
    Route::post('/programs',[AdminProgramController::class,'store'])->name('programs.store');
    Route::get('/programs/{id}/edit',[AdminProgramController::class,'edit'])->name('programs.edit');
    Route::put('/programs/{id}',[AdminProgramController::class,'update'])->name('programs.update');
    Route::delete('/programs/{id}',[AdminProgramController::class,'destroy'])->name('programs.destroy');

//assignment routes 

Route::get('/assignments', [AdminAssignmentController::class, 'index'])->name('assignments.index');
Route::get('/assignments/create', [AdminAssignmentController::class, 'create'])->name('assignments.create');
Route::post('/assignments', [AdminAssignmentController::class, 'store'])->name('assignments.store');
Route::get('/assignments/{assignment}/edit',[AdminAssignmentController::class,'edit'])->name('assignment.edit');
Route::put('/assignments/{assignment}',[AdminAssignmentController::class,'update'])->name('assignments.update');
Route::delete('/assignments/{assignment}',[AdminAssignmentController::class, 'destroy'])->name('assignment.destroy');
// Assign students to an assignment (POST /admin/assignments/{assignment}/assign-students)
Route::post('/assignments/{assignment}/assign-students', [AdminAssignmentController::class, 'assignStudents'])->name('assignments.assign-students');
});









// Frontend Blog Routes (public access)
Route::get('/blogs', [BlogController::class, 'showFrontendBlogs'])->name('public.blogs.showFrontendBlogs');
// Route::get('/blogs/{blog}', [BlogController::class, 'show'])->name('public.blogs.show');
// User Dashboard

//frontend event routes (public access)
Route::get('/events', [EventController::class, 'showFrontendEvents'])->name('public.events.showFrontendEvents');

Route::get('/user/dashboard', function () {
    return 'Welcome, user!';
})->name('user.dashboard')->middleware(['auth', 'EnsureRole:user']);

// Redirect Route
Route::get('/redirect', function () {
    // if (auth()->check()) {
    //     if (auth()->user()->role === 'admin') {
    //         return redirect()->route('admin.users.index');
    //     } elseif (auth()->user()->role === 'user') {
    //         return redirect()->route('user.dashboard');
    //     }   
    // }
    return redirect()->route('login');
})->middleware(['auth', 'EnsureRedirect']);

require __DIR__ . '/auth.php';
