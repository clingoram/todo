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
     * 取得所有待辦事項資料
     * 
     * 在月曆上，顯示該月份所有待辦事項資料
     * 
     * @queryParam sort 設定排序方式 Example:DESC
     *
     * @response  {
     *  "id": 4,
     *  "title": "LeetCode",
     *  "status": true,
     *  "category":"Coding",
     *  "start": "2021-12-28 10:00:05",
     *  "end": "2021-12-30 12:21:07"
     * }
     * 
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
     * 新增待辦事項
     * 
     * 新增資料
     * 
     * @urlParam lang The language
     * @bodyParam name string required 待辦事項名稱 Example: 買衣服
     * @bodyParam classification string required 待辦事項所屬分類 Example: 購物
     * @bodyParam start string required 待辦事項開始日期與時間 Example: 2022-1-12 09:22:36
     * @bodyParam end string required 待辦事項結束日期與時間 Example: 2022-1-12 11:30:21
     * @bodyParam state boolean. 待辦事項狀態 預設true Example: true
     *
     * @response  201{
     *  "status": true,
     *  "message":"Success",
     *  "data_return":{
     *      null
     *  }
     * }
     * 
     * @response  400 {
     *  "status": false,
     *  "message": "todoTask.name不能為空",
     *  "data_return": null
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
     * 顯示特定待辦事項
     *
     * 取得單一資料
     * 
     * @urlParam id int required 待辦事項ID.
     * @urlParam lang The language.
     * 
     * @bodyParam id int required 待辦事項ID Example: 3
     * @bodyParam name string required 待辦事項名稱 Example: 買衣服
     * @bodyParam classification string required 待辦事項所屬分類 Example: 購物
     * @bodyParam start string required 待辦事項開始日期與時間 Example: 2022-1-12 09:22:36
     * @bodyParam end string required 待辦事項結束日期與時間 Example: 2022-1-12 11:30:21
     * @bodyParam state boolean. 待辦事項狀態 預設true Example: true
     *
     * @response  200{
     * "status": true,
     * "message": "Success",
     * "data_return": {
     *    "id": 3,
     *    "description": "LeetCode",
     *    "status": 0,
     *    "created_at": "2022-01-12T16:00:00.000000Z",
     *    "end_at": "2022-01-21 00:00:00",
     *    "name": "工作",
     *    "cId": 3
     *  }
     * }
     * 
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
     * 更新
     * 
     * 更新單一資料
     * 
     * @urlParam id int required 待辦事項ID.
     * @urlParam lang The language
     * 
     * @bodyParam name string required 待辦事項名稱 Example: 買衣服
     * @bodyParam classification string required 待辦事項所屬分類 Example: 購物
     * @bodyParam start string required 待辦事項開始日期與時間 Example: 2022-1-12 09:22:36
     * @bodyParam end string required 待辦事項結束日期與時間 Example: 2022-1-12 11:30:21
     * @bodyParam state boolean. 待辦事項狀態 預設true Example: true
     *
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
     * 刪除特定待辦項目
     * 
     * 刪除單一項目
     * 
     * @urlParam id int required 待辦項目ID
     * @bodyParam id int required 待辦項目ID Example: 2
     *
     * @response  200{
     *  "status": true,
     *  "message":"Success",
     *  "data_return":{
     *      null
     *  }
     * }
     * 
     * @response  204 {
     *  "status": false,
     *  "message": "Fail",
     *  "data_return": null
     * }
     * 
     */
    public function destroy(int $id)
    {
        $findExist = Task::find($id);
        if (isset($findExist)) {
            $findExist->delete();
            if ($findExist->trashed()) {
                return response()->json(
                    ['status' => true, 
                    'message' => 'Success', 
                    'data_return' => null],
                200);
            }
        }
        return response()->json(['status' => false, 'message' => 'Fail', 'data_return' => null], 204);
    }
}
