<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Models\Category;

class TodosController extends Controller
{
    /**
     * index para mostrar todos los todos
     * store para guardar un todo
     * update para actualñizar un todo
     * destroy para eliminar un todo
     * edit para mostrar el formulario de edicion
     */
    public function Storage(Request $request){

        $request->validate([
            'title' =>'required|min:3'
        ]);
        $todo = new Todo;
        $todo->title = $request->title;
        $todo->category_id = $request->category_id;
        $todo->save();

        return redirect()-> route('todos')->with('success', 'tarea creada correctamente');
    }
    public function Index(){
        $todos = Todo::all();
        $categories = Category::all();
        return view('todos.index', ['todos' => $todos, 'categories' => $categories]);
    }
    public function show($id){
        $todo = Todo::find($id);
        return view('todos.show', ['todo' => $todo]);
    }
    public function update(Request $request, $id){
        $todo = Todo::find($id);
        $todo->title = $request->title;
        $todo->save();

        //dd($todo);
        //return view('todos.index', ['success' => 'tarea actualizada']);
        return redirect()->route('todos')->with('success', 'tarea actualizada');
    }
    public function destroy($id){
        $todo = Todo::find($id);
        $todo->delete();
        return redirect()->route('todos')->with('success', 'tarea eliminada');

    }
}
