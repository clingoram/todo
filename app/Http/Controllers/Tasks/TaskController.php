<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $allData = Task::select('id', 'description AS title', 'created_at AS start', 'end_at AS end', 'status AS taskStatus')
            ->where('status', 0)
            ->orderByDesc('created_at')
            ->get();

        $array = [];
        foreach ($allData as $key) {
            $task['id'] = $key['id'];
            $task['title'] = $key['title'];
            $task['status'] = $key['taskStatus'];
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
        //     'name' => 'bail|required|max:150|min:3',
        //     'dateTime' => 'required',
        // ]);

        // if ($validator->fails()) {
        //     return response()->json(['errors' => $validator->errors()], 422);
        // }

        // 新增成功
        $newTask = new Task;
        $newTask->description = $request->todoTask['name'];
        $newTask->created_at = $request->start;
        $newTask->end_at = $request->todoTask['end'];
        // $newTask->end_at = $request->todoTask['category'];

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
        $find = Task::find($id);
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
            // 更新成功
            $findExist->status = $request->item['status'] ? true : false;
            // 更新時間要用當下更新的時間
            $findExist->updated_at = $request->item['dateTimeStart'] ? Carbon::now() : null;
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
            return "Deleted Successful.";
        }
        return "Not Found.";
    }
}
