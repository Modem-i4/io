@extends('layouts.app')

@section('content')
    <!--Invoice Create SECTION-->
    <section class="">
        <div class="container-fluid">
            <div class="col-12 pt-3 mb-3 bg-white rounded">
                <h1 class="mb-3">Накладні</h1>

                <invoice-create-form></invoice-create-form>

                <!--
                <invoice-create-form-dev></invoice-create-form-dev>
                -->
            </div>
        </div>
    </section>

@endsection
