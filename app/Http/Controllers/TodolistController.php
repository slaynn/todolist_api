<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Todolist;
use App\Models\Todo;

class TodolistController extends Controller
{


    public function getLists(Request $request){
        $user = $request->user();
        $lists = Todolist::where('user_id', $user->id)->with('todos')->get();
        foreach ($lists as $list) {
           $nb_todos = Todo::where('todolist_id', $list->id)->count();
           $list['nb_todos'] = $nb_todos;
        }
        return response()->json($lists);
    }

    public function getTodos(Request $request, $id){
        $user = $request->user();
        $list = Todolist::findOrFail($id);
        if(! $list){
            return abort(403, "Cette liste n'exite pas");
        }
        if($user->id == $list->user_id){
            $todos = Todo::where('todolist_id', $id)->get();
            return response()->json($todos);
        }
        else{
            return abort(403, "Cette liste ne vous appartient pas");
        }
    }

    public function createTodolist(Request $request){
        $todolist = TodoList::create([
            'name' => $request->input('name'),
            'user_id' => $request->user()->id
        ]);

        $todolist->save();
        return response()->json($todolist);
    }

    public function createTodo(Request $request){
        $user = $request->user();
        $list = Todolist::findOrFail($request->input('todolist_id'));
        if(! $list){
            return abort(403, "Cette liste n'exite pas");
        }
        if($user->id == $list->user_id){
            error_log('toto');
            $todo = Todo::create([
                'name' => $request->input('name'),
                'completed' => $request->input('completed'),
                'todolist_id' => $list->id
                ]);
            return response()->json($todo);
        }
        else{
            return abort(403, "Cette liste ne vous appartient pas");
        }
        
    }

    public function updateTodo(Request $request, $id){
        $todo = Todo::findOrFail($id);
        $todo->name = $request->name;
        $todo->save();

        return response()->json($todo);

    }

    public function completeTodo(Request $request, $id){
        $todo = Todo::findOrFail($id);
        $todo->completed = $request->input('completed');
        $todo->save();
        return response()->json($todo);
    }
}
