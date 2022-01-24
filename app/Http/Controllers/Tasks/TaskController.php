<?php

namespace App\Http\Controllers\Tasks;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

// model
use App\Models\Task;

/**
 * @group Tasks management
 * 
 * APIs for manage tasks resource.
 */
class TaskController extends Controller
{
    /**
     * Display a listing of tasks.
     * 
     * Get a list of tasks.
     *
     * Success:
     * @response  {
     *  "id": 4,
     *  "title": "LeetCode",
     *  "status": true,
     *  "category":"Coding",
     *  "start": "2021-12-28 10:00:05",
     *  "end": "2021-12-30 12:21:07"
     * }
     * 
     * Fail:
     * @response  400 {
     *  "status": false,
     *  "message": "todoTask.name不能為空",
     * }
     * 
     * 
     * @return 格式為JSON的回應
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allData = Task::select('id', 'description AS title', 'created_at AS start', 'end_at AS end', 'status AS taskStatus', 'classification')
            ->where('status', false)
            ->orWhere('deleted_at', null)
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
     * @bodyParam type string array required.Task name,classification,start date,end date and state.
     * @urlParam  lang The language (路徑參數，依序為名稱 說明)
     * @queryParam  page The page number to return (查詢字串參數，依序為名稱 說明)
     * @queryParam  page required The page number. Example: 4 (查詢字串參數帶範例，依序為名稱 必填 說明 範例)
     * @queryParam  user_id required The id of the user. No-example(查詢字串參數不要帶範例)
     *
     * Success:
     * @response  {
     *  "status": true,
     *  "message":"Success",
     *  "data_return":{
     *      
     *  }
     * }
     * 
     * Fail:
     * @response  400 {
     *  "status": false,
     *  "message": "todoTask.name不能為空",
     * }
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 驗證
        $validated = Validator::make($request->all(), [
            'todoTask.name' => ['bail', 'required', 'max:150', 'min:2', 'string'],
            'todoTask.start' => ['required', 'date'],
            'todoTask.end' => ['required', 'date'],
            'todoTask.state' => ['Boolean'],
            'classificationSelected' => ['required', 'numeric']
        ]);
        if ($validated->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validated->errors(),
                'data_return' => null,
            ], 400);
        }

        $newTask = new Task;
        $newTask->description = $request->todoTask['name'];
        $newTask->created_at = $request->todoTask['start'];
        $newTask->end_at = $request->todoTask['end'];
        $newTask->classification = $request->classificationSelected;
        $newTask->save();

        return response()->json([
            'status' => true,
            'message' => 'Success.',
            'data_return' => $newTask
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @bodyParam int id required.Task id.
     * @urlParam  task id int
     * @queryParam  page The page number to return (查詢字串參數，依序為名稱 說明)
     * @queryParam  page required The page number. Example: 4 (查詢字串參數帶範例，依序為名稱 必填 說明 範例)
     * @queryParam  task id required .The id of the task.
     *
     * Success:
     * @response  {
     *  "id": 4,
     *  "title": "LeetCode",
     *  "status": true,
     *  "category":"Coding",
     *  "start": "2021-12-28 10:00:05",
     *  "end": "2021-12-30 12:21:07"
     * }
     * 
     * Fail:
     * @response  400 {
     *  "status": false,
     *  "message": "Somethig wrong.",
     * }
     * 
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $find = Task::select(
            'task.id',
            'task.description',
            'task.status',
            'task.created_at',
            'task.end_at',
            'category.name',
            'category.id AS cId'
        )->join('category', 'task.classification', '=', 'category.id')->where('task.id', $id)->first();

        if (isset($find)) {
            return response()->json([
                'status' => true,
                'message' => 'Success',
                'data_return' => $find
            ], 200);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Something wrong.',
                'data_return' => null,
            ], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        // 驗證
        $validator = Validator::make($request->all(), [
            'todoTask.name' => ['bail', 'required', 'max:150', 'min:2', 'string'],
            'todoTask.start' => ['required', 'date'],
            'todoTask.end' => ['required'],
            'todoTask.state' => ['Boolean'],
            'classification' => ['required', 'numeric']
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors(),
                'data_return' => null,
            ], 404);
        }

        $findExist = Task::find($id);
        $findExist->description = $request->todoTask['name'];
        $findExist->created_at = $request->todoTask['start'];
        $findExist->end_at = $request->todoTask['end'];
        $findExist->status = $request->todoTask['state'] ? false : true;
        $findExist->classification = $request->classification;
        // 更新時間要用當下更新的時間
        $findExist->updated_at = Carbon::now();
        $findExist->save();

        if ($findExist === true) {
            return response()->json(['status' => true, 'message' => 'Success', 'data_return' => null], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $findExist = Task::find($id);
        if (isset($findExist)) {
            $findExist->delete();

            if ($findExist->trashed()) {
                return response()->json(['status' => true, 'message' => 'Success', 'data_return' => null], 200);
            }
        }
        return response()->json(['status' => false, 'message' => 'Fail', 'data_return' => null], 204);
    }
}
