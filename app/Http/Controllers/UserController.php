<?php

namespace App\Http\Controllers;

use App\Helpers\FileUploader;
use App\Models\ToDoList;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function home()
    {

        $lists = ToDoList::where('user_id', auth()->user()->id)->orderBy('date', 'asc')->get();
        return view('dashboard', compact('lists'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'date' => 'required|date',
            'priority' => 'required|in:high,medium,low',
            'description' => 'required|string',
            'image' => 'nullable'
        ]);
        // return $request->all();
        $user = auth()->user();
        $list = ToDoList::create([
            'user_id' => $user->id,
            'title' => $request->title,
            'date' => $request->date,
            'priority' => $request->priority,
            'description' => $request->description,
            'image' => isset($request->image) ? FileUploader::uploadFile($request->image, 'images/to-do-list') : null,
        ]);
        return response(['message' => 'To Do List added successfully!']);
    }
    public function edit(Request $request)
    {
        $list = ToDoList::where(['id' => $request->id, 'user_id' => auth()->user()->id])->first();
        return response($list);
    }
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric|exists:to_do_lists,id',
            'title' => 'required|string',
            'date' => 'required|date',
            'priority' => 'required|in:high,medium,low',
            'description' => 'required|string',
            'image' => 'nullable'
        ]);
        $list = ToDoList::findOrFail($request->id);
        $list->title = $request->title;
        $list->date = $request->date;
        $list->description = $request->description;
        $list->priority = $request->priority;
        if ($request->image) {
            $list->image = FileUploader::uploadFile($request->image, 'images/to-do-list');
        }
        $list->save();

        return response(['message' => 'To Do List updated successfully!']);
    }
    public function destroy(Request $request)
    {
        ToDoList::findOrFail($request->id)->delete();
        return response(['message' => 'To Do List deleted successfully!']);
    }
}
