@extends('layouts.app')

@section('content')
    <section class="my-4">
      <div class="container-fluid">
        <div class="row d-flex justify-content-center">
          @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
          @endif
        
    <!--Departments SECTION-->
    <section>
            <div class="col-12 pt-3 mb-3 bg-white rounded ">
              <!--PAGINATION-->
              <div class="d-flex justify-content-end">
                <div class="">
                  <nav aria-label="Page navigation example">
                    @if($paginator->total() > $paginator->count())
                    {{ $paginator->links() }}
                    @endif
                  </nav>
                </div>
              </div>              
              <div>
                <table class="table table-hover col-12">
                  <thead>
                    <tr role="row">
                      <th rowspan="1" colspan="1">
                        <svg
                          width="1em"
                          height="1em"
                          viewBox="0 0 16 16"
                          class="bi bi-check"
                          fill="currentColor"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            fill-rule="evenodd"
                            d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z"
                          />
                        </svg>
                      </th>
                      <th>id</th>
                      <th>Назва</th>
                      <th>Корпус</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($paginator as $item)
                                @php /** @var \App\Models\InventoryDepartment $item */ @endphp
                                    <tr  role="row">
                                      <td><input type="checkbox" aria-label="Choose item" /></td>
                                      <td>{{ $item->id }}</td>    
                                        <td><a href="{{ route('admin.departments.edit', $item->id) }}">
                                            {{ $item->title }}
                                            </a>
                                        </td>    
                                        <td @if(in_array($item->parent_id, [0, 1])) style="color:#ccc" @endif>
                                            {{-- $item->parent_id --}}                                            
                                           {{-- -$item->parent_title звертання через аксесор--}}
                                          {{ $item->parentTitle }}
                                        </td>    
                                    </tr>   
                            @endforeach
                  </tbody>
                </table>
              </div>
              <!--PAGINATION-->
              <div class="d-flex justify-content-end">
                <div class="">
                  <nav aria-label="Page navigation example">
                    @if($paginator->total() > $paginator->count())
                        {{ $paginator->links() }}
                    @endif
                  </nav>
                </div>
              </div>
            </div>
    </section>
    </div>
  </div>
  </section>
    <!--FOOTER-->
@endsection
