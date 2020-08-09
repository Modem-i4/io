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
            <div class="col-12 pt-3 mb-3">
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
                <div class="wrapper-editor">

                  <div class="d-flex justify-content-center buttons-wrapper">
                    <button id="" class="btn btn-sm btn-info btn-rounded addNewRows">Add new rows</button>
                  </div>

                </div>
                
                <table class="table table-hover" id="dt-multi-checkbox" >
                  <thead class="thead-light">
                    <tr>
                      <th></th>
                      <!--th>
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
                      </th-->
                      <th>id</th>
                      <th>Назва</th>
                      <th>Корпус</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($paginator as $item)
                                @php /** @var \App\Models\InventoryDepartment $item */ @endphp
                                    <tr>
                                      <td></td>
                                      <!--td><input type="checkbox" aria-label="Choose item" /></td-->
                                      <td class="p-1 align-middle text-center">{{ $item->id }}</td>    
                                      <td class="p-1 align-middle">{{ $item->title }}</td>    
                                      <td class="p-1 align-middle" @if(in_array($item->parent_id, [0, 1])) style="color:#ccc" @endif>{{-- $item->parent_id --}}{{ $item->parentTitle }}</td>    
                                    </tr>   
                            @endforeach
                  </tbody>
                </table>
              </div>
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

    <div class="md-form">
      <input type="search" id="form-autocomplete" class="form-control mdb-autocomplete">
      
      <label for="form-autocomplete" class="active">What is your favorite US state?</label>
    </div>

    </div>
  </div>
  <script type="text/javascript">
  $(document).ready(function(){
       
    
      $.ajaxSetup({
        headers:{
          'X-CSRF-Token' : $("input[name=_token]").val()
        }
      });
   
      $('#dt-multi-checkbox').Tabledit({
        url:'{{ route("tabledit.action") }}',
        dataType:"json",
        warningClass:"table-success",
        dangerClass:"table-danger",
        columns:{
          identifier:[1, 'id'],
          editable:[[2, 'title'], [3, 'parent_id', '{@foreach ($categoryList as $categoryOption) "{{ (string) $categoryOption->id }}":"{{ (string) $categoryOption->id_title }}"{{ ($loop->last ? '' : ',') }}@endforeach }']]       
        },  //[3, 'parent_id']] [3, 'gender', '{"1":"Male", "2":"Female"}']
        
        restoreButton:false,
        onSuccess:function(data, textStatus, jqXHR)
        {
          if(data.action == 'delete')
          {
            $('#'+data.id).remove();
          }
          console.log('textStatus');
          console.log(textStatus);
          console.log(jqXHR.responseJSON);
          console.log(jqXHR);
          
          $('#dt-multi-checkbox_wrapper .row:first-child>.col-md-6:first-child').html('<span class="alert alert-success" role="alert">Зміни збережено</span>');
          setTimeout(function(){
            $('#dt-multi-checkbox_wrapper .row:first-child>.col-md-6:first-child span').fadeOut(1000);
          },2500);
      
        },
        onAjax: function(action, data, serialize) {
            console.log(action);
            console.log('serialize');
            console.log(data);
            
            if (action === 'edit') {
                  /*for (let prop in data) { 
                    if (!$.trim(data[prop].value).length ) {
                      console.log("NO DATA!");
                      console.log(data[prop]);
                      $('.wrapper-editor').html('error');
                      return false;
                    }
                   */   $('.tabledit-save-button').click(function() {
       
                  var inp = $('input.tabledit-input.form-control').val();
                                  console.log(inp);
                  });
                  var propl = [1,2];
                  //var prr = propl.values();
                   for (let key of propl) { 
                    if (!$.trim(data[key].value).length ) {
                      console.log("NO DATA!");
                      console.log(data[key]);
                      $('.wrapper-editor').html('error');
                      
                      $('input.tabledit-input.form-control:enabled').attr({
                        'data-toggle':"tooltip", 'data-placement':"top", 'title':"Заповніть поле",
                      }).addClass('alert-warning');
                      
                      setTimeout(function(){
                        $('input.alert-warning').removeClass('alert-warning');
                      },3000);
                      
                      
                        $('[data-toggle="tooltip"]').tooltip('show');
                     
                      
                      //return false;
                    }
                  }
                     
            } 
        },
        onFail: function(jqXHR, textStatus, errorThrown) {
          var errors = jqXHR.responseJSON
          if (errors) {
            $('#errorEdit').hide().fadeIn('slow');
            nM(errors);
            }
          }
      });

        function nM (errors) {
          $.each(errors, function (key, data) {
            $.each(data, function (index, data) {
              $("#errorEdit ul")
                .append('<li>'+data+'</li>');
            })
          });
          $('#errorEdit').fadeOut(10000);
        }
        
      //});
      
  });  
  </script>
  </section>
    <!--FOOTER-->
@endsection
