<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

class Task
{
  public function __construct(
    public int $id,
    public string $title,
    public string $description,
    public ?string $long_description,
    public bool $completed,
    public string $created_at,
    public string $updated_at
  ) {
  }
}


Route::get('/', function () {
    return redirect()->route('tasks.index');
});

Route::get('/tasks', function () {
    return view('index', [
      // we want to get all tasks. We want most recent task first
      // 'tasks'=> \App\Models\Task::latest()->where('completed', true)->get(), methods from Query Builder

       'tasks'=> \App\Models\Task::latest()->get()
    ]
 );
})->name('tasks.index');


Route::view('/tasks/create', 'create')->name('tasks.create');

// We can use Task and laravel will grab primary key wich is id of task. Then we do not need use findOrFail. Laravel will catch that for us
Route::get('/tasks/{task}/edit' , function (\App\Models\Task $task) {

  return view('edit', [
    'task' => $task
  ]);

})->name('tasks.edit');


// we are using use() when we passing data
// Route::get('/tasks/{id}' , function ($id) use($tasks) {
Route::get('/tasks/{task}' , function (\App\Models\Task $task) {
    // $task = collect($tasks)->firstWhere('id', $id);

    // if(!$task) {
    //     abort(404);
    // }

    // find return null if do not find anything. We need to take care of it. We are using findOrFail not Find
    return view('show', [
      'task' => $task
      ]);

})->name('tasks.show');

Route::post('/tasks', function(Request $request) {
  $data = $request->validate([
    'title'=> 'required|max:255',
    'description' => 'required',
    'long_description' => 'required',
  ]);

  $task = new App\Models\Task;
  $task->title = $data['title'];
  $task->description = $data['description'];
  $task->long_description = $data['long_description'];
  $task->completed = false;
  $task->save();

  return redirect()->route('tasks.show', ['task'=> $task->id])
    ->with('success', 'Task created successfuly!');

})->name('tasks.store');

Route::put('/tasks/{task}', function(\App\Models\Task $task, Request $request) {
  $data = $request->validate([
    'title'=> 'required|max:255',
    'description' => 'required',
    'long_description' => 'required',
  ]);

  $task->title = $data['title'];
  $task->description = $data['description'];
  $task->long_description = $data['long_description'];
  $task->completed = false;
  $task->save();

  return redirect()->route('tasks.show', ['task'=> $task->id])
    ->with('success', 'Task updated successfuly!');

})->name('tasks.update');

// If route is not a match
Route::fallback(function () {
    return 'Still ot somwhere!';
});
