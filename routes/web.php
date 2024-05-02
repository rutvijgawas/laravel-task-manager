<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/', [TaskController::class, 'index'])->name('/');
Route::controller(TaskController::class)->group(function(){
    Route::get('/projects', 'showProjects')->name('projects.show');
    Route::get('/project/{id}', 'projectTaskList')->name('tasks');
    Route::post('/task/{project_id}', 'store')->name('task.store');
    Route::put('/task/updatePriority', 'updatePriority')->name('task.updatePriority');
    Route::put('/task/{task}/update', 'update')->name('task.update');
    Route::delete('/task/{task}/delete', 'destroy')->name('task.destroy');
});
