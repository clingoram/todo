<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpFoundation\Response;

// model
use App\Models\Task;

class TaskController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allData = Task::select('id', 'description AS title', 'created_at AS start', 'end_at AS end', 'status AS taskStatus', 'classification')
            ->where('status', 0)
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'name' => ['bail', 'required', 'max:150', 'min:3', 'string'],
        //     'start' => ['required', 'date'],
        //     'end' => ['required'],
        //     // 'state' => ['Boolean'],
        //     // 'category' => ['required']
        // ]);
        // $this->validate($request, [
        //     'name' => ['bail', 'required', 'max:150', 'min:3', 'string'],
        //     'start' => ['required', 'date'],
        //     'end' => ['required'],
        //     'category' => ['required'],
        //     // 'state' => ['Boolean'],
        // ]);
        // if ($validator->fails()) {
        //     return response()->json(['Errors' => $validator->errors()], 422);
        // }
        // 新增成功
        $newTask = new Task;
        $newTask->description = $request->todoTask['name'];
        $newTask->created_at = $request->start;
        $newTask->end_at = $request->todoTask['end'];
        $newTask->classification = $request->classification;

        $newTask->save();
        // return $newTask;
        return response()->noContent(Response::HTTP_CREATED);
    }

    /**
     * Find specific data
     * @param int $id
     * @return json
     */
    public function show(Request $request, $id)
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
        // $this->validate($request, [
        //     'name' => ['bail', 'required', 'max:150', 'min:3', 'string'],
        //     'start' => ['required', 'date'],
        //     'end' => ['required'],
        //     'category' => ['required'],
        //     // 'state' => ['Boolean'],
        // ]);

        $findExist = Task::find($id);

        if (isset($findExist)) {
            $findExist->description = $request->todoTask['name'];
            $findExist->created_at = $request->todoTask['start'];
            $findExist->end_at = $request->todoTask['end'];
            $findExist->status = $request->todoTask['state'] ? false : true;
            $findExist->classification = $request->classification;

            // 更新時間要用當下更新的時間
            $findExist->updated_at = Carbon::now();
            $findExist->save();
            // return $findExist;
            return response($findExist, Response::HTTP_OK);
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
                // return "Deleted Successful.";
                return response()->json(null, Response::HTTP_NO_CONTENT);
            }
        }
        return "Not Found.";
    }
}
