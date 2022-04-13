<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Items</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
</head>
<body>
    <div class="container">
        <div class="col-md-12" style="margin-top: 20px"><a href="{{ route('item.add') }}">Add Item</a> | <a href="{{ route('items.list') }}">View Item</a></div>
          <div class="row" style="margin-top: 30px">
            <div class="col-md-3"></div>
              <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">ADD NEW ITEM</div>
                        <div class="card-body">
                            @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

                            <form action="{{ route('add.item') }}" method="post" id="add-company-form" autocomplete="off">
                                @csrf
                                <div class="form-group ">
                                    <label for="">Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Enter Item name">
                                    <span class="text-danger error-text name_error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="">Quantity</label>
                                    <input type="text" class="form-control" name="qty" placeholder="Enter Quantity">
                                    <span class="text-danger error-text qty_error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="">Brand</label>
                                    <input type="text" class="form-control" name="brand" placeholder="Enter Brand">
                                    <span class="text-danger error-text brand_error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="">Buying Price</label>
                                    <input type="text" class="form-control" name="buying_price" placeholder="Enter Buying Price">
                                    <span class="text-danger error-text buying_price_error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="">Profit Price</label>
                                    <input type="text" class="form-control" name="profit_margin" placeholder="Enter Profit Margin">
                                    <span class="text-danger error-text profit_margin_error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="">Selling Price</label>
                                    <input type="text" class="form-control" name="selling_price" placeholder="Enter Selling Price">
                                    <span class="text-danger error-text selling_price_error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="">Warranty</label>
                                    <input type="text" class="form-control" name="warranty" placeholder="Enter Warranty">
                                    <span class="text-danger error-text warranty_error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="">Expiry Date</label>
                                    <input type="text" class="form-control" name="expiry_date" placeholder="Enter Expiry Date">
                                    <span class="text-danger error-text expiry_date_error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="">Status</label>
                                    <select name="status" class="form-control">
                                        <option value="Active">Active</option>
                                        <option value="Inactive">In Active</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-block btn-success">SAVE</button>
                                </div>
                            </form>
                        </div>
                    </div>
              </div>
              <div class="col-md-3"></div>
          </div>

    </div>
    @include('edit-item-modal')
    <script src="{{ asset('jquery/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('datatable/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('toastr/toastr.min.js') }}"></script>
    <script>

         toastr.options.preventDuplicates = true;

         $.ajaxSetup({
             headers:{
                 'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
             }
         });


         $(function(){

                //ADD NEW COUNTRY
                $('#add-company-form').on('submit', function(e){
                    e.preventDefault();
                    var form = this;
                    $.ajax({
                        url:$(form).attr('action'),
                        method:$(form).attr('method'),
                        data:new FormData(form),
                        processData:false,
                        dataType:'json',
                        contentType:false,
                        beforeSend:function(){
                             $(form).find('span.error-text').text('');
                        },
                        success:function(data){
                             if(data.code == 0){
                                   $.each(data.error, function(prefix, val){
                                       $(form).find('span.'+prefix+'_error').text(val[0]);
                                   });
                             }else{
                                 $(form)[0].reset();
                                //  alert(data.msg);
                                $('#companies-table').DataTable().ajax.reload(null, false);
                                toastr.success(data.msg);
                             }
                        }
                    });
                });

                //GET ALL COMPANIES
               var table =  $('#companies-table').DataTable({
                     processing:true,
                     info:true,
                     ajax:"{{ route('get.items.list') }}",
                     "pageLength":50,
                     "aLengthMenu":[[5,10,25,50,-1],[5,10,25,50,"All"]],
                     columns:[
                         {data:'checkbox', name:'checkbox', orderable:false, searchable:false},
                         {data:'DT_RowIndex', name:'DT_RowIndex'},
                         {data:'name', name:'name'},
                         {data:'brand', name:'brand'},
                         {data:'qty', name:'qty'},
                         {data:'buying_price', name:'buying_price'},
                         {data:'profit_margin', name:'profit_margin'},
                         {data:'selling_price', name:'selling_price'},
                         {data:'actions', name:'actions', orderable:false, searchable:false},
                     ]
                }).on('draw', function(){
                    $('input[name="company_checkbox"]').each(function(){this.checked = false;});
                    $('input[name="main_checkbox"]').prop('checked', false);
                    $('button#deleteAllBtn').addClass('d-none');
                });

                $(document).on('click','#editCompanyBtn', function(){
                    var id = $(this).data('id');
                    $('.editCompany').find('form')[0].reset();
                    $('.editCompany').find('span.error-text').text('');
                    $.post('<?= route("get.item.details") ?>',{id:id}, function(data){
                        //  alert(data.details.country_name);
                        $('.editCompany').find('input[name="id"]').val(data.details.id);
                        $('.editCompany').find('input[name="name"]').val(data.details.name);
                        $('.editCompany').find('input[name="brand"]').val(data.details.brand);
                        $('.editCompany').find('input[name="qty"]').val(data.details.qty);
                        $('.editCompany').find('input[name="buying_price"]').val(data.details.buying_price);
                        $('.editCompany').find('input[name="profit_margin"]').val(data.details.profit_margin);
                        $('.editCompany').find('input[name="selling_price"]').val(data.details.selling_price);
                        $('.editCompany').find('input[name="warranty"]').val(data.details.warranty);
                        $('.editCompany').find('input[name="expiry_date"]').val(data.details.expiry_date);
                        $('.editCompany').find('input[name="status"]').val(data.details.status);
                        $('.editCompany').modal('show');
                    },'json');
                });

                //UPDATE COUNTRY DETAILS
                $('#update-company-form').on('submit', function(e){
                    e.preventDefault();
                    var form = this;
                    $.ajax({
                        url:$(form).attr('action'),
                        method:$(form).attr('method'),
                        data:new FormData(form),
                        processData:false,
                        dataType:'json',
                        contentType:false,
                        beforeSend: function(){
                             $(form).find('span.error-text').text('');
                        },
                        success: function(data){
                              if(data.code == 0){
                                  $.each(data.error, function(prefix, val){
                                      $(form).find('span.'+prefix+'_error').text(val[0]);
                                  });
                              }else{
                                  $('#companies-table').DataTable().ajax.reload(null, false);
                                  $('.editCompany').modal('hide');
                                  $('.editCompany').find('form')[0].reset();
                                  toastr.success(data.msg);
                              }
                        }
                    });
                });

                //DELETE COMPANY RECORD
                $(document).on('click','#deleteCompanyBtn', function(){
                    var id = $(this).data('id');
                    var url = '<?= route("delete.item") ?>';

                    swal.fire({
                         title:'Are you sure?',
                         html:'You want to <b>delete</b> this item',
                         showCancelButton:true,
                         showCloseButton:true,
                         cancelButtonText:'Cancel',
                         confirmButtonText:'Yes, Delete',
                         cancelButtonColor:'#d33',
                         confirmButtonColor:'#556ee6',
                         width:300,
                         allowOutsideClick:false
                    }).then(function(result){
                          if(result.value){
                              $.post(url,{id:id}, function(data){
                                   if(data.code == 1){
                                       $('#companies-table').DataTable().ajax.reload(null, false);
                                       toastr.success(data.msg);
                                   }else{
                                       toastr.error(data.msg);
                                   }
                              },'json');
                          }
                    });

                });

           $(document).on('click','input[name="main_checkbox"]', function(){
                  if(this.checked){
                    $('input[name="company_checkbox"]').each(function(){
                        this.checked = true;
                    });
                  }else{
                     $('input[name="company_checkbox"]').each(function(){
                         this.checked = false;
                     });
                  }
                  toggledeleteAllBtn();
           });

           $(document).on('change','input[name="company_checkbox"]', function(){

               if( $('input[name="company_checkbox"]').length == $('input[name="company_checkbox"]:checked').length ){
                   $('input[name="main_checkbox"]').prop('checked', true);
               }else{
                   $('input[name="main_checkbox"]').prop('checked', false);
               }
               toggledeleteAllBtn();
           });


           function toggledeleteAllBtn(){
               if( $('input[name="company_checkbox"]:checked').length > 0 ){
                   $('button#deleteAllBtn').text('Delete ('+$('input[name="company_checkbox"]:checked').length+')').removeClass('d-none');
               }else{
                   $('button#deleteAllBtn').addClass('d-none');
               }
           }


           $(document).on('click','button#deleteAllBtn', function(){
               var checkedCompanies = [];
               $('input[name="company_checkbox"]:checked').each(function(){
                   checkedCompanies.push($(this).data('id'));
               });

               var url = '{{ route("delete.selected.items") }}';
               if(checkedCompanies.length > 0){
                   swal.fire({
                       title:'Are you sure?',
                       html:'You want to delete <b>('+checkedCompanies.length+')</b> companies',
                       showCancelButton:true,
                       showCloseButton:true,
                       confirmButtonText:'Yes, Delete',
                       cancelButtonText:'Cancel',
                       confirmButtonColor:'#556ee6',
                       cancelButtonColor:'#d33',
                       width:300,
                       allowOutsideClick:false
                   }).then(function(result){
                       if(result.value){
                           $.post(url,{countries_ids:checkedCompanies},function(data){
                              if(data.code == 1){
                                  $('#companies-table').DataTable().ajax.reload(null, true);
                                  toastr.success(data.msg);
                              }
                           },'json');
                       }
                   })
               }
           });
        



         });

    </script>
</body>
</html>