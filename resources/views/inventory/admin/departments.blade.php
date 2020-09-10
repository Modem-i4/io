@extends('layouts.app')

@section('content')
   <!--Departments SECTION-->
    <section class="">
      <div class="container-fluid">
        <div class="col-12 pt-3 mb-3 bg-white rounded">
            <h2 class="mb-3 display-4">Приміщення</h2>
            <div class="">
                <form class="form-inline mb-3" id="addItem" name="addItem" action="{{ route('admin.departments.store') }}" method="post">
                  @csrf
                  <div class="form-group mr-3">
                    <label for="addtitle" class="my-1 mr-2">Назва:</label>
                    <input type="text" class="form-control" id="addTitle" placeholder="Введіть назву" name="addTitle" minlength="3" required>
                  </div>
                  <div class="form-group mr-3">
                    <label for="addPlace" class="my-1 mr-2">Корпус:</label>
                    <!--No Ajax-->
                      <!--select name="addPlace" placeholder="Оберіть категорію" id="addPlace" class="form-control" required>
                      @foreach ($categoryList as $categoryOption)
                          <option value="{{ $categoryOption->id }}">{{ $categoryOption->title }}</option>
                      @endforeach
                      </select-->
                      <select name="addPlace" placeholder="Оберіть категорію" id="addPlace" class="form-control" data-ajax--url="{{ route('api.categories') }}" data-width="200px" data-placeholder="Оберіть корпус" required>
                          @foreach ($categoryList as $categoryOption) 
                            @if ($loop->first)
                              <option value="{{ $categoryOption->id }}">{{ $categoryOption->title }}</option>
                            @endif
                          @endforeach
                      </select>
                  </div>
                  <button type="submit" class="btn btn-primary p-2 border rounded">
                    <span class="icon-add"></span><span class="d-none d-md-inline">Додати приміщення</span>
                  </button>
                </form>
            </div>
            <div class="d-flex justify-content-between flex-wrap">

            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
                <div class="d-flex justify-content-between flex-wrap">
                  <div class="py-3">
                    <!--a href="" class="p-2 mr-2 border rounded text-decoration-none dell">
                      <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M11.293 1.293a1 1 0 0 1 1.414 0l2 2a1 1 0 0 1 0 1.414l-9 9a1 1 0 0 1-.39.242l-3 1a1 1 0 0 1-1.266-1.265l1-3a1 1 0 0 1 .242-.391l9-9zM12 2l2 2-9 9-3 1 1-3 9-9z"></path>
                        <path fill-rule="evenodd" d="M12.146 6.354l-2.5-2.5.708-.708 2.5 2.5-.707.708zM3 10v.5a.5.5 0 0 0 .5.5H4v.5a.5.5 0 0 0 .5.5H5v.5a.5.5 0 0 0 .5.5H6v-1.5a.5.5 0 0 0-.5-.5H5v-.5a.5.5 0 0 0-.5-.5H3z"></path>
                      </svg>
                      <span class="d-none d-md-inline">Редагувати відмічені</span>
                    </a-->
                    <a href="" class="p-2 border rounded text-decoration-none delete-many"><span class="icon-trash-o"></span> <span class="d-none d-md-inline">Видалити відмічені</span>
                    </a>
                  </div>
                </div>

                    <div class="alert-msg p-3 d-flex justify-content-between">
                      <div></div>
                    </div>
                    @if($paginator->total() > $paginator->count())<!--PAGINATION-->
                      <div class="d-flex justify-content-between">
                          <nav aria-label="Page navigation">
                            {{ $paginator->links() }} 
                          </nav>
                      </div>  
                    @endif
                
          </div>    
              <div id="table" class="table-editable">
                <table class="table table-hover items-table" id="dt-all-checkbox" >
                  <thead class="thead-light">
                    <tr>
                      <th></th>
                      <th>id</th>
                      <th>Назва</th>
                      <th>Корпус</th>
                      <th class="no-sort">Дія</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($paginator as $item)
                                @php /** @var \App\Models\InventoryDepartment $item */ @endphp
                                    <tr data-id="{{ $item->id }}">
                                      <td ></td>
                                      <td class="align-middle">{{ $item->id }}</td>    
                                      <td class="align-middle">@if(in_array($item->id, [0, 1, 2, 3, 4, 5, 6, 7])){{ $item->title }}@else<a href="" class="update" data-name="title" data-type="text" data-pk="{{ $item->id }}" data-url="/{{ Request::path() }}/update_ajax" data-title="Введіть назву">{{ $item->title }}</a>@endif</td>        
                                      <td class="align-middle">@if(in_array($item->id, [0, 1]))Кореневий корпус@elseif(in_array($item->id, [2,3,4,5,6,7]))Острозька академія@else
                                        <a href="" class="update-select" data-name="parent_id" data-type="select2" data-pk="{{ $item->id }}" data-url="/{{ Request::path() }}/update_ajax" data-value="{{ $item->parent_id }}" data-title="Оберіть корпус" 
                                          data-source="{{ route('api.categories') }}" data-placeholder="Оберіть корпус">{{ $item->parentTitle }}</a>
                                      @endif
                                      </td>
                                      <td><a href="" class="delete" data-id="{{ $item->id }}"><span class="icon-trash-o"></span></a></td>
                                    </tr>   
                            @endforeach
                  </tbody>
                </table>
              </div>
              <div class="d-flex justify-content-between flex-wrap">
                <div class="py-3">
                  <a href="" class="p-2 border rounded text-decoration-none delete-many">
                    <span class="icon-trash-o"></span> <span class="d-none d-md-inline">Видалити відмічені</span>
                  </a>
                </div>
                <div>
                  <!--PAGINATION-->
                    <div class="d-flex justify-content-end">
                        <nav aria-label="Page navigation">
                          @if($paginator->total() > $paginator->count())
                          {{ $paginator->links() }}
                          @endif
                        </nav>
                    </div> 
                </div>
              </div>          
          </div>
      </div>
  </section> 
