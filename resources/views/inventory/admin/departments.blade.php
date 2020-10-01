@extends('layouts.app')

@section('content')
    <!--Departments SECTION-->
    <section class="">
        <div class="container-fluid">
            <div class="col-12 pt-3 mb-3 bg-white rounded">
                <h2 class="mb-3 display-1">Приміщення</h2>
                <div class="">
                    <form class="form-inline mb-3" id="addItem" name="addItem" action="{{ route('admin.departments.store') }}" method="post">
                        @csrf
                        <div class="form-group mr-3">
                            <label for="addtitle" class="my-1 mr-2">Назва:</label>
                            <input type="text" class="form-control" id="addTitle" placeholder="Введіть назву" name="addTitle" minlength="3" required>
                        </div>
                        <div class="form-group mr-3">
                            <label for="addPlace" class="my-1 mr-2">Корпус:</label>

                            <select name="addPlace" placeholder="Оберіть категорію" id="addPlace" class="form-control" data-ajax--url="" data-width="200px" data-placeholder="Оберіть корпус" required>

                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary p-2 border rounded">
                            <svg class="icon icon-plus mx-2"><use xlink:href="/img/icons/symbol-defs.svg#icon-plus"></use></svg><span class="d-none d-md-inline">Додати приміщення</span>
                        </button>
                    </form>
                </div>

                <departments-table></departments-table>
            </div>
        </div>
    </section>

@endsection
