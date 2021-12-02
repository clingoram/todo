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
        // $validated = Validator::make($request->all(), [
        //     'name' => ['bail', 'required', 'max:150', 'min:2', 'string'],
        //     'start' => ['required', 'date'],
        //     'end' => ['required', 'date'],
        //     'state' => ['Boolean'],
        //     // 'classificationSelected' => ['required', 'numeric']
        // ]);

        // // 客製化抓到錯誤後的行為
        // if ($validated->fails()) {
        //     return response()->json([
        //         'message' => 'Parameters Error',
        //         'status' => false,
        //         'error' => $validated->errors(),
        //     ], 400);
        // }


        // 新增成功
        $newTask = new Task;
        $newTask->description = $request->todoTask['name'];
        $newTask->created_at = $request->todoTask['start'];
        $newTask->end_at = $request->todoTask['end'];
        $newTask->classification = $request->classificationSelected;
        $newTask->save();

        // $newTask = Task::create([
        //     'description' => $request->todoTask['name'],
        //     'created_at' => $request->todoTask['start'],
        //     'end_at' => $request->todoTask['end'],
        //     'classification' => $request->classificationSelected
        // ]);
        return response()->noContent(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
            // dump(gettype($find));
            return json_encode($find);
            // return json_encode($find, JSON_UNESCAPED_UNICODE);
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
        $findExist = Task::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => ['bail', 'required', 'max:150', 'min:3', 'string'],
            'start' => ['required', 'date'],
            'end' => ['required'],
            'state' => ['Boolean'],
            'category' => ['required']
        ])->validate();

        // if (isset($findExist)) {
        // $findExist->update($findExist);

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
        // };
        // 無資料
        // return 'No data';
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
