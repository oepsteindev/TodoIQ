<?php

namespace App\Http\Controllers;

use App\Todos;
use Illuminate\Http\Request;

class TodosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get all todos
        $todos = Todos::all();

        //get counts for other parts of page
        $countIncomplete = Todos::where('completed', '=', 0)->count();

        $countComplete = Todos::where('completed', '=', 1)->count();

        return view('todos.index', compact('todos', 'countIncomplete', 'countComplete'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate!
        $this->validate($request, [
            'title' => 'required',
        ]);

        //make a new todo!
        $todo = new Todos;
        $todo->title = $request->input('title');
        $todo->completed = 0;
        $todo->save();

        return redirect('./todos')->with('success', "To Do Created!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Todos  $todos
     * @return \Illuminate\Http\Response
     */
    public function show(Todos $todos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Todos  $todos
     * @return \Illuminate\Http\Response
     */
    public function edit(Todos $todos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Todos  $todos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todos $todos)
    {
        //
    }

    public function completed()
    {
        $data = explode(",", str_replace(['[', ']', '"'], '', urldecode($_GET['data'])));

        foreach ($data as $id) {
            $todo = Todos::find($id);
            $todo->completed = 1;
            $todo->save();
        }

        //echo success back to ajax request
        header('Content-Type: application/json');
        echo json_encode(array(
            'success' => true,
        ));
    }

    public function destroyMe($id)
    {
        self::destroy($id);
        return redirect('./todos')->with('success', "To Do Deleted!");
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Todos  $todos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $todo = Todos::find($id);
        $todo->delete();

    }
}
