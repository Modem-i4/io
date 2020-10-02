@extends('layouts.app')

@section('content')
    <!--Departments SECTION-->
    <section class="">
        <div class="container-fluid">
            <div class="col-12 pt-3 mb-3 bg-white rounded">
                <h2 class="mb-3 display-1">Приміщення</h2>

                <departments-table></departments-table>

            </div>
        </div>
    </section>

@endsection
