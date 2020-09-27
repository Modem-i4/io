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
                <div class="d-flex justify-content-between flex-wrap">

                    <div class="d-flex justify-content-between flex-wrap">
                        <div class="py-3">
                            <!--a href="" class="p-2 mr-2 border rounded text-decoration-none dell">
                              <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M11.293 1.293a1 1 0 0 1 1.414 0l2 2a1 1 0 0 1 0 1.414l-9 9a1 1 0 0 1-.39.242l-3 1a1 1 0 0 1-1.266-1.265l1-3a1 1 0 0 1 .242-.391l9-9zM12 2l2 2-9 9-3 1 1-3 9-9z"></path>
                                <path fill-rule="evenodd" d="M12.146 6.354l-2.5-2.5.708-.708 2.5 2.5-.707.708zM3 10v.5a.5.5 0 0 0 .5.5H4v.5a.5.5 0 0 0 .5.5H5v.5a.5.5 0 0 0 .5.5H6v-1.5a.5.5 0 0 0-.5-.5H5v-.5a.5.5 0 0 0-.5-.5H3z"></path>
                              </svg>
                              <span class="d-none d-md-inline">Редагувати відмічені</span>
                            </a-->
                            <a href="" class="p-2 border rounded text-decoration-none delete-many"><svg class="icon icon-trash-o mx-2"><use xlink:href="/img/icons/symbol-defs.svg#icon-trash-o"></use></svg><span class="d-none d-md-inline">Видалити відмічені</span>
                            </a>
                        </div>
                    </div>

                    <div class="alert-msg p-3 d-flex justify-content-between">
                        <div></div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-12">

                        <departments-table></departments-table>

                    </div>
                </div>

                <div class="d-flex justify-content-between flex-wrap">
                    <div class="py-3">
                        <a href="" class="p-2 border rounded text-decoration-none delete-many">
                            <svg class="icon icon-trash-o mx-2"><use xlink:href="/img/icons/symbol-defs.svg#icon-trash-o"></use></svg><span class="d-none d-md-inline">Видалити відмічені</span>
                        </a>
                    </div>
                    <div>

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
