<?php

use Illuminate\Support\Facades\Route;

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

// $tasks = [
//   new Task(
//     1,
//     'Buy groceries',
//     'Task 1 description',
//     'Task 1 long description',
//     false,
//     '2023-03-01 12:00:00',
//     '2023-03-01 12:00:00'
//   ),
//   new Task(
//     2,
//     'Sell old stuff',
//     'Task 2 description',
//     null,
//     false,
//     '2023-03-02 12:00:00',
//     '2023-03-02 12:00:00'
//   ),
//   new Task(
//     3,
//     'Learn programming',
//     'Task 3 description',
//     'Task 3 long description',
//     true,
//     '2023-03-03 12:00:00',
//     '2023-03-03 12:00:00'
//   ),
//   new Task(
//     4,
//     'Take dogs for a walk',
//     'Task 4 description',
//     null,
//     false,
//     '2023-03-04 12:00:00',
//     '2023-03-04 12:00:00'
//   ),
// ];

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


// we are using use() when we passing data
// Route::get('/tasks/{id}' , function ($id) use($tasks) {
Route::get('/tasks/{id}' , function ($id) {
    // $task = collect($tasks)->firstWhere('id', $id);

    // if(!$task) {
    //     abort(404);
    // }

    // find return null if do not find anything. We need to take care of it. We are using findOrFail not Find
    return view('show', [
      'task' => \App\Models\Task::findOrFail($id)
      ]);

})->name('tasks.show');

// set up name for route
// Route::get("/xxx", function () {
//     return 'Hello';
// })->name('hello route');

// Route::get('hallo', function () {
//     return redirect()->route('hello route');
// });

// Route::get('/greet/{name}', function ($name) {
//     return 'Hello ' . $name . '!';
// });

// If route is not a match
Route::fallback(function () {
    return 'Still ot somwhere!';
});


// GET
// POST
// PUT
// DELETE
