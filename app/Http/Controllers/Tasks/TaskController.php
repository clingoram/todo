<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

// models
use App\Models\Task;

// DB
use Illuminate\Support\Facades\DB;

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
        // fullcalendar key只能用title,start,end
        $data = DB::table('task')->select('description as title', 'created_at as start', 'updated_at as end from task')->get();
        // return Task::orderByDesc('created_at')->get();

        // $data = [
        //     [
        //         "title" => "測試資料1",
        //         "start" => "2021-08-13",
        //         "end" => "2021-08-17"
        //     ],
        //     [
        //         "title" => "One",
        //         "start" => "2021-08-30",
        //         "end" => "2021-09-01"
        //     ]
        // ];
        return $data;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'addtaskName' => 'bail|required|max:150|min:3',
        //     'dateTime' => 'required',
        // ]);

        // if ($validator->fails()) {
        //     return response()->json(['errors' => $validator->errors()], 422);
        // }

        $newTask = new Task;
        $newTask->description = $request->task['addtaskName'];
        $newTask->created_at = $request->task['dateTime'];
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
