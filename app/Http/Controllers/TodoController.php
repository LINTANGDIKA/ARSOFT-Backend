<?php

namespace App\Http\Controllers;

use App\Models\todo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller
{
    public function createTodo(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'title' => 'required',
            'detail' => 'nullable'
        ]);
        if ($validate->fails()) {
            return response()->json(
                [
                    'error' => true,
                    'message' => $validate->errors()->first(),
                    'status' => 404
                ],
                404
            );
        }
        $todo = todo::create([
            'title' => $request->title,
            'detail' => $request->detail,
            'user_id' => auth()->user()->id,
            'status' => 'waiting'
        ]);
        return response()->json([
            'data' => $todo,
            'message' => 'Todo Created Successfully',
            'status' => 200
        ], 200);
    }
    public function updateTodo(Request $request, $id)
    {
        $data = todo::find($id);
        if (!$data) {
            return response()->json([
                'data' => $data,
                'message' => 'Todo Not Found!',
                'status' => 404
            ], 404);
        }
        $validate = Validator::make($request->all(), [
            'title' => 'required',
            'detail' => 'nullable'
        ]);
        if ($validate->fails()) {
            return response()->json(
                [
                    'error' => true,
                    'message' => $validate->errors()->first(),
                    'status' => 404
                ],
                404
            );
        }
        $todo = $data->update([
            'title' => $request['title'],
            'detail' => $request['detail'],
        ]);
        return response()->json([
            'data' => $data,
            'message' => 'Todo Updated Successfully',
            'status' => 200
        ], 200);
    }
    public function findDataId($id)
    {
        $data = todo::find($id);
        if (!$data) {
            return response()->json([
                'data' => $data,
                'message' => 'Todo not found!',
                'status' => 404
            ], 404);
        }
        return response()->json([
            'data' => $data,
            'message' => 'Todo with id ' . $id . ' has been obtained',
            'status' => 200
        ], 200);
    }
    public function findData()
    {
        $data = todo::all();
        return response()->json([
            'data' => $data,
            'message' => 'All todo data has been obtained',
            'status' => 200
        ], 200);
    }
    public function findTodobyUser()
    {
        $data = User::find(Auth()->user()->id)->todo;
        return response()->json([
            'data' => $data,
            'message' => 'Todo with email ' . Auth()->user()->email . ' has been obtained',
            'status' => 200
        ], 200);
    }
    public function done($id)
    {
        $data = todo::find($id);
        if (!$data) {
            return response()->json([
                'data' => $data,
                'message' => 'Todo not found!',
                'status' => 404
            ], 404);
        }
        $data->update([
            'status' => 'Done'
        ]);
        return response()->json([
            'data' => $data,
            'message' => 'Todo with id ' . $id . ' the status has been updated',
            'status' => 200
        ], 200);
    }
    public function onChange($id)
    {
        $data = todo::find($id);
        if (!$data) {
            return response()->json([
                'data' => $data,
                'message' => 'Todo not found!',
                'status' => 404
            ], 404);
        }
        $data->update([
            'status' => 'On Change'
        ]);
        return response()->json([
            'data' => $data,
            'message' => 'Todo with id ' . $id . ' the status has been updated',
            'status' => 200
        ], 200);
    }
    public function delete($id)
    {
        todo::destroy($id);
        return response()->json([
            'message' => 'Todo has been removed',
            'status' => 200
        ], 200);
    }
}
