<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// models
use App\Models\Task;

use Illuminate\Support\Carbon;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Task::orderByDesc('created_at')->get();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newTask = new Task;
        $newTask->description = $request->item['name'];
        $newTask->save();
        return $newTask;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $findExist = Task::find($id);

        if (isset($findExist)) {
            $findExist->status = $request->item['status'] ? true : false;
            $findExist->updated_at = $request->item['status'] ? Carbon::now() : null;
            $findExist->save();
            return $findExist;
        };
        return 'No data';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $findExist = Task::find($id);
        if (isset($findExist)) {
            $findExist->delete();
            return "Deleted Successful.";
        }
        return "Not Found.";
    }
}
