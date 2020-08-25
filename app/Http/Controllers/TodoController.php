<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;

class TodoController extends Controller
{
    public function index(){
        $todos = Todo::orderBy('id', 'desc')->get();
        return request()->json(200, $todos);
    }

    public function search($key){
        $todos = Todo::where('name', 'like', '%'.$key.'%')->get();
        return request()->json(200, $todos);
    }

    public function store(Request $request){
        $todo = new Todo();
        $todo->name = $request->name;
        
        if($todo->save()){
            $todos = Todo::all();
            return request()->json(200, $todos);
        }
    }

    public function edit($id){
        $todo = Todo::findOrFail($id);
        return request()->json(200, $todo);
    }

    public function update(Request $request, $id){
        $todo = Todo::findOrFail($id);
        $todo->name = $request->name;
        $todo->update();
    }

    public function destroy($id){
        $todo = Todo::findOrFail($id);
        $todo->delete();
    }
}