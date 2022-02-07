<?php

namespace App\Http\Controllers\Category;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

// Model
use App\Models\Category;

/**
 * @group Category management
 * 
 * APIs for manage categories.
 */
class CategoryController extends Controller
{

    /**
     * 取得所有分類
     * 
     * 在modal內，顯示所有分類項目
     * 
     * @response  [{
     *  "id": 1,
     *  "name": "Work",
     *  "created_at": "2021-12-28 10:00:05",
     *  },
     *  {
     *  "id":2,
     *  "name":"Play",
     *  "created_at":"2022-1-06 9:34:33"
     *  }
     * ]
     * 
     * 
     * @return 格式為JSON的回應
     *
     */
    public function index()
    {
        $classification = Category::select('id', 'name', 'created_at')->where('deleted_at', null)->orderByDesc('created_at')
            ->get();
        return json_encode($classification);
    }

    /**
     * 新增分類
     * 
     * 新增分類項目
     * 
     * @urlParam  lang The language
     * @bodyParam name string required 分類名稱 Example: Work
     *
     * @response  201 {
     *  "status": true,
     *  "message":"Success",
     *  "data_return":{
     *    "id": 3,
     *    "name": "工作",
     *    "created_at": "2021-12-23T08:05:52.000000Z"
     *  }
     * }
     * 
     * @response  400 {
     *  "status": false,
     *  "message": "name不能為空",
     *  "data_return": null
     * }
     *
     * 
     */
    public function store($request)
    {
        $validator = Validator::make($request->all(), [
            'category.name' => ['bail', 'required', 'max:150', 'min:1', 'string']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Parameters Error',
                'status' => false,
                'data_return' => $validator->errors(),
            ], 400);
        }

        $data = new Category();
        $data->name = $request->category['name'];
        $data->created_at = Carbon::now();
        $data->save();

        // return response()->json($data, 201);
        return response()->json([
            'message' => 'Success.',
            'status' => true,
            'data_return' => $data
        ], 200);
    }

    /**
     * 刪除分類
     * 
     * 刪除特定分類
     *     
     * @urlParam id int required 分類ID Example: 2
     * @bodyParam id int required 分類ID Example: 2
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
     */
    public function destroy(int $id)
    {
        $findExist = Category::find($id);

        if (isset($findExist)) {
            $findExist->delete();

            if ($findExist->trashed()) {
                return response()->json(['message' => 'Success', 'status' => true], 200);
            }
        }
        return response()->json(['message' => 'Fail', 'status' => false], 204);
    }
}
