<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpFoundation\Response;

// model
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
        ], 200);
    }

    /**
     * Display the specified resource.
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

        return response()->json(['status' => true, 'message' => 'Success', 'data_return' => null], 200);
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
