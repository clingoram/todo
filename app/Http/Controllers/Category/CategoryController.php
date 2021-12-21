<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

// DB
// use Illuminate\Support\Facades\DB;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classification = Category::select('id', 'name')->where('deleted_at', null)->orderByDesc('created_at')
            ->get();
        return json_encode($classification);
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
            'name' => ['bail', 'required', 'max:150', 'min:1', 'string'],
            'created_at' => ['required', 'date']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Parameters Error',
                'status' => false,
                'data_return' => $validator->errors(),
            ], 400);
        }

        $data = Category::create([
            'name' => $request->category['name'],
            'created_at' => Carbon::now()
        ]);

        // $data = new Category();
        // $data->name = $request->category['name'];
        // $data->created_at = Carbon::now();
        // $data->save();

        // return response()->json($data, 201);
        return response()->json([
            'message' => 'Success.',
            'status' => true,
            'data_return' => $data
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $findExist = Category::find($id);

        if (isset($findExist)) {
            $findExist->delete();

            if ($findExist->trashed()) {
                // return response()->json(null, Response::HTTP_NO_CONTENT);
                return response()->json(['message' => 'Success', 'status' => true], 200);
            }
        }
        // return "Not Found.";
        return response()->json(['message' => 'Fail', 'status' => false], 204);
    }
}
