<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// models
use App\Task;

// DB
// use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        return DB::table('task')->orderBy('id','desc')->get();
    }

    // save data
    public function store(Request $request)
    {
        // $newTask = new Task;
        // $newTask->description = $request->item['name'];
        // $newTask->save();
        // return $newTask;

        DB::table('task')->insert([
            'description' => $request->item['name']
        ]);

    }

    public function update()
    {

    }

    public function destory()
    {

    }
}
