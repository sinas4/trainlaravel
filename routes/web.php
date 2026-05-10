<?php
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\CustomAuthCheck;
use Illuminate\Contracts\Support\ValidatedData;
use App\Models\Post;
use function PHPUnit\Framework\isNull;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/phone/check', [AuthController::class, 'checkPhone'])->name('phone.check');
Route::get('/verify', [AuthController::class, 'showVerify'])->name('verify');
Route::post('/verify-code', [AuthController::class, 'verifyCode'])->name('verify.code');

Route::get('/complete-profile', [AuthController::class, 'showCompleteProfile'])->name('complete.profile');
Route::post('/complete-profile', [AuthController::class, 'completeProfile'])->name('complete.profile.submit');

Route::get('/login/password', [AuthController::class, 'showLoginWithPassword'])->name('login.password');
Route::post('/login/password', [AuthController::class, 'loginWithPassword'])->name('login.password.submit');

Route::middleware(CustomAuthCheck::class)->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::put('/dashboard/update-profile', [DashboardController::class, 'updateProfile'])->name('dashboard.update.profile');
    Route::put('/dashboard/update-password', [DashboardController::class, 'updatePassword'])->name('dashboard.update.password');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});









//  صفحه اصلی  
Route::get('/', function () {
    return view('home');
})->name('home');









//  وبلاگ‌ها 

Route::prefix('posts')->name('posts.')->group(function(){
    Route::get('/' , [PostController::class , 'index'])->name('index');
    //رفتن به صفحه ایجاد پست
    Route::get('/create', [PostController::class , 'create'])->name('create')->middleware(CustomAuthCheck::class);
    // ایجاد پست
    Route::post('/store', [PostController::class , 'store'])->name('store');
    //single.post
    Route::get('/{post:slug}', [PostController::class, 'single'])->name('single');

    Route::get('/{post:slug}/edit', [PostController::class, 'edit'])->name('edit');

    Route::put('/{post:slug}', [PostController::class, 'update'])->name('update');

    Route::delete('/{post:slug}', [PostController::class, 'delete'])->name('delete');

}); 













//  todo list
Route::get('/todos', function () {
    $todos = session('todos', []);
    return view('todos.index', compact('todos'));
})->name('todos.index');

Route::post('/todos', function (Request $request) {
    $todos = session('todos', []);
    $todos[] = $request->input('title');
    session(['todos' => $todos]);
    return redirect()->route('todos.index');
})->name('todos.store');

Route::get('/todos/delete/{index}', function ($index) {
    $todos = session('todos', []);
    unset($todos[$index]);
    session(['todos' => array_values($todos)]);
    return redirect()->route('todos.index');
})->name('todos.delete');





//  یادداشت‌ها 
Route::prefix('notes')->name('notes.')->group(function () {
    Route::get('/', function () {
        $notes = session('notes', []);
        return view('notes.index', compact('notes'));
    })->name('index');

    Route::post('/', function (Request $request) {
        $notes = session('notes', []);
        $notes[] = [
            'id' => Str::random(5),
            'title' => $request->title,
            'body' => $request->body,
        ];
        session(['notes' => $notes]);
        return redirect()->route('notes.index');
    })->name('store');

    Route::get('/delete/{id}', function ($id) {
        $notes = session('notes', []);
        $notes = array_filter($notes, function ($note) use ($id) {
            return $note['id'] != $id;
        });
        session(['notes' => array_values($notes)]);
        return redirect()->route('notes.index');
    })->name('delete');

    Route::get('/{id}', function ($id) {
        $notes = session('notes', []);
        $note = collect($notes)->firstWhere('id', $id);
        return view('notes.show', compact('note'));
    })->name('show');
});





// کاربران 
Route::prefix('users')->name('users.')->group(function () {
    Route::get('/', function () {
        return view('users.index');
    })->name('index');

    Route::get('/{userId}', function ($userId) {
        return view('users.single', compact('userId'));
    })->name('single');
});