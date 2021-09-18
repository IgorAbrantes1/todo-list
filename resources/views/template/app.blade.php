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
    <body>

        <h1>{{ trans('Todos') }}</h1>
        <hr>

        <h2>{{ trans('Add new task') }}</h2>
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="list-unstyled">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('/todos') }}" method="POST">
            @csrf
            <input type="text" class="form-control" name="task" placeholder="{{ trans('Add new task') }}"/>
            <button class="btn btn-primary" type="submit">{{ trans('Store') }}</button>
        </form>


        <h2>{{ trans('Pending tasks') }}</h2>
        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <ul class="list-group list-unstyled">
            @foreach($todos as $todo)
                <li class="list-group-item">{{ $todo->task }}</li>
            @endforeach
        </ul>

        <h2>{{ trans('Completed Tasks') }}</h2>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ"
                crossorigin="anonymous"></script>
    </body>
</html>
