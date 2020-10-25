@extends('layouts.app')

@section('content')
    <!--Statuses SECTION-->
    <section class="">
        <div class="container-fluid">
            <div class="col-12 pt-3 mb-3 bg-white rounded">
                <h1 class="mb-3">Статуси</h1>

                <statuses-table></statuses-table>

            </div>
        </div>
    </section>

@endsection
