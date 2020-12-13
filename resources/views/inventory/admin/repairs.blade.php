@extends('layouts.app')

@section('content')
    <!--Types SECTION-->
    <section class="">
        <div class="container-fluid">
            <div class="col-12 pt-3 mb-3 bg-white rounded">
                <h1 class="mb-3">Інформація з ремонту</h1>

                <repairs-table></repairs-table>

            </div>
        </div>
    </section>

@endsection
