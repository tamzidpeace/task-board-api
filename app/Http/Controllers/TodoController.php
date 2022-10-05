<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller
{
    public function getTodo()
    {
        try {
            $todo = Todo::orderBy('updated_at', 'desc')->get()->groupBy('status');
            return $this->success('Todo data fetched!', $todo);
        } catch (Exception $e) {
            return $this->error('An error occurred!', $e);
        }
    }

    public function addTodo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'task' => 'required',
        ]);
        if ($validator->fails()) return $this->error($validator->errors()->first(), $validator->errors());

        try {
            $new_todo = new Todo();
            $new_todo->task = $request->task;
            $new_todo->save();
            $all_todo = Todo::orderBy('updated_at', 'desc')->get()->groupBy('status');
            return $this->success('Todo added!', $all_todo);
        } catch (Exception $e) {
            return $this->error('An error occurred!', $e);
        }
    }

    public function changeStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'status' => 'required|in:todo,in_progress,done',
        ]);
        if ($validator->fails()) return $this->error($validator->errors()->first(), $validator->errors());

        try {
            $todo = Todo::find($request->id);
            $todo->status = $request->status;
            $todo->save();
            $all_todo = Todo::orderBy('updated_at', 'desc')->get()->groupBy('status');
            return $this->success('Todo status changed!', $all_todo);
        } catch (Exception $e) {
            return $this->error('An error occurred!', $e);
        }
    }



    private function success($msg = 'Task successful!', $data = [], $type = null)
    {
        return response()->json([
            'success' => true,
            'code' => 200,
            'message' => $msg,
            'data' => $data,
            'type' => $type
        ]);
    }

    private function error($msg = 'An error occurred!', $error = [], $type = null)
    {
        return response()->json([
            'success' => false,
            'code' => 400,
            'message' => $msg,
            'data' => $error,
            'type' => $type
        ]);
    }
}
