<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Task;

class TaskController extends Controller
{
    public function index(){
		$tasks = Task::where('iscompleted', false)->orderBy('id', 'DESC')->get();
		$completed_tasks = Task::where('iscompleted', true)->get();
		
		return view('welcome', compact('tasks', 'completed_tasks'));
	}
	
	public function store(Request $request){
		$input = $request->all();
		$task = new Task();
		$task->task = request('task');
		$task->save();
		
		return Redirect::back()->with('message', 'Задача добавлена');
	}
	
	public function complete($id){
		$task = Task::find($id);
		$task->iscompleted = true;
		$task->save();
		
		return Redirect::back()->with('message', 'Задача перенесена');
	}
	
	public function destroy($id){
		$task = Task::find($id);
		$task->delete();
		
		return Redirect::back()->with('message', 'Задача выполнена и удалена из списка');
	}
}
