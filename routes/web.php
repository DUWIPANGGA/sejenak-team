<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Resource Routes
Route::resource('users', UserController::class);
Route::resource('roles', RoleController::class);
Route::resource('proposals', ProposalController::class);
Route::resource('sessions', SessionController::class);
Route::resource('messages', MessageController::class);
Route::resource('transactions', TransactionController::class);
Route::resource('posts', PostController::class);
Route::resource('comments', CommentController::class);
Route::resource('replies', ReplyController::class);
Route::resource('likes', LikeController::class);
Route::resource('moods', MoodController::class);
Route::resource('journals', JournalController::class);
Route::resource('audios', AudioController::class);
Route::resource('challenges', ChallengeController::class);
Route::resource('circles', CircleController::class);
Route::resource('exercises', ExerciseController::class);

// Custom Routes
Route::post('proposals/{proposal}/approve', [ProposalController::class, 'approve'])->name('proposals.approve');
Route::post('proposals/{proposal}/reject', [ProposalController::class, 'reject'])->name('proposals.reject');
Route::post('sessions/{session}/close', [SessionController::class, 'close'])->name('sessions.close');
Route::post('likes/toggle', [LikeController::class, 'toggleLike'])->name('likes.toggle');
Route::get('moods/user/{user}', [MoodController::class, 'userMoods'])->name('moods.user');
Route::get('moods/user/{user}/statistics', [MoodController::class, 'moodStatistics'])->name('moods.statistics');
Route::get('journals/user/{user}', [JournalController::class, 'userJournals'])->name('journals.user');
Route::get('audios/category/{category}', [AudioController::class, 'byCategory'])->name('audios.category');
Route::get('audios/{audio}/play', [AudioController::class, 'play'])->name('audios.play');
Route::post('challenges/{challenge}/join/{user}', [ChallengeController::class, 'join'])->name('challenges.join');
Route::post('challenges/{challenge}/complete/{user}', [ChallengeController::class, 'complete'])->name('challenges.complete');
Route::post('challenges/{challenge}/leave/{user}', [ChallengeController::class, 'leave'])->name('challenges.leave');
Route::get('challenges/{challenge}/participants', [ChallengeController::class, 'participants'])->name('challenges.participants');
Route::post('circles/{circle}/add-member', [CircleController::class, 'addMember'])->name('circles.add-member');
Route::post('circles/{circle}/remove-member/{user}', [CircleController::class, 'removeMember'])->name('circles.remove-member');
Route::post('circles/{circle}/update-role/{user}', [CircleController::class, 'updateMemberRole'])->name('circles.update-role');
Route::get('circles/user/{user}', [CircleController::class, 'myCircles'])->name('circles.my-circles');
Route::post('exercises/{exercise}/start/{user}', [ExerciseController::class, 'startExercise'])->name('exercises.start');
Route::post('exercises/{exercise}/complete/{user}', [ExerciseController::class, 'completeExercise'])->name('exercises.complete');
Route::get('exercises/type/{type}', [ExerciseController::class, 'byType'])->name('exercises.by-type');
Route::get('exercises/user/{user}/progress', [ExerciseController::class, 'userProgress'])->name('exercises.progress');
// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin,super_admin'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // User Management
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('users.edit');
    Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('users.update');
    Route::post('/users/{user}/suspend', [AdminController::class, 'suspendUser'])->name('users.suspend');
    Route::post('/users/{user}/unsuspend', [AdminController::class, 'unsuspendUser'])->name('users.unsuspend');
    Route::get('/users/{user}/activity', [AdminController::class, 'userActivity'])->name('users.activity');
    
    // Proposal Management
    Route::get('/proposals', [AdminController::class, 'proposals'])->name('proposals');
    Route::get('/proposals/{proposal}/review', [AdminController::class, 'reviewProposal'])->name('proposals.review');
    Route::post('/proposals/{proposal}/approve', [AdminController::class, 'approveProposal'])->name('proposals.approve');
    Route::post('/proposals/{proposal}/reject', [AdminController::class, 'rejectProposal'])->name('proposals.reject');
    
    // Moderation
    Route::get('/moderation/posts', [AdminController::class, 'moderationPosts'])->name('moderation.posts');
    Route::get('/moderation/comments', [AdminController::class, 'moderationComments'])->name('moderation.comments');
    Route::delete('/posts/{post}', [AdminController::class, 'deletePost'])->name('posts.delete');
    Route::delete('/comments/{comment}', [AdminController::class, 'deleteComment'])->name('comments.delete');
    Route::post('/posts/{post}/pin', [AdminController::class, 'pinPost'])->name('posts.pin');
    Route::post('/posts/{post}/unpin', [AdminController::class, 'unpinPost'])->name('posts.unpin');
    
    // Counseling Monitoring
    Route::get('/counseling/stats', [AdminController::class, 'counselingStats'])->name('counseling.stats');
    
    // Transaction Management
    Route::get('/transactions', [AdminController::class, 'transactions'])->name('transactions');
    Route::get('/transactions/export', [AdminController::class, 'exportTransactions'])->name('transactions.export');
    
    // Audio Management
    Route::get('/audios', [AdminController::class, 'audios'])->name('audios');
    Route::get('/audios/create', [AdminController::class, 'createAudio'])->name('audios.create');
    Route::post('/audios', [AdminController::class, 'storeAudio'])->name('audios.store');
    Route::get('/audios/{audio}/edit', [AdminController::class, 'editAudio'])->name('audios.edit');
    Route::put('/audios/{audio}', [AdminController::class, 'updateAudio'])->name('audios.update');
    Route::delete('/audios/{audio}', [AdminController::class, 'deleteAudio'])->name('audios.delete');
    
    // Challenge Management
    Route::get('/challenges', [AdminController::class, 'challenges'])->name('challenges');
    Route::get('/challenges/{challenge}/participants', [AdminController::class, 'challengeParticipants'])->name('challenges.participants');
    
    // Circle Management (Super Admin only)
    Route::get('/circles', [AdminController::class, 'circles'])->name('circles');
    Route::delete('/circles/{circle}', [AdminController::class, 'deleteCircle'])->name('circles.delete');
    
    // Reports
    Route::get('/reports', [AdminController::class, 'reports'])->name('reports');
});