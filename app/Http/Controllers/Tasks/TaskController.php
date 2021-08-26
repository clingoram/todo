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
        $validator = Validator::make($request->all(), [
            'itemName' => 'required|max:150',
            'createdTime' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $newTask = new Task;
        // $newTask->description = $request->item['name'];

        $newTask->description = $request->item['itemName'];
        $newTask->created_at = $request->item['createdTime'];
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
