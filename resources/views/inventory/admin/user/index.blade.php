@extends('layouts.app')

@section('content')

    <users-table></users-table>

    {{--
    <users-list></users-list>
    --}}

    {{--

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>Користувачі</h2>
                <div class="form-text text-muted"></div>
            </div>

            <div class="card-body">

                <table class="table table-bordered data-table">
                    <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th width="100px">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>



    !!!!!!!!!!!!
        <table class="table">
        <thead>
        <tr>
        <th scope="col">#id</th>
        <th scope="col">Ім'я</th>
        <th scope="col">Email</th>
        <th scope="col">Роль</th>
        </tr>
        </thead>
        <tbody>
    @foreach($users as $user)
        <tr>
        <th scope="row">{{ $user->id }}</th>
        <td><a href="{{ route('admin.users.show', $user->id) }}">{{ $user->name }}</a></td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->role }}</td>
        </tr>
        @endforeach
        </tbody>
        </table>


        !!!!!!!!!!!!
    </div>
    </div>
    </div>
    <script type="text/javascript">
    $(function () {

    var table = $('.data-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ route('admin.users.index') }}",
    columns: [
    {data: 'id', name: 'id'},
    {data: 'name', name: 'name'},
    {data: 'email', name: 'email'},
    {data: 'role', name: 'role'},
    {data: 'action', name: 'action', orderable: false, searchable: false},
    ]
    });

    });
        </script>
    --}}
@endsection
