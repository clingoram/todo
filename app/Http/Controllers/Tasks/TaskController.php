<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// models
use App\Models\Task;

use Illuminate\Support\Carbon;

// DB
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DB::table('task')->orderBy('id','desc')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     //
    // }

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


        // DB::table('task')->insert([
        //     'description' => $request->item['name']
        // ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $findExist = DB::table('task')->find($id);
        $findExist = Task::find($id);

        if(isset($findExist)){
            $findExist->status = $request->item['status'] ? true : false;
            $findExist->updated_at = $request->item['status'] ? Carbon::now() : null;
            
            // return DB::table('task')->where('id',$id)->update(
            //                     ['status' => $findExist->status],
            //                     ['updated_at' => $findExist->updated_at]
            // );

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
        if(isset($findExist)){
            $findExist->delete();
            return "Deleted Successful.";
        }
        return "Not Found.";
    }
}
