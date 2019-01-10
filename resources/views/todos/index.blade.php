@extends('layouts.app') 
@section('content')


<div class="row">
    <div class="col-md-6">
        <div class="card">
            <h3>To Do's</h3>
            <!-- New Task Form -->
            <form action="{{ url('todos') }}" method="POST" class="form-horizontal">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="title" class="col-sm-8 control-label">Add Task:</label>

                    <div class="col-sm-12">
                        <input type="text" name="title" id="task-name" class="form-control" placeholder='Whats to do?'>
                    </div>
                </div>

                <!-- Add Task Button -->
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-12">
                        <button type="submit" class="btn btn-primary btn-sm float-right">
                               Add
                            </button>
                    </div>
                </div>
            </form>
            <hr>
            <h5>&nbsp;{{ $countIncomplete }} Tasks Remaining</h5>
            
            @if(count($todos) > 0) @foreach($todos as $todo) @if($todo['completed'] == 0)
            <form action="./todos/{{ $todo['_id'] }}" method="POST" style="margin: 5px;">
                <div class="checkbox float-left">
                    <label>
                                        <input class="to-do compcheck" type="checkbox" name="todos[]"  value="{{ $todo['_id'] }}"/> &nbsp;
                                    </label>
                </div>
                {{ $todo['title'] }} {{ csrf_field() }} {{-- <button class="btn btn-danger btn-sm float-right"> <i class="fa fa-trash " aria-hidden="true"></i></button>                --}}
                <a class="btn btn-danger btn-xs float-right" onclick="return confirm('Delete Todo?');" style="margin-left: 10px;" href="./todos/destroyMe/{{ $todo['_id'] }}"><i class="fa fa-trash " aria-hidden="true"></i></a>
            </form>

            @endif @endforeach @endif
            <div class="mark-complete">
                <br>

                <button style="margin-bottom: 10px;" class="mark-complete btn btn-sm btn-success float-right" id="completebtn">Complete</button>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <h3>Complete</h3>
            <div class="col-sm-12 card space" id="done-items">
                Nothing completed yet, D'oh!
            </div>

            <div class="col-sm-12  space" id="completed-items">

                @if(count($todos) > 0) @foreach($todos as $todo) @if($todo['completed'] == 1)
                <div class="card space">
                    <form action="./todos/{{ $todo['_id'] }}" method="POST">
                        &nbsp;{{ $todo['title'] }}

                        <a class="btn btn-danger btn-xs float-right" onclick="return confirm('Delete Todo?');" style="margin: 3px;" href="./todos/destroyMe/{{ $todo['_id'] }}"><i class="fa fa-trash " aria-hidden="true"></i></a>
                        <span class="badge badge-success float-right" style="margin-top: 10px;">Completed</span>
                </div>
                </form>
                @endif @endforeach @endif

            </div>

        </div>
    </div>


    <script type="text/javascript">
        let isCompleted = {{ $countComplete }}
    </script>
@endsection