@endsection
@section('pagejs')
<script type="text/javascript">
            /*var selectData = [];  //робимо масив на стороні клієнта
          $.each({ @foreach ($categoryList as $categoryOption) "{{ (string) $categoryOption->id }}":"{{ (string) $categoryOption->title }}"{{ ($loop->last ? '' : ',') }}@endforeach }, function(k, v) {
              countries.push({id: k, text: v});
          });*/     
         /* var selectData = [@foreach ($categoryList as $categoryOption) {id:'{{ (string) $categoryOption->id }}', text:'{{ (string) $categoryOption->title }}' } {{ ($loop->last ? '':',') }} @endforeach];
          */

</script>

@endsection
@section('pagejs1')
<script type="text/javascript">
  $(document).ready(function () {
    //Add Item 
    $("#addItem").validate({
      rules: {
       // addTitle: {required: true},
       // addPlace: {required: true},

      },
      messages: {
        addTitle: "Заповніть поле (мін. 3 символи)",
        addPlace: "Заповніть поле"
        
      },
      tooltip_options: {
        addPlace: {placement:'auto'}
      },
      submitHandler: function(form) {
    var form_action = $("#addItem").attr("action");
    var selectedText = $("#addPlace option:selected").text();
    var dataAddmsg = 'Новий запис додано';
    $.ajax({
      data: $('#addItem').serialize(),
      url: form_action, //не потребує треба розібратись
      type: "POST",
      dataType: 'json',
      success: function (data) {
        var rowNode =  t.row.add( ['',data.id,
        '<a href="" class="update new" data-name="title" data-type="text" data-pk="' + data.id + '" data-url="/{{ Request::path() }}/update_ajax" data-title="Введіть назву">' + data.title + '</a>', 
        '<a href="" class="update-select" data-name="parent_id" data-type="select2" data-pk="' + data.id + '" data-url="/{{ Request::path() }}/update_ajax" data-value="' + data.parent_id + '" data-title="Оберіть корпус" data-source="{{ route('api.categories') }}" data-placeholder="Оберіть корпус">' + selectedText + '</a>', 
        '<a href="" class="delete" data-id="' + data.id + '"><span class="icon-trash-o"></span></a>'] )
          .draw().node();
          $(".alert-msg div").removeClass().fadeIn(1000).addClass('text-success show').html(dataAddmsg).fadeOut(5000).removeClass('show');
          $( rowNode ).attr("data-id", data.id).addClass( 'alert-success');
          setTimeout(function(){  $(rowNode).removeClass('alert-success'); }, 2000);
          $('#addItem')[0].reset();
          $('#addPlace').val('1').trigger('change');
      },
      error: function (data) {
        console.log('Error:', data);
      }
    });
    }
    });

  });

</script>

@endsection