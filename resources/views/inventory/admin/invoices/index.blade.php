@extends('layouts.app')

@section('content')
    <!--Invoices SECTION-->
    <section class="">
        <div class="container-fluid">
            <div class="col-12 pt-3 mb-3 bg-white rounded">
                <h1 class="mb-3">Накладні</h1>

                <div>
                    Список накладних
                </div>
                <a href="{{ route('admin.invoices.create') }}">Створити нову накладну</a>

            </div>
        </div>
    </section>

@endsection
