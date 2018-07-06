<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Task;
class TasksController extends Controller
{

    public function index(){
        //$tasks = \DB::table('task')->find($id);
        $tasks = Task::completed()->latest()->get(); // completed è il mio metodo custom che trovo nel model

        return view('welcome', compact('tasks'));
    }

    public function show(Task $task){
        //$tasks = \DB::table('task')->find($id);
        $tasks = $task::find($task);
        return view('welcome', compact('tasks'));
    }
}
