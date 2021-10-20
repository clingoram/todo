<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

// models
use App\Models\Task;
use App\Models\Category;


class TaskController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allData = Task::select('id', 'description AS title', 'created_at AS start', 'end_at AS end', 'status AS taskStatus')
            ->where('status', 0)
            ->orderByDesc('created_at')
            ->get();

        $array = [];
        foreach ($allData as $key) {
            $task['id'] = $key['id'];
            $task['title'] = $key['title'];
            $task['status'] = $key['taskStatus'] ? false : true;
            $task['category'] = $key['classification'];
            $task['start'] = $key['start'];
            $task['end'] = $key['end'];
            array_push($array, $task);
        }
        return json_encode($array);
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
        //     'name' => ['bail', 'required', 'max:150', 'min:3', 'string'],
        //     'start' => ['required', 'date'],
        //     'end' => ['required'],
        //     // 'state' => ['Boolean']
        // ]);

        // $messages = [
        //     'same' => 'The :attribute and :other must match.',
        //     'size' => 'The :attribute must be exactly :size.',
        //     'between' => 'The :attribute value :input is not between :min - :max.',
        //     'in' => 'The :attribute must be one of the following types: :values',
        // ];

        // if ($validator->fails()) {
        //     return response()->json(['Errors' => $validator->errors()], 422);
        // }
        // 新增成功
        $newTask = new Task;
        $newTask->description = $request->todoTask['name'];
        $newTask->created_at = $request->start;
        $newTask->end_at = $request->todoTask['end'];
        // $newTask->end_at = $request->todoTask['classification'];

        $newTask->save();
        return $newTask;
    }

    /**
     * Find specific data
     * @param int $id
     * @return json
     */
    public function find($id)
    {
        // $find = Task::find($id);

        $find = Task::select(
            'task.id',
            'task.description',
            'task.status',
            'task.created_at',
            'task.end_at',
            'category.name'
        )->join('category', 'task.classification', '=', 'category.id')->where('task.id', $id)->first();

        if (isset($find)) {
            return json_encode($find);
        }
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
            $findExist->description = $request->todoTask['name'];
            $findExist->created_at = $request->todoTask['start'];
            $findExist->end_at = $request->todoTask['end'];
            $findExist->status = $request->todoTask['state'] ? false : true;
            // 更新時間要用當下更新的時間
            $findExist->updated_at = Carbon::now();
            $findExist->save();
            return $findExist;
        };
        // 無資料
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

            if ($findExist->trashed()) {
                return "Deleted Successful.";
            }
        }
        return "Not Found.";
    }
}
