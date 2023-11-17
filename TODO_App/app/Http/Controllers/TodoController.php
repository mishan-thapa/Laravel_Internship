<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{

    public function index()
    {
        $todos = Todo::all();
        return view('todo.index', ['todos' => $todos]);
    }

    public function create()
    {
        return view('todo.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'name'=>'required',
                'work'=>'required',
                'dueDate'=>'required',
            ]
        );
        $newTodo = Todo::create($data);
        return redirect(route('todo.index'));
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $todo = Todo::find($id);
        return view('todo.edit', ['todo' => $todo]);
    }

    public function update(Request $request, string $id)
    {
        $data = $request->validate(
            [
                'name'=>'required',
                'work'=>'required',
                'dueDate'=>'required',
            ]
        );

        $todo = Todo::find($id);
        if($todo){
            $todo->name = $request->name;
            $todo->work = $request->work;
            $todo->dueDate = $request->dueDate;
            $todo->save();
            return redirect(route('todo.index'));
        }else{
            //asko lagi xuttai view banauna xa
        }
        
    }

    public function destroy(string $id)
    {
        $todo = Todo::find($id);
        $todo->delete();
        return redirect(route('todo.index'));
    }
}
