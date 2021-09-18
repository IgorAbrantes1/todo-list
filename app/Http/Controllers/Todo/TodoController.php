<?php

namespace App\Http\Controllers\Todo;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $todos = Todo::all();
        return view('template.app', compact('todos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $payload = $request->validate([
            'task' => 'required|max:200'
        ]);

        if (!$payload)
            return redirect(route('todo.index'))->with('errors', 'Bad Request!');

        Todo::create($payload);

        return redirect(route('todo.index'))->with('status', 'Task added!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $todo = Todo::all()->where('id', '=', $id)->first();

        if (!$todo)
            return redirect(route('todo.index'));

        $payload = $request->validate([
            'task' => 'required|max:200'
        ]);

        if (!$payload)
            return redirect(route('todo.index'));

        if ($payload['task'] === $todo->task)
            return redirect(route('todo.index'));

        $taskAnt = $todo->task;
        $todo->update($payload);

        return redirect(route('todo.index'))->with([
            'status' => "Task updated with successful! '" . $taskAnt . "' to '" . $todo->task . "'",
            'task' => $todo->task
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $todo = Todo::all()->where('id', '=', $id)->first();

        if (!$todo)
            return redirect(route('todo.index'));

        $todo->update([
            'status' => false
        ]);

        return redirect(route('todo.index'))->with('status', "Task '$todo->task' removed!");
    }
}
