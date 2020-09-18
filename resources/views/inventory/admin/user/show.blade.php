@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>{{ $user->name }}</h2>
                <div class="form-text text-muted">{{ $user->email }}</div>
            </div>

            <div class="card-body">
                <div class="mb-3">
                    Якась інформація про користувача.
                </div>

                <hr>

                <div class="mt-4">
                    <h2>
                        Предмети які належать користувачу
                    </h2>
                    !!!ТИПУ СПИСОК!!!
                </div>
            </div>
        </div>
    </div>
@endsection
