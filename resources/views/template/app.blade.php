<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU"
              crossorigin="anonymous">

        <title>{{ trans('Todo List') }}</title>
    </head>
    <body class="container">

        <div class="d-flex flex-column justify-content-center">
            <h1 class="my-2 text-center">{{ trans('Todos') }}</h1>
            <hr>

            <h2 class="my-2">{{ trans('Add new task') }}</h2>
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('todo.store') }}" method="POST">
                @csrf
                <input type="text" class="form-control" name="task" placeholder="{{ trans('Add new task') }}" required/>
                <button class="btn btn-primary my-2" type="submit">{{ trans('Store') }}</button>
            </form>

            <h2 class="my-2">{{ trans('Pending tasks') }}</h2>
            <ul class="list-group list-unstyled">
                @foreach($todos as $todo)
                    @if($todo->status)
                        @if($todo->task === session('task'))
                            @if(session('status'))
                                <div class="alert alert-success mt-3">
                                    {{ session('status') }}
                                </div>
                            @endif
                        @endif
                        <li class="row align-items-center list-group-item mx-1">
                            {{ $todo->task }}
                            <form class="d-flex align-items-center justify-content-end"
                                  action="{{ route('todo.destroy', $todo->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-primary me-1 my-auto" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse-{{ $loop->index }}" aria-expanded="false">
                                    {{ trans('Edit') }}
                                </button>
                                <button class="btn btn-danger ms-1 my-auto" type="submit">
                                    {{ trans('Delete') }}
                                </button>
                            </form>

                            <div class="collapse mt-2" id="collapse-{{ $loop->index }}">
                                <div class="card card-body mx-auto">
                                    <form action="{{ route('todo.update', $todo->id) }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <input type="text" class="form-control" name="task" value="{{ $todo->task }}"
                                               required/>
                                        <button class="btn btn-warning mx-auto my-2"
                                                type="submit">{{ trans('Update') }}</button>
                                    </form>
                                </div>
                            </div>
                        </li>
                    @endif
                @endforeach
            </ul>

            <h2 class="my-2">{{ trans('Completed Tasks') }}</h2>
            <ul class="list-group list-unstyled">
                @foreach($todos as $todo)
                    @if(!$todo->status)
                        @if($todo->task === session('task'))
                            @if(session('status'))
                                <div class="alert alert-success mt-3">
                                    {{ session('status') }}
                                </div>
                            @endif
                        @endif
                        <li class="row align-items-center mx-1">
                            <div class="alert alert-success">
                                {{ $todo->task }}
                            </div>
                        </li>
                    @endif
                @endforeach
            </ul>

        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ"
                crossorigin="anonymous"></script>
    </body>
</html>
