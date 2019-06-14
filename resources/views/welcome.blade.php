@extends('layouts.app')

@section('content')
<div class="container">
	@if(session()->has('message'))
	<div class="alert alert-success alert-dismissible fade show" role="alert">
		<strong>Внимание...</strong>{{ session()->get('message') }}
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span></button>
	</div>
	@endif
	<div class="col-md-6">
		<h2>Список задач за день</h2>
		<form method="POST" action="{{url('/task')}}">
		@csrf
		<div class="form-group">
			<input type="text" class="form-controll" name="task" placeholder="Enter Task" />
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-success">Добавить</button>
		</div>
		</form>
		<hr/>
		<ul>
			@foreach($tasks as $task)
			<li><a href="{{url('/'.$task->id.'/complete')}}">{{$task->task}}</a></li>
			@endforeach
		</ul>
		<h4>Перенесенные задачи</h4>
		<ol>
			@foreach($completed_tasks as $c_task)
			<li><a href="{{url('/'.$c_task->id.'/delete')}}">{{$c_task->task}}</a></li>
			@endforeach
		</ol>
	</div>
</div>
@endsection