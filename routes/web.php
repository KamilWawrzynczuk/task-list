<?php
use App\Models\Task;
use App\Http\Requests\TaskRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return redirect()->route('tasks.index');
});

Route::get('/tasks', function () {
    return view('index', [
      // we want to get all tasks. We want most recent task first
      // 'tasks'=> \App\Models\Task::latest()->where('completed', true)->get(), methods from Query Builder
      // or paginate() to use paginations
       'tasks'=> Task::latest()->paginate(10)
    ]
 );
})->name('tasks.index');


Route::view('/tasks/create', 'create')->name('tasks.create');

// We can use Task and laravel will grab primary key wich is id of task.
// Then we do not need use findOrFail. Laravel will catch that for us
Route::get('/tasks/{task}/edit' , function (Task $task) {

  return view('edit', [
    'task' => $task
  ]);

})->name('tasks.edit');

// we are using use() when we passing data
// Route::get('/tasks/{id}' , function ($id) use($tasks) {
Route::get('/tasks/{task}' , function (Task $task) {

    return view('show', [
      'task' => $task
      ]);

})->name('tasks.show');

Route::post('/tasks', function(TaskRequest $request) {

  $task = Task::create( $request->validated() );

  return redirect()->route('tasks.show', ['task'=> $task->id])
    ->with('success', 'Task created successfuly!');

})->name('tasks.store');

Route::put('/tasks/{task}', function(Task $task, TaskRequest $request) {

  $task->update( $request->validated());

  return redirect()->route('tasks.show', ['task'=> $task->id])
    ->with('success', 'Task updated successfuly!');

})->name('tasks.update');


Route::delete('task/{task}', function(Task $task){
  $task->delete();

  return redirect()->route('tasks.index')
    ->with('success','Task deleted successfuly');
})->name('tasks.destroy');

Route::put('tasks/{task}/toogle-complete', function(Task $task){
  $task->toogleComplete();

  return redirect()->back()->with('success','Task updated sucessfully');
})->name('tasks.toogle-complete');

// If route is not a match
Route::fallback(function () {
    return 'Still ot somwhere!';
});